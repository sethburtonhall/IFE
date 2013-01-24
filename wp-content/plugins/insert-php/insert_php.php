<?php
/*
Plugin Name: Insert PHP
Plugin URI: http://www.willmaster.com/software/WPplugins/
Description: Run PHP code inserted into WordPress posts and pages.
Version: 1.0
Date: 6 November 2012
Author: Will Bontrager Software, LLC <will@willmaster.com>
Author URI: http://www.willmaster.com/contact.php
*/

/*
	Copyright 2012 Will Bontrager Software, LLC (email: will@willmaster.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation. A copy of the license is at
	http://www.gnu.org/licenses/gpl-2.0.html

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
*/

/*
Note: This plugin requires WordPress version 3.0 or higher.

Information about the Insert PHP plugin can be found here:
http://www.willmaster.com/software/WPplugins/go/iphphome_iphplugin

Instructions and examples can be found here:
http://www.willmaster.com/software/WPplugins/go/iphpinstructions_iphplugin
*/


if( ! function_exists('will_bontrager_insert_php') )
{

	function will_bontrager_insert_php()
	{
		$content = get_the_content();
		preg_match_all('!\[insert_php[^\]]*\](.*?)\[/insert_php[^\]]*\]!is',$content,$matches);
		$num_matches = count($matches[0]);
		for( $i=0; $i<$num_matches; $i++ )
		{
			ob_start();
			eval($matches[1][$i]);
			$replacement = ob_get_contents();
			ob_clean();
			$search = quotemeta($matches[0][$i]);
			$search = str_replace('/',"\\".'/',$search);
			$content = preg_replace("/$search/",$replacement,$content,1);
		}
		return $content;
	} # function will_bontrager_insert_php()

	add_filter( 'the_content', 'will_bontrager_insert_php', 9 );

} # if( ! function_exists('will_bontrager_insert_php') )

?>
