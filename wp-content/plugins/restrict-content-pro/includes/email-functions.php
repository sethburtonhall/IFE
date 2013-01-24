<?php

function rcp_email_subscription_status( $user_id, $status = 'active' ) {

	global $rcp_options;

	$user_info = get_userdata($user_id);
	$admin_email = get_option('admin_email');
	$message = '';
	$admin_message = '';

	$site_name = stripslashes_deep( html_entity_decode( get_bloginfo('name'), ENT_COMPAT, 'UTF-8' ) );

	switch ($status) :

		case "active" :
			$message = $rcp_options['active_email'];
			wp_mail( $user_info->user_email, $rcp_options['active_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('is now subscribed to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Subscription level', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_active_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_email, __('New subscription on ', 'rcp') . $site_name, $admin_message );
			}
		break;

		case "cancelled" :
			$message = $rcp_options['cancelled_email'];
			wp_mail( $user_info->user_email, $rcp_options['cancelled_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('has cancelled their subscription to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Their subscription level was', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_cancelled_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_email, __('Cancelled subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		case "expired" :
			$message = $rcp_options['expired_email'];
			wp_mail( $user_info->user_email, $rcp_options['expired_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name . "'s " . __('subscription has expired', 'rcp') . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_expired_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_email, __('Expired subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		case "free" :
			$message = $rcp_options['free_email'];
			wp_mail( $user_info->user_email, $rcp_options['free_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('is now subscribed to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Subscription level', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_free_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_email, __('New free subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		case "trial" :
			$message = $rcp_options['trial_email'];
			wp_mail( $user_info->user_email, $rcp_options['trial_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('is now subscribed to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Subscription level', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_trial_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_email, __('New trial subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		default:
			break;

	endswitch;
}

function rcp_filter_email_tags($message, $user_id, $display_name) {

	$site_name = stripslashes_deep( html_entity_decode( get_bloginfo('name'), ENT_COMPAT, 'UTF-8' ) );

	$message = str_replace('%blogname%', $site_name, $message);
	$message = str_replace('%username%', $display_name, $message);
	$message = str_replace('%expiration%', rcp_get_expiration_date($user_id), $message);
	$message = str_replace('%subscription_name%', rcp_get_subscription($user_id), $message);
	$message = str_replace('%subscription_key%', rcp_get_subscription_key($user_id), $message);
	$message = str_replace('%amount%', html_entity_decode( rcp_currency_filter( rcp_get_users_last_payment_amount( $user_id ) ), ENT_COMPAT, 'UTF-8' ), $message);

	return htmlspecialchars($message);
}