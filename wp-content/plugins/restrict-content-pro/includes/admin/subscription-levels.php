<?php

function rcp_member_levels_page()
{
	global $rcp_options, $rcp_db_name, $wpdb;	
	$page = admin_url( '/admin.php?page=rcp-member-levels' );
	?>
	<div class="wrap">
		<?php if(isset($_GET['edit_subscription'])) :
			include('edit-subscription.php'); 
		else : ?>
			<h2><?php _e('Subscription Levels', 'rcp'); ?></h2>
		
			<table class="wp-list-table widefat fixed posts rcp-subscriptions">
				<thead>
					<tr>
						<th class="rcp-sub-order-col"><?php _e('Order', 'rcp'); ?></th>
						<th class="rcp-sub-id-col"><?php _e('ID', 'rcp'); ?></th>
						<th class="rcp-sub-name-col"><?php _e('Name', 'rcp'); ?></th>
						<th class="rcp-sub-desc-col"><?php _e('Description', 'rcp'); ?></th>
						<th class="rcp-sub-level-col"><?php _e('Access Level', 'rcp'); ?></th>
						<th class="rcp-sub-duration-col"><?php _e('Duration', 'rcp'); ?></th>
						<th class="rcp-sub-price-col"><?php _e('Price', 'rcp'); ?></th>
						<th class="rcp-sub-subs-col"><?php _e('Subscribers', 'rcp'); ?></th>
						<?php do_action('rcp_levels_page_table_header'); ?>
						<th class="rcp-sub-actions-col"><?php _e('Actions', 'rcp'); ?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php _e('Order', 'rcp'); ?></th>
						<th><?php _e('ID', 'rcp'); ?></th>
						<th><?php _e('Name', 'rcp'); ?></th>
						<th style="width: 300px;"><?php _e('Description', 'rcp'); ?></th>
						<th><?php _e('Access Level', 'rcp'); ?></th>
						<th><?php _e('Duration', 'rcp'); ?></th>
						<th><?php _e('Price', 'rcp'); ?></th>
						<th><?php _e('Subscribers', 'rcp'); ?></th>
						<?php do_action('rcp_levels_page_table_footer'); ?>
						<th><?php _e('Actions', 'rcp'); ?></th>
					</tr>
				</tfoot>
				<tbody>
				<?php $levels = rcp_get_subscription_levels('all', false); ?>
				<?php 
				if($levels) :
					$i = 1;
					foreach( $levels as $key => $level) : ?>
						<tr id="recordsArray_<?php echo $level->id; ?>" class="rcp-subscription rcp_row <?php if(rcp_is_odd($i)) { echo 'alternate'; } ?>">
							<td><a href="#" class="dragHandle"></a></td>
							<td><?php echo $level->id; ?></td>
							<td><?php echo stripslashes(utf8_decode($level->name)); ?></td>
							<td><?php echo stripslashes(utf8_decode($level->description)); ?></td>
							<td><?php echo $level->level != '' ? $level->level : __('none', 'rcp'); ?></td>
							<td>
								<?php 
									if($level->duration > 0) {
										echo $level->duration . ' ' . rcp_filter_duration_unit($level->duration_unit, $level->duration);
									} else {
										echo __('unlimited', 'rcp');
									}
								?>
							</td>
							<td><?php echo rcp_currency_filter($level->price); ?></td>
							<td><?php if($level->price > 0 || $level->duration > 0) { echo rcp_count_members($level->id, 'active'); } else { echo rcp_count_members($level->id, 'free'); } ?></td>
							<?php do_action('rcp_levels_page_table_column', $level->id); ?>
							<td>
								<a href="<?php echo add_query_arg('edit_subscription', $level->id, $page); ?>"><?php _e('Edit', 'rcp'); ?></a> |
								<?php if($level->status != 'inactive') { ?>
									<a href="<?php echo add_query_arg('deactivate_subscription', $level->id, $page); ?>"><?php _e('Deactivate', 'rcp'); ?></a> |
								<?php } else { ?>
									<a href="<?php echo add_query_arg('activate_subscription', $level->id, $page); ?>"><?php _e('Activate', 'rcp'); ?></a> |
								<?php } ?>
								<a href="<?php echo add_query_arg('delete_subscription', $level->id, $page); ?>" class="rcp_delete_subscription"><?php _e('Delete', 'rcp'); ?></a>
							</td>
						</tr>
					<?php $i++;
					endforeach;
				else : ?>
					<tr><td colspan="9"><?php _e('No subscription levels added yet.', 'rcp'); ?></td>
				<?php endif; ?>
			</table>
			<?php do_action('rcp_levels_below_table'); ?>		
			<h3><?php _e('Add New Level', 'rcp'); ?></h3>
			<form id="rcp-member-levels" action="" method="post">
				<table class="form-table">
					<tbody>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="rcp-name"><?php _e('Name', 'rcp'); ?></label>
							</th>
							<td>
								<input type="text" id="rcp-name" name="name" value="" style="width: 300px;"/>
								<p class="description"><?php _e('The name of the membership level.', 'rcp'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="rcp-description"><?php _e('Description', 'rcp'); ?></label>
							</th>
							<td>
								<textarea id="rcp-description" name="description" style="width: 300px;"></textarea>
								<p class="description"><?php _e('Membership level description. This is shown on the registration form.', 'rcp'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="rcp-level"><?php _e('Access Level', 'rcp'); ?></label>
							</th>
							<td>
								<select id="rcp-level" name="level">
									<?php
									$access_levels = rcp_get_access_levels();
									foreach( $access_levels as $access ) {
										echo '<option value="' . $access . ' ' . selected($access, $level->level, false) . '">' . $access . '</option>';
									}	
									?>
								</select>
								<p class="description"><?php _e('Level of accesss this subscription gives. Leave at 0 for default or you are unsure what this is.', 'rcp'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="rcp-duration"><?php _e('Duration', 'rcp'); ?></label>
							</th>
							<td>
								<input type="text" id="rcp-duration" style="width: 40px;" name="duration" value=""/>
								<select name="duration-unit" id="rcp-duration-unit">
									<option value="day"><?php _e('Days(s)', 'rcp'); ?></option>
									<option value="month"><?php _e('Month(s)', 'rcp'); ?></option>
									<option value="year"><?php _e('Years(s)', 'rcp'); ?></option>
								</select>
								<p class="description"><?php _e('Length of time for this membership level. Enter 0 for unlimited.', 'rcp'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="rcp-price"><?php _e('Price', 'rcp'); ?></label>
							</th>
							<td>
								<input type="text" id="rcp-price" name="price" value="" style="width: 40px;"/>
								<select name="rcp-price-select" id="rcp-price-select">
									<option value="normal"><?php echo $rcp_options['currency']; ?></option>
									<option value="free"><?php _e('Free', 'rcp'); ?></option>
								</select>
								<p class="description"><?php _e('The price of this membership level. Enter 0 for free.', 'rcp'); ?></p>
							</td>
						</tr>
						<tr class="form-field">
							<th scope="row" valign="top">
								<label for="rcp-status"><?php _e('Status', 'rcp'); ?></label>
							</th>
							<td>
								<select name="status" id="rcp-status">
									<option value="active"><?php _e('Active', 'rcp'); ?></option>
									<option value="inactive"><?php _e('Inactive', 'rcp'); ?></option>
								</select>
								<p class="description"><?php _e('Members may only sign up for active subscription levels.', 'rcp'); ?></p>
							</td>
						</tr>
					</tbody>
				</table>
				<p class="submit">
					<input type="hidden" name="rcp-action" value="add-level"/>
					<input type="submit" value="<?php _e('Add Membership Level', 'rcp'); ?>" class="button-primary"/>
				</p>
			</form>
		<?php endif; ?>
	</div><!--end wrap-->
		
	<?php
}