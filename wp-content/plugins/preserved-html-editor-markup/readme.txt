=== Preserved HTML Editor Markup ===
Contributors: marcuspope
Donate link: http://www.marcuspope.com/wordpress
Tags: wpautop, editor, markup, html, white space, HTML5, WYSIWYG, visual, developer
Requires at least: 3.2.1
Tested up to: 3.4
Stable tag: trunk
License: GPLv2 or later


Preserves white space and developer edits in HTML AND WYSIWYG tab.  Supports inline scripts/css, JavaScript code blocks and HTML5 content editing


== Description ==

This plugin preserves the user-generated HTML markup in the TinyMCE editor.  Unlike other plugins this one allows developers to work in the HTML tab AND end-users to work in the WYSIWYG Visual tab at the same time!  No longer will your HTML markup be completely munged into an unrecognizable form when you switch between those tabs.  And you don't have to hang your users/editors out to dry when you hand off the project with a disabled Visual tab.

#### IMPORTANT: Please read the installation instructions carefully.  If you have existing content it will not render properly after activating this plugin until you use the Fix It Tools.

(One user didn't read or follow these steps and panicked thinking I ruined their website.)

It also supports HTML5 Block Anchor tags in addition to other HTML5 elements, something that is currently not supported in WordPress via any existing plugins.


Version 1.5 will probably be the last version I release for a while since my daughter will be born soon.  I've added support for full JavaScript code blocks in the HTML tab.  They are compatible and preserved when switching to Visual mode.  This rounds out the support for almost complete html preservation, with full use of the WYSIWYG editor. And you don't need to wrap comment codes around it per the recommendations located here: <http://codex.wordpress.org/Using_Javascript> but you can leave them in if you want.

Version 1.4 was just a minor patch release.  User @denl noticed a problem with the plugin CataBlog which implements its own administrative management features by disabling the 'show_ui' flag for its custom post type.  I was ignoring any custom post type that didn't have a GUI, but it was an unecessary filter that probably limited other plugins.  This fix allows any post type that supports the TinyMCE editor to be "fixed" using the tools under Admin > Settings > Writing.

Since version 1.3 you can now use inline CSS and JavaScript in the HTML editor and everything should be preserved.  To be clear, this applies to tags only, like `onclick` events and style definitions - not script blocks themselves.  To enable this feature you must disable the `wptexturize` and `convert_chars` filters by adding the following code to your theme's `functions.php`:

    remove_filter("the_content", "wptexturize");
    remove_filter("the_content", "convert_chars");

This new feature is pretty experimental at the moment.  I tried to make it compatible with wptexturize but that proved close to impossible without duplicating a lot of core code in my plugin.  It's also not compatible with TinyMCE Advanced when the "stop removing p and br tags" setting is enabled.
I've tested it on a variety of code samples and I'm pleased with the results but if you find any content that isn't preserved just open a support ticket and I should be able to fix it.

Since version 1.2, you now have a little more control over how content is created.  And most of the previous caveats to using this plugin are now resolved.

  1. You can now choose whether to use BR tags OR P tags for newlines.  Even better you can use both, where one return key press injects a BR tag, and two return key presses will wrap a Paragraph tag.  This is great for being able to wrap headers at specific break points all while enjoying the semantic perks of paragraphs.
  
  1. In addition to choosing what type of tags to use, you can also change the behavior depending on the type of post, including custom post types.  So Pages can default to BR tags, and Blog Posts can default to Paragraph tags.
  
  1. If you have existing content that was created before activating this plugin, you can now use the Fixit feature to convert your existing content in a way that makes it render the same as before. Only use this feature (located under Admin > Settings > Writing: Fixing Existing Content) if you are installing this plugin for the first time, otherwise it will remove all of the formatted white space in your posts.
  
  1. Multi-line HTML comments are now supported (Thanks to [@cwlee_klagroup](http://wordpress.org/support/profile/cwlee_klagroup) for suggesting the working fix!)
  
  1. The Format drop down in the TinyMCE editor had a bug which is now fixed.  It will now select "Format" if you place the cursor on a section of bare text.  Currently the editor just leaves the previously selected format option in place.  It's minor but it's good to know when you have bare text in your content.
  
  1. There was a fairly problematic bug in the old version where in some browsers you couldn't change the formatting of a single line in the Visual editor if you started from scratch.  Choosing a different Format option would change the entire document, with the only work around being to edit the document in HTML mode.  That was bad, and somehow went unnoticed for far too long.  Anyway, that is fixed now.

The caveats that still remains are:

  1. With script blocks added to your HTML markup, the right arrow key does not pass over them in the Visual Tab.  You can down arrow over them however so this will likely never be addressed.
  
  1. If you use the Paragraph tag setting for newlines there is a minor bug where it will only wrap your content in Paragraph tags if you specify Paragraph in the Format drop down or if you enter more than one paragraph of text.  So if you just type one sentence and click save it will not wrap the content in Paragraph tags.  I tried to fix this but ran out of my allotted time working on other core issues.  Should be fixed in the next release.
  
  1. For performance reasons, it will only preserve spaces if 4 spaces are used consecutively - i.e. an expanded tab in developer terms.  It will not preserve intra-tag white space like &lt;p&nbsp;&nbsp;&nbsp;&nbsp;&gt;.

  1. If you do add 4 or more spaces inside of an element tag it will corrupt the markup and mangle the output.  But as this is intended for developer edits, this should be an extreme rarity given the habit is virtually non-existent in development communities.

  1. PRE tags are not affected and behave as you would expect, however due to how browsers parse tags, the first newline in the content of a PRE tag will be wiped out unless it is padded with either another new line or multiple spaces.

  1. CODE tags are not preserving white space at all, and when wrapped with PRE tags white space is still removed.  I'm working to resolve this problem.

== Installation ==

1. Upload the plugin contents to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in Wordpress Admin
1. If you have existing content that needs fixing, use the "Fix Posts" feature under Admin > Settings > Writing: Fix Existing Content.
1. You're done!

== Frequently Asked Questions ==

= When will code tag issues be resolve? =

This is a tough one.  Not only do I have no idea why they're being trumped, but I also have a daughter that will be born pretty soon :D, and a project at work that is about to get hectic :(  I'll try to fix it when I can but if you have the skills to help debug the help would be greatly appreciated.

= Does this plugin actually disable wpautop? =

Yes.  And unlike virtually every other "disable wpautop" plugin this one will actually disable the client-side version of wpautop that runs when you switch between the Visual and HTML tabs. Even when using the P Tag mode or hybrid mode, wpautop is disabled and custom code is being used to inject paragraphs a little more intelligently.

= What exactly do the "Fix Posts" or "Fix XXX" buttons do to my content? =

Firstly, only use this feature if you are starting new with version 1.2. And definitely backup your database before running these tools, they have only been tested on two sites so far.  And although in theory it is safe, you should still protect yourself.

The fix actually just runs wpautop one final time on the posts in the database.  By default WordPress runs that function every time it displays content, so the raw data in the database is free of any paragraph tags & other formatting tweaks.  The Fix buttons update the raw content in the database with the formatted version wpautop produces.  And fortunately wpautop was designed in a way that it can be run multiple times so it shouldn't mangle your content.

All of your post content will be converted, including past revisions.  So if you need to revert a page or post after you activate this feature, you won't have to reformat the previous version by hand.

The plugin also keeps track of when it was activated, so it will only modify content that was edited before the plugin was activated.  So if you created some new content after activating the plugin and later realized all of your other content wasn't displaying correctly it's safe to use the Fix buttons without ruining your new content.

== Upgrade Notice ==

If you used version 1.0 or 1.1 to create content, do not use the Fix it features unless you are ok with losing the white space preservation of those posts.

== Screenshots ==

1. No screenshots

== Changelog ==
= 1.4 =
* Removed 'show_ui' filter for fix custom post type buttons.
= 1.3 =
* Added support for inline JavaScript and CSS, as long as the wptexturize and convert_chars filters are disabled. (Thanks to ViennaMex for pointed out the problem.)
* Added cache-buster for this plugin's JavaScript includes to prevent upgrade issues seen in version 1.2 (Thanks to dreamdancerdesign, peterdub & abbyj for troubleshooting support.)
* Special thanks to dreamdancerdesign for providing a live testing server - above and beyond.
= 1.2 =
* Added support for user-specified newline behavior per post type
* Added support for multi-line html comments (Thanks cwlee_klagroup!)
* Fixed a bug found in TinyMCE related to Format drop down
* Added tools to convert existing site content programmatically by post type.
= 1.1 =
* Refactored for support of < php5.3 by replacing function references with static function array refs
= 1.0 =
* Initial creation of plugin

== Arbitrary section ==
