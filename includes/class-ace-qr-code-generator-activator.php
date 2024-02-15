<?php

/**
 * Fired during plugin activation
 *
 * @link       https://acewebx.com/
 * @since      1.0.0
 *
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/includes
 * @author     AceWebX <webb.xpert01@gmail.com>
 */
class Ace_Qr_Code_Generator_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$qr_code = array(
			'Qr-code-title' => "QR Code Generator",
			'Qr-code-description' => "Generate a QR Code for a plain text, web URL, SMS message, business card, or contact information.",
			'url-tab' => "URL",
			'url-text'=> "Enter Url:",
			
			'Plaint-text-tab' => "PLAIN TEXT",
            'text' => 'Enter Text:',
			'contact-tab' => "CONTACT",
			'name-text'=>"Name",
			'personal-number-text' =>"Personal Number:",
			"work-text"=>"Work:",
			"cell-text" =>"Cell:",
			"email-for-contact-text" =>"Email:",
			'business-card-tab' =>"BUSINESS CARD",
			"business-name-text"  =>"Name:",
			"business-phone-text" =>"Phone Number:",
			"email-text"=>"Email:",
			'sms-tab' => "SMS",
			"number-text"=>"Number:",
			"message-text"=> "Message:",
			"button-title" => "Generate",
			"generated-message-title"=>"Here is the newly generated QR Code:",
			
		);
		
		if (get_option("qr-code") === false) update_option("qr-code", $qr_code);

	}

}
