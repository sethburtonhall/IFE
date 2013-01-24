<?php

function rcp_export_page() {
	global $rcp_options, $rcp_db_name, $wpdb;	
	$current_page = admin_url( '/admin.php?page=rcp-export' );
	?>
	<div class="wrap">
		<h2><?php _e( 'Export', 'rcp' ); ?></h2>
		<h3><?php _e( 'Members Export', 'rcp' ); ?></h3>
		<p><?php _e( 'Download member data as a CSV file. This is useful for tasks such as importing batch users into Mail Chimp, or other systems.', 'rcp' ); ?></p>
		<form id="rcp_export" action="<?php echo $current_page; ?>" method="post">
			<p>
				<select name="rcp-subscription" id="rcp-subscription">
					<option value="all"><?php _e( 'All', 'rcp' ); ?></option>
					<?php 
					$levels = rcp_get_subscription_levels( 'all', false );
					if($levels) :
						foreach( $levels as $key => $level) : ?>
						<option value="<?php echo absint( $level->id ); ?>"><?php echo esc_html( $level->name ); ?></option>
						<?php
						endforeach;
					endif; ?>
				</select>
				<label for="rcp-subscription"><?php _e( 'Choose the subscription to export members from', 'rcp' ); ?></label>
			</p>
			<p>
				<select name="rcp-status" id="rcp-status">
					<option value="active"><?php _e( 'Active', 'rcp' ); ?></option>
					<option value="pending"><?php _e( 'Pending', 'rcp' ); ?></option>
					<option value="expired"><?php _e( 'Expired', 'rcp' ); ?></option>
					<option value="cancelled"><?php _e( 'Cancelled', 'rcp' ); ?></option>
					<option value="free"><?php _e( 'Free', 'rcp' ); ?></option>
				</select>
				<label for="rcp-status"><?php _e( 'Choose the status to export', 'rcp' ); ?></label>
			</p>
			<input type="hidden" name="rcp-action" value="export-members"/>
			<input type="submit" class="button-secondary" value="<?php _e( 'Download Member CSV', 'rcp' ); ?>"/>
		</form>
		
		<!-- payments export -->
		<h3><?php _e( 'Payments Export', 'rcp' ); ?></h3>
		<p><?php _e( 'Download payment data as a CSV file. Use this file for your own record keeping or tracking.', 'rcp' ); ?></p>
		<form id="rcp_export" action="<?php echo esc_url( $current_page ); ?>" method="post">
			<input type="hidden" name="rcp-action" value="export-payments"/>
			<input type="submit" class="button-secondary" value="<?php _e( 'Download Payments CSV', 'rcp' ); ?>"/>
		</form>
		
	</div><!--end wrap-->
	<?php
}