<?php

function rcp_check_if_upgrade_needed() {
	global $rcp_db_version, $rcp_discounts_db_version, $rcp_payments_db_version;
	
	if( $rcp_db_version != get_option( 'rcp_db_version' ) ) {
		return true;
	}
	if( $rcp_discounts_db_version != get_option( 'rcp_discounts_db_version' ) ) {
		return true;
	}
	if( $rcp_payments_db_version != get_option( 'rcp_payments_db_version' ) ) {
		return true;
	}
	return false;
}
add_action( 'admin_init', 'rcp_check_if_upgrade_needed' );

function rcp_run_upgrade() {
	if( isset( $_GET['rcp-action'] ) && $_GET['rcp-action'] == 'upgrade' && rcp_check_if_upgrade_needed() ) {
		rcp_options_upgrade();
		wp_redirect( admin_url() ); exit;
	}
}
add_action( 'admin_init', 'rcp_run_upgrade' );

function rcp_options_upgrade() {

	global $wpdb, $rcp_db_name, $rcp_db_version, $rcp_discounts_db_name, $rcp_discounts_db_version, $rcp_payments_db_name, $rcp_payments_db_version;

	
	/****************************************
	* upgrade discount codes DB
	****************************************/
	
	if( !$wpdb->query( "SELECT `max_uses` FROM `" . $rcp_discounts_db_name . "`" ) ) {
		$wpdb->query( "ALTER TABLE `" . $rcp_discounts_db_name . "` ADD `max_uses` mediumint" );
		update_option( 'rcp_discounts_db_version', $rcp_discounts_db_version );	
	}
	if(!$wpdb->query( "SELECT `expiration` FROM `" . $rcp_discounts_db_name . "`" ) ) 
	{
		$wpdb->query( "ALTER TABLE `" . $rcp_discounts_db_name . "` ADD `expiration` mediumtext" );
		update_option( 'rcp_discounts_db_version', $rcp_discounts_db_version );	
	}
	
	/****************************************
	* upgrade subscription levels DB
	****************************************/
	
	if( get_option('rcp_db_version') == '' )
		update_option( 'rcp_db_version', $rcp_db_version );
	
	if( !$wpdb->query( "SELECT `level` FROM `" . $rcp_db_name . "`" ) ) {
		$wpdb->query( "ALTER TABLE `" . $rcp_db_name . "` ADD `level` mediumtext" );
		update_option( 'rcp_db_version', $rcp_db_version );	
	}
	if(!$wpdb->query( "SELECT `status` FROM `" . $rcp_db_name . "`" ) ) {
		$wpdb->query( "ALTER TABLE `" . $rcp_db_name . "` ADD `status` tinytext" );
		update_option( 'rcp_db_version', $rcp_db_version );	
	}
	if(!$wpdb->query( "SELECT `status` FROM `" . $rcp_db_name . "`") ) {
		$wpdb->query( "ALTER TABLE `" . $rcp_db_name . "` ADD `status` tinytext" );
		update_option( 'rcp_db_version', $rcp_db_version );	
	}

	/****************************************
	* upgrade payments DB
	****************************************/

	if( get_option( 'rcp_payments_db_version' ) == '1.0' ) {
		$wpdb->query( "ALTER TABLE " . $rcp_payments_db_name . " MODIFY `amount` mediumtext" );
		update_option( "rcp_payments_db_version", $rcp_payments_db_version );	
	}	
	
}
register_activation_hook( RCP_PLUGIN_FILE, 'rcp_options_upgrade' );

// this is a one-time function to upgrade database table collation
function rcp_upgrade_table_collation() {
	if( isset( $_GET['rcp-action'] ) && $_GET['rcp-action'] == 'db-collate' ) {
		global $wpdb, $rcp_db_name, $rcp_db_version, $rcp_discounts_db_name, $rcp_discounts_db_version, $rcp_payments_db_name, $rcp_payments_db_version;
			
		$wpdb->query( "alter table `" . $rcp_db_name . "` convert to character set utf8 collate utf8_unicode_ci" );
		$wpdb->query( "alter table `" . $rcp_discounts_db_name . "` convert to character set utf8 collate utf8_unicode_ci" );
		$wpdb->query( "alter table `" . $rcp_payments_db_name . "` convert to character set utf8 collate utf8_unicode_ci" );
		wp_redirect( add_query_arg('rcp-db', 'updated', admin_url() ) ); exit;
	}
}
add_action( 'admin_init', 'rcp_upgrade_table_collation' );