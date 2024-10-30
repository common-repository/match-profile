<?php
defined( 'ABSPATH' ) or die();

class WL_MP_Database {
	public static function setup() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}wl_mp_marriage (
				id int(11) NOT NULL AUTO_INCREMENT,
				first_name varchar(255) NOT NULL,
				last_name varchar(255) DEFAULT NULL,
				father_name varchar(255) DEFAULT NULL,
				mother_name varchar(255) DEFAULT NULL,
				qualification varchar(255) DEFAULT NULL,
				occupation varchar(255) DEFAULT NULL,
				address text NOT NULL,
				city varchar(255) NOT NULL,
				state varchar(255) NOT NULL,
				zip varchar(255) DEFAULT NULL,
				country varchar(255) NOT NULL,
				phone varchar(255) DEFAULT NULL,
				email varchar(255) DEFAULT NULL,
				religion varchar(255) DEFAULT NULL,
				date_of_birth timestamp NULL DEFAULT NULL,
				height varchar(255) DEFAULT NULL,
				marital_status varchar(255) DEFAULT NULL,
				looking_for varchar(255) DEFAULT NULL,
				is_active tinyint(1) NOT NULL DEFAULT '1',
				`created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				`updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id)
				) $charset_collate";
		dbDelta( $sql );
	}
}