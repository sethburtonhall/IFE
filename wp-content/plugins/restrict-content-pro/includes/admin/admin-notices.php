<?php

function rcp_first_activation_notice() {
	global $rcp_options;
	// only show notice if settings have never been saved
	if( !is_array( $rcp_options ) || $rcp_options == '') {
		echo '<div class="updated"><p>' . __( 'You should now configure your Restrict Content Pro settings', 'rcp' ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'rcp_first_activation_notice' );

function rcp_upgrade_needed_notice() {
	if( rcp_check_if_upgrade_needed() ) {
		echo '<div class="error"><p>' . __( 'The Restrict Content Pro database needs updated: ', 'rcp' ) . ' ' . '<a href="' . esc_url( add_query_arg( 'rcp-action', 'upgrade', admin_url() ) ) . '">' . __( 'upgrade now', 'rcp' ) . '</a></p></div>';
	}
	if( isset( $_GET['rcp-db'] ) && $_GET['rcp-db'] == 'updated' ) {
		echo '<div class="updated fade"><p>' . __( 'The Restrict Content Pro database has been updated', 'rcp' ) . '</p></div>';
	}
	if( isset( $_GET['edit_member'] ) && isset( $_GET['updated'] ) && $_GET['updated'] == 'true' ) {
		echo '<div class="updated fade"><p>' . __( 'Member updated', 'rcp' ) . '</p></div>';
	}
}
add_action('admin_notices', 'rcp_upgrade_needed_notice' );

function rcp_upgrade_complete_notice() {
	if( isset( $_GET['rcp-action'] ) && $_GET['rcp-action'] == 'upgrade-complete' )
		echo '<div class="updated"><p>' . __( 'Database upgrade complete', 'rcp' ) . '</p></div>';
}
add_action( 'admin_notices', 'rcp_upgrade_complete_notice' );