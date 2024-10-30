<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Declare main class
 */
if ( ! class_exists('THEMEQX_CFPTWC_ADMIN_MENU')){
    class THEMEQX_CFPTWC_ADMIN_MENU{
        /**
         * @var null
         */
        protected static $_instance = null;

        /**
         * @return null|THEMEQX_CFPTWC_ADMIN_MENU
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
            add_action('admin_menu', array($this, 'themeqx_cfptwc_admin_menu'));

            add_action( 'add_meta_boxes', array($this, 'themeqx_cfptwc_register_contact_msg_meta_boxes') );

        }


        /**
         * Main dashboard
         */
        public function themeqx_cfptwc_dashboard(){
            include CFPTWC_DIR.'admin/view/settings_general_tab.php';
        }

        public function themeqx_cfptwc_admin_menu(){
            add_submenu_page('edit.php?post_type=cfptwc_msgs',__('CFPTWC Settings'), __('CFPTWC Settings'),'manage_options','cfptwc', array($this, 'themeqx_cfptwc_dashboard') );
        }


        /**
         * Register meta box(es) for view contact messages.
         */
        function themeqx_cfptwc_register_contact_msg_meta_boxes() {
            add_meta_box( 'cfptwc-contact-msg-details', __( 'Contact Message', 'contact-from-product-tab-woocommerce' ), array($this, 'themeqx_cfptwc_register_contact_msg_meta_boxes_view'), 'cfptwc_msgs' );
        }
        function themeqx_cfptwc_register_contact_msg_meta_boxes_view( $post ) {
            include CFPTWC_DIR.'/views/contact_msgs_view_meta_box.php';
        }


    }
}


/**
 * Initialize Main Class
 */
THEMEQX_CFPTWC_ADMIN_MENU::instance();