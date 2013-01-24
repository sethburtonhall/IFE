=== Insert PHP ===
Contributors: WillBontrager
Donate link: http://www.willmaster.com/plugindonate.php
Tags: run PHP, insert PHP, insert PHP page, insert PHP post, use PHP
Requires at least: 3.0
Tested up to: 3.4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Run PHP code inserted into WordPress posts and pages.

== Description ==

Run PHP code inserted into WordPress posts and pages.

The PHP code is between special tags ("[insert_php]" 
instead of "&lt;?php" and "[/insert_php]" instead of "?&gt;").

The PHP code runs as the page is sent to the browser. Output of the PHP code is published directly onto the post or page where the PHP code between the special tags is located.

Examples of use:

* Publish local time (users' computer clock settings being unreliable).

* Insert output of another PHP script, or just to run a script whether or not it generates output.

* Check/manipulate cookies or other actions that JavaScript can accomplish when using JavaScript is undesirable.

More information about the Insert PHP plugin can be found here: 
http://www.willmaster.com/software/WPplugins/go/iphphome_iphplugin

== Installation ==

1. Download insert-php.zip from the "download" link on the web page where you're viewing this or from http://www.willmaster.com/download/DownloadHandlerLink.php?file=insert-php.zip (direct download link)

1. Decompress the file contents.

1. Upload the insert-php folder to your WordPress plugins directory (/wp-content/plugins/).

1. Activate the Insert PHP plugin from the WordPress Dashboard.

1. See instructions for using the plugin.

== Frequently Asked Questions ==

= How do I use this thing? =

Make a copy of the working PHP code to be used in a post or a page.

Replace "&lt;?php" on the first line with "[insert_php]". Replace "?&gt;" on the last line with "[/insert_php]".

Paste the code into your post or page.

Examples are here: http://www.willmaster.com/software/WPplugins/go/iphpinstructions_iphplugin

= Can I have more than one place with PHP code on individual posts and pages? =

Yes. I have found no limit to the number of places PHP code can be inserted into a post or page. Probably there is no WordPress software limit. There may be a server memory limit of your PHP code uses a lot of memory. 

= Does the PHP output need to have paragraph and line break HTML formatting codes? =

No. HTML paragraph and line break formatting are applied to PHP output.

= Do I put the PHP code into content at the "Visual" tab or the "HTML" tab? =

Use the HTML tab. While the Visual tab will, sometimes, the HTML tab allows working with the code without the visual formatting.

= Why can't I set cookies or do a browser redirect? =

With PHP, cookies are set in the web page header lines, before any page content is processed. Redirects, too, are done in the header lines. When PHP code is within a post or a page, all the header lines have already been sent, along with part of the content. At that point, it is too late to set cookies or redirect with PHP.

= I get a "Parse error: ..." What do I do now? =

Unless the source code of the plugin has been changed or somehow became corrupted, the parse error is likely to be in the PHP code inserted into the post or page. Example:

Parse error: syntax error, unexpected T_STRING, expecting ',' or ';' in /public_html/wp331/wp-content/plugins/insert_php.php(48) : eval()'d code on line 5

Either within or at the end of the parse error message you'll find something like this:

eval()'d code on line 5

The error is on the indicated line number of the PHP code you are inserting ("5" in the example). You'll find the error at the line indicated in the error message.

At the PHP code you inserted, count down the number of lines indicated in or at the end of the error message. You'll find the error at that line.

If you have PHP code inserted in more than one place, the error message may apply to any of those places. Temporarily remove or disable them, one at a time, until you determine which one the error message applies to.

If Insert PHP is used with an include() function, the include()'d file may be spawning the error message. In that case, the file name being include()'d and the line number of the error should be somewhere within the error message. 

When the error is located, correct it and try again.

== Screenshots ==

No screenshots available.

== Changelog ==

= 1.0 =
First public distribution version.

== Upgrade Notice ==

= 1.0 =
First public distribution version.

