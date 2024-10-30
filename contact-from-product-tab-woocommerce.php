<?php
/**
 * Plugin Name: Contact From Product Tab WooCommerce
 * Plugin URI: http://www.themeqx.com/
 * Description: An excellent way to get user response from every product in WooCommerce. This is a premium plugin we released for free
 * Version: 2.0.1
 * Author: Themeqx
 * Author URI: http://www.themeqx.com
 * Requires at least: 4.0
 * Tested up to: 4.9
 *
 * Text Domain: contact-from-product-tab-woocommerce
 * Domain Path: /languages/
 *
 */

//Defining constant Constants
define('CFPTWC_VERSION', '2.0.1');
define('CFPTWC_DIR', plugin_dir_path(__FILE__));
define('CFPTWC_URL', plugin_dir_url(__FILE__));
define('CFPTWC_BASE_FILE', __FILE__);

if ( ! defined( 'ABSPATH' ) ) {
    echo "Direct access not allowed";
    exit; // Exit if accessed directly
}

include CFPTWC_DIR.'classes/themeqx_cfptwc_base.php';