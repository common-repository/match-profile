<?php
defined( 'ABSPATH' ) or die();

class WL_MP_Shortcode {
	public static function marriageForm( $attr ) {
		/* Enqueue styles */

		wp_enqueue_style( 'bootstrap', WL_MP_PLUGIN_URL . '/public/css/bootstrap.min.css' );
		
		wp_enqueue_style( 'wl-mp-toastr', WL_MP_PLUGIN_URL . '/assets/css/toastr.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wl-mp-toastr-js', WL_MP_PLUGIN_URL . '/assets/js/toastr.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-ajax-js', WL_MP_PLUGIN_URL . '/public/js/wl-mp-ajax.js', array( 'jquery' ) );
		ob_start();
		require_once( 'inc/wl_mp_marriage_form.php' );
		return ob_get_clean();
	}
}