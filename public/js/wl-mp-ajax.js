jQuery(document).ready(function() {

	function save(selector, action, form = null) {
		jQuery(document).on('click', selector, function(event) {
			var data = {
				action: action,
				data: form ? jQuery(form).serializeArray() : []
			};
			var formData = {};
			if(form) {
				jQuery.each(jQuery(form).serializeArray(), function() {
		    		formData[this.name] = this.value;
				});
			}
			jQuery(selector).prop('disabled', true);
			jQuery.ajax({
				type: 'POST',
				url: jQuery(form).attr('action'),
				data: jQuery.extend(formData, data),
				success: function(response) {
					jQuery(selector).prop('disabled', false);
					if(response.success) {
						toastr.success(response.data);
						jQuery(form)[0].reset();
					} else {
						if(response.data && jQuery.isPlainObject(response.data)) {
							jQuery(form + ' span.text-danger').remove();
							jQuery(form + ' :input').each(function() {
								var input = this;
								if(response.data[input.name]) {
									var errorSpan = '<span class="text-danger"><strong>' + response.data[input.name] + '</strong></span>';
									jQuery(errorSpan).insertAfter(this);
								}
							});
						}
						toastr.error('Error!');
					}
				},
				error: function(response) {
					jQuery(selector).prop('disabled', false);
					toastr.error('Error!');
				}
			});
		});
	}
	save('.add-marriage-submit', 'wl-mp-add-marriage', '#wlmp-marriage-add-form');
});