<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://acewebx.com/
 * @since      1.0.0
 *
 * @package    Ace_Qr_Code_Generator
 * @subpackage Ace_Qr_Code_Generator/admin/partials
 */
$qr_code_text = get_option("qr-code");
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="ace-tools">
<div id="main-content">
            <div id="page-container">
                <div class="card" id="QRcodegenerator" style="display:block;">
                    <div class="title">QR code Generator</div>
                    <div class="content-ace">
                        <ul>
                            <li>
                                <div class="label-heading">
                                    <p>
                                        <label>Shortcode</label><br>
                                        <span><i>Use this shortcode anywhere on website</i></span>
                                    </p>
                                </div>
                                <div class="content-box">
                                    <code>[ace-qr-code-generator tool=qr-code]</code>
                                    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/tools/copy.png' ?>" class="tool-icon" id="copy">
                                    <img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/tools/copying.png' ?>" class="tool-icon copied" style="display:none;">
                                </div>
                            </li> 
                            <form action="#" method="POST" class="qr-code"> 
                            
                            <?php
                                foreach ($qr_code_text as $key => $label): ?>
                                        <li>
                                            <div class="label-heading">
                                                <p>
                                                    <label for="<?php echo $key; ?>"><?php echo str_replace('-', ' ', ucfirst($key)); ?> </label><br>
                                                </p>
                                            </div>
                                            <div class="content-box">
                                                <input type="text" id="<?php echo $key; ?>-title" name="<?php echo $key; ?>" value="<?php echo $qr_code_text[$key]; ?>">
                                            </div>
                                        </li>
                                <?php endforeach; ?>

                                <li>
                                <input type="submit" name="qr-code-submit" class="qr-code" value="Save">
                                </li>
                           
                                        <li>
                                            <div class="label-heading">
                                                <p>
                                                    <label>Preview</label><br>
                                                    <span><i>Check How Tool looks</i></span>
                                                </p>
                                            </div>
                                            <div class="content-box">
                                                <div class="prview-image"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/preview/qr-code-generator.png' ?>" class="preview-img"></div>
                                            </div>
                                        </li>
                        </ul>                      
                    </div>
                </div>
            </div>
</div>
</div>