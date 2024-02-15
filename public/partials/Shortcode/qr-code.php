<?php $qr_code = get_option("qr-code"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<div id="qrGen" class="col col_8_of_12">
     <div class="page_title">
         <div>
             <h1><?php echo $qr_code['Qr-code-title'] ; ?></h1>
         </div>
     </div>
     <div class="clearfix"></div>
     <div class="row">
         <div class="col col_12_of_12 qr-code-generetors">
             <p><?php echo $qr_code['Qr-code-description'] ; ?></p>
         <ul class="nav nav-tabs" id="qrOptions" role="tablist">
             <li class="nav-item">
                 <a class="nav-link active" id="url-tab" data-toggle="tab" href="#url" data-opt="web_url" role="tab" aria-controls="url" aria-selected="true">
                    <i class="fas fa-link"></i><?php echo $qr_code['url-tab'] ; ?> 
                </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" id="plainText-tab" data-toggle="tab" href="#plainText" data-opt="plain_texts" role="tab" aria-controls="plainText" aria-selected="false">
                    <i class="fas fa-file-alt"></i><?php echo $qr_code['Plaint-text-tab'] ; ?> 
                </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" data-opt="phone_numbers" role="tab" aria-controls="contact" aria-selected="false">
                    <i class="fas fa-address-book"></i> <?php echo $qr_code['contact-tab'] ; ?>
                </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" id="businessCard-tab" data-toggle="tab" href="#businessCard" data-opt="business_cards" role="tab" aria-controls="businessCard" aria-selected="false">
                    <i class="fas fa-id-card"></i><?php echo $qr_code['business-card-tab'] ; ?>
                </a>
             </li>
             <li class="nav-item">
                 <a class="nav-link" id="sms-tab" data-toggle="tab" href="#sms" role="tab" data-opt="sms" aria-controls="sms" aria-selected="false"> 
                    <i class="fas fa-envelope"></i> <?php echo $qr_code['sms-tab'] ; ?>
                </a>
             </li>
         </ul>
         
         <div class="tab-content" id="qrTabContent">
             <div class="tab-pane fade show active" id="url" role="tabpanel" aria-labelledby="url-tab" >
                 <div id="web_url" class="box">
                     <div class="row">
                         <div class="col col col_12_of_12">
                            <div class="tab-fields">
                                <div class="field-collunm">
                                     <div class="chboxl"><label><strong><?php echo $qr_code['url-text'] ; ?></strong></label></div>
                                     <div class="chboxr input-group">
                                        <input type="text" name="web_urls" id="web_urls" placeholder="Enter Url (https://example.com)">
                                        <div class="invalid-feedback">
                                            This is not a valid link.
                                        </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="tab-pane fade" id="plainText" role="tabpanel" aria-labelledby="plainText-tab">
                <div id="plain_texts" class="box">
                    <div class="row">
                        <div class="col col col_12_of_12">
                            <div class="tab-fields">
                                <div class="field-collunm">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['text'] ; ?></strong></label></div>
                                    <div class="chboxr">
                                        <input type="text" name="user_text" id="user_text" placeholder="Enter Text Here">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
             <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div id="phone_numbers" class="box">
                    <div class="row">
                        <div class="col col col_12_of_12">
                            <div class="tab-fields">
                                <div class="field-collunm">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['name-text'] ; ?></strong></label></div>
                                    <div>
                                        <input type="text" name="c_name" id="c_name" placeholder="Name">
                                    </div>
                                </div>
                               
                                <div class="field-collunm">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['personal-number-text'] ; ?></strong></label></div>
                                    <div class="chboxr">
                                        <input type="number" name="c_home" id="c_home" placeholder="Personal Number">
                                    </div>
                                </div>
                                <div class="field-collunm">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['work-text'] ; ?></strong></label></div>
                                    <div>
                                        <input type="number" name="c_work" id="c_work" placeholder="Work Number">
                                    </div>
                                </div>
                                <div class="field-collunm">
                                    <div class="chboxl">
                                        <label><strong><?php echo $qr_code['cell-text'] ; ?></strong></label>
                                    </div>
                                    <div>
                                        <input type="number" name="c_cell" id="c_cell" placeholder="Cell Number">
                                    </div>
                                </div>
                                <div class="field-collunm">
                                    <div class="chboxl">
                                        <label><strong><?php echo $qr_code['email-for-contact-text'] ; ?></strong></label>
                                    </div>
                                    <div>
                                        <input type="text" name="c_email" id="c_email" placeholder="Email">
                                        <div class="invalid-feedback">
                                            This is not valid email.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            
             <div class="tab-pane fade" id="businessCard" role="tabpanel" aria-labelledby="businessCard-tab">
                <div id="business_cards" class="box">
                    <div class="row">
                        <div class="col col col_12_of_12">
                            <div class="tab-fields">
                                <div class="field-collunm">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['business-name-text'] ; ?></strong></label></div>
                                    <div>
                                        <input type="text" name="b_name" id="b_name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="field-collunm">
                                    <div class="chboxl">
                                        <label><strong><?php echo $qr_code['business-phone-text'] ; ?></strong></label>
                                    </div>
                                    <div>
                                        <input type="number" name="b_phone" id="b_phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="field-collunm">
                                    <div class="chboxl">
                                        <label><strong><?php echo $qr_code['email-text'] ; ?></strong></label>
                                    </div>
                                    <div>
                                        <input type="text" name="b_email" id="b_email" placeholder="Email">
                                        <div class="invalid-feedback">
                                            This is not valid email.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
             <div class="tab-pane fade" id="sms" role="tabpanel" aria-labelledby="sms-tab">
                <div id="sms" class="box">
                    <div class="row">
                        <div class="col col col_12_of_12">
                            <div class="tab-fields">
                                <div class="field-collunm full">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['number-text'] ; ?></strong></label></div>
                                    <div class="chboxr">
                                        <input type="number" name="sms_number" id="sms_number" placeholder="Number">
                                    </div>
                                </div>
                                <div class="field-collunm full">
                                    <div class="chboxl"><label><strong><?php echo $qr_code['message-text'] ; ?></strong></label></div>
                                    <div class="chboxr">
                                        <textarea name="sms_message" id="sms_message" placeholder="Message"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
             <div class="row">
                 <div class="col col col_12_of_12 mt-3">
                     <button class="btn-block mybutton Generateqr" id="Generateqr"><?php echo $qr_code['button-title'];?></button>
                 </div>
             </div>
            
             <div class="row mx-0 mt-3" id="qrError"></div>

             <div class="row d-none" id="qrLoader">
                <div class="col-md-12 text-center">
                    <img class="qrLoader" src="/wp-content/plugins/ace-qr-code-generator/public/image/loader.gif" alt="">
                 </div>
             </div>
             <div class="row d-none" id="showQr">
                 <div class="col-md-12 text-center">
                     <div class="showQr">
                         <div class="chboxl">
                             <label><strong class="genHead"><?php echo $qr_code['generated-message-title'] ;?></strong></label>
                         </div>
                         <div class="chboxl">
                             <div class="col-md-6 col-lg-4 mx-auto text-center qr-download" id="genQR">
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         </div>
     </div>

   