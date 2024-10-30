<?php
defined( 'ABSPATH' ) or die();

require_once( WL_MP_PLUGIN_DIR_PATH . '/admin/inc/controllers/WL_MP_Marriage.php' );

class WL_MP_Marriage_Front extends WL_MP_Marriage {
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
					'country'        => $country
				) );
		  		$wpdb->query( 'COMMIT;' );
		  		wp_send_json_success( esc_html__( "Thank you for your details.", WL_MP_DOMAIN ) );
			} catch ( \Exception $exception ) {
		  		$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error();
			}
		}
		wp_send_json_error( $errors );
	}
}
?>