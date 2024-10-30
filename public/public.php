<?php
defined( 'ABSPATH' ) or die();

require_once( 'WL_MP_Language.php' );
require_once( 'WL_MP_Shortcode.php' );
require_once( 'inc/controllers/WL_MP_Marriage_Front.php' );

add_action( 'plugins_loaded', array( 'WL_MP_Language', 'loadTranslation' ) );
add_shortcode( 'wl_mp_marriage_form', array( 'WL_MP_Shortcode', 'marriageForm' ) );

add_action( 'admin_post_wl-mp-add-marriage', array( 'WL_MP_Marriage_Front', 'wl_mp_add_marriage' ) );
add_action( 'admin_post_nopriv_wl-mp-add-marriage', array( 'WL_MP_Marriage_Front', 'wl_mp_add_marriage' ) );
?>