<?php
/*
 * Plugin Name: Match Profile
 * Plugin URI: https://weblizar.com
 * Description: Match Profile is a simple plugin to collect marriage profile data.
 * Version: 1.9
 * Author: Weblizar
 * Author URI: https://weblizar.com
 * Text Domain: WL_MP_DOMAIN
*/

defined( 'ABSPATH' ) or die();

if ( ! defined( 'WL_MP_DOMAIN' ) ) {
	define( 'WL_MP_DOMAIN', 'WL-MP' );
}

if ( ! defined( 'WL_MP_PLUGIN_URL') ) {
	define( 'WL_MP_PLUGIN_URL', plugins_url() . '/match-profile' );
}

if ( ! defined( 'WL_MP_PLUGIN_DIR_PATH' ) ) {
	define( 'WL_MP_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

final class WL_MP_MatchProfile {
	private static $instance = null;

	private function __construct() {
		$this->initializeHooks();
		$this->setupDatabase();
	}

	public static function getInstance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function initializeHooks() {
		if ( is_admin() ) {
			require_once( 'admin/admin.php' );
		}
		require_once( 'public/public.php' );
	}

	private function setupDatabase() {
		require_once( 'admin/WL_MP_Database.php' );
		register_activation_hook( __FILE__, array( 'WL_MP_Database', 'setup' ) );
	}
}
WL_MP_MatchProfile::getInstance();
?>
