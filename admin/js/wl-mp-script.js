jQuery(document).ready(function() {

	function copyToClipboard(selector, target) {
		jQuery(document).on('click', selector, function() {
			var value = jQuery(target).text();
			var temp = jQuery("<input>");
			jQuery("body").append(temp);
			temp.val(value).select();
			document.execCommand("copy");
			temp.remove();
			toastr.success('Copied to clipboard.');
		});
	}

	function resetFormOnOpenModal(modal, form) {
		jQuery(document).on('show.bs.modal', modal, function() {
			jQuery(form)[0].reset();
			jQuery(form + ' span.text-danger').remove();
		});
	}

	function appendModalToBody(modal) {
		jQuery(modal).appendTo("body");
	}

	copyToClipboard('#wl_mp_marriage_form_shortcode_copy', '#wl_mp_marriage_form_shortcode');
	resetFormOnOpenModal('#add-marriage', '#wlmp-marriage-add-form');
	appendModalToBody('#add-marriage');
	appendModalToBody('#update-marriage');
});