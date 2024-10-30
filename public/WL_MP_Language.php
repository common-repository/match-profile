<?php
defined( 'ABSPATH' ) or die();

class WL_MP_Language {
	public static function loadTranslation() {
		load_plugin_textdomain( WL_MP_DOMAIN, false, basename( WL_MP_PLUGIN_DIR_PATH ) . '/languages' );
	}
}