<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register item Post type
 */
add_action( 'init', 'themeqx_cfptwc_init_function' );
function themeqx_cfptwc_init_function() {

    /**
     * Get contact Messages
     */
    $labels = array(
        'name'               => _x( 'cfptwc_msgs', 'post type general name', 'contact-from-product-tab-woocommerce' ),
        'singular_name'      => _x( 'cfptwc_msg', 'post type singular name', 'contact-from-product-tab-woocommerce' ),
        'menu_name'          => _x( 'CFPTWC', 'admin menu', 'contact-from-product-tab-woocommerce' ),
        'name_admin_bar'     => _x( 'cfptwc_msg', 'add new on admin bar', 'contact-from-product-tab-woocommerce' ),
        'add_new'            => _x( 'Add New', 'cfptwc_msg', 'contact-from-product-tab-woocommerce' ),
        'add_new_cfptwc_msg'       => __( 'Add New cfptwc_msg', 'contact-from-product-tab-woocommerce' ),
        'new_cfptwc_msg'           => __( 'New cfptwc_msg', 'contact-from-product-tab-woocommerce' ),
        'edit_cfptwc_msg'          => __( 'Edit cfptwc_msg', 'contact-from-product-tab-woocommerce' ),
        'view_cfptwc_msg'          => __( 'View cfptwc_msg', 'contact-from-product-tab-woocommerce' ),
        'all_cfptwc_msgs'          => __( 'All cfptwc_msgs', 'contact-from-product-tab-woocommerce' ),
        'search_cfptwc_msgs'       => __( 'Search cfptwc_msgs', 'contact-from-product-tab-woocommerce' ),
        'parent_cfptwc_msg_colon'  => __( 'Parent cfptwc_msgs:', 'contact-from-product-tab-woocommerce' ),
        'not_found'          => __( 'No cfptwc_msgs found.', 'contact-from-product-tab-woocommerce' ),
        'not_found_in_trash' => __( 'No cfptwc_msgs found in Trash.', 'contact-from-product-tab-woocommerce' )
    );
    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'themeqx' ),
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'cfptwc_msgs' ),
        'capability_type'    => 'post',
        'menu_icon'           => 'dashicons-email',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => false
    );
    register_post_type( 'cfptwc_msgs', $args );
}

/**
 * @return mixed
 */

if ( ! function_exists('cfptwc_get_the_user_ip')) {
    function cfptwc_get_the_user_ip(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}

/**
 * Saving settings
 */
if ( ! empty($_POST['themeqx_cfptwc_settings'])){
    $themeqx_cfptwc_settings = $_POST['themeqx_cfptwc_settings'];
    if (count($themeqx_cfptwc_settings) > 0){
        foreach($themeqx_cfptwc_settings as $name => $value){
            if (strpos($value, "\n") !== false) {
                $themeqx_cfptwc_settings[$name] = implode( "\n", array_map( 'sanitize_text_field', explode( "\n", $value ) ) );
            }else{
                $themeqx_cfptwc_settings[$name] = sanitize_text_field($value);
            }
        }
    }
    add_action( 'admin_notices', 'themeqx_cfptwc_admin_notice__success' );
}

/**
 * @param string $key
 * @return bool|mixed|void
 */

if ( ! function_exists('get_cfptwc_option')) {
    function get_cfptwc_option($key = ''){
        $option = maybe_unserialize(get_option('themeqx_cfptwc_option'));
        if ($option) {
            if (is_array($option)) {
                if (key_exists($key, $option)) {
                    return $option[$key];
                }
                return $key;
            }
        }
        return $option;
    }
}

/**
 * Save custom field
 */
if ( ! empty($_POST['cfptwc_custom_fields'])){
    $cfptwc_custom_fields = $_POST['cfptwc_custom_fields'];
    if (! empty($cfptwc_custom_fields['field_title']) && ! empty($cfptwc_custom_fields['field_name'] )){
        foreach ($cfptwc_custom_fields as $key => $value){
            $cfptwc_custom_fields[$key] = sanitize_text_field($value);
        }

        $previous_fields = get_option('cfptwc_custom_fields');
        $previous_fields[$cfptwc_custom_fields['field_name']] = $cfptwc_custom_fields;

    }
}

function themeqx_cfptwc_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <h1 class="noticed_promotion"><a href="https://codecanyon.net/item/woocommerce-product-tab-contact-form/18916603?ref=themeqx" target="_blank">Get Pro Version to Unlock More Benefits</a> </h1>
    </div>
    <?php
    //update_option('themeqx_cfptwc_option', $themeqx_cfptwc_settings);
    //update_option('cfptwc_custom_fields', $previous_fields);
}
