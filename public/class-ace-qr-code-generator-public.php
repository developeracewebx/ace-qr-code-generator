<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://acewebx.com/
 * @since      1.0.0
 *
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/public
 * @author     AceWebX <webb.xpert01@gmail.com>
 */
//require_once(dirname(__FILE__) . '/InfiQrs/InfiQr/qrlib.php');
class Ace_Qr_Code_Generator_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ace-qr-code-generator-public.css', array(), time(), 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ace-qr-code-generator-public.js', array( 'jquery' ), time(), true );
        //wp_localize_script('custom-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	}
	public function aceOnReadyQRHandler(){
		add_shortcode('ace-qr-code-generator', [$this, 'qrcodeShortcodeCallback']);
	}

	public function qrcodeShortcodeCallback( $atts ){
		
		$shortcodeAtts = shortcode_atts( array(
			'tool' => 'qr-code'
		), $atts );

		$file = plugin_dir_path( __FILE__ ) . "partials/Shortcode/" . $shortcodeAtts['tool'] . ".php";
		if( ! file_exists($file) ) $file = plugin_dir_path( __FILE__ ) . "partials/Shortcode/qr-code.php";

		ob_start();
			include( $file );
		return ob_get_clean();
	}


		public function get_qr_code_generator()
		{

			
			require_once(dirname(__FILE__) . '/library/infiQr.php');
             
			$this->flush_old_qrs();  // remove all old qrs expect last 50
			$milliseconds = floor(microtime(true) * 1000);
			$PNG_TEMP_DIR =  'qrcodes/';
			$filename = $PNG_TEMP_DIR . $milliseconds . '.png';
			$errorCorrectionLevel = 'L';
			/* if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
			$errorCorrectionLevel = $_REQUEST['level'];  */
			$Qrtype = $_POST['data'];

			$newArr = ["Qrtype" => $Qrtype];
			$jsonObj = json_encode($newArr);
			//createToolLog("QR Generator", $jsonObj);
			$Qrtype=$Qrtype['action'];
			
			switch ($Qrtype) {
				case 'plain_texts':
					$codeContents = $_POST['data']['plainText'];
					break;
				case 'phone_numbers':
					// $codeContents = 'tel:'.$_POST['phoneNo'];
					$codeContents  = 'BEGIN:VCARD' . "\n";
					$codeContents  .= 'tel:' . $_POST['data']['c_home'] . "\n";
					$codeContents .= 'FN:' . $_POST['data']['c_name'] . "\n";
					$codeContents .= 'TEL;WORK;VOICE:' . $_POST['data']['c_work'] . "\n";
					$codeContents .= 'TEL;TYPE=cell:' . $_POST['data']['c_cell'] . "\n";
					$codeContents .= 'EMAIL:' . $_POST['data']['c_email'] . "\n";
					$codeContents .= 'END:VCARD';
					break;
				case 'web_url':
					$codeContents = $_POST['data']['url'];
					break;
				case 'sms':
					$number = $_POST['data']['usrnmbr'];
					$message = $_POST['data']['usrmsg'];
					$codeContents = 'sms:' . $number;
					$codeContents .= ':' . $message;
					break;
				case 'business_cards':
					// here our data
					$name = $_POST['data']['b_name'];
					$phone = $_POST['data']['b_phone'];
					$email = $_POST['data']['b_email'];
					// we building raw data
					$codeContents  = 'BEGIN:VCARD' . "\n";
					$codeContents .= 'FN:' . $name . "\n";
					$codeContents .= 'TEL;WORK;VOICE:' . $phone . "\n";
					$codeContents .= 'EMAIL:' . $email . "\n";
					$codeContents .= 'END:VCARD';
					break;
				default:
					break;
			}
			$path= ACE_QR_PLUGIN_PATH.$filename;
			$infiqr = new Infiqr();
			$data=$infiqr->generate($codeContents, "png",$path,$errorCorrectionLevel);
			//echo $codeContents;
			//QRcode::png($codeContents, $filename, $errorCorrectionLevel, 5);
				//
			$data['ress'] = plugins_url('ace-qr-code-generator/qrcodes') . '/' . basename($filename);
			
			echo json_encode($data);

			exit;
	   
	}
	public function flush_old_qrs()
		{
			$mydir = ACE_QR_PLUGIN_PATH."/qrcodes";

			if (!is_dir($mydir)) {

				
				 mkdir($mydir, 0770, true);
				
			/// echo 'Directory created successfully: ' . $mydir;
			} 

			$dir = $mydir."qrcodes/";

			foreach(glob($dir.'*.*') as $v){
				unlink($v);
			}
		
			
		}
}