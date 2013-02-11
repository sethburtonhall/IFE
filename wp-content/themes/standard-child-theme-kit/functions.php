<?php

/* ----------------------------------------------------------- *
 * 1. Custom Child-Theme functions
 * ----------------------------------------------------------- */

// show admin bar only for admins - default hide for subscribers
if (!current_user_can('manage_options')) {
  add_filter('show_admin_bar', '__return_false');
}

function digwp_bloginfo_shortcode( $atts ) {
   extract(shortcode_atts(array(
       'key' => '',
   ), $atts));
   return get_bloginfo($key);
}
add_shortcode('bloginfo', 'digwp_bloginfo_shortcode');


// allows shortcode to be used in execphp
add_filter('widget_execphp', 'do_shortcode');

// create custom fields - Investment Details
add_action( 'show_user_profile', 'ife_investment_details_create_fields' );
add_action( 'edit_user_profile', 'ife_investment_details_create_fields' );

function ife_investment_details_create_fields( $user ) {

  if ( current_user_can('edit_pages') ) {

    echo '<h1>Investment Details</h1>

    <table class="form-table">

      <tr>
        <th><label for="film_1">Film</label></th>

        <td>
          <input type="text" name="film_1" id="film_1" value="';
          echo esc_attr( get_the_author_meta( 'film_1', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>

      <tr>
        <th><label for="amount_1">Amount</label></th>

        <td>
          <input type="text" name="amount_1" id="amount_1" value="';
          echo esc_attr( get_the_author_meta( 'amount_1', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>

      <tr>
        <th><label for="film_2">Film</label></th>

        <td>
          <input type="text" name="film_2" id="film_2" value="';
          echo esc_attr( get_the_author_meta( 'film_2', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>
      
      <tr>
        <th><label for="amount_2">Amount</label></th>

        <td>
          <input type="text" name="amount_2" id="amount_2" value="';
          echo esc_attr( get_the_author_meta( 'amount_2', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>

      <tr>
        <th><label for="film_3">Film</label></th>

        <td>
          <input type="text" name="film_3" id="film_3" value="';
          echo esc_attr( get_the_author_meta( 'film_3', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>
      
      <tr>
        <th><label for="amount_3">Amount</label></th>

        <td>
          <input type="text" name="amount_3" id="amount_3" value="';
          echo esc_attr( get_the_author_meta( 'amount_3', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>

      <tr>
        <th><label for="film_4">Film</label></th>

        <td>
          <input type="text" name="film_4" id="film_4" value="';
          echo esc_attr( get_the_author_meta( 'film_4', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>

      <tr>
        <th><label for="amount_4">Amount</label></th>

        <td>
          <input type="text" name="amount_4" id="amount_4" value="';
          echo esc_attr( get_the_author_meta( 'amount_4', $user->ID ) );
          echo '" class="regular-text" /><br />
        </td>
      </tr>

    </table>';

  } else {
    return false;
  }
 }


// save custom fields - Investment Details
add_action( 'personal_options_update', 'ife_investment_details_save_fields' );
add_action( 'edit_user_profile_update', 'ife_investment_details_save_fields' );

function ife_investment_details_save_fields( $user_id ) {

  if ( !current_user_can( 'edit_user', $user_id ) )
    return false;

  update_usermeta( $user_id, 'film_1', $_POST['film_1'] );
  update_usermeta( $user_id, 'amount_1', $_POST['amount_1'] );

  update_usermeta( $user_id, 'film_2', $_POST['film_2'] );
  update_usermeta( $user_id, 'amount_2', $_POST['amount_2'] );

  update_usermeta( $user_id, 'film_3', $_POST['film_3'] );
  update_usermeta( $user_id, 'amount_3', $_POST['amount_3'] );

  update_usermeta( $user_id, 'film_4', $_POST['film_4'] );
  update_usermeta( $user_id, 'amount_4', $_POST['amount_4'] );
}


// display custom data in RCP user table - Investment Details

function ife_investment_details_display_fields () {
  ?>
  <th class="rcp-film-col"><?php _e('Films', 'rcp'); ?></th>
  <th class="rcp-film-col"><?php _e('Amounts', 'rcp'); ?></th>
  <?php
}
add_action('rcp_members_page_table_header', 'ife_investment_details_display_fields');
add_action('rcp_members_page_table_footer', 'ife_investment_details_display_fields');

function ife_add_row($user_id) {
  ?>
  <td>
    <?php echo get_user_meta($user_id, 'film_1', true ); ?><br>
    <?php echo get_user_meta($user_id, 'film_2', true ); ?><br>
    <?php echo get_user_meta($user_id, 'film_3', true ); ?><br>
    <?php echo get_user_meta($user_id, 'film_4', true ); ?>
  </td>

  <td>
    <?php echo get_user_meta($user_id, 'amount_1', true ); ?><br>
    <?php echo get_user_meta($user_id, 'amount_2', true ); ?><br>
    <?php echo get_user_meta($user_id, 'amount_3', true ); ?><br>
    <?php echo get_user_meta($user_id, 'amount_4', true ); ?>
  </td>
  <?php
}
add_action('rcp_members_page_table_column', 'ife_add_row');


// shows user's film investments and amounts
function ife_investment_details( $atts, $content = null ) {
  global $current_user; 
  get_currentuserinfo();

  $author_id = $current_user->ID;

  $film_1 = get_field('film_1', 'user_' . $author_id );
  $amount_1 = get_field('amount_1', 'user_' . $author_id );

  $film_2 = get_field('film_2', 'user_' . $author_id );
  $amount_2 = get_field('amount_2', 'user_' . $author_id );

  $film_3 = get_field('film_3', 'user_' . $author_id );
  $amount_3 = get_field('amount_3', 'user_' . $author_id );

  $film_4 = get_field('film_4', 'user_' . $author_id );
  $amount_4 = get_field('amount_4', 'user_' . $author_id );
 
if (is_user_logged_in()) {
    echo '<table class="table table-bordered table-condensed">
      <thead>
        <tr>
          <th>Film</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>';
if (!empty( $film_1 ) ) {
    echo '<tr>
          <td>';
    echo $film_1;
    echo '</td>
          <td>';
    echo $amount_1;
    echo '</td>
        </tr>';
}

if (!empty( $film_2 ) ) {
    echo '<tr>
          <td>';
    echo $film_2;
    echo '</td>
          <td>';
    echo $amount_2;
    echo '</td>        
        </tr>';
}

if (!empty( $film_3 ) ) {
    echo '<tr>
          <td>';
    echo $film_3;
    echo '</td>
          <td>';
    echo $amount_3;
    echo '</td>        
        </tr>';
}

if (!empty( $film_4 ) ) {
    echo '<tr>
          <td>';
    echo $film_4;
    echo '</td>
          <td>';
    echo $amount_4;
    echo '</td>        
        </tr>';
}

    echo '</tbody>
        </table>';

}  else {
    return false;
  }

}
add_shortcode( 'investment_details', 'ife_investment_details');


// IFE CUSTOM - this overrides the RCP subscription_detail shortcode and prevents payment details from displaying
function ife_remove_payment_details( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'option' => ''
  ), $atts ) );

  global $user_ID, $rcp_options;

  if(is_user_logged_in()) {
    $details = '<ul id="rcp_subscription_details">';
      $details .= '<li><span class="rcp_subscription_name">' . __( 'Subscription Level', 'rcp' ) . '</span><span class="rcp_sub_details_separator">:&nbsp;</span><span class="rcp_sub_details_current_level">' . rcp_get_subscription( $user_ID ) . '</span></li>';
      if( rcp_get_expiration_date( $user_ID ) ) {
        $details .= '<li><span class="rcp_sub_details_exp">' . __( 'Expiration Date', 'rcp' ) . '</span><span class="rcp_sub_details_separator">:&nbsp;</span><span class="rcp_sub_details_exp_date">' . rcp_get_expiration_date( $user_ID ) . '</span></li>';
      }
      $details .= '<li><span class="rcp_sub_details_recurring">' . __( 'Recurring', 'rcp' ) . '</span><span class="rcp_sub_details_separator">:&nbsp;</span><span class="rcp_sub_is_recurring">';
      $details .= rcp_is_recurring( $user_ID ) ? __( 'yes', 'rcp' ) : __( 'no', 'rcp' ) . '</span></li>';
      $details .= '<li><span class="rcp_sub_details_status">' . __( 'Current Status', 'rcp' ) . '</span><span class="rcp_sub_details_separator">:&nbsp;</span><span class="rcp_sub_details_current_status">' . rcp_print_status( $user_ID ) . '</span></li>';
      if( ( rcp_is_expired( $user_ID ) || rcp_get_status( $user_ID ) == 'cancelled' ) && rcp_subscription_upgrade_possible( $user_ID ) ) {
        $details .= '<li><a href="' . esc_url( get_permalink( $rcp_options['registration_page'] ) ) . '" title="' . __( 'Renew your subscription', 'rcp' ) . '" class="rcp_sub_details_renew">' . __( 'Renew your subscription', 'rcp' ) . '</a></li>';
      } elseif( !rcp_is_active( $user_ID ) && rcp_subscription_upgrade_possible( $user_ID ) ) {
        $details .= '<li><a href="' . esc_url( get_permalink( $rcp_options['registration_page'] ) ) . '" title="' . __( 'Upgrade your subscription', 'rcp' ) . '" class="rcp_sub_details_renew">' . __( 'Upgrade your subscription', 'rcp' ) . '</a></li>';
      } elseif( rcp_is_active( $user_ID ) && get_user_meta( $user_ID, 'rcp_paypal_subscriber', true) ) {
        $details .= '<li class="rcp_cancel"><a href="https://www.paypal.com/cgi-bin/customerprofileweb?cmd=_manage-paylist" target="_blank" title="' . __( 'Cancel your subscription', 'rcp' ) . '">' . __( 'Cancel your subscription', 'rcp' ) . '</a></li>';
      }
      $details = apply_filters( 'rcp_subscription_details_list', $details );
    $details .= '</ul>';
    // $details .= '<div class="rcp-payment-history">';
    //   $details .= '<h3 class="payment_history_header">' . __( 'Your Payment History', 'rcp' ) . '</h3>';
    //   $details .= rcp_print_user_payments( $user_ID );
    // $details .= '</div>';
    $details = apply_filters( 'rcp_subscription_details', $details );
  } else {
    $details = '<p>' . __( 'You must be logged in to view your subscription details', 'rcp' ) . '</p>';
  }
  return $details;
}
add_shortcode( 'subscription_details', 'ife_remove_payment_details' );


// create & display Payment History
add_action( 'show_user_profile', 'ife_display_payment_history' );
add_action( 'edit_user_profile', 'ife_investment_details_create_fields' );

function ife_display_payment_history( $user ) {

  if ( current_user_can('read') ) {
    echo '<div class="rcp-payment-history">';
    echo '<table class="form-table">
    <tbody><tr>
      <th><label>Your payment history</label></th>
      <td>';
    echo rcp_print_user_payments( $user_ID );
    echo '<br><br>
    </td>
  </tr>
  </tbody>
</table>';
    echo '</div>';

  } else {
    return false;
  }
 }


// custom login page
function my_login_logo() { ?>
    <style type="text/css">

        html {
        margin-top: 0px !important;
        }

        .login.login-action-login.wp-core-ui {
          background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/study-bg.jpg) 50% 50%;
          -webkit-background-size: cover;
            -moz-background-size: cover;
              -o-background-size: cover;
                background-size: cover;
        }

        body.login {
          background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/bg.png);
        }

        body.login div#login h1 a {
          background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/login-logo.jpg);
          padding-bottom: 15px;
        }

        #login {
          width: 320px;
        }

        .login h1 a {
          background-image: url('../images/wordpress-logo.png?ver=20120216') no-repeat top center;
          background-size:  100% 35px;
          width: 312px;
          height: 35px;
          margin-left: 8px;
        }

        .login form {
          -webkit-box-shadow: none;
          box-shadow: none;
          border-radius: 0px;
          border: none;
        }

        #nav, #backtoblog {
        }
        .login #nav {
          background: white;
          margin-left: 8px;
        }

        .login #backtoblog {
          background: white;
          margin-left: 8px;
          padding-bottom: 20px;
        }

    </style>

<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Indie Film Equities';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );


// hide user profile fields
function hide_profile_fields( $contactmethods ) {
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
unset($contactmethods['url']);
unset($contactmethods['description']);
return $contactmethods;
}
add_filter('user_contactmethods','hide_profile_fields',10,1);



function admin_del_options() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}

add_action('admin_head', 'admin_del_options');



//ocultar campos ao editar profile e ao criar novo usuario
function hide_personal_options(){
echo "\n" . '<script type="text/javascript">jQuery(document).ready(function($) {

$(\'form#your-profile > h3\').hide();
$(\'form#your-profile\').show();
$(\'form#your-profile > h3:first\').hide();
$(\'form#your-profile > table:first\').hide();
$(\'form#your-profile label[for=url], form#your-profile input#url\').hide();
$(\'form#your-profile label[for=description], form#your-profile textarea#description, form#your-profile span.description\').hide();

$(\'form#createuser label[for=role], form#createuser select#role\').hide();
$(\'form#createuser label[for=url], form#createuser input#url\').hide();
});
 
</script>' . "\n";
}
add_action('admin_head','hide_personal_options');

?>
