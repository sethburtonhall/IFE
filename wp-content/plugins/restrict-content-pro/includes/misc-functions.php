<?php


/**
 * Checks whether the post is Paid Only
 *
 * @access      private
 * @return      bool
*/

function rcp_is_paid_content( $post_id ) {
	if ( $post_id == '' || !is_int( $post_id ) )
		$post_id = get_the_ID();

	$return = false;

	$is_paid = get_post_meta( $post_id, '_is_paid', true );
	if ( $is_paid ) {
		// this post is for paid users only
		$return = true;
	}

	return (bool) apply_filters( 'rcp_is_paid_content', $return, $post_id );
}


/**
 * Retrieve a list of all Paid Only posts
 *
 * @access      public
 * @return      array
*/

function rcp_get_paid_posts() {
	$paid_ids = array();
	$paid_posts = get_posts( 'meta_key=_is_paid&meta_value=1&post_status=publish&posts_per_page=-1' );
	if ( $paid_posts ) {
		foreach ( $paid_posts as $p ) {
			$paid_ids[] = $p->ID;
		}
	}
	// return an array of paid post IDs
	return $paid_ids;
}


/**
 * Apply the currency sign to a price
 *
 * @access      public
 * @return      string
*/

function rcp_currency_filter( $price ) {
	global $rcp_options;
	$currency = isset( $rcp_options['currency'] ) ? $rcp_options['currency'] : 'USD';
	$position = isset( $rcp_options['currency_position'] ) ? $rcp_options['currency_position'] : 'before';
	if ( $position == 'before' ) :
		switch ( $currency ) :
		case "GBP" : return '&pound;' . $price; break;
		case "USD" :
		case "AUD" :
		case "BRL" :
		case "CAD" :
		case "HKD" :
		case "MXN" :
		case "SGD" :
			return '&#36;' . $price;
			break;
		case "JPY" : return '&yen;' . $price; break;
		default :
			$formatted = $currency . ' ' . $price;
			return apply_filters( 'rcp_' . strtolower( $currency ) . '_currency_filter_before', $formatted, $currency, $price );
			break;
			endswitch;
			else :
				switch ( $currency ) :
				case "GBP" : return $price . '&pound;'; break;
		case "USD" :
		case "AUD" :
		case "BRL" :
		case "CAD" :
		case "HKD" :
		case "MXN" :
		case "SGD" :
			return $price . '&#36;';
			break;
		case "JPY" : return $price . '&yen;'; break;
		default :
	$formatted = $price . ' ' . $currency;
	return apply_filters( 'rcp_' . strtolower( $currency ) . '_currency_filter_after', $formatted, $currency, $price );
	break;
	endswitch;
	endif;
}


/**
 * Get the currency list
 *
 * @access      private
 * @return      array
*/

function rcp_get_currencies() {
	$currencies = array(
		'USD' => __( 'US Dollars (&#36;)', 'rcp' ),
		'EUR' => __( 'Euros (&euro;)', 'rcp' ),
		'GBP' => __( 'Pounds Sterling (&pound;)', 'rcp' ),
		'AUD' => __( 'Australian Dollars (&#36;)', 'rcp' ),
		'BRL' => __( 'Brazilian Real (&#36;)', 'rcp' ),
		'CAD' => __( 'Canadian Dollars (&#36;)', 'rcp' ),
		'CZK' => __( 'Czech Koruna', 'rcp' ),
		'DKK' => __( 'Danish Krone', 'rcp' ),
		'HKD' => __( 'Hong Kong Dollar (&#36;)', 'rcp' ),
		'HUF' => __( 'Hungarian Forint', 'rcp' ),
		'ILS' => __( 'Israeli Shekel', 'rcp' ),
		'JPY' => __( 'Japanese Yen (&yen;)', 'rcp' ),
		'MYR' => __( 'Malaysian Ringgits', 'rcp' ),
		'MXN' => __( 'Mexican Peso (&#36;)', 'rcp' ),
		'NZD' => __( 'New Zealand Dollar (&#36;)', 'rcp' ),
		'NOK' => __( 'Norwegian Krone', 'rcp' ),
		'PHP' => __( 'Philippine Pesos', 'rcp' ),
		'PLN' => __( 'Polish Zloty', 'rcp' ),
		'SGD' => __( 'Singapore Dollar (&#36;)', 'rcp' ),
		'SEK' => __( 'Swedish Krona', 'rcp' ),
		'CHF' => __( 'Swiss Franc', 'rcp' ),
		'TWD' => __( 'Taiwan New Dollars', 'rcp' ),
		'THB' => __( 'Thai Baht', 'rcp' ),
		'TRY' => __( 'Turkish Lira', 'rcp' )
	);
	return apply_filters( 'rcp_currencies', $currencies );
}


/**
 * reverse of strstr()
 *
 * @access      private
 * @return      string
*/

function rcp_rstrstr( $haystack, $needle ) {
	return substr( $haystack, 0, strpos( $haystack, $needle ) );
}


/**
 * Is odd?
 *
 * Checks if a number is odd
 *
 * @access      private
 * @return      bool
*/

function rcp_is_odd( $int ) {
	return $int & 1;
}


/*
* Gets the excerpt of a specific post ID or object
* @param - $post - object/int - the ID or object of the post to get the excerpt of
* @param - $length - int - the length of the excerpt in words
* @param - $tags - string - the allowed HTML tags. These will not be stripped out
* @param - $extra - string - text to append to the end of the excerpt
*/

function rcp_excerpt_by_id( $post, $length = 50, $tags = '<a><em><strong><blockquote><ul><ol><li><p>', $extra = ' . . .' ) {

	if ( is_int( $post ) ) {
		// get the post object of the passed ID
		$post = get_post( $post );
	} elseif ( !is_object( $post ) ) {
		return false;
	}
	$more = false;
	if ( has_excerpt( $post->ID ) ) {
		$the_excerpt = $post->post_excerpt;
	} elseif ( strstr( $post->post_content, '<!--more-->' ) ) {
		$more = true;
		$length = strpos( $post->post_content, '<!--more-->' );
		$the_excerpt = $post->post_content;
	} else {
		$the_excerpt = $post->post_content;
	}

	$tags = apply_filters( 'rcp_excerpt_tags', $tags );

	if ( $more ) {
		$the_excerpt = strip_shortcodes( strip_tags( stripslashes( substr( $the_excerpt, 0, $length ) ), $tags ) );
	} else {
		$the_excerpt = strip_shortcodes( strip_tags( stripslashes( $the_excerpt ), $tags ) );
		$the_excerpt = preg_split( '/\b/', $the_excerpt, $length * 2+1 );
		$excerpt_waste = array_pop( $the_excerpt );
		$the_excerpt = implode( $the_excerpt );
		$the_excerpt .= $extra;
	}

	return wpautop( $the_excerpt );
}


/**
 * The default length for excerpts
 *
 * @access      private
 * @return      string
*/

function rcp_excerpt_length( $excerpt_length ) {
	// the number of words to show in the excerpt
	return 100;
}
add_filter( 'rcp_filter_excerpt_length', 'rcp_excerpt_length' );


/**
 * Get current URL
 *
 * Returns the URL to the current page, including detection for https
 *
 * @access      private
 * @return      string
*/

function rcp_get_current_url() {
	global $post;

	if ( is_singular() ) :

		$current_url = get_permalink( $post->ID );

	else :
		
		$current_url = 'http';
		if ( isset( $_SERVER["HTTPS"] ) && $_SERVER["HTTPS"] == "on" ) $current_url .= "s";

		$current_url .= "://";
		
		if ( $_SERVER["SERVER_PORT"] != "80" ) {
			$current_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else { 
			$current_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}
		
	endif;

	return apply_filters( 'rcp_current_url', $current_url );
}


/**
 * Log Types
 *
 * Sets up the valid log types for WP_Logging
 *
 * @access      private
 * @since       1.3.4
 * @return      array
*/

function rcp_log_types( $types ) {

    $types = array(
    	'gateway_error'
    );
    return $types;

}
add_filter( 'wp_log_types', 'rcp_log_types' );