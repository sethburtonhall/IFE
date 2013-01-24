<?php
/*
	Plugin Name:	AP Gravatars
	Plugin URI:		http://ardentpixels.com/josh/wordpress/plugins/ap-gravatars
	Description:	A simple plugin that adds the gravatar photo associated with the user's email to their profile page. If they do not have a gravatar account, it displays a link to create one. MultiSite compatable!

	Version: 		1.0
	Author: 		Josh Maxwell (Ardent Pixels)
	Author URI: 	http://ardentpixels.com/josh
	License: 		GPL2
*/

/*  Copyright 2012 Josh Maxwell & Ardent Pixels

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Add to Profile page
	function ap_gravatar_options($user){
?>
			<h3>Profile Picture</h3>
			
			<table class="form-table">
				<tr>
					<th><label>Your profile picture</label></th>
					<td width="100">
<?php
		
		$source = 'http://www.gravatar.com/avatar/';
		// $default = '?d=';
		$default = '?d=http://middle8media.com/ife/ife-gravatar.jpg';
		$size = '100';
		$grav_query_str = $default . '&s=' . $size . '&r=g';

		global $profileuser;
		$id = $profileuser->ID;
		$email = $profileuser->user_email;
		$name = $profileuser->display_name;
		
		$src = $source;
		$src .= md5(strtolower($email));
		$src .= $grav_query_str;

		$avatar = "<img src='$src' class='avatar avatar-$size' alt='$name' height='$size' width='$size' />";
		
		echo($avatar);
?>
					</td>
					<td><?php // echo "<span class='description'>$id &bull; $name &bull; $email</span><br>"; ?>
						Your Gravatar is an image that follows you from site to site appearing<br/>
						beside your name when you do things like comment or post on a blog.
						<br/><br/>
						We use Gravatars to display your profile picture. If you do not have a<br/>
						Gravatar you can sign up at <a href="http://gravatar.com">gravatar.com</a> to have a picture of <br/>
						yourself appear not only here, but on all sorts of other sites!
					</td>
				</tr>
				<tr>
					<th></th>
					<td></td>
					<td>
							<a class="button" href="http://en.gravatar.com/site/signup" target="_blank">Get your Gravatar today &raquo;</a>
					</td>
				</tr>
			</table>

<?php	
	}


// Hook
add_action('show_user_profile', 'ap_gravatar_options');
add_action('edit_user_profile', 'ap_gravatar_options');


?>
