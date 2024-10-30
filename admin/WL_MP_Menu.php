<?php
defined( 'ABSPATH' ) or die();

class WL_MP_Menu {
	public static function createMenu() {
		add_menu_page( esc_html__( 'Match Profile', WL_MP_DOMAIN ), esc_html__( 'Match Profile', WL_MP_DOMAIN ), 'manage_options', 'match_profile', array( 'WL_MP_Menu', 'menuCallback' ), 'dashicons-star-filled', 25 );
		add_submenu_page( 'match_profile', esc_html__( 'Match Profile', WL_MP_DOMAIN ), esc_html__( 'Match Profile', WL_MP_DOMAIN ), 'manage_options', 'match_profile', array( 'WL_MP_Menu', 'menuCallback' ) );
	
	}

	public static function menuCallback() {
		/* Enqueue styles */
		wp_enqueue_style( 'wl-mp-style', WL_MP_PLUGIN_URL . '/admin/css/wl-mp-style.css' );
		wp_enqueue_style( 'bootstrap', WL_MP_PLUGIN_URL . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style( 'mdb', WL_MP_PLUGIN_URL . '/assets/css/mdb.lite.min.css' );
		wp_enqueue_style( 'wl-mp-font-awesome', WL_MP_PLUGIN_URL . '/admin/css/all.min.css' );
		wp_enqueue_style( 'wl-mp-dataTables-bootstrap4', WL_MP_PLUGIN_URL . '/admin/css/dataTables.bootstrap4.min.css' );
		wp_enqueue_style( 'wl-mp-responsive-dataTables', WL_MP_PLUGIN_URL . '/admin/css/responsive.dataTables.min.css' );
		wp_enqueue_style( 'wl-mp-responsive-bootstrap4', WL_MP_PLUGIN_URL . '/admin/css/responsive.bootstrap4.min.css' );
		wp_enqueue_style( 'wl-mp-toastr', WL_MP_PLUGIN_URL . '/assets/css/toastr.min.css' );
		wp_enqueue_style( 'wl-mp-jquery-confirm', WL_MP_PLUGIN_URL . '/admin/css/jquery-confirm.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wl-mp-popper-js', WL_MP_PLUGIN_URL . '/admin/js/popper.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-bootstrap-js', WL_MP_PLUGIN_URL . '/assets/js/bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-jquery-dataTables-js', WL_MP_PLUGIN_URL . '/admin/js/jquery.dataTables.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-dataTables-bootstrap4-js', WL_MP_PLUGIN_URL . '/admin/js/dataTables.bootstrap4.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-dataTables-responsive-js', WL_MP_PLUGIN_URL . '/admin/js/dataTables.responsive.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-responsive-bootstrap4-js', WL_MP_PLUGIN_URL . '/admin/js/responsive.bootstrap4.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-toastr-js', WL_MP_PLUGIN_URL . '/assets/js/toastr.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-jquery-confirm-js', WL_MP_PLUGIN_URL . '/admin/js/jquery-confirm.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-script-js', WL_MP_PLUGIN_URL . '/admin/js/wl-mp-script.js', array( 'jquery' ) );
		wp_enqueue_script( 'wl-mp-ajax-js', WL_MP_PLUGIN_URL . '/admin/js/wl-mp-ajax.js', array( 'jquery' ) );
		wp_localize_script( 'wl-mp-ajax-js', 'WLMPAjax', array( 'security' => wp_create_nonce( 'wl-mp' ) ) );
		require_once( 'inc/wl_mp_menu_page.php' );
	}

	public static function ourProducts() {
		require_once( 'inc/wl_mp_our_products.php' );
	}

	public static function ourProductsAssets() {
		/* Enqueue styles */
		wp_enqueue_style( 'wl-mp-products', WL_MP_PLUGIN_URL . '/admin/css/wl-mp-products.css' );
		wp_enqueue_style( 'bootstrap', WL_MP_PLUGIN_URL . '/public/css/bootstrap.min.css' );

		/* Enqueue scripts */
		wp_enqueue_script( 'wl-mp-popper-js', WL_MP_PLUGIN_URL . '/admin/js/popper.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'bootstrap-js', WL_MP_PLUGIN_URL . '/public/js/bootstrap.js', array( 'jquery' ) );
	}
}
?>