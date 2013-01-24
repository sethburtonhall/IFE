<?php

/*******************************************
* Restrict Content Feed Functions
*******************************************/

function rcp_filter_feed_posts($content) {
	global $rcp_options;
	$hide_from_feed = get_post_meta( get_the_ID(), 'rcp_hide_from_feed', true );
	if ( $hide_from_feed == 'on' ) {
		if( rcp_is_paid_content( $post_id ) ) {
			return $rcp_options['paid_message'];
		} else {
			return $rcp_options['free_message'];
		}
	}
	return $content;
	
}
add_action( 'the_excerpt_rss', 'rcp_filter_feed_posts' );
add_action( 'the_content_rss', 'rcp_filter_feed_posts' );
