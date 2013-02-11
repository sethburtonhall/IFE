<?php
  if ( is_user_logged_in() ) {
      echo '<div rel="Member Profile" class="well login-well">
              <div class="ife-member-details">
                <div class="ife-avatar">';

      global $current_user; 
        get_currentuserinfo();

      echo get_avatar( $current_user->ID, $size = '416', $default = 'http://middle8media.com/ife/ife-gravatar.jpg', $alt = false ) ;

          echo '</div>
                <div class="ife-user-info">
                  <h3>Welcome Back, ';

      echo $current_user->user_firstname;

            echo '</h3>
                  <ul>
                   <li><i class="icon-cog"></i><a href="/wp-admin/profile.php">Edit Profile</a></li>
                   <li><i class="icon-signout"></i><a href="'; echo wp_logout_url(); echo '" title="Logout">Logout</a></li>
                  </ul>
                </div>
              </div>

            <div class="subscription-details">
              <h3>Subscription Details</h3>';

      echo do_shortcode('[subscription_details]');

      echo '</div>';

      // hides user's film investments and amounts if none exist

      global $current_user; 
      get_currentuserinfo();
      $author_id = $current_user->ID;
      $film_custom_field = get_field('film_1', 'user_' . $author_id );
      if ( is_user_logged_in() && empty( $film_custom_field ) ) {
      echo '';
    } else {
        echo '<hr>
              <div class="investment-details">
                <h3>Investment Overview</h3>';

        echo do_shortcode('[investment_details]');
        
        echo '</div>';
    }

  } else {
      echo '<div rel="Already a Member?" class="well login-well">';
      echo do_shortcode('[login_form redirect="/the-study"]');
      echo '</div>';
  }
?>
