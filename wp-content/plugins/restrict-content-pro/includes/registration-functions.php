<?php

function rcp_get_return_url() {
	
	global $rcp_options;

	if( isset( $rcp_options['redirect'] ) ) {
		$redirect = get_permalink( $rcp_options['redirect'] );
	} else {
		$redirect = home_url();
	}
	return apply_filters( 'rcp_return_url', $redirect );
}