<?php
/*
Plugin Name: Restrict Content Pro - Mail Chimp
Plugin URL: http://pippinsplugins.com/restrict-content-pro-mailchimp/
Description: Include a Mail Chimp signup option with your Restrict Content Pro registration form
Version: 1.1
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Contributors: Pippin Williamson
*/

function rcp_mailchimp_settings_menu() {
	// add settings page
	add_submenu_page('rcp-members', __('Restrict Content Pro Mail Chimp Settings', 'rcp'), __('Mail Chimp', 'rcp'),'manage_options', 'rcp-mailchimp', 'rcp_mailchimp_settings_page');
}
add_action('admin_menu', 'rcp_mailchimp_settings_menu', 100);

// register the plugin settings
function rcp_mailchimp_register_settings() {

	// create whitelist of options
	register_setting( 'rcp_mailchimp_settings_group', 'rcp_mailchimp_settings' );
}
//call register settings function
add_action( 'admin_init', 'rcp_mailchimp_register_settings', 100 );

function rcp_mailchimp_settings_page() {
	
	$rcp_mc_options = get_option('rcp_mailchimp_settings');
		
	?>
	<div class="wrap">
		<h2><?php _e('Restrict Content Pro Mail Chimp Settings', 'rcp'); ?></h2>
		<?php
		if ( ! isset( $_REQUEST['updated'] ) )
			$_REQUEST['updated'] = false;
		?>
		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'rcp' ); ?></strong></p></div>
		<?php endif; ?>
		<form method="post" action="options.php" class="rcp_options_form">

			<?php settings_fields( 'rcp_mailchimp_settings_group' ); ?>
			<?php $lists = rcp_get_mailchimp_lists(); ?>
				
			<table class="form-table">

				<tr>
					<th>
						<label for="rcp_mailchimp_settings[mailchimp_api]"><?php _e( 'Mail Chimp API Key', 'rcp' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" id="rcp_mailchimp_settings[mailchimp_api]" name="rcp_mailchimp_settings[mailchimp_api]" value="<?php if(isset($rcp_mc_options['mailchimp_api'])) { echo $rcp_mc_options['mailchimp_api']; } ?>"/>
						<div class="description"><?php _e('Enter your Mail Chimp API key to enable a newsletter signup option with the registration form.', 'rcp'); ?></div>
					</td>
				</tr>
				<tr>
					<th>
						<label for="rcp_mailchimp_settings[mailchimp_list]"><?php _e( 'Newsletter List', 'rcp' ); ?></label>
					</th>
					<td>
						<select id="rcp_mailchimp_settings[mailchimp_list]" name="rcp_mailchimp_settings[mailchimp_list]">
							<?php
								if($lists) :
									foreach($lists as $list) :
										echo '<option value="' . $list['id'] . '"' . selected($rcp_mc_options['mailchimp_list'], $list['id'], false) . '>' . $list['name'] . '</option>';
									endforeach;
								else :
							?>
							<option value="no list"><?php _e('no lists', 'rcp'); ?></option>
						<?php endif; ?>
						</select>
						<div class="description"><?php _e('Choose the list to subscribe users to', 'rcp'); ?></div>
					</td>
				</tr>
				<tr>
					<th>
						<label for="rcp_mailchimp_settings[signup_label]"><?php _e( 'Form Label', 'rcp' ); ?></label>
					</th>
					<td>
						<input class="regular-text" type="text" id="rcp_mailchimp_settings[signup_label]" name="rcp_mailchimp_settings[signup_label]" value="<?php if(isset($rcp_mc_options['signup_label'])) { echo $rcp_mc_options['signup_label']; } ?>"/>
						<div class="description"><?php _e('Enter the label to be shown on the "Signup for Newsletter" checkbox', 'rcp'); ?></div>
					</td>
				</tr>
			</table>
			<!-- save the options -->
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'rcp' ); ?>" />
			</p>
			
		</form>
	</div><!--end .wrap-->
	<?php
}

function rcp_mailchimp_admin_styles() {
	wp_enqueue_style('rcp-admin', RCP_PLUGIN_DIR . 'includes/css/admin-styles.css');
}
if (isset($_GET['page']) && ($_GET['page'] == 'rcp-mailchimp')) {
	add_action('admin_enqueue_scripts', 'rcp_mailchimp_admin_styles');
}

// get an array of all mailchimp subscription lists
function rcp_get_mailchimp_lists() {
	
	$rcp_mc_options = get_option('rcp_mailchimp_settings');
	
	if(strlen(trim($rcp_mc_options['mailchimp_api'])) > 0 ) {
		
		$lists = array();
		if( ! class_exists( 'MCAPI' ) )
			require_once('mailchimp/MCAPI.class.php');
		$api = new MCAPI($rcp_mc_options['mailchimp_api']);
		$list_data = $api->lists();
		if($list_data) :
			foreach($list_data['data'] as $key => $list) :
				$lists[$key]['id'] = $list['id'];
				$lists[$key]['name'] = $list['name'];
			endforeach;
		endif;
		return $lists;
	}
	return false;
}

// adds an email to the mailchimp subscription list
function rcp_subscribe_email($email) {
	$rcp_mc_options = get_option('rcp_mailchimp_settings');
	
	if(strlen(trim($rcp_mc_options['mailchimp_api'])) > 0 ) {
		if( ! class_exists( 'MCAPI' ) )
			require_once('mailchimp/MCAPI.class.php');
		$api = new MCAPI($rcp_mc_options['mailchimp_api']);
		
		$merge_vars = array(
			'FNAME' => isset( $_POST['rcp_user_first'] ) ? sanitize_text_field( $_POST['rcp_user_first'] ) : '',
			'LNAME' => isset( $_POST['rcp_user_last'] ) ? sanitize_text_field( $_POST['rcp_user_last'] ) : ''
		);

		if($api->listSubscribe( $rcp_mc_options['mailchimp_list'], $email, $merge_vars ) === true) {
			return true;
		}
	}

	return false;
}

// displays the mailchimp checkbox
function rcp_mailchimp_fields() {
	$rcp_mc_options = get_option('rcp_mailchimp_settings');
	ob_start(); 
		if(strlen(trim($rcp_mc_options['mailchimp_api'])) > 0 ) { ?>
		<p>
			<input name="rcp_mailchimp_signup" id="rcp_mailchimp_signup" type="checkbox" checked="checked"/>
			<label for="rcp_mailchimp_signup"><?php echo isset( $rcp_mc_options['signup_label'] ) ? $rcp_mc_options['signup_label'] : __( 'Signup for our newsletter', 'rcp'); ?></label>
		</p>
		<?php
	}
	echo ob_get_clean();
}
add_action('rcp_before_registration_submit_field', 'rcp_mailchimp_fields', 100);

// checks whether a user should be signed up for he mailchimp list
function rcp_check_for_email_signup($posted, $user_id) {
	if( isset( $posted['rcp_mailchimp_signup'] ) ) {
		if( is_user_logged_in() ) {
			$user_data 	= get_userdata( $user_id );
			$email 		= $user_data->user_email;
		} else {
			$email = $posted['rcp_user_email'];
		}
		rcp_subscribe_email( $email );
		update_user_meta( $user_id, 'rcp_subscribed_to_mailchimp', 'yes' );
	}
}
add_action('rcp_form_processing', 'rcp_check_for_email_signup', 10, 2);

function rcp_add_mc_table_column_header_and_footer() {
	echo '<th style="width: 140px;">Mail Chimp Signup</th>';
}
add_action('rcp_members_page_table_header', 'rcp_add_mc_table_column_header_and_footer');
add_action('rcp_members_page_table_footer', 'rcp_add_mc_table_column_header_and_footer');

function rcp_add_mc_table_column_content($user_id) {
	$signed_up = get_user_meta( $user_id, 'rcp_subscribed_to_mailchimp', true );
	
	if( $signed_up )
		$signed_up = __('yes', 'rcp');
	else
		$signed_up = __('no', 'rcp');
		
	echo '<td>' . $signed_up . '</td>';
}
add_action('rcp_members_page_table_column', 'rcp_add_mc_table_column_content');