<!DOCTYPE html>
<!--[if IE 8 ]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <title><?php wp_title( '' ); ?></title>
    <?php $presentation_options = get_option( 'standard_theme_presentation_options'); ?>
    <?php if( '' != $presentation_options['fav_icon'] ) { ?>
      <link rel="shortcut icon" href="<?php echo $presentation_options['fav_icon']; ?>" />
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $presentation_options['fav_icon']; ?>" />
    <?php } // end if ?>
    <?php global $post; ?>
    <?php if( standard_using_native_seo() && ( ( is_single() || is_page() ) && ( 0 != strlen( trim( ( $google_plus = get_user_meta( $post->post_author, 'google_plus', true ) ) ) ) ) ) ) { ?>
      <link rel="author" href="<?php echo trailingslashit( $google_plus ) ?>posts"/>
    <?php } // end if ?>
    <?php $global_options = get_option( 'standard_theme_global_options' ); ?>
    <?php if( '' != $global_options['google_analytics'] ) { ?>
      <?php if( is_user_logged_in() ) { ?>
        <!-- Google Analytics is restricted only to users who are not logged in. -->
      <?php } else { ?>
        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '<?php echo $global_options[ 'google_analytics' ] ?>']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
      <?php } // end if/else ?>
    <?php } // end if ?>
    <?php wp_head(); ?>

  </head>
  <body <?php body_class(); ?>>

    <?php
      // Check to see if there is a header image, to set a class for the positioning of the logo
      $header_image = get_header_image();
      $head_class = ! empty( $header_image ) ? 'imageyup' : 'imageless';
    ?>

      <div id="header" class="<?php echo $head_class ?>">
        <div id="head-wrapper" class="container clearfix">

            <div id="hgroup" class="clearfix <?php echo '' == $presentation_options['logo'] ? 'no-logo' : 'has-logo'; ?>">
                <div id="logo">
                  <?php if( is_single() || is_page() ) { ?>

                    <?php if( 'video' == get_post_format() || 'image' == get_post_format() || '' == get_the_title() ) { ?>

                      <h1 id="site-title">
                        <?php if( '' == $presentation_options['logo'] ) { ?>
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        <?php } else { ?>
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home">
                            <img src="<?php echo $presentation_options['logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" id="header-logo" />
                          </a>
                        <?php } // end if/else ?>
                      </h1>

                    <?php } else { ?>

                      <p id="site-title">
                        <?php if( '' == $presentation_options['logo'] ) { ?>
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        <?php } else { ?>
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home">
                            <img src="<?php echo $presentation_options['logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" id="header-logo" />
                          </a>
                        <?php } // end if/else ?>
                      </p>

                    <?php } // end if/else ?>

                  <?php } else { ?>

                    <h1 id="site-title">
                      <?php if( '' == $presentation_options['logo'] ) { ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                      <?php } else { ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php get_bloginfo( 'name' ); ?>" rel="home">
                          <img src="<?php echo $presentation_options['logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" id="header-logo" />
                        </a>
                      <?php } // end if/else ?>
                    </h1>
                  <?php } // end if/else ?>

                  <?php if ( '' == $presentation_options['logo'] ) { ?>
                    <p><small id="site-description"><?php bloginfo( 'description' ); ?></small></p>
                  <?php } // end if ?>

              </div><!-- /#logo -->

            </div><!-- /#hgroup -->

            <?php if( 'imageyup' == $head_class ) { ?>
              <div id="header-image" class="row">
                <div class="span12">
                  <?php if ( ! empty( $header_image ) ) { ?>
                    <?php if( standard_is_on_wp34() ) { ?>
                      <img src="<?php esc_url( header_image() ); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php get_bloginfo( 'name' ); ?>" />
                    <?php } else { ?>
                      <img src="<?php esc_url( header_image() ); ?>" width="<?php echo HEADER_IMAGE_WIDTH ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="<?php get_bloginfo( 'name' ); ?>" />
                    <?php } // end if/else ?>
                  <?php } // end if ?>
                </div> <!-- /#header-image -->
              </div> <!-- /row -->
            <?php } // end if ?>

        </div> <!-- /#head-wrapper -->
      </div> <!-- /#header -->

      <?php if( has_nav_menu( 'menu_below_logo' ) ) { ?>
            <div class="container">
            </div><!-- /.container -->
      <?php } // end if ?>
