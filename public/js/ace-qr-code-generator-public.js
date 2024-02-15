jQuery(document).ready(function($) {
   
	$("#qrOptions .nav-item .nav-link").on('click',function(event) {
		event.preventDefault();
	   if(!$(this).hasClass('active')){
		   $('#qrGen input').val('');
		   $(".Generateqr").prop('disabled', true);
		   $('#genQR').empty();
		   $('#showQr').addClass("d-none");
		   $(".nav-link").removeClass("active");
		   $(this).addClass("active");
		   let display = $(this).attr('href');
		   $(".tab-pane").removeClass('show');
		   $(".tab-pane").removeClass('active');
           $(display).addClass("show");
           $(display).addClass("active");
		  
	   }
	});
	
        
   
	function checkFilled() {
		let state = false;
		$('#qrGen input').each(function() {
			if ($(this).val() !== '') {
				if (!state) {
					state = true;
				}
			}
		});
		if (state) {
			$(".Generateqr").prop('disabled', false);
		} else {
			$(".Generateqr").prop('disabled', true);
		}

	}

	$('#qrGen input').on('input', function() {
		checkFilled();
		$(this).removeClass('is-invalid');
	})

	checkFilled();
	// Log User Activity
// function logUserAction(action) {
// $.ajax({
//  type: "POST",
//  url: "<?php echo base_url('gif/logUserAction'); ?>",
//  data: {
//    action: action
//  }
// });
// }

	$(".Generateqr").click(function(event) {
		
		event.preventDefault();
	   // logUserAction("QR Code Generator Tool");
		$('#showQr').addClass("d-none");
      
		var selQr = $("#qrOptions .nav-item .nav-link.active").data('opt');

		var data = {};

		if(validateQRData(selQr)){

		   if (selQr == 'plain_texts') {
			   var userTxt = $('#user_text').val();

			   data = {
				   'plainText': userTxt
			   };
		   }

		   if (selQr == 'web_url') {
			   var webUrl = $('#web_urls').val();

			   data = {
				   'url': webUrl
			   };
		   }

		   if (selQr == 'sms') {
			   var usrnmbr = $('#sms_number').val();
			   var usrmsg = $('#sms_message').val();

			   data = {
				   'usrnmbr': usrnmbr,
				   'usrmsg': usrmsg
			   };
		   }

		   if (selQr == 'business_cards') {
			   var b_name = $('#b_name').val();
			   var b_phone = $('#b_phone').val();
			   var b_email = $('#b_email').val();

			   data = {
				   'b_name': b_name,
				   'b_phone': b_phone,
				   'b_email': b_email
			   };
		   }


		   if (selQr == 'phone_numbers') {
			   var c_name = $('#c_name').val();
			   var c_work = $('#c_work').val();
			   var c_home = $('#c_home').val();
			   var c_email = $('#c_email').val();
			   var c_cell = $('#c_cell').val();
			   data = {
				   'c_name': c_name,
				   'c_work': c_work,
				   'c_home': c_home,
				   'c_cell': c_cell,
				   'c_email': c_email
			   };
		   }
		   data['action'] = selQr;

		   function fadeError(){
			   $( "#qrError div" ).fadeOut( "slow" );
			   setTimeout(function() {$("#qrError div").remove()}, 2000);
		   }

		   $.ajax({
			url: ajax_object.ajax_url,
            data: {
                action: 'get_qr_code_generator',
                data: data,
            },
            type: "post",

			   beforeSend: function (){
				   $('#qrLoader').removeClass('d-none');
				   $(".Generateqr").prop('disabled', true);
			   },
			   success: function(res) {
				   try {
					   let response = JSON.parse(res);
					   setTimeout(function() {
						$('#qrLoader').addClass('d-none');
						
						
						$('#genQR').html(`
							<img class="w-100" src="${response.ress}">
							<a class="btn btn-primary" href="${response.ress}" role="button" download>Download</a>
						`);
					}, 2000);

					  
						

					   $('#showQr').removeClass("d-none");
				   } catch (error) {
					 
						setTimeout(function() {
							$('#qrLoader').addClass('d-none');
						}, 2000); 

					   $('#qrError').html('<div class="alert alert-danger col-md-12">An error occured while generating QR!</div>');
					   setTimeout(fadeError, 3000)
				   }  
			   },
			   complete: function (){
				   $(".Generateqr").prop('disabled', false);
			   },
			   error: function(){
				   $('#qrLoader').addClass('d-none');
				   $('#qrError').html('<div class="alert alert-danger col-md-12">An error occured while generating QR!</div>');
				   setTimeout(fadeError, 2000)
				   $(".Generateqr").prop('disabled', false);
			   }
		   });
	   }
	});

	
});

function validateQRData(selForm){
   let valid = true;
   
   switch(selForm){
	   case 'web_url':
		   if(!isUrlValid($('#web_urls').val()) && !$('#web_urls').hasClass('is-invalid')){
			   $('#web_urls').addClass('is-invalid')
			   valid=false;
		   }
		   break;
	   case 'phone_numbers':
		   if(($('#c_email').val() !=='') && !isEmail($('#c_email').val()) && !$('#c_email').hasClass('is-invalid')){
			   $('#c_email').addClass('is-invalid')
			   valid=false;
		   }
		   break;
	   case 'business_cards':
		   if(($('#b_email').val() !=='') && !isEmail($('#b_email').val()) && !$('#b_email').hasClass('is-invalid')){
			   $('#b_email').addClass('is-invalid')
			   valid=false;
		   }
		   break;
	   default:
		   break;
   }

   return valid;
}

function isUrlValid(url) {
   return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

function isEmail(email) {
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   return regex.test(email);
}
