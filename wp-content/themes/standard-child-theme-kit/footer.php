<div id="footer" class="clearfix">

		<?php if( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) { ?>
			<div id="footer-widgets" class="clearfix">
				<div class="container">
					<div class="row">

						<div id="left-footer-widgets" class="span4 clearfix">
							<?php dynamic_sidebar( 'sidebar-3' ); ?>
						</div><!-- /#left-footer-widget -->

						<div id="center-footer-widgets" class="span4 clearfix">
							<?php dynamic_sidebar( 'sidebar-4' ); ?>
						</div><!-- /#center-footer-widget -->

						<div id="right-footer-widgets" class="span4 clearfix">
							<?php dynamic_sidebar( 'sidebar-5' ); ?>
						</div><!-- /#right-footer-widget -->

					</div><!-- /row -->
				</div><!-- /container -->
			</div><!-- /#footer-widgets -->
		<?php } // end if ?>

		<div id="sub-floor" class="clearfix">
			<div class="container">
				<div class="row">
					<div id="footer-links" class="span8">
						<?php
							if( has_nav_menu( 'footer_menu' ) ) {
								wp_nav_menu(
									array(
										'theme_location'  	=> 'footer_menu',
										'container_class' 	=> 'menu-footer-nav-container navbar',
										'items_wrap'      	=> '<ul id="%1$s" class="nav %2$s">%3$s</ul>',
										'fallback_cb'		=> false,
										'depth'          	=> 1
									)
								);
							} // end if
						?>
					</div><!-- /#footer-links -->

<!-- 					<div id="credit" class="<?php echo has_nav_menu( 'footer_menu' ) ? 'span4' : 'span12'; ?>">
						<?php printf( __( '%1$s by %2$s', 'standard' ), '<a href="http://standardtheme.com">Standard</a>', '<a href="http://8bit.io/">8BIT</a>' ); ?>
					</div> -->

					<div id="credit" class=" footer_menu span4">
						© 2012 <a href="http://newriverreleasing.com" target="_blank" title="New River Releasing">New River Releasing</a> | a <a href="http://middle8media.com" target="_blank" title="M8M">M8M</a> Website
					</div>
					<!-- /#credits -->

				</div><!-- /row -->
			</div><!-- /.container -->
		</div><!-- /#sub-floor -->
	</div><!-- /#footer -->
	<?php wp_footer(); ?>

	<script type="text/javascript">
		jQuery("h1").fitText(1.7, { minFontSize: '23px', maxFontSize: '33px' });
	  jQuery("#hero-h1").fitText(1.2, { minFontSize: '30px', maxFontSize: '50px' });
	  jQuery("h2").fitText(2, { minFontSize: '20px', maxFontSize: '24px' });
	  jQuery("h3").fitText(1, { minFontSize: '14px', maxFontSize: '20px' });
	  jQuery("").fitText(1, { minFontSize: '14px', maxFontSize: '20px' });
	</script>

	</body>
</html>