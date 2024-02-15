// Active Menus 

jQuery(document).ready(function(){
	// Add event listener to each menu item
	var menuItems = document.querySelectorAll('#left-menu ul li');
	menuItems.forEach(function(item) {
		item.addEventListener('click', function() {
			// Remove active class from all menu items
			menuItems.forEach(function(innerItem) {
				innerItem.classList.remove('active');
			});

			// Add active class to the clicked menu item
			item.classList.add('active');

			// Hide all content sections
			var contentSections = document.querySelectorAll('.card');
			contentSections.forEach(function(section) {
				section.style.display = 'none';
			});

			// Display the corresponding content section
			var targetId = item.getAttribute('id').replace('MenuItem', 'Converter');
			var targetSection = document.getElementById(targetId);
			targetSection.style.display = 'block';
		});
	});
	
	// Function to copy shortcode to clipboard
	function copyShortcode(cardId) {
		var shortcodeElement = jQuery('#' + cardId + ' .content-box code');
		var shortcodeText = shortcodeElement.text().trim();

		// Create a temporary textarea to copy text
		var textarea = jQuery('<textarea>').text(shortcodeText).css({ position: 'fixed', opacity: 0 });
		jQuery('body').append(textarea);

		// Select the text and copy to clipboard
		textarea.select();
		document.execCommand('copy');

		// Remove the temporary textarea
		textarea.remove();

		// Hide the "copy.png" image and show the "copying.png" image
		var copyIcon = jQuery('#' + cardId + ' .tool-icon#copy');
		copyIcon.hide();
		jQuery('#' + cardId + ' .tool-icon.copied').show();

		// After 2 seconds, reset to "copy.png"
		setTimeout(function () {
			// Show the "copy.png" image and hide the "copying.png" image
			copyIcon.show();
			jQuery('#' + cardId + ' .tool-icon.copied').hide();
		}, 2000);
	}
	
	// Click event for the copy icon
	jQuery('.tool-icon#copy').on('click', function () {
		var cardId = jQuery(this).closest('.card').attr('id');
		copyShortcode(cardId);
	});


	jQuery('#left-menu').find('*').removeClass('active');

	var fragment = window.location.hash.substring(1);

	
		// Check if there's a fragment
		if (fragment) {
			// Find the element with the corresponding id and add the 'active' class
			jQuery('#' + fragment).addClass('active');
			var contentSections = document.querySelectorAll('.card');
			contentSections.forEach(function(section) {
				section.style.display = 'none';
			});

			var targetId = fragment.replace('MenuItem', 'Converter');
            var targetSection = document.getElementById(targetId);
			targetSection.style.display = 'block'; 
		}
		else{
			jQuery('#colorMenuItem').addClass('active');
		}

		jQuery('.pressure-convert').submit(function(event) {
			
			

			setTimeout(function () {
			location.reload();
			}, 4000);
		});

});
