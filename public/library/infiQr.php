<?php 

/**
 * InfiQr Codeigniter Qr Code generator Library
 *
 * Generate Qr code in your CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			Naseem Fasal
 * @license			None
 * @link			https://github.com/naseemfasal
 */

require_once(dirname(__FILE__) . '/phpqrcode/qrlib.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
class Infiqr 
{


	public function generate($conents,$type,$path,$errorCorrectionLevel)
	{
		    QRcode::$type($conents,$path,$errorCorrectionLevel,10,10); 

	}
}
