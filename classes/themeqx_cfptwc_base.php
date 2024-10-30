<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Declare main class
 */
if ( ! class_exists('THEMEQX_CFPTWC_BASE')){
    class THEMEQX_CFPTWC_BASE{
        /**
         * @var null
         */
        protected static $_instance = null;


        /**
         * @return null|THEMEQX_CFPTWC_BASE
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * THEMEQX_CFPTWC_BASE constructor.
         */
        public function __construct(){
            //Adding initial setup
            register_activation_hook( CFPTWC_BASE_FILE, array($this, 'themeqx_cfptwc_initial_setup') );

            add_action('admin_enqueue_scripts', array($this, 'themeqx_cfptwc_load_script_admin'));
            add_action('wp_enqueue_scripts', array($this, 'themeqx_cfptwc_load_script'));
            add_filter( 'woocommerce_product_tabs', array($this, 'themeqx_contact_form_tab'), 98 );
            add_filter( 'plugin_action_links_' . plugin_basename(CFPTWC_BASE_FILE), array($this, 'themeqx_cfptwc_add_action_links') );
        }


        /**
         * Initial Setup
         */

        public function themeqx_cfptwc_initial_setup(){

            $themeqx_cfptwc_version = get_option('themeqx_cfptwc_version');
            $admin_email = get_option('admin_email');
            $email_length = strlen($admin_email);
            if ( ! $themeqx_cfptwc_version) {
                $options_settings = 'a:8:{s:23:"receiving_email_address";s:'.$email_length.':"'.$admin_email.'";s:15:"form_submit_msg";s:24:"Thank you for your query";s:34:"enable_email_notification_to_admin";s:1:"1";s:32:"admin_email_notification_subject";s:42:"{sender_name} has been placed a new query.";s:33:"admin_email_notification_template";s:103:"Hi

{sender_name} has been placed a new query at {product_name}. Message was below.

{message}

Regards";s:32:"send_email_to_user_after_contact";s:1:"0";s:20:"sender_email_subject";s:28:"Your query has been recieved";s:27:"email_content_after_contact";s:152:"Hi {sender_name}

Thank you for your query at {product_name}, we will contact with you as soon as possible if need. Your message was

{message}

Regards";}';

                update_option('themeqx_cfptwc_version', CFPTWC_VERSION);
                update_option('themeqx_cfptwc_option', $options_settings);
            }


        }


        /**
         * Load Script and or CSS for WooCommerce tabs contact form
         */
        public function themeqx_cfptwc_load_script_admin(){
            wp_enqueue_style('themeqx-cfptwc-admin-style', CFPTWC_URL.'assets/css/cfptwc-admin.css', array(),CFPTWC_VERSION);

            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('themeqx-cfptwc-js-admin', CFPTWC_URL.'assets/js/cfptwc-admin.js', array('jquery'),CFPTWC_VERSION, true);
        }
        public function themeqx_cfptwc_load_script(){
            //wp_enqueue_style('themeqx-cfptwc-style', WPSUB_URL.'assets/css/cfptwc.css', array(),CFPTWC_VERSION);
            wp_enqueue_script('themeqx-cfptwc-js', CFPTWC_URL.'assets/js/cfptwc.js', array('jquery'),CFPTWC_VERSION, true);
            wp_localize_script('themeqx-cfptwc-js', 'cfptwc', array('ajaxurl' => admin_url('admin-ajax.php') ));
        }



        public function themeqx_contact_form_tab($tabs){

            $tabs['themeqx_tabs_contact_form'] = array(
                'title' => apply_filters('cfptwc_contact_form_tab_name', __('Contact form', 'contact-from-product-tab-woocommerce')),
                'priority' => 31,
                'callback' => array($this, 'themeqx_cfptwc_tab_callback')
            );

            return $tabs;
        }

        public function themeqx_cfptwc_tab_callback(){
            include CFPTWC_DIR.'views/themeqx_cfptwc_tab.php';
        }

        function themeqx_cfptwc_add_action_links ( $links ) {
            $mylinks = array(
                '<a href="' . admin_url( 'edit.php?post_type=cfptwc_msgs&page=cfptwc' ) . '">Settings</a>',
            );
            return array_merge( $links, $mylinks );
        }

    }
}


/**
 * Initialize Main Class
 */
THEMEQX_CFPTWC_BASE::instance();

include CFPTWC_DIR.'classes/themeqx_cfptwc_functions.php';
include CFPTWC_DIR.'classes/themeqx_cfptwc_ajax.php';
include CFPTWC_DIR.'classes/themeqx_cfptwc_admin_menu.php';