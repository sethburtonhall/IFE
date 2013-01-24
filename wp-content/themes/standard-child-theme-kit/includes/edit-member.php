<?php
$user = get_userdata( absint( urldecode( $_GET['edit_member'] ) ) );
?>
<h2>
	<?php _e( 'Edit Member:', 'rcp' ); echo ' ' . $user->display_name; ?> - 
	<a href="<?php echo admin_url( '/admin.php?page=rcp-members' ); ?>" class="button-secondary">
		<?php _e( 'Cancel', 'rcp' ); ?>
	</a>	
</h2>
<form id="rcp-edit-member" action="" method="post">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-status"><?php _e( 'Status', 'rcp' ); ?></label>
				</th>
				<td>
					<select name="status" id="rcp-status">
						<?php
							$statuses = array( 'active', 'expired', 'cancelled', 'pending', 'free' );
							$current_status = get_user_meta( $user->ID, 'rcp_status', true );
							foreach( $statuses as $status ) : 
								echo '<option value="' . esc_attr( $status ) .  '"' . selected( $status, rcp_get_status( $user->ID ), false ) . '>' . ucwords( $status ) . '</option>';
							endforeach;
						?>
					</select>
					<p class="description"><?php _e( 'The status of this user\'s subscription', 'rcp' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-level"><?php _e( 'Subscription Level', 'rcp' ); ?></label>
				</th>
				<td>
					<select name="level" id="rcp-level">
						<?php
							foreach( rcp_get_subscription_levels( 'all', false ) as $key => $level) :
								echo '<option value="' . esc_attr( absint( $level->id ) ) . '"' . selected( $level->name, rcp_get_subscription( $user->ID ), false ) . '>' . esc_html( $level->name ) . '</option>';
							endforeach;
						?>
					</select>
					<p class="description"><?php _e( 'Choose the subscription level for this user', 'rcp' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-expiration"><?php _e( 'Expiration date', 'rcp' ); ?></label>
				</th>
				<td>
					<input name="expiration" id="rcp-expiration" type="text" style="width: 120px;" class="datepicker" value="<?php echo esc_attr( get_user_meta( $user->ID, 'rcp_expiration', true ) ); ?>"/>
					<p class="description"><?php _e( 'Enter the expiration date for this user in the format of yyyy-mm-dd', 'rcp' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<?php _e( 'Recurring', 'rcp' ); ?>
				</th>
				<td>
					<label for="rcp-recurring">
						<input name="recurring" id="rcp-recurring" type="checkbox" value="1" <?php checked( 1, rcp_is_recurring( $user->ID ) ); ?>/>
						<?php _e( 'Is this user\'s subscription recurring?', 'rcp' ); ?>
					</label>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<?php _e( 'Sign Up Method', 'rcp' ); ?>
				</th>
				<td>
					<?php $method = get_user_meta( $user->ID, 'rcp_signup_method', true ) ? get_user_meta( $user->ID, 'rcp_signup_method', true ) : 'live';?>
					<select name="signup_method" id="rcp-signup-method">
						<option value="live" <?php selected( $method, 'live' ); ?>><?php _e( 'User Signup', 'rcp' ); ?>
						<option value="manual" <?php selected( $method, 'manual' ); ?>><?php _e( 'Added by admin manually', 'rcp' ); ?>
					</select>
					<p class="description"><?php _e( 'Was this a real signup or a membership given to the user', 'rcp' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-notes"><?php _e( 'User Notes', 'rcp' ); ?></label>
				</th>
				<td>
					<textarea name="notes" id="rcp-notes" class="large-text" rows="10" cols="50"><?php echo esc_textarea( get_user_meta( $user->ID, 'rcp_notes', true ) ); ?></textarea>
					<p class="description"><?php _e( 'Use this area to record notes about this user if needed', 'rcp' ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<input type="hidden" name="rcp-action" value="edit-member"/>
		<input type="hidden" name="user" value="<?php echo absint( urldecode( $_GET['edit_member'] ) ); ?>"/>
		<input type="submit" value="<?php _e( 'Update User Subscription', 'rcp' ); ?>" class="button-primary"/>
	</p>
</form>