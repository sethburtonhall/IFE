<?php

function rcp_setup_cron_jobs() {
	if ( !wp_next_scheduled( 'rcp_expired_users_check' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'daily', 'rcp_expired_users_check' );
	}
}
add_action('wp', 'rcp_setup_cron_jobs');

// runs each day and checks for expired members. Each member gets an email on the day of their expiration
function rcp_check_for_expired_users() {
	$expired_members 	= get_users(array(
		'meta_key' 		=> 'rcp_expiration', 
		'meta_value' 	=> '', 
		'meta_compare' 	=> '!=',
		'number' 		=> 9999, 
		'count_total' 	=> false
		)
	);
	if( $expired_members ) {
		foreach( $expired_members as $member ) {
			
			$expiration_date = rcp_get_expiration_timestamp( $member->ID );
			if( $expiration_date ) {
				$expiration_date += 86400; // to make sure we have given PayPal enough time to send the IPN

				if( rcp_get_status( $member->ID ) == 'active' && rcp_is_expired( $member->ID ) && ( time() > $expiration_date ) ) {
					if( ! get_user_meta($member->ID, '_rcp_expired_email_sent', true ) ) {
						rcp_email_subscription_status( $member->ID, 'expired' );
						add_user_meta( $member->ID, '_rcp_expired_email_sent', 'yes' );
					}
				}
			}
		}
	}
}
add_action( 'rcp_expired_users_check', 'rcp_check_for_expired_users' );