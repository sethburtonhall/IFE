<?php

function rcp_admin_scripts($hook) {
	global $rcp_members_page, $rcp_subscriptions_page, $rcp_discounts_page, $rcp_payments_page, $rcp_settings_page, $rcp_export_page, $rcp_help_page;
	$pages = array( $rcp_members_page, $rcp_subscriptions_page, $rcp_discounts_page, $rcp_payments_page, $rcp_settings_page, $rcp_export_page, $rcp_help_page );
	
	if( in_array( $hook, $pages ) ) {
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'bbq',  RCP_PLUGIN_URL . 'includes/js/jquery.ba-bbq.min.js' );
		wp_enqueue_script( 'rcp-admin-scripts',  RCP_PLUGIN_URL . 'includes/js/admin-scripts.js' );
	}
	if( $hook == $rcp_help_page ) {
		wp_enqueue_style( 'jquery-snippet',  RCP_PLUGIN_URL . 'includes/css/jquery.snippet.min.css' );	
		wp_enqueue_script( 'jquery-snippet',  RCP_PLUGIN_URL . 'includes/js/jquery.snippet.min.js' );	
	}
	if( $hook == $rcp_members_page ) {
		wp_localize_script( 'rcp-admin-scripts', 'rcp_member_vars', array(
				'rcp_member_nonce' => wp_create_nonce( 'rcp_member_nonce' )
			)
		); 	
	}
}
add_action( 'admin_enqueue_scripts', 'rcp_admin_scripts' );

function rcp_admin_styles( $hook ) {
	global $rcp_members_page, $rcp_subscriptions_page, $rcp_discounts_page, $rcp_payments_page, $rcp_settings_page, $rcp_export_page, $rcp_help_page;
	$pages = array(
		$rcp_members_page, 
		$rcp_subscriptions_page, 
		$rcp_discounts_page, 
		$rcp_payments_page, 
		$rcp_settings_page, 
		$rcp_export_page,
		$rcp_help_page,
		'post.php',
		'edit.php',
		'post-new.php'
	);
	
	if( in_array( $hook, $pages ) ) {
		wp_enqueue_style( 'datepicker',  RCP_PLUGIN_URL . 'includes/css/datepicker.css' );
		wp_enqueue_style( 'rcp-admin',  RCP_PLUGIN_URL . 'includes/css/admin-styles.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'rcp_admin_styles' );


// register our form css
function rcp_register_css() {
	wp_register_style('rcp-form-css',  RCP_PLUGIN_URL . 'includes/css/forms.css', RCP_PLUGIN_VERSION );
}
add_action('init', 'rcp_register_css');

// register our front end scripts
function rcp_register_scripts() {
	wp_register_script( 'rcp-scripts',  RCP_PLUGIN_URL . 'includes/js/front-end-scripts.js', array('jquery') );
	wp_register_script( 'jquery-validate',  RCP_PLUGIN_URL . 'includes/js/jquery.validate.min.js', array('jquery') );
}
add_action( 'init', 'rcp_register_scripts' );
 
// load our form css
function rcp_print_css() {
	global $rcp_load_css, $rcp_options;
 
	// this variable is set to TRUE if the short code is used on a page/post
	if ( ! $rcp_load_css || ( isset( $rcp_options['disable_css'] ) && $rcp_options['disable_css'] ) )
		return; // this means that neither short code is present, so we get out of here

	wp_print_styles( 'rcp-form-css' );
}
add_action( 'wp_footer', 'rcp_print_css' );

// load our form scripts
function rcp_print_scripts() {
	global $rcp_load_scripts, $rcp_options;
 
	// this variable is set to TRUE if the short code is used on a page/post
	if ( ! $rcp_load_scripts )
		return; // this means that neither short code is present, so we get out of here

	if( isset( $rcp_options['front_end_validate'] ) )
		$validate = 'true';
	else
		$validate = 'false';
	
	wp_localize_script('rcp-scripts', 'rcp_script_options', 
		array( 
			'validate' 	=> $validate,
			'ajaxurl' 	=> admin_url( 'admin-ajax.php' )
		) 
	);
	wp_print_scripts( 'rcp-scripts' );
	wp_print_scripts( 'jquery-validate' );
}
add_action( 'wp_footer', 'rcp_print_scripts' );