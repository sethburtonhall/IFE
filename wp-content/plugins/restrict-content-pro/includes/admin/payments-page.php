<?php

function rcp_payments_page()
{
	global $rcp_options, $rcp_db_name, $wpdb;	
	$current_page = admin_url( '/admin.php?page=rcp-payments' );
	?>
	<div class="wrap">
		<h2><?php _e( 'Payments', 'rcp' ); ?></h2>
		
		<?php do_action('rcp_payments_page_top'); ?>
		
		<?php 
		$page = isset( $_GET['p'] ) ? $_GET['p'] : 1;
		$per_page = 20;
		
		$user = get_current_user_id();
		$screen = get_current_screen();
		$screen_option = $screen->get_option('per_page', 'option');
		$per_page = get_user_meta( $user, $screen_option, true );
		if ( empty ( $per_page) || $per_page < 1 ) {
			$per_page = $screen->get_option( 'per_page', 'default' );
		}
		$total_pages = 1;
		$offset = $per_page * ( $page-1 );
		
		$payments = rcp_get_payments( $offset, $per_page );
		$payment_count = rcp_count_payments();
		$total_pages = ceil( $payment_count / $per_page );
		?>
		<p class="total"><strong><?php _e( 'Total Earnings', 'rcp' ); ?>: <?php echo rcp_currency_filter( rcp_get_earnings() ); ?></strong></p>
		<table class="wp-list-table widefat fixed posts rcp-payments">
			<thead>
				<tr>
					<th style="width: 40px;"><?php _e( 'ID', 'rcp' ); ?></th>
					<th style="width: 150px;"><?php _e( 'Subscription', 'rcp' ); ?></th>
					<th style="width: 240px;"><?php _e( 'Subscription Key', 'rcp' ); ?></th>
					<th><?php _e( 'Date', 'rcp' ); ?></th>
					<th style="width: 90px;"><?php _e( 'Amount', 'rcp' ); ?></th>
					<th><?php _e( 'Type', 'rcp' ); ?></th>
					<th style="width: 90px;"><?php _e( 'User', 'rcp' ); ?></th>
					<?php do_action('rcp_payments_page_table_header'); ?>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th style="width: 40px;"><?php _e( 'ID', 'rcp' ); ?></th>
					<th><?php _e( 'Subscription', 'rcp' ); ?></th>
					<th><?php _e( 'Subscription Key', 'rcp' ); ?></th>
					<th><?php _e( 'Date', 'rcp' ); ?></th>
					<th><?php _e( 'Amount', 'rcp' ); ?></th>
					<th><?php _e( 'Type', 'rcp' ); ?></th>
					<th><?php _e( 'User', 'rcp' ); ?></th>
					<?php do_action( 'rcp_payments_page_table_footer' ); ?>
				</tr>
			</tfoot>
			<tbody>
				<?php
					if( $payments ) :
						$i = 0; $total_earnings = 0;
						foreach( $payments as $payment ) : 
							$user = get_userdata( $payment->user_id );
							?>
							<tr class="rcp_payment <?php if( rcp_is_odd( $i ) ) echo 'alternate'; ?>">
								<td><?php echo absint( $payment->id ); ?></td>
								<td><?php echo esc_html( $payment->subscription ); ?></td>
								<td><?php echo esc_html( $payment->subscription_key ); ?></td>
								<td><?php echo esc_html( $payment->date ); ?></td>
								<td><?php echo rcp_currency_filter( $payment->amount ); ?></td>
								<td><?php echo esc_html( $payment->payment_type ); ?></td>
								<td><?php echo isset( $user->display_name ) ? esc_html( $user->display_name ) : ''; ?></td>
								<?php do_action( 'rcp_payments_page_table_column', $payment->id ); ?>
							</tr>
						<?php
						$i++; $total_earnings = $total_earnings + $payment->amount;
						endforeach;
					else : ?>
					<tr><td colspan="7"><?php _e( 'No payments recorded yet', 'rcp' ); ?></td></tr>
				<?php endif;?>
			</table>
			<?php if ($total_pages > 1) : ?>
				<div class="tablenav">
					<div class="tablenav-pages alignright">
						<?php
							if(isset($_GET['show']) && $_GET['show'] > 0) {
								$base = 'admin.php?page=rcp-payments&show=' . $_GET['show'] . '%_%';
							} else {
								$base = 'admin.php?page=rcp-payments%_%';
							}
							echo paginate_links( array(
								'base' 		=> $base,
								'format' 	=> '&p=%#%',
								'prev_text' => __( '&laquo; Previous' ),
								'next_text' => __( 'Next &raquo;' ),
								'total' 	=> $total_pages,
								'current' 	=> $page,
								'end_size' 	=> 1,
								'mid_size' 	=> 5,
							));
						?>	
				    </div>
				</div><!--end .tablenav-->
			<?php endif; ?>
			<?php do_action( 'rcp_payments_page_bottom' ); ?>
	</div><!--end wrap-->
	<?php
}