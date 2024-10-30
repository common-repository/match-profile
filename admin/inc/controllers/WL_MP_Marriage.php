<?php
defined( 'ABSPATH' ) or die();

class WL_MP_Marriage {
	protected static $looking_for_data = array( 'Bride', 'Groom' );
	protected static $marital_status_data = array( 'Never Married', 'Married', 'Awaiting-Divorce', 'Divorced', 'Widowed', 'Annulled' );
	protected static $height_data = array( '4,0', '4,1', '4,2', '4,3', '4,4', '4,5', '4,6', '4,7', '4,8', '4,9', '4,10', '4,11', '5,0', '5,1', '5,2', '5,3', '5,4', '5,5', '5,6', '5,7', '5,8', '5,9', '5,10', '5,11', '6,0', '6,1', '6,2', '6,3', '6,4', '6,5', '6,6', '6,7', '6,8', '6,9', '6,10', '6,11', '7' );

	public static function wl_mp_add_marriage() {
		if ( ! wp_verify_nonce( $_POST['add-marriage'], 'add-marriage' ) ) {
			die();
		}

		global $wpdb;

		$looking_for    = isset( $_POST['looking_for'] ) ? sanitize_text_field( $_POST['looking_for'] ) : '';
		$first_name     = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name      = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$father_name    = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
		$mother_name    = isset( $_POST['mother_name'] ) ? sanitize_text_field( $_POST['mother_name'] ) : '';
		$qualification  = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
		$occupation     = isset( $_POST['occupation'] ) ? sanitize_text_field( $_POST['occupation'] ) : '';
		$email          = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
		$zip            = isset( $_POST['zip'] ) ? sanitize_text_field( $_POST['zip'] ) : '';
		$date_of_birth  = isset( $_POST['date_of_birth'] ) ? sanitize_text_field( $_POST['date_of_birth'] ) : '';
		$phone          = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
		$religion       = isset( $_POST['religion'] ) ? sanitize_text_field( $_POST['religion'] ) : '';
		$marital_status = isset( $_POST['marital_status'] ) ? sanitize_text_field( $_POST['marital_status'] ) : '';
		$height         = isset( $_POST['height'] ) ? sanitize_text_field( $_POST['height'] ) : '';
		$address        = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
		$city           = isset( $_POST['city'] ) ? sanitize_text_field( $_POST['city'] ) : '';
		$state          = isset( $_POST['state'] ) ? sanitize_text_field( $_POST['state'] ) : '';
		$country        = isset( $_POST['country'] ) ? sanitize_text_field( $_POST['country'] ) : '';
		$is_active      = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		$errors = [];
		if (  empty( $first_name ) ) {
			$errors['first_name'] = esc_html__( 'Please provide first name.', WL_MP_DOMAIN );
		}
		if (  empty( $address ) ) {
			$errors['address'] = esc_html__( 'Please provide address.', WL_MP_DOMAIN );
		}
		if (  empty( $city ) ) {
			$errors['city'] = esc_html__( 'Please specify city.', WL_MP_DOMAIN );
		}
		if (  empty( $state ) ) {
			$errors['state'] = esc_html__( 'Please specify state.', WL_MP_DOMAIN );
		}
		if (  empty( $country ) ) {
			$errors['country'] = esc_html__( 'Please specify country.', WL_MP_DOMAIN );
		}
		if (  ! empty( $email ) && ! is_email( $email ) ) {
			$errors['email'] = esc_html__( 'Please provide valid email address.', WL_MP_DOMAIN );
		}

		if (  ! empty( $marital_status ) && ! in_array( $marital_status, self::$marital_status_data ) ) {
			$errors['marital_status'] = esc_html__( 'Please select valid marital status.', WL_MP_DOMAIN );
		}

		if (  ! empty( $looking_for ) && ! in_array( $looking_for, self::$looking_for_data ) ) {
			$errors['looking_for'] = esc_html__( 'Please select either Groom or Bride.', WL_MP_DOMAIN );
		}

		if (  ! empty( $height ) && ! in_array( $height, self::$height_data ) ) {
			$errors['height'] = esc_html__( 'Please select valid height.', WL_MP_DOMAIN );
		}

		if ( ! empty( $date_of_birth) ) {
			if ( ! preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_of_birth ) ) {
				$errors['date_of_birth'] = esc_html__( 'Invalid date.', WL_MP_DOMAIN );
			} else {
				$d = explode( "-"  , $date_of_birth );
				if( ! checkdate( $d[1], $d[2], $d[0]) ) {
					$errors['date_of_birth'] = esc_html__( 'Not a recognised date.', WL_MP_DOMAIN );
				} else {
					$date_of_birth = date( "Y-m-d H:i:s", strtotime( $date_of_birth) );
				}
			}
		} else {
			$date_of_birth = null;
		}

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );
				$wpdb->insert( "{$wpdb->prefix}wl_mp_marriage", array(
					'looking_for'    => $looking_for,
					'first_name'     => $first_name,
					'last_name'      => $last_name,
					'father_name'    => $father_name,
					'mother_name'    => $mother_name,
					'qualification'  => $qualification,
					'occupation'     => $occupation,
					'email'          => $email,
					'zip'            => $zip,
					'date_of_birth'  => $date_of_birth,
					'phone'          => $phone,
					'religion'       => $religion,
					'marital_status' => $marital_status,
					'height'         => $height,
					'address'        => $address,
					'city'           => $city,
					'state'          => $state,
					'country'        => $country,
					'is_active'      => $is_active
				) );
				$wpdb->query( 'COMMIT;' );
				wp_send_json_success();
			} catch ( \Exception $exception ) {
				$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error();
			}
		}
		wp_send_json_error( $errors );
	}

	public static function wl_mp_get_marriage_data() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-mp' ) ) {
			die();
		}

		global $wpdb;
		$data = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wl_mp_marriage ORDER BY `id` DESC" );
		if ( count( $data ) !== 0 ) {
			foreach ( $data as $row ) {
				$id             = $row->id;
				$first_name     = $row->first_name;
				$last_name      = $row->last_name ? $row->last_name : '-';
				$looking_for    = $row->looking_for ? $row->looking_for: '-';
				$qualification  = $row->qualification ? $row->qualification : '-';
				$occupation     = $row->occupation ? $row->occupation : '-';
				$marital_status = $row->marital_status ? $row->marital_status : '-';
				$date_of_birth  = $row->date_of_birth ? date_format( date_create( $row->date_of_birth ), "d M, Y" ) : '-';
				$phone          = $row->phone ? $row->phone : '-';
				$email          = $row->email ? $row->email : '-';
				$religion       = $row->religion ? $row->religion : '-';
				$height         = $row->height ? $row->height : '-';
				$city           = $row->city;
				$state          = $row->state;
				$country        = $row->country;
				$zip            = $row->zip ? $row->zip : '-';
				$is_active      = $row->is_active ? esc_html__( "Active", WL_MP_DOMAIN ) : esc_html__( "Inactive", WL_MP_DOMAIN );

				$results["data"][] = array(
					$first_name,
					$last_name,
					$looking_for,
					$qualification,
					$occupation,
					$marital_status,
					$date_of_birth,
					$phone,
					$email,
					$religion,
					$height,
					$city,
					$state,
					$country,
					$zip,
					$is_active,
					'<a class="mr-3" href="#update-marriage" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-id="' . $id . '"><i class="fas fa-edit"></i></i></a> <a href="javascript:void(0)" delete-marriage-security="' . wp_create_nonce( "delete-marriage-$id" ) . '"delete-marriage-id="' . $id . '" class="delete-marriage"> <i class="fas fa-trash text-danger"></i></a>'
				);
			}
		} else {
			$results["data"] = [];
		}
		wp_send_json( $results );
	}

	public static function wl_mp_fetch_marriage() {
		if ( ! wp_verify_nonce( $_REQUEST['security'], 'wl-mp' ) ) {
			die();
		}

		global $wpdb;

		$id   = intval( sanitize_text_field( $_POST['id'] ) );
		$marriage = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}wl_mp_marriage WHERE id = $id" );
		?>
		<form id="wlmp-marriage-update-form">
			<?php $nonce = wp_create_nonce( "update-marriage-$id" ); ?>
			<input type="hidden" name="update-marriage-<?php echo esc_attr($id); ?>" value="<?php echo esc_attr($nonce); ?>">
			<label class="col-form-label"><?php esc_html_e( 'Looking For', WL_MP_DOMAIN ); ?>:</label><br>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="looking_for" value="Bride" id="wlmp-marriage-looking_for-bride_update">
				<label class="form-check-label" for="wlmp-marriage-looking_for-bride_update"><?php esc_html_e( 'Bride', WL_MP_DOMAIN ); ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="looking_for" value="Groom" id="wlmp-marriage-looking_for-groom_update">
				<label class="form-check-label" for="wlmp-marriage-looking_for-groom_update"><?php esc_html_e( 'Groom', WL_MP_DOMAIN ); ?></label>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="wlmp-marriage-first_name_update" class="col-form-label"><?php esc_html_e( 'First Name', WL_MP_DOMAIN ); ?>:</label>
					<input name="first_name" type="text" class="form-control" id="wlmp-marriage-first_name_update" placeholder="<?php esc_attr_e( "First Name", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->first_name); ?>">
				</div>
				<div class="col-sm-6 form-group">
					<label for="wlmp-marriage-last_name_update" class="col-form-label"><?php esc_html_e( 'Last Name', WL_MP_DOMAIN ); ?>:</label>
					<input name="last_name" type="text" class="form-control" id="wlmp-marriage-last_name_update" placeholder="<?php esc_attr_e( "Last Name", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->last_name); ?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 form-group">
					<label for="wlmp-marriage-father_name_update" class="col-form-label"><?php esc_html_e( "Father's Name", WL_MP_DOMAIN ); ?>:</label>
					<input name="father_name" type="text" class="form-control" id="wlmp-marriage-father_name_update" placeholder="<?php esc_attr_e( "Father's Name", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->father_name); ?>">
				</div>
				<div class="col-sm-6 form-group">
					<label for="wlmp-marriage-mother_name_update" class="col-form-label"><?php esc_html_e( "Mother's Name", WL_MP_DOMAIN ); ?>:</label>
					<input name="mother_name" type="text" class="form-control" id="wlmp-marriage-mother_name_update" placeholder="<?php esc_attr_e( "Mother's Name", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->mother_name); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="wlmp-marriage-qualification_update" class="col-form-label"><?php esc_html_e( 'Qualification', WL_MP_DOMAIN ); ?>:</label>
				<input name="qualification" type="text" class="form-control" id="wlmp-marriage-qualification_update" placeholder="<?php esc_attr_e( "Qualification", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr( $marriage->qualification ); ?>">
			</div>
			<div class="form-group">
				<label for="wlmp-marriage-occupation_update" class="col-form-label"><?php esc_html_e( 'Occupation', WL_MP_DOMAIN ); ?>:</label>
				<input name="occupation" type="text" class="form-control" id="wlmp-marriage-occupation_update" placeholder="<?php esc_attr_e( "Occupation", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->occupation); ?>">
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="wlmp-marriage-email_update" class="col-form-label"><?php esc_html_e( 'Email', WL_MP_DOMAIN ); ?>:</label>
					<input name="email" type="email" class="form-control" id="wlmp-marriage-email_update" placeholder="<?php esc_attr_e( "Email", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->email); ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="wlmp-marriage-zip_update" class="col-form-label"><?php esc_html_e( 'Zip', WL_MP_DOMAIN ); ?>:</label>
					<input name="zip" type="text" class="form-control" id="wlmp-marriage-zip_update" placeholder="<?php esc_attr_e( "Zip", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->zip); ?>">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-sm-6">
					<label for="wlmp-marriage-date_of_birth_update" class="col-form-label"><?php esc_html_e( 'Date of Birth', WL_MP_DOMAIN ); ?>:</label>
					<input name="date_of_birth" type="text" class="form-control" id="wlmp-marriage-date_of_birth_update" placeholder="<?php esc_attr_e( "DOB in yyyy-mm-dd", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->date_of_birth) ? date_format( date_create( $marriage->date_of_birth ), "Y-m-d" ) : ''; ?>">
				</div>
				<div class="form-group col-sm-6">
					<label for="wlmp-marriage-phone_update" class="col-form-label"><?php esc_html_e( 'Phone Number', WL_MP_DOMAIN ); ?>:</label>
					<input name="phone" type="text" class="form-control" id="wlmp-marriage-phone_update" placeholder="<?php esc_attr_e( "Phone Number", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->phone); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="wlmp-marriage-religion_update" class="col-form-label"><?php esc_html_e( 'Religion', WL_MP_DOMAIN ); ?>:</label>
				<input name="religion" type="text" class="form-control" id="wlmp-marriage-religion_update" placeholder="<?php esc_attr_e( "Religion", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->religion); ?>">
			</div>
			<div class="form-group">
				<label for="wlmp-marriage-marital_status_update"><?php esc_html_e( 'Marital Status', WL_MP_DOMAIN ); ?>:</label>
				<select name="marital_status" class="form-control" id="wlmp-marriage-marital_status_update">
					<option value="Never Married"><?php esc_html_e( 'Never Married', WL_MP_DOMAIN ); ?></option>
					<option value="Married"><?php esc_html_e( 'Married', WL_MP_DOMAIN ); ?></option>
					<option value="Awaiting-Divorce"><?php esc_html_e( 'Awaiting Divorce', WL_MP_DOMAIN ); ?></option>
					<option value="Divorced"><?php esc_html_e( 'Divorced', WL_MP_DOMAIN ); ?></option>
					<option value="Widowed"><?php esc_html_e( 'Widowed', WL_MP_DOMAIN ); ?></option>
					<option value="Annulled"><?php esc_html_e( 'Annulled', WL_MP_DOMAIN ); ?></option>
				</select>
			</div>
			<div class="form-group">
				<label for="wlmp-marriage-height_update"><?php esc_html_e( 'Height', WL_MP_DOMAIN ); ?>:</label>
				<select name="height" class="form-control" id="wlmp-marriage-height_update">
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
				<label for="wlmp-marriage-address_update" class="col-form-label"><?php esc_html_e( 'Address', WL_MP_DOMAIN ); ?>:</label>
				<textarea name="address" class="form-control" rows="2" id="wlmp-marriage-address_update" placeholder="<?php esc_attr_e( "Address", WL_MP_DOMAIN ); ?>"><?php echo esc_attr($marriage->address); ?></textarea>
			</div>
			<div class="row">
				<div class="form-group col-sm-4">
					<label for="wlmp-marriage-city_update" class="col-form-label"><?php esc_html_e( 'City', WL_MP_DOMAIN ); ?>:</label>
					<input name="city" type="text" class="form-control" id="wlmp-marriage-city_update" placeholder="<?php esc_attr_e( "City", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->city); ?>">
				</div>
				<div class="form-group col-sm-4">
					<label for="wlmp-marriage-state_update" class="col-form-label"><?php esc_html_e( 'State', WL_MP_DOMAIN ); ?>:</label>
					<input name="state" type="text" class="form-control" id="wlmp-marriage-state_update" placeholder="<?php esc_attr_e( "State", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->state); ?>">
				</div>
				<div class="form-group col-sm-4">
					<label for="wlmp-marriage-country_update" class="col-form-label"><?php esc_html_e( 'Country', WL_MP_DOMAIN ); ?>:</label>
					<input name="country" type="text" class="form-control" id="wlmp-marriage-country_update" placeholder="<?php esc_attr_e( "Country", WL_MP_DOMAIN ); ?>" value="<?php echo esc_attr($marriage->country); ?>">
				</div>
			</div>
			<div class="form-check form-check-inline">
				<input name="is_active" class="form-check-input" type="checkbox" id="wlmp-marriage-is_active_update" <?php echo esc_attr($marriage->is_active) ? "checked" : ""; ?>>
				<label class="form-check-label" for="wlmp-marriage-is_active_update">
					<?php esc_html_e( 'Is Active?', WL_MP_DOMAIN ); ?>
				</label>
			</div>
			<input type="hidden" name="marriage_id" value="<?php echo esc_attr($marriage->id); ?>"/>
		</form>
		<script>
			jQuery("input[name=looking_for][value=<?php echo esc_attr($marriage->looking_for); ?>]").prop("checked", true);
			jQuery("#wlmp-marriage-marital_status_update").val("<?php echo esc_attr($marriage->marital_status); ?>");
			jQuery("#wlmp-marriage-height_update").val("<?php echo esc_attr($marriage->height); ?>");
		</script>
		<?php
		die();
	}

	public static function wl_mp_update_marriage() {
		$id = intval( sanitize_text_field( $_POST['marriage_id'] ) );
		if ( ! wp_verify_nonce( $_POST["update-marriage-$id"], "update-marriage-$id" ) ) {
			die();
		}

		global $wpdb;

		$looking_for    = isset( $_POST['looking_for'] ) ? sanitize_text_field( $_POST['looking_for'] ) : '';
		$first_name     = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
		$last_name      = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
		$father_name    = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
		$mother_name    = isset( $_POST['mother_name'] ) ? sanitize_text_field( $_POST['mother_name'] ) : '';
		$qualification  = isset( $_POST['qualification'] ) ? sanitize_text_field( $_POST['qualification'] ) : '';
		$occupation     = isset( $_POST['occupation'] ) ? sanitize_text_field( $_POST['occupation'] ) : '';
		$email          = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
		$zip            = isset( $_POST['zip'] ) ? sanitize_text_field( $_POST['zip'] ) : '';
		$date_of_birth  = isset( $_POST['date_of_birth'] ) ? sanitize_text_field( $_POST['date_of_birth'] ) : '';
		$phone          = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
		$religion       = isset( $_POST['religion'] ) ? sanitize_text_field( $_POST['religion'] ) : '';
		$marital_status = isset( $_POST['marital_status'] ) ? sanitize_text_field( $_POST['marital_status'] ) : '';
		$height         = isset( $_POST['height'] ) ? sanitize_text_field( $_POST['height'] ) : '';
		$address        = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
		$city           = isset( $_POST['city'] ) ? sanitize_text_field( $_POST['city'] ) : '';
		$state          = isset( $_POST['state'] ) ? sanitize_text_field( $_POST['state'] ) : '';
		$country        = isset( $_POST['country'] ) ? sanitize_text_field( $_POST['country'] ) : '';
		$is_active      = isset( $_POST['is_active'] ) ? boolval( sanitize_text_field( $_POST['is_active'] ) ) : 0;

		$errors = [];
		if (  empty( $first_name ) ) {
			$errors['first_name'] = esc_html__( 'Please provide first name.', WL_MP_DOMAIN );
		}
		if (  empty( $address ) ) {
			$errors['address'] = esc_html__( 'Please provide address.', WL_MP_DOMAIN );
		}
		if (  empty( $city ) ) {
			$errors['city'] = esc_html__( 'Please specify city.', WL_MP_DOMAIN );
		}
		if (  empty( $state ) ) {
			$errors['state'] = esc_html__( 'Please specify state.', WL_MP_DOMAIN );
		}
		if (  empty( $country ) ) {
			$errors['country'] = esc_html__( 'Please specify country.', WL_MP_DOMAIN );
		}
		if (  ! empty( $email ) && ! is_email( $email ) ) {
			$errors['email'] = esc_html__( 'Please provide valid email address.', WL_MP_DOMAIN );
		}

		if (  ! empty( $marital_status ) && ! in_array( $marital_status, self::$marital_status_data ) ) {
			$errors['marital_status'] = esc_html__( 'Please select valid marital status.', WL_MP_DOMAIN );
		}

		if (  ! empty( $looking_for ) && ! in_array( $looking_for, self::$looking_for_data ) ) {
			$errors['looking_for'] = esc_html__( 'Please select either Groom or Bride.', WL_MP_DOMAIN );
		}

		if (  ! empty( $height ) && ! in_array( $height, self::$height_data ) ) {
			$errors['height'] = esc_html__( 'Please select valid height.', WL_MP_DOMAIN );
		}

		if ( ! empty( $date_of_birth) ) {
			if ( ! preg_match( "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $date_of_birth ) ) {
				$errors['date_of_birth'] = esc_html__( 'Invalid date.', WL_MP_DOMAIN );
			} else {
				$d = explode( "-"  , $date_of_birth );
				if( ! checkdate( $d[1], $d[2], $d[0]) ) {
					$errors['date_of_birth'] = esc_html__( 'Not a recognised date.', WL_MP_DOMAIN );
				} else {
					$date_of_birth = date( "Y-m-d H:i:s", strtotime( $date_of_birth) );
				}
			}
		} else {
			$date_of_birth = null;
		}

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );
				$wpdb->update( "{$wpdb->prefix}wl_mp_marriage",
					array(
						'looking_for'    => $looking_for,
						'first_name'     => $first_name,
						'last_name'      => $last_name,
						'father_name'    => $father_name,
						'mother_name'    => $mother_name,
						'qualification'  => $qualification,
						'occupation'     => $occupation,
						'email'          => $email,
						'zip'            => $zip,
						'date_of_birth'  => $date_of_birth,
						'phone'          => $phone,
						'religion'       => $religion,
						'marital_status' => $marital_status,
						'height'         => $height,
						'address'        => $address,
						'city'           => $city,
						'state'          => $state,
						'country'        => $country,
						'is_active'      => $is_active,
						'updated_at'     => date('Y-m-d H:i:s')
					),
					array( 'id' => $id )
				);
				$wpdb->query( 'COMMIT;' );
				wp_send_json_success();
			} catch ( \Exception $exception ) {
				$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error();
			}
		}
		wp_send_json_error( $errors );
	}

	public static function wl_mp_delete_marriage() {
		$id = intval( sanitize_text_field( $_POST['id'] ) );
		if ( ! wp_verify_nonce( $_POST["delete-marriage-$id"], "delete-marriage-$id" ) ) {
			die();
		}

		global $wpdb;

		try {
			$wpdb->query( 'BEGIN;' );
			$wpdb->delete( "{$wpdb->prefix}wl_mp_marriage", array( 'id' => $id ) );
			$wpdb->query( 'COMMIT;' );
			wp_send_json_success();
		} catch ( \Exception $exception ) {
			$wpdb->query( 'ROLLBACK;' );
			wp_send_json_error();
		}
	}
}
?>