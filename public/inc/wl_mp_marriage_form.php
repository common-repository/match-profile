<?php
defined( 'ABSPATH' ) or die();
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<h2><?php esc_html_e( 'Marriage Profile Form', WL_MP_DOMAIN ); ?></h2>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" id="wlmp-marriage-add-form">
			<?php $nonce = wp_create_nonce( 'add-marriage' ); ?>
		    <input type="hidden" name="add-marriage" value="<?php echo esc_attr($nonce); ?>">
		    <div class="row">

		    	<div class=" col-md-12 form-group ">
		    	<label><?php esc_html_e( 'Looking For', WL_MP_DOMAIN ); ?>:</label><br>

		    	<div class="form-group form-check-inline">
		    		<label class="radio-inline "><input checked type="radio" name="looking_for" value="Groom" id="wlmp-marriage-looking_for-groom"><?php esc_html_e( 'Bride', WL_MP_DOMAIN ); ?></label>
		    	</div>

		    	<div class="form-group form-check-inline">
					<label class="radio-inline "><input type="radio" name="looking_for" value="Bride" id="wlmp-marriage-looking_for-bride"><?php esc_html_e( 'Groom', WL_MP_DOMAIN ); ?></label>
				</div>
			</div>
		    </div>
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="wlmp-marriage-first_name"><?php esc_html_e( 'First Name', WL_MP_DOMAIN ); ?>:</label>
					<input name="first_name" type="text" class="form-control" id="wlmp-marriage-first_name" placeholder="<?php esc_attr_e( "First Name", WL_MP_DOMAIN ); ?>">
				</div>
				<div class="col-md-6 form-group">
					<label for="wlmp-marriage-last_name"><?php esc_html_e( 'Last Name', WL_MP_DOMAIN ); ?>:</label>
					<input name="last_name" type="text" class="form-control" id="wlmp-marriage-last_name" placeholder="<?php esc_attr_e( "Last Name", WL_MP_DOMAIN ); ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="wlmp-marriage-father_name"><?php esc_html_e( "Father's Name", WL_MP_DOMAIN ); ?>:</label>
					<input name="father_name" type="text" class="form-control" id="wlmp-marriage-father_name" placeholder="<?php esc_attr_e( "Father's Name", WL_MP_DOMAIN ); ?>">
				</div>
				<div class="col-md-6 form-group">
					<label for="wlmp-marriage-mother_name"><?php esc_html_e( "Mother's Name", WL_MP_DOMAIN ); ?>:</label>
					<input name="mother_name" type="text" class="form-control" id="wlmp-marriage-mother_name" placeholder="<?php esc_attr_e( "Mother's Name", WL_MP_DOMAIN ); ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
				<label for="wlmp-marriage-qualification"><?php esc_html_e( 'Qualification', WL_MP_DOMAIN ); ?>:</label>
				<input name="qualification" type="text" class="form-control" id="wlmp-marriage-qualification" placeholder="<?php esc_attr_e( "Qualification", WL_MP_DOMAIN ); ?>">
			</div>
			<div class="col-md-12 form-group">
				<label for="wlmp-marriage-occupation"><?php esc_html_e( 'Occupation', WL_MP_DOMAIN ); ?>:</label>
				<input name="occupation" type="text" class="form-control" id="wlmp-marriage-occupation" placeholder="<?php esc_attr_e( "Occupation", WL_MP_DOMAIN ); ?>">
			</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="wlmp-marriage-email"><?php esc_html_e( 'Email', WL_MP_DOMAIN ); ?>:</label>
					<input name="email" type="email" class="form-control" id="wlmp-marriage-email" placeholder="<?php esc_attr_e( "Email", WL_MP_DOMAIN ); ?>">
				</div>
				<div class="form-group col-md-6">
					<label for="wlmp-marriage-zip"><?php esc_html_e( 'Zip', WL_MP_DOMAIN ); ?>:</label>
					<input name="zip" type="text" class="form-control" id="wlmp-marriage-zip" placeholder="<?php esc_attr_e( "Zip", WL_MP_DOMAIN ); ?>">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="wlmp-marriage-date_of_birth"><?php esc_html_e( 'Date of Birth', WL_MP_DOMAIN ); ?>:</label>
					<input name="date_of_birth" type="text" class="form-control" id="wlmp-marriage-date_of_birth" placeholder="<?php esc_attr_e( "DOB in yyyy-mm-dd", WL_MP_DOMAIN ); ?>">
				</div>
				<div class="form-group col-md-6">
					<label for="wlmp-marriage-phone"><?php esc_html_e( 'Phone Number', WL_MP_DOMAIN ); ?>:</label>
					<input name="phone" type="text" class="form-control" id="wlmp-marriage-phone" placeholder="<?php esc_attr_e( "Phone Number", WL_MP_DOMAIN ); ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 form-group">
				<label for="wlmp-marriage-religion"><?php esc_html_e( 'Religion', WL_MP_DOMAIN ); ?>:</label>
				<input name="religion" type="text" class="form-control" id="wlmp-marriage-religion" placeholder="<?php esc_attr_e( "Religion", WL_MP_DOMAIN ); ?>">
			</div>
			<div class="col-md-12 form-group">
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
			<div class="col-md-12 form-group">
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
			<div class="col-md-12 form-group">
				<label for="wlmp-marriage-address"><?php esc_html_e( 'Address', WL_MP_DOMAIN ); ?>:</label>
				<textarea name="address" class="form-control" rows="2" id="wlmp-marriage-address" placeholder="<?php esc_attr_e( "Address", WL_MP_DOMAIN ); ?>"></textarea>
			</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4">
					<label for="wlmp-marriage-city"><?php esc_html_e( 'City', WL_MP_DOMAIN ); ?>:</label>
					<input name="city" type="text" class="form-control" id="wlmp-marriage-city" placeholder="<?php esc_attr_e( "City", WL_MP_DOMAIN ); ?>">
				</div>
				<div class="form-group col-md-4">
					<label for="wlmp-marriage-state"><?php esc_html_e( 'State', WL_MP_DOMAIN ); ?>:</label>
					<input name="state" type="text" class="form-control" id="wlmp-marriage-state" placeholder="<?php esc_attr_e( "State", WL_MP_DOMAIN ); ?>">
				</div>
				<div class="form-group col-md-4">
					<label for="wlmp-marriage-country"><?php esc_html_e( 'Country', WL_MP_DOMAIN ); ?>:</label>
					<input name="country" type="text" class="form-control" id="wlmp-marriage-country" placeholder="<?php esc_attr_e( "Country", WL_MP_DOMAIN ); ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<br>
					<button type="button" class="btn btn-lg btn-block btn-primary add-marriage-submit"><?php esc_html_e( 'Submit!', WL_MP_DOMAIN ); ?></button>
				</div>
			</div>
		</form>
	</div>
</div>

