<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Declare ajax class
 */
if ( ! class_exists('THEMEQX_WPSUB_AJAX')){
    class THEMEQX_WPSUB_AJAX{
        /**
         * @var null
         */
        protected static $_instance = null;

        /**
         * @return null|THEMEQX_WPSUB_AJAX
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * THEMEQX_WPSUB_BASE constructor.
         */
        public function __construct(){
            add_action('wp_ajax_cfptwc_save_form_data', array($this, 'themeqx_cfptwc_save_form_data'));
            add_action('wp_ajax_nopriv_cfptwc_save_form_data', array($this, 'themeqx_cfptwc_save_form_data'));
            
            add_action('wp_ajax_cfptwc_edit_custom_field', array($this, 'themeqx_cfptwc_edit_custom_field'));
            add_action('wp_ajax_cfptwc_delete_custom_field', array($this, 'themeqx_cfptwc_delete_custom_field'));
        }

        /**
         * Ajax add lookup
         */
        public function themeqx_cfptwc_save_form_data(){
            global $wpdb;

            if (is_user_logged_in()){
                $user = wp_get_current_user();

                $author_name = $user->display_name;
                $email = $user->user_email;
            }else {
                $author_name = sanitize_text_field($_POST['author_name']);
                $email = sanitize_text_field($_POST['email']);
            }


            $subject = sanitize_text_field($_POST['subject']);
            $cfptwc_product_id = (int) sanitize_text_field($_POST['cfptwc_product_id']);
            $message = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $_POST['message'] ) ) );
            $message = str_replace("\n", "<br>",$message);

            $cfptwc_messages = array(
                'sender_name' => $author_name,
                'email' => $email,
            );

            /**
             * Getting custom field type value from post
             */
            $cfptwc_custom_fields = get_option('cfptwc_custom_fields');
            if ($cfptwc_custom_fields && is_array($cfptwc_custom_fields)){
                foreach ($cfptwc_custom_fields as $field_name => $field_value){
                    if ( ! empty($_POST[$field_name])){
                        if (is_array($_POST[$field_name])){
                            $custom_post_item = sanitize_text_field(implode(',',$_POST[$field_name] ));
                        }else{
                            $custom_post_item = sanitize_text_field($_POST[$field_name]);
                        }
                        $cfptwc_messages[$field_name] = $custom_post_item;
                    }
                }
            }

            $cfptwc_messages['message'] = $message;
            $cfptwc_messages['ip_address'] = cfptwc_get_the_user_ip();

            //Save it Also in Posts
            $insert_as_custom_post = wp_insert_post(
                array(
                    'post_title'    =>$subject,
                    'post_type'     =>'cfptwc_msgs',
                    'post_content'  => json_encode($cfptwc_messages),
                    'post_status'   => 'publish',
                    'post_parent'   => $cfptwc_product_id
                )
            );

            $product_name = get_the_title($cfptwc_product_id);
            if ($insert_as_custom_post){
                //Send email notification to admin if it enabled
                if (get_cfptwc_option('enable_email_notification_to_admin') == 1){
                    $subject = get_cfptwc_option('admin_email_notification_subject');

                    ob_start();
                    include CFPTWC_DIR.'views/emails/admin_email_notification.php';
                    $user_email_content = ob_get_clean();

                    $template_variable = array(
                        '{sender_name}', '{message}', '{product_name}', '{subject}'
                    );
                    $replaced_template_variable = array(
                        $author_name, $message, $product_name, $subject
                    );

                    $user_email_content = str_replace($template_variable, $replaced_template_variable, $user_email_content);
                    $subject = str_replace($template_variable, $replaced_template_variable, $subject);

                    $admin_email = get_cfptwc_option('receiving_email_address')? get_cfptwc_option('receiving_email_address') : get_option('admin_email');


                    $headers = array("Content-Type: text/html; charset=UTF-8;", "Reply-To: {$author_name} <{$email}>");
                    $send_to_user_mail = wp_mail($admin_email, $subject, $user_email_content, $headers);
                }

                //Send thank you email to user if it enabled
                if (get_cfptwc_option('send_email_to_user_after_contact') == 1){
                    $subject = get_cfptwc_option('sender_email_subject');

                    ob_start();
                    include CFPTWC_DIR.'views/emails/response_email_after_contact.php';
                    $user_email_content = ob_get_clean();

                    $template_variable = array(
                        '{sender_name}', '{message}', '{product_name}', '{subject}'
                    );
                    $replaced_template_variable = array(
                        $author_name, $message, $product_name, $subject
                    );

                    $user_email_content = str_replace($template_variable, $replaced_template_variable, $user_email_content);
                    $subject = str_replace($template_variable, $replaced_template_variable, $subject);

                    $headers = array("Content-Type: text/html; charset=UTF-8;");
                    $send_to_user_mail = wp_mail($email, $subject, $user_email_content, $headers);
                }

                $form_submitted_msg = get_cfptwc_option('form_submit_msg');
                
                die(json_encode(array('status' => 1, 'msg' => $form_submitted_msg )));
            }
            die(json_encode(array('status' => 0, 'msg' => __('Something went wrong, please try again', 'contact-from-product-tab-woocommerce'))));
        }

        
        public function themeqx_cfptwc_edit_custom_field(){
            $field_name = sanitize_text_field($_POST['field_name']);
            include CFPTWC_DIR.'admin/view/edit_custom_field.php';
            die();
        }
        public function themeqx_cfptwc_delete_custom_field(){
            $field_name = sanitize_text_field($_POST['field_name']);
            $previous_fields = get_option('cfptwc_custom_fields');
            unset($previous_fields[$field_name]);
            update_option('cfptwc_custom_fields', $previous_fields);
            die();
        }

    }
}


/**
 * Initialize The Class
 */
THEMEQX_WPSUB_AJAX::instance();
