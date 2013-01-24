<?php 
/**
 * @package Hide User Profile Fields
 * @author Gustavo Brandao Guerra
 * @version 1.2
 */
/*
Plugin Name: Hide User Profile Fields
Plugin URI: 
Description: Clean up some dummy fields from user profiles edition and creation pages, focused on corporate purposes. The following fields are removed right after this plugin activation: Colors Profile, Keyboard Shortcuts, Toolbar, AIM, Jabber, Yahoo IM, Website URL, Biography Description and User Role (every new user is created as Subscriber)
Author: Gustavo Brandao Guerra
Version: 1.2
Author URI: http://www.mestredostutoriais.com.br/
*/

/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

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