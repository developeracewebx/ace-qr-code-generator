<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://acewebx.com/
 * @since      1.0.0
 *
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/admin
 * @author     AceWebX <webb.xpert01@gmail.com>
 */
class Ace_Qr_Code_Generator_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ace_Qr_Code_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ace_Qr_Code_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ace-qr-code-generator-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ace_Qr_Code_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ace_Qr_Code_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ace-qr-code-generator-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function aceAdminMenuQrcode(){
		
		add_menu_page( 
			__( 'Ace QR Code Generator', 'ace-qr-code-generator' ), // Page Title
			__( 'Ace QR Code Generator', 'ace-qr-code-generator' ), // Menu Title
			'manage_options', // Accessibility
			'ace-qr-code-generator', // Pags Slug
			[$this,'ace_qr_generatorCallback'], // Callback Function
			'dashicons-admin-tools', // Menu Icon
			40,
		);

	}

	public function ace_qr_generatorCallback(){
        $qr_code_text= get_option("qr-code");
		if (isset($_POST['qr-code-submit'])){
			$arr_qr = array();
			foreach ($qr_code_text as $key => $label) $arr_qr[$key] = $_POST[$key];
			update_option("qr-code", $arr_qr);
		}
		include( plugin_dir_path( __FILE__ ) . 'partials/ace-qr-code-generator-admin-display.php');
	}

}
