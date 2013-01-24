<?php

/*******************************************
* Restrict Content Admin Pages
*******************************************/

function rcp_settings_menu() {

	global $rcp_members_page, $rcp_subscriptions_page, $rcp_discounts_page, $rcp_payments_page, $rcp_settings_page, $rcp_export_page, $rcp_help_page;

	// add settings page
	add_menu_page( __( 'Restrict Content Pro Settings', 'rcp' ), __( 'Restrict', 'rcp' ), 'manage_options', 'rcp-members', 'rcp_members_page',  plugin_dir_url( RCP_PLUGIN_FILE ) . 'includes/images/lock.png' );
	$rcp_members_page 		= add_submenu_page( 'rcp-members', __( 'Members', 'rcp' ), __( 'Members', 'rcp' ), 'manage_options', 'rcp-members', 'rcp_members_page' );
	$rcp_subscriptions_page = add_submenu_page( 'rcp-members', __( 'Subscription Levels', 'rcp' ), __( 'Subscription Levels', 'rcp' ), 'manage_options', 'rcp-member-levels', 'rcp_member_levels_page' );
	$rcp_discounts_page 	= add_submenu_page( 'rcp-members', __( 'Discounts', 'rcp' ), __( 'Discount Codes', 'rcp' ), 'manage_options', 'rcp-discounts', 'rcp_discounts_page' );
	$rcp_payments_page 		= add_submenu_page( 'rcp-members', __( 'Payments', 'rcp' ), __( 'Payments', 'rcp' ), 'manage_options', 'rcp-payments', 'rcp_payments_page' );
	$rcp_settings_page 		= add_submenu_page( 'rcp-members', __( 'Restrict Content Pro Settings', 'rcp' ), __( 'Settings', 'rcp' ),'manage_options', 'rcp-settings', 'rcp_settings_page' );
	$rcp_export_page 		= add_submenu_page( 'rcp-members', __( 'Export Member Data', 'rcp' ), __( 'Export', 'rcp' ),'manage_options', 'rcp-export', 'rcp_export_page' );
	$rcp_help_page 			= add_submenu_page( 'rcp-members', __( 'Help', 'rcp' ), __( 'Help', 'rcp' ), 'manage_options', 'rcp-help', 'rcp_help_page' );

	if ( get_bloginfo('version') >= 3.3 ) {
		// load each of the help tabs
		add_action( "load-$rcp_members_page", "rcp_help_tabs" );
		add_action( "load-$rcp_subscriptions_page", "rcp_help_tabs" );
		add_action( "load-$rcp_discounts_page", "rcp_help_tabs" );
		add_action( "load-$rcp_payments_page", "rcp_help_tabs" );
		add_action( "load-$rcp_settings_page", "rcp_help_tabs" );
		add_action( "load-$rcp_export_page", "rcp_help_tabs" );
	}
	add_action( "load-$rcp_members_page", "rcp_screen_options" );
	add_action( "load-$rcp_subscriptions_page", "rcp_screen_options" );
	add_action( "load-$rcp_discounts_page", "rcp_screen_options" );
	add_action( "load-$rcp_payments_page", "rcp_screen_options" );
	add_action( "load-$rcp_settings_page", "rcp_screen_options" );
	add_action( "load-$rcp_export_page", "rcp_screen_options" );
}
add_action( 'admin_menu', 'rcp_settings_menu' );