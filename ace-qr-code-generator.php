<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://acewebx.com/
 * @since             1.0.0
 * @package           Ace_Qr_Code_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       Ace QR Code Generator
 * Plugin URI:        https://wordpress.org/plugins/ace-qr-code-generator
 * Description:       This plugin contain multiple QR code generator, which can be access via short codes.
 * Version:           1.0.0
 * Author:            AceWebX
 * Author URI:        https://acewebx.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ace-qr-code-generator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ACE_QR_CODE_GENERATOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ace-qr-code-generator-activator.php
 */
function activate_ace_qr_code_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ace-qr-code-generator-activator.php';
	Ace_Qr_Code_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ace-qr-code-generator-deactivator.php
 */
function deactivate_ace_qr_code_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ace-qr-code-generator-deactivator.php';
	Ace_Qr_Code_Generator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ace_qr_code_generator' );
register_deactivation_hook( __FILE__, 'deactivate_ace_qr_code_generator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ace-qr-code-generator.php';

define("ACE_QR_PLUGIN_PATH", plugin_dir_path(__FILE__));

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ace_qr_code_generator() {

	$plugin = new Ace_Qr_Code_Generator();
	$plugin->run();

}
run_ace_qr_code_generator();
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/path/to/your/script.js', array('jquery'), null, true);

    wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');





