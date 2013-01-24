<?php

// login form fields
function rcp_login_form_fields( $args = array() ) {

	global $post;

	$action = rcp_get_current_url();

	// parse the arguments passed
	$defaults = array (
 		'redirect' => $action,
 		'class' => 'rcp_form'
	);
	$args = wp_parse_args( $args, $defaults );
	// setup each argument in its own variable
	extract( $args, EXTR_SKIP );

	ob_start();

		do_action( 'rcp_before_login_form' );

		if( !is_user_logged_in() ) {

			// show any error messages after form submission
			rcp_show_error_messages( 'login' ); ?>

			<form id="rcp_login_form"  class="<?php echo $class; ?>" method="POST" action="<?php echo esc_url( $action ); ?>">
				<fieldset class="rcp_login_data">
					<p>
						<label for="rcp_user_Login"><?php _e( 'Username', 'rcp' ); ?></label>
						<input name="rcp_user_login" id="rcp_user_login" class="required" type="text"/>
					</p>
					<p>
						<label for="rcp_user_pass"><?php _e( 'Password', 'rcp' ); ?></label>
						<input name="rcp_user_pass" id="rcp_user_pass" class="required" type="password"/>
					</p>
					<p class="rcp_lost_password"><a href="<?php echo esc_url( wp_lostpassword_url( $action ) ); ?>"><?php _e( 'Lost your password?', 'rcp' ); ?></a></p>
					<p>
						<input type="hidden" name="rcp_action" value="login"/>
						<input type="hidden" name="rcp_redirect" value="<?php echo esc_url( $redirect ); ?>"/>
						<input type="hidden" name="rcp_login_nonce" value="<?php echo wp_create_nonce( 'rcp-login-nonce' ); ?>"/>
						<input id="rcp_login_submit" type="submit" value="Login"/>
					</p>
				</fieldset>
			</form>
			<?php
		} else {
			echo __( 'You are logged in.', 'rcp' ) . ' <a href="' . wp_logout_url( home_url() ) . '">' . __( 'Logout', 'rcp' ) . '</a>';
		}

		do_action( 'rcp_after_login_form' );

	return ob_get_clean();
}

// registration form fields
function rcp_registration_form_fields( $args = array() ) {
	global $rcp_options, $rcp_db_name, $rcp_discounts_db_name, $wpdb, $post;

	// parse the arguments passed
	$defaults = array (
 		'class' => 'rcp_form'
	);
	$args = wp_parse_args( $args, $defaults );
	// setup each argument in its own variable
	extract( $args, EXTR_SKIP );

	$action = rcp_get_current_url();

	ob_start(); ?>

		<?php if( !is_user_logged_in() ) { ?>
			<h3 class="rcp_header">
				<?php echo apply_filters( 'rcp_registration_header_logged_in', __( 'Register New Account', 'rcp' ) ); ?>
			</h3>
		<?php } else { ?>
			<h3 class="rcp_header">
				<?php echo apply_filters( 'rcp_registration_header_logged_out', __( 'Add a Subscription', 'rcp' ) ); ?>
			</h3>
		<?php }

		do_action( 'rcp_before_register_form' );

		// show any error messages after form submission
		rcp_show_error_messages( 'register' ); ?>

		<form id="rcp_registration_form" class="<?php echo esc_attr( $class ); ?>" method="POST" action="<?php echo esc_url( $action ); ?>">

			<?php if( !is_user_logged_in() ) { ?>

			<?php do_action( 'rcp_before_register_form_fields' ); ?>

			<fieldset class="rcp_user_fieldset">
				<p id="rcp_user_login_wrap">
					<label for="rcp_user_Login"><?php echo apply_filters ( 'rcp_registration_username_label', __( 'Username', 'rcp' ) ); ?></label>
					<input name="rcp_user_login" id="rcp_user_login" class="required" type="text" <?php if( isset( $_POST['rcp_user_login'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_login'] ) . '"'; } ?>/>
				</p>
				<p id="rcp_user_email_wrap">
					<label for="rcp_user_email"><?php echo apply_filters ( 'rcp_registration_email_label', __( 'Email', 'rcp' ) ); ?></label>
					<input name="rcp_user_email" id="rcp_user_email" class="required" type="email" <?php if( isset( $_POST['rcp_user_email'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_email'] ) . '"'; } ?>/>
				</p>
				<p id="rcp_user_first_wrap">
					<label for="rcp_user_first"><?php echo apply_filters ( 'rcp_registration_firstname_label', __( 'First Name', 'rcp' ) ); ?></label>
					<input name="rcp_user_first" id="rcp_user_first" type="text" <?php if( isset( $_POST['rcp_user_first'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_first'] ) . '"'; } ?>/>
				</p>
				<p id="rcp_user_last_wrap">
					<label for="rcp_user_last"><?php echo apply_filters ( 'rcp_registration_lastname_label', __( 'Last Name', 'rcp' ) ); ?></label>
					<input name="rcp_user_last" id="rcp_user_last" type="text" <?php if( isset( $_POST['rcp_user_last'] ) ) { echo 'value="' . esc_attr( $_POST['rcp_user_last'] ) . '"'; } ?>/>
				</p>
				<p id="rcp_password_wrap">
					<label for="password"><?php echo apply_filters ( 'rcp_registration_password_label', __( 'Password', 'rcp' ) ); ?></label>
					<input name="rcp_user_pass" id="rcp_password" class="required" type="password"/>
				</p>
				<p id="rcp_password_again_wrap">
					<label for="password_again"><?php echo apply_filters ( 'rcp_registration_password_again_label', __( 'Password Again', 'rcp' ) ); ?></label>
					<input name="rcp_user_pass_confirm" id="rcp_password_again" class="required" type="password"/>
				</p id="rcp_user_login_wrap">

				<?php do_action( 'rcp_after_password_registration_field' ); ?>

			</fieldset>
			<?php }

			$levels = rcp_get_subscription_levels( 'active', true );
			if( $levels && count( $levels ) > 1 ) : ?>
			<fieldset class="rcp_subscription_fieldset">
				<p class="rcp_subscription_message"><?php echo apply_filters ( 'rcp_registration_choose_subscription', __( 'Choose your subscription level', 'rcp' ) ); ?></p>
				<ul id="rcp_subscription_levels">
					<?php
						foreach( $levels as $key => $level ) : ?>
							<?php if( rcp_show_subscription_level( $level->id ) ) : ?>
							<li id="rcp_subscription_level_<?php echo $level->id; ?>" class="rcp_subscription_level">
								<input type="radio" class="required rcp_level" <?php if( $key == 0 || ( isset( $_GET['level']) && $_GET['level'] == $key ) ){ echo 'checked="checked"'; }?> name="rcp_level" rel="<?php echo esc_attr( $level->price ); ?>" value="<?php echo esc_attr( absint( $level->id ) ); ?>" <?php if( $level->duration == 0 ) { echo 'data-duration="forever"'; } ?>/>&nbsp;
								<span class="rcp_subscription_level_name"><?php echo utf8_decode( stripcslashes( $level->name ) ); ?></span><span class="rcp_separator">&nbsp;-&nbsp;</span><span class="rcp_price" rel="<?php echo esc_attr( $level->price ); ?>"><?php echo $level->price > 0 ? rcp_currency_filter( $level->price ) : __( 'free', 'rcp' ); ?><span class="rcp_separator">&nbsp;-&nbsp;</span></span>
								<span class="rcp_level_duration"><?php echo $level->duration > 0 ? $level->duration . '&nbsp;' . rcp_filter_duration_unit( $level->duration_unit, $level->duration ) : __( 'unlimited', 'rcp' ); ?></span>
								<div class="rcp_level_description <?php if( $single_level ){ echo 'rcp_single_level_description'; }?>"> <?php echo stripslashes( utf8_decode( $level->description ) ); ?></div>
							</li>
							<?php endif; ?>
						<?php endforeach; ?>
				</ul>
			<?php elseif($levels) : ?>
				<input type="hidden" class="rcp_level" name="rcp_level" rel="<?php echo esc_attr( $levels[0]->price ); ?>" value="<?php echo esc_attr( $levels[0]->id ); ?>"/>
			<?php else : ?>
				<p><strong><?php _e( 'You have not created any subscription levels yet', 'rcp' ); ?></strong></p>
			<?php endif; ?>
			</fieldset>
				<?php
				$discounts = rcp_get_discounts();
				if( $discounts ) : ?>
					<p id="rcp_discount_code_wrap">
						<label for="rcp_discount_code">
							<?php _e( 'Discount Code', 'rcp' ); ?>
							<span class="rcp_discount_valid" style="display: none;"> - <?php _e( 'Valid', 'rcp' ); ?></span>
							<span class="rcp_discount_invalid" style="display: none;"> - <?php _e( 'Invalid', 'rcp' ); ?></span>
						</label>
						<input type="text" id="rcp_discount_code" name="rcp_discount" class="rcp_discount_code" value=""/>
					</p>
				<?php endif;

				do_action( 'rcp_after_register_form_fields', $levels );

				$gateways = rcp_get_enabled_payment_gateways();
				if( count( $gateways ) > 1 ) :
					$display = rcp_has_paid_levels() ? '' : ' style="display: none;"';
					echo '<p id="rcp_payment_gateways"' . $display . '>';
						echo '<select name="rcp_gateway" id="rcp_gateway">';
							foreach( $gateways as $key => $gateway ) :
								echo '<option value="' . esc_attr( $key ) . '">' . esc_html( $gateway ) . '</option>';
							endforeach;
						echo '</select>';
						echo '<label for="rcp_gateway">' . __( 'Choose Your Payment Method', 'rcp' ) . '</label>';
					echo '</p>';
				else:
					foreach( $gateways as $key => $gateway ) :
						echo '<input type="hidden" name="rcp_gateway" value="' . esc_attr( $key ) . '"/>';
					endforeach;
				endif;

				do_action( 'rcp_before_registration_submit_field', $levels );

				?>

			</fieldset>
			<p id="rcp_submit_wrap">
				<input type="hidden" name="rcp_register_nonce" value="<?php echo wp_create_nonce('rcp-register-nonce' ); ?>"/>
				<input type="submit" name="rcp_submit_registration" id="rcp_submit" value="<?php echo apply_filters ( 'rcp_registration_register_button', __( 'Register', 'rcp' ) ); ?>"/>
			</p>
		</form>
		<?php
		do_action( 'rcp_after_register_form' );
	return ob_get_clean();
}

function rcp_change_password_form( $args = array() ) {
	global $post;

	$redirect = rcp_get_current_url();

	// parse the arguments passed
	$defaults = array (
 		'redirect' => $current_url,
 		'class' => 'rcp_form'
	);
	$args = wp_parse_args( $args, $defaults );
	// setup each argument in its own variable
	extract( $args, EXTR_SKIP );

	ob_start();

		do_action( 'rcp_before_password_form' );

		// show any error messages after form submission
		rcp_show_error_messages( 'password' ); ?>

		<?php if( isset( $_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
			<div class="rcp_message success">
				<span><?php _e( 'Password changed successfully', 'rcp' ); ?></span>
			</div>
		<?php } ?>
		<form id="rcp_password_form"  class="<?php echo esc_attr( $class ); ?>" method="POST" action="<?php echo esc_url( $current_url ); ?>">
			<fieldset class="rcp_change_password_fieldset">
				<p>
					<label for="rcp_user_pass"><?php echo apply_filters ( 'rcp_registration_new_password_label', __( 'New Password', 'rcp' ) ); ?></label>
					<input name="rcp_user_pass" id="rcp_user_pass" class="required" type="password"/>
				</p>
				<p>
					<label for="rcp_user_pass_confirm"><?php echo apply_filters ( 'rcp_registration_confirm_password_label', __( 'Password Confirm', 'rcp' ) ); ?></label>
					<input name="rcp_user_pass_confirm" id="rcp_user_pass_confirm" class="required" type="password"/>
				</p>
				<p>
					<input type="hidden" name="rcp_action" value="reset-password"/>
					<input type="hidden" name="rcp_redirect" value="<?php echo esc_url( $redirect ); ?>"/>
					<input type="hidden" name="rcp_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce' ); ?>"/>
					<input id="rcp_password_submit" type="submit" value="<?php echo apply_filters ( 'rcp_registration_change_password_button', __( 'Change Password', 'rcp' ) ); ?>"/>
				</p>
			</fieldset>
		</form>
		<?php
		do_action( 'rcp_after_password_form' );
	return ob_get_clean();
}

function rcp_add_auto_renew( $levels ) {
	global $rcp_options;
	if( $levels && !isset( $rcp_options['disable_auto_renew'] ) ) : ?>
	<p id="rcp_auto_renew_wrap">
		<input name="rcp_auto_renew" id="rcp_auto_renew" type="checkbox" checked="checked"/>
		<label for="rcp_auto_renew"><?php echo apply_filters ( 'rcp_registration_auto_renew', __( 'Auto Renew', 'rcp' ) ); ?></label>
	</p>
	<?php endif;
}
add_action( 'rcp_before_registration_submit_field', 'rcp_add_auto_renew' );