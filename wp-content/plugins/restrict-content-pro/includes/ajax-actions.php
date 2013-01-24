<?php
/*
* Check whether a discount code is valid. Used during registration to validate a discount code on the fly
* @param - string $code - the discount code to validate
* return none
*/
function rcp_validate_discount_with_ajax() {
	if( isset( $_POST['code'] ) ) {
		if( rcp_validate_discount( $_POST['code'] ) ) {
			$code_details = rcp_get_discount_details_by_code( $_POST['code'] );
			if( $code_details && $code_details->amount == 100 && $code_details->unit == '%' ) {
				// this is a 100% discount
				echo 'valid and full';
			} else {
				echo 'valid';
			}
		} else {
			echo 'invalid';
		}
	}
	die();
}
add_action( 'wp_ajax_validate_discount', 'rcp_validate_discount_with_ajax' );
add_action( 'wp_ajax_nopriv_validate_discount', 'rcp_validate_discount_with_ajax' );