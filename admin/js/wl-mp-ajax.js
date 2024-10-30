jQuery(document).ready(function() {

	function initializeDatatable(table, action) {
		jQuery(table).DataTable({
	        aaSorting: [],
	        responsive: true,
			stateSave: true,
			ajax: {
				url: ajaxurl + '?security=' + WLMPAjax.security + '&action=' + action,
	            dataSrc: 'data'
			},
			language: {
				"loadingRecords": "Loading..."
			}
		});
	}

	function save(selector, action, form = null, modal = null, reloadTables = []) {
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
				url: ajaxurl,
				data: jQuery.extend(formData, data),
				success: function(response) {
					jQuery(selector).prop('disabled', false);
					if(response.success) {
						toastr.success('Success!');
						jQuery(form)[0].reset();
						if(modal) {
							jQuery(modal).modal('hide');
						}
						reloadTables.forEach(function(table) {
							jQuery(table).DataTable().ajax.reload(null, false);
						});
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
				},
				dataType: 'json'
			});
		});
	}

	function fetch(modal, action, target) {
		jQuery(modal).on('show.bs.modal', function (e) {
			var id = jQuery(e.relatedTarget).data('id');
			jQuery.ajax({
				type : 'post',
				url : ajaxurl + '?security=' + WLMPAjax.security + '&action=' + action,
				data :  'id='+ id,
				success : function(data) {
					jQuery(target).html(data);
				}
			});
		});
	}

	function remove(selector, id_attribute, nonce_attribute, nonce_name, action, reloadTables = []) {
		jQuery(document).on("click", selector, function (event) {
			var id = jQuery(this).attr(id_attribute);
			var nonce = jQuery(this).attr(nonce_attribute);
			jQuery.confirm({
			    title: 'Confirm!',
			    content: 'Please confirm!',
			    buttons: {
			        confirm: function () {
						jQuery.ajax({
							data: "id=" + id + "&" + nonce_name + "-" + id + "=" + nonce + "&action=" + action,
							url: ajaxurl,
							type: "POST",
							success: function(response) {
								if(response.success) {
									toastr.success('Success!');
									reloadTables.forEach(function(table) {
										jQuery(table).DataTable().ajax.reload(null, false);
									});
								} else {
									toastr.error('Error!');
								}
							},
							error: function(response) {
								toastr.error('Error!');
							}
						});
			        },
			        cancel: function () {
			        }
			    }
			});
		});
	}

	initializeDatatable('#marriage-table', 'wl-mp-get-marriage-data');
	save('.add-marriage-submit', 'wl-mp-add-marriage', '#wlmp-marriage-add-form', '#add-marriage', ['#marriage-table']);
	fetch('#update-marriage', 'wl-mp-fetch-marriage', '#fetch_marriage');
	save('.update-marriage-submit', 'wl-mp-update-marriage', '#wlmp-marriage-update-form', '#update-marriage', ['#marriage-table']);
	remove('.delete-marriage', 'delete-marriage-id', 'delete-marriage-security', 'delete-marriage', 'wl-mp-delete-marriage', ['#marriage-table']);

});