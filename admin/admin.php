<?php
defined( 'ABSPATH' ) or die();

require_once( 'WL_MP_Menu.php' );
require_once( 'inc/controllers/WL_MP_Marriage.php' );

add_action( 'admin_menu', array( 'WL_MP_Menu', 'createMenu' ) );
add_action( 'wp_ajax_wl-mp-get-marriage-data', array( 'WL_MP_Marriage', 'wl_mp_get_marriage_data' ) );
add_action( 'wp_ajax_wl-mp-add-marriage', array( 'WL_MP_Marriage', 'wl_mp_add_marriage' ) );
add_action( 'wp_ajax_wl-mp-fetch-marriage', array( 'WL_MP_Marriage', 'wl_mp_fetch_marriage' ) );
add_action( 'wp_ajax_wl-mp-update-marriage', array( 'WL_MP_Marriage', 'wl_mp_update_marriage' ) );
add_action( 'wp_ajax_wl-mp-delete-marriage', array( 'WL_MP_Marriage', 'wl_mp_delete_marriage' ) );
?>