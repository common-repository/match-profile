<?php
defined( 'ABSPATH' ) or die();
?>

<div class="container-fluid wl_mp_container">
	<div class="row">
		<div class="col text-center ">
			<h1 class="display-4 aqua-gradient text-white"><span class="border-bottom"><?php esc_html_e( 'Match Profile', WL_MP_DOMAIN ); ?></span></h1>
			<div class="mt-4 text-center alert alert-primary text-white aqua-gradient" role="alert">
				<?php esc_html_e( 'Welcome to Match Profile Plugin', WL_MP_DOMAIN ); ?>!
			</div>
			<div class="card col text-center">
				<?php esc_html_e( 'To Display Marriage Form on Front End, Copy and Paste Shortcode', WL_MP_DOMAIN ); ?>:
				<div class="col-12 justify-content-center align-items-center ">
					<span class="col-6">
						<strong id="wl_mp_marriage_form_shortcode">[wl_mp_marriage_form]</strong>
					</span>
					<span class="col-6">
						<button id="wl_mp_marriage_form_shortcode_copy" class="btn btn-outline-success btn-sm" type="button"><?php esc_html_e( 'Copy', WL_MP_DOMAIN ); ?></button>
					</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="v-pills-marriage" role="tabpanel" aria-labelledby="v-pills-marriage-tab">
					<div class="card col">
						<div class="card-header">
							<div class="row">
								<div class="col-md-9 col-xs-12">
									<span class="h2 align-middle"><?php esc_html_e( 'Marriage Profiles', WL_MP_DOMAIN ); ?></span>
								</div>
								<div class="col-md-3 col-xs-12">
									<button type="button" class="btn btn-outline-primary float-right add-marriage" data-toggle="modal" data-target="#add-marriage"  data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> <?php esc_html_e( 'Add New Profile', WL_MP_DOMAIN ); ?>
								</button>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col">
								<table class="table table-hover table-striped table-bordered" id="marriage-table">
									<thead>
										<tr>
											<th scope="col"><?php esc_html_e( 'First Name', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Last Name', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Looking For', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Qualification', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Occupation', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Marital Status', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Date of Birth', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Phone', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Email', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Religion', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Height', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'City', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'State', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Country', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Zip', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Status', WL_MP_DOMAIN ); ?></th>
											<th scope="col"><?php esc_html_e( 'Edit', WL_MP_DOMAIN ); ?></th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="add-marriage" tabindex="-1" role="dialog" aria-labelledby="add-marriage-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-marriage-label"><?php esc_html_e( 'Add New Marriage Profile', WL_MP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4">
				<form id="wlmp-marriage-add-form">
					<?php $nonce = wp_create_nonce( 'add-marriage' ); ?>
					<input type="hidden" name="add-marriage" value="<?php echo esc_attr($nonce); ?>">
					<label class="col-form-label"><?php esc_html_e( 'Looking For', WL_MP_DOMAIN ); ?>:</label><br>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="looking_for" value="Bride" id="wlmp-marriage-looking_for-bride">
						<label class="form-check-label" for="wlmp-marriage-looking_for-bride"><?php esc_html_e( 'Bride', WL_MP_DOMAIN ); ?></label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" checked type="radio" name="looking_for" value="Groom" id="wlmp-marriage-looking_for-groom">
						<label class="form-check-label" for="wlmp-marriage-looking_for-groom"><?php esc_html_e( 'Groom', WL_MP_DOMAIN ); ?></label>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="wlmp-marriage-first_name" class="col-form-label"><?php esc_html_e( 'First Name', WL_MP_DOMAIN ); ?>:</label>
							<input name="first_name" type="text" class="form-control" id="wlmp-marriage-first_name" placeholder="<?php esc_attr_e( "First Name", WL_MP_DOMAIN ); ?>">
						</div>
						<div class="col-sm-6 form-group">
							<label for="wlmp-marriage-last_name" class="col-form-label"><?php esc_html_e( 'Last Name', WL_MP_DOMAIN ); ?>:</label>
							<input name="last_name" type="text" class="form-control" id="wlmp-marriage-last_name" placeholder="<?php esc_attr_e( "Last Name", WL_MP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="wlmp-marriage-father_name" class="col-form-label"><?php esc_html_e( "Father's Name", WL_MP_DOMAIN ); ?>:</label>
							<input name="father_name" type="text" class="form-control" id="wlmp-marriage-father_name" placeholder="<?php esc_attr_e( "Father's Name", WL_MP_DOMAIN ); ?>">
						</div>
						<div class="col-sm-6 form-group">
							<label for="wlmp-marriage-mother_name" class="col-form-label"><?php esc_html_e( "Mother's Name", WL_MP_DOMAIN ); ?>:</label>
							<input name="mother_name" type="text" class="form-control" id="wlmp-marriage-mother_name" placeholder="<?php esc_attr_e( "Mother's Name", WL_MP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="wlmp-marriage-qualification" class="col-form-label"><?php esc_html_e( 'Qualification', WL_MP_DOMAIN ); ?>:</label>
						<input name="qualification" type="text" class="form-control" id="wlmp-marriage-qualification" placeholder="<?php esc_attr_e( "Qualification", WL_MP_DOMAIN ); ?>">
					</div>
					<div class="form-group">
						<label for="wlmp-marriage-occupation" class="col-form-label"><?php esc_html_e( 'Occupation', WL_MP_DOMAIN ); ?>:</label>
						<input name="occupation" type="text" class="form-control" id="wlmp-marriage-occupation" placeholder="<?php esc_attr_e( "Occupation", WL_MP_DOMAIN ); ?>">
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="wlmp-marriage-email" class="col-form-label"><?php esc_html_e( 'Email', WL_MP_DOMAIN ); ?>:</label>
							<input name="email" type="email" class="form-control" id="wlmp-marriage-email" placeholder="<?php esc_attr_e( "Email", WL_MP_DOMAIN ); ?>">
						</div>
						<div class="form-group col-sm-6">
							<label for="wlmp-marriage-zip" class="col-form-label"><?php esc_html_e( 'Zip', WL_MP_DOMAIN ); ?>:</label>
							<input name="zip" type="text" class="form-control" id="wlmp-marriage-zip" placeholder="<?php esc_attr_e( "Zip", WL_MP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-6">
							<label for="wlmp-marriage-date_of_birth" class="col-form-label"><?php esc_html_e( 'Date of Birth', WL_MP_DOMAIN ); ?>:</label>
							<input name="date_of_birth" type="text" class="form-control" id="wlmp-marriage-date_of_birth" placeholder="<?php esc_attr_e( "DOB in yyyy-mm-dd", WL_MP_DOMAIN ); ?>">
						</div>
						<div class="form-group col-sm-6">
							<label for="wlmp-marriage-phone" class="col-form-label"><?php esc_html_e( 'Phone Number', WL_MP_DOMAIN ); ?>:</label>
							<input name="phone" type="text" class="form-control" id="wlmp-marriage-phone" placeholder="<?php esc_attr_e( "Phone Number", WL_MP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="wlmp-marriage-religion" class="col-form-label"><?php esc_html_e( 'Religion', WL_MP_DOMAIN ); ?>:</label>
						<input name="religion" type="text" class="form-control" id="wlmp-marriage-religion" placeholder="<?php esc_attr_e( "Religion", WL_MP_DOMAIN ); ?>">
					</div>
					<div class="form-group">
						<label for="wlmp-marriage-marital_status"><?php esc_html_e( 'Marital Status', WL_MP_DOMAIN ); ?>:</label>
						<select name="marital_status" class="form-control" id="wlmp-marriage-marital_status">
							<option value="Never Married"><?php esc_html_e( 'Never Married', WL_MP_DOMAIN ); ?></option>
							<option value="Married"><?php esc_html_e( 'Married', WL_MP_DOMAIN ); ?></option>
							<option value="Awaiting-Divorce"><?php esc_html_e( 'Awaiting Divorce', WL_MP_DOMAIN ); ?></option>
							<option value="Divorced"><?php esc_html_e( 'Divorced', WL_MP_DOMAIN ); ?></option>
							<option value="Widowed"><?php esc_html_e( 'Widowed', WL_MP_DOMAIN ); ?></option>
							<option value="Annulled"><?php esc_html_e( 'Annulled', WL_MP_DOMAIN ); ?></option>
						</select>
					</div>
					<div class="form-group">
						<label for="wlmp-marriage-height"><?php esc_html_e( 'Height', WL_MP_DOMAIN ); ?>:</label>
						<select name="height" class="form-control" id="wlmp-marriage-height">
							<option value="" selected><?php esc_html_e( 'Select Height', WL_MP_DOMAIN ); ?></option>
							<option value="4,0"><?php esc_html_e( "'4' '0' '(1.22 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,1"><?php esc_html_e( "'4' '1' '(1.24 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,2"><?php esc_html_e( "'4' '2' '(1.28 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,3"><?php esc_html_e( "'4' '3' '(1.31 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,4"><?php esc_html_e( "'4' '4' '(1.34 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,5"><?php esc_html_e( "'4' '5' '(1.35 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,6"><?php esc_html_e( "'4' '6' '(1.37 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,7"><?php esc_html_e( "'4' '7' '(1.40 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,8"><?php esc_html_e( "'4' '8' '(1.42 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,9"><?php esc_html_e( "'4' '9' '(1.45 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,10"><?php esc_html_e( "'4' '10' '(1.47 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="4,11"><?php esc_html_e( "'4' '11' '(1.50 mts)'", WL_MP_DOMAIN ); ?></option>
							<optgroup label="&nbsp;"></optgroup>
							<option value="5,0"><?php esc_html_e( "'5' '0' '(1.52 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,1"><?php esc_html_e( "'5' '1' '(1.55 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,2"><?php esc_html_e( "'5' '2' '(1.58 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,3"><?php esc_html_e( "'5' '3' '(1.60 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,4"><?php esc_html_e( "'5' '4' '(1.63 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,5"><?php esc_html_e( "'5' '5' '(1.65 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,6"><?php esc_html_e( "'5' '6' '(1.68 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,7"><?php esc_html_e( "'5' '7' '(1.70 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,8"><?php esc_html_e( "'5' '8' '(1.73 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,9"><?php esc_html_e( "'5' '9' '(1.75 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,10"><?php esc_html_e( "'5' '10' '(1.78 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="5,11"><?php esc_html_e( "'5' '11' '(1.80 mts)'", WL_MP_DOMAIN ); ?></option>
							<optgroup label="&nbsp;&nbsp;"></optgroup>
							<option value="6,0"><?php esc_html_e( "'6' '0' '(1.83 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,1"><?php esc_html_e( "'6' '1' '(1.85 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,2"><?php esc_html_e( "'6' '2' '(1.88 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,3"><?php esc_html_e( "'6' '3' '(1.91 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,4"><?php esc_html_e( "'6' '4' '(1.93 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,5"><?php esc_html_e( "'6' '5' '(1.96 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,6"><?php esc_html_e( "'6' '6' '(1.98 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,7"><?php esc_html_e( "'6' '7' '(2.01 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,8"><?php esc_html_e( "'6' '8' '(2.03 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,9"><?php esc_html_e( "'6' '9' '(2.06 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,10"><?php esc_html_e( "'6' '10' '(2.08 mts)'", WL_MP_DOMAIN ); ?></option>
							<option value="6,11"><?php esc_html_e( "'6' '11' '(2.11 mts)'", WL_MP_DOMAIN ); ?></option>
							<optgroup label="&nbsp;&nbsp;&nbsp;"></optgroup>
							<option value="7"><?php esc_html_e( "'7' '(2.13 mts) plus'", WL_MP_DOMAIN ); ?></option>
						</select>
					</div>
					<div class="form-group">
						<label for="wlmp-marriage-address" class="col-form-label"><?php esc_html_e( 'Address', WL_MP_DOMAIN ); ?>:</label>
						<textarea name="address" class="form-control" rows="2" id="wlmp-marriage-address" placeholder="<?php esc_html_e( "Address", WL_MP_DOMAIN ); ?>"></textarea>
					</div>
					<div class="row">
						<div class="form-group col-sm-4">
							<label for="wlmp-marriage-city" class="col-form-label"><?php esc_html_e( 'City', WL_MP_DOMAIN ); ?>:</label>
							<input name="city" type="text" class="form-control" id="wlmp-marriage-city" placeholder="<?php esc_html_e( "City", WL_MP_DOMAIN ); ?>">
						</div>
						<div class="form-group col-sm-4">
							<label for="wlmp-marriage-state" class="col-form-label"><?php esc_html_e( 'State', WL_MP_DOMAIN ); ?>:</label>
							<input name="state" type="text" class="form-control" id="wlmp-marriage-state" placeholder="<?php esc_html_e( "State", WL_MP_DOMAIN ); ?>">
						</div>
						<div class="form-group col-sm-4">
							<label for="wlmp-marriage-country" class="col-form-label"><?php esc_html_e( 'Country', WL_MP_DOMAIN ); ?>:</label>
							<input name="country" type="text" class="form-control" id="wlmp-marriage-country" placeholder="<?php esc_html_e( "Country", WL_MP_DOMAIN ); ?>">
						</div>
					</div>
					<div class="form-check form-check-inline">
						<input name="is_active" class="form-check-input" type="checkbox" id="wlmp-marriage-is_active" checked>
						<label class="form-check-label" for="wlmp-marriage-is_active">
							<?php esc_html_e( 'Is Active?', WL_MP_DOMAIN ); ?>
						</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_html_e( 'Close', WL_MP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary add-marriage-submit"><?php esc_html_e( 'Save changes', WL_MP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="update-marriage" tabindex="-1" role="dialog" aria-labelledby="update-marriage-label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="add-marriage-label"><?php esc_html_e( 'Update Marriage Profile', WL_MP_DOMAIN ); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body pr-4 pl-4" id="fetch_marriage"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_html_e( 'Close', WL_MP_DOMAIN ); ?></button>
				<button type="button" class="btn btn-primary update-marriage-submit"><?php esc_html_e( 'Save changes', WL_MP_DOMAIN ); ?></button>
			</div>
		</div>
	</div>
</div>