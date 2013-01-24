<?php

// displays error messages from form submissions
function rcp_show_error_messages( $error_id = '' ) {
	if( $codes = rcp_errors()->get_error_codes() ) {
		do_action( 'rcp_errors_before' );
		echo '<div class="rcp_message error">';
		    // Loop error codes and display errors
		   foreach( $codes as $code ) {
		   		if( rcp_errors()->get_error_data( $code ) == $error_id ) {

			        $message = rcp_errors()->get_error_message($code);
			        
			        do_action( 'rcp_error_before' );
			        echo '<p class="rcp_error"><span><strong>' . __( 'Error', 'rcp' ) . '</strong>: ' . esc_html( $message ) . '</span></p>';
			        do_action( 'rcp_error_after' );
		    	}
		    }
		echo '</div>';
		do_action( 'rcp_errors_after' );
	}	
}

// used for tracking error messages
function rcp_errors(){
    static $wp_error; // Will hold global variable safely
    return isset( $wp_error ) ? $wp_error : ( $wp_error = new WP_Error( null, null, null ) );
}