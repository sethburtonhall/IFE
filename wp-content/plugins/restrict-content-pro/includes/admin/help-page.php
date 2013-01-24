<?php

function rcp_help_page()
{
	global $rcp_options, $rcp_db_name, $wpdb;	
	$page = admin_url( '/admin.php?page=rcp-help' );
	?>
	<div class="wrap rcp-help">
		<h2><?php _e('Help Documentation', 'rcp'); ?></h2>
		<div class="metabox-holder has-right-sidebar">
			
			<div class="inner-sidebar">
				
				<div class="postbox">
					<h3><span><?php _e('Restrict Content Pro', 'rcp'); ?></span></h3>
					<div class="inside">
						<p>Created by Pippin Williamson</p>
						<p>&copy; Copyright 2011 - <?php echo date_i18n('Y'); ?> <a href="http://pippinsplugins.com">Pippin's Plugins</a></p>
					</div>
				</div>
				
				<div class="postbox">
					<h3><span><?php _e('Index', 'rcp'); ?></span></h3>
					<div class="inside">
						<ul>
							<li><a href="#about">About this Help Page</a></li>
							<li><a href="#videos">Overview Videos</a></li>
							<li><a href="#faqs">Frequently Asked Questions</a></li>
							<li><a href="#restricting-content">Restricting Post/Page Content</a></li>
							<li><a href="#shortcode-ref">Short Code Reference</a></li>
							<li><a href="#template-tag-ref">Template Tag Reference</a></li>
							<li><a href="#filter-ref">Filter Reference</a></li>
							<li><a href="#action-ref">Action Reference</a></li>
						</ul>
					</div>
				</div>
				
			</div> <!-- .inner-sidebar -->
			
			<div id="post-body">
				<div id="post-body-content">
					
					<div class="postbox" id="about">
						<h3><span><?php _e('Finding Documentation and About this Help Page', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>This help page will help you setup restricted content in your posts, pages, and custom post types.</p>
							<p>All documentation for configuring this plugin, such as creating subscription levels and discounts, is located on the admin page for that section, in the Help Tab, which is placed in the top right corner of the screen.</p>
							<p><img class="help-image" src="<?php echo RCP_PLUGIN_URL; ?>/includes/images/help_images/help-tab.png"/></p>
						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="videos">
						<h3><span><?php _e('Quick Video Tutorials', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>The following videos will demonstrate each of the basic sections of the plugin.</p>
							
							<h4>Adding / Modifying Subscription Levels</h4>
							<p><iframe src="http://www.screenr.com/embed/dVos" width="650" height="396" frameborder="0"></iframe></p>
							
							<h4>Adding Manuel Subscriptions to Members and Editing Existing Memeber's Subscriptions</h4>
							<p><iframe src="http://www.screenr.com/embed/mVos" width="650" height="396" frameborder="0"></iframe></p>
							
							<h4>Adding / Editing Discount Codes</h4>
							<p><iframe src="http://www.screenr.com/embed/0Vos" width="650" height="396" frameborder="0"></iframe></p>
							
							<h4>Overview of Configuring the Plugin Settings</h4>
							<p><iframe src="http://www.screenr.com/embed/lVos" width="650" height="396" frameborder="0"></iframe></p>
							
							<h4>Restricting Post/Page Content with the "Restrict this content" Meta Box Options</h4>
							<p><iframe src="http://www.screenr.com/embed/EFx8" width="650" height="396" frameborder="0"></iframe></p>
							
							<h4>Restricting Post/Page Content with Short Codes</h4>
							<p><iframe src="http://www.screenr.com/embed/iFx8" width="650" height="396" frameborder="0"></iframe></p>
							
							<h4>Setting Up Registration / Login Forms and Other Short Codes</h4>
							<p><iframe src="http://www.screenr.com/embed/Kd3s" width="650" height="396" frameborder="0"></iframe></p>
							
						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="restricting-content">
						<h3><span><?php _e('Restricting Post/Page Content', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>Restricting the content within a Post or Page is very easy, and there are several different ways you can do it.</p>
							<p>You can easily restrict the entire contents of a post or page by simply checking an option in the "Restrict This Content" meta box, or you can restrict portions of content using the provided short codes. Both of these methods are explained in detail below.</p>
							
							<h4>Restricting Entire Posts / Pages</h4>
							<p>On every post, page, and custom post type is a meta box called <em>Restrict this Content</em>. It has several options, which will allow you to restrict the entire contents of your post or page to registered users only, either free or paid.</p>
							<p><img class="help-image" src="<?php echo RCP_PLUGIN_URL; ?>/includes/images/help_images/metabox.png" /></p>
							<ul>
								<li><em><?php _e('Paid Only?', 'rcp'); ?></em> - Check this box to restrict the entire contents of this post / page to paid subscribers only. Members who have an active, free trial will also be able to view this content.</li> 
									<li><em><?php _e('Show Excerpt?', 'rcp'); ?></em> - Check this box to show the post / page excerpt to non-active users (or those without an active paid subscription). If this box is left unchecked, then only the text defined in the Messages section of the Settings page will be shown when a user attempts to view this post / page.</li>
									<li><em><?php _e('Hide from Feed?', 'rcp'); ?></em> - Check this box to prevent the excerpt of this post / page from being shown in the RSS / Atom feeds. This is a good idea if you wish to completely hide premium posts from non-registered users.</li>
									<Li><em><?php _e('Access Level', 'rcp'); ?></em> - This option allows you to restrict the content to members with a subscription level that has an access level of the specified number or higher. For exaample, if you set this to "5", then only users that are subscribed to a subscription level with an acccess level of "5" or higher will be able to view this content.</li>
									<li><em><?php _e('Subscription Level', 'rcp'); ?></em> - This option allows you to restrict the content to only users subscribed to the specified subscription level. For example, if you set this to "Gold", then only users subscribed to the "Gold" subscription level will be able to view this content.</li>
									<li><em><?php _e('User Level', 'rcp'); ?></em> - This option will allow you to set a minimum user level required to view this post / page's content. For example, set this to "Editor" to only permit users with Editor access and great to view this post / page's content. You can also set this to "Subscriber" in order to require users be logged-in to view this content.</li>
							</ul>
							<p>The last three options (Access Level, Subscription Level, and User Level) can all be combined to create advanced restrictions. For example, if you set a post to have an access level of 3, a subscription level of "Gold", and a "User Level" of "Contributor", then only users subscribed to the "Gold" level (this level must have an access level of 3 or higher) AND are of the user level "Contributor" or higher will be able to view the content. A user subscribed to "Gold" but with a user level of "Subscriber" will not be able to view the content.</p>
							
							<h4>Restricting Portions of Content</h4>
							
							<p>Instead of automatically restricting the entire contents of a post / page with the meta box option, you can also restrict only portions of the content with a short code. This method is more flexible and is best suited for users who want to block of sections of their content to subscribers, while leaving other blocks open to all users.</p>
							
							<p>To restrict a portion of content, use the [restrict] short code. The short code will allow you to "hide" blocks of content from all but authorized users.</p>
							
							<p>For example, to restrict a block of text to logged-in users only (both free and paid), you can do this:</p>
							
							<p><strong><em>[restrict]This is the restricted text[/restrict]</em></strong></p>
							
							<p>If a user is not logged in, then they will see a message like this (text is defined in settings):</p>
							
							<p><em>You must be logged-in to view this content.</em></p>
							
							<p>The above example uses the short code in its simplest form, with no parameters. To get a little more advanced, and restrict the content to paid subscribers only, you can use a short code like this:</p>
							
							<p><strong><em>[restrict paid=true]This is the restricted text[/restrict]</em></strong></p>
							
							<p>When the <em>paid=true</em> parameter is set, then the "Premium Content Message" in Settings will be used.</p>
							
							<p>You can also define a custom message to be shown, instead of using the messages setup in the settings page. To show a custom message to unauthorized users, use this:</p>
							
							<p><strong><em>[restrict paid=true message="This is the custom message"]This is the restricted text[/restrict]</em></strong></p>
							
							<p>It is also possible to restrict a block of text to users of a minimum user level with short codes as well. To hide content from all but users with a role of "Author" or greater, use this:</p>
							
							<p><strong><em>[restrict userlevel="author"]This is the restricted text[/restrict]</em></strong></p>
							
							<p>You can also restrict content to only users of a specific subscription level by using the "subscription" parameter. If your "Gold" subscription level has an ID of "3", you would use this to limit the content to only Gold subscribers:</p>
								
							<p><strong><em>[restrict subscription=3]This is restricted to gold subscribers[/restrict]</em></strong></p>
							
							<p>It is also possible to restrict content to only users subscribed to a subscription level that provides a certain access level or higher. For example, if you wanted to restrict content to only users with a subscription that provides an access level of 4 or higher, you would use:</p>
								
							<p><strong><em>[restrict level=4]This is restricted to subscribers with an access level of 4 or higher[/restrict]</em></strong></p>
							
							<p>A list of the user roles available is shown in the <a href="#shortcode-ref">Short Code Reference</a> section.</p>

							<p>There are also a variety of other short codes available that allow you to restrict content in various ways. Read the section below to learn more about each of these short codes.</p>

						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="faqs">
						<h3><span><?php _e('Frequently Asked Questions', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>This section addresses some of the most frequently asked questions. Please read below.</p>
							<h4>My registration page shows "User registration is not enabled". What do I do?</h4>
							<p>This message is shown because you have not enabled the "Anyone can register" option in WordPress. Go to your WordPress Dashboard, click Settings > General and select the option for "Anyone can register".</p>
							
							<h4>Members register, but stay as "pending" after completing payment. How do I fix it?</h4>
							<p>This is usually caused because your website host does not support cURL, which is a PHP tool. There is an option in Restrict > Settings > Payments that will allow you do disable cURL and use an alternate method. If disabling cURL does not fix the problem, contact support.</p>
							
							<h4>Are there any conflicts with caching plugins?</h4>
							<p>In general no, but there is one conflict with a particular kind of caching often available in caching plugins: <strong>object caching</strong></p>
							<p>When object caching is enabled, some users may not experience their accounts getting automatically set to "active" after signing up. If you are experiencing this problem, and have object caching enabled, please disable it.</p>

						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="shortcode-ref">
						<h3><span><?php _e('Short Code Reference', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>There are ten short codes included with this plugin. This section will list each of them, and also the parameters (if any) available for each.</p>
							
							<h4>[restrict] . . . [/restrict]</h4>
							<p>This is the short code you will use to restrict a portion of content to registered users only. It has several parameters that let you define whether the content is restricted to paid users only, which user levels can view the content, and also the message that should be displayed to non-authorized users.</p>
							<p><strong>Parameters</strong>:</p>
							<ul>
								<li><em>paid</em> - whether content is viewable by paid users only. Options: <em>true/false</em>; default: <em>false</em></li>
								<li><em>level</em> - the access level (set by the subscription level) required to view this content</li>
								<li><em>subscription</em> - the subscription users must be subscribed to in order to view this content. You must use the ID of the subscription level.</li>
								<li><em>userlevel</em> - the user level(s) that can view this content. Options:
									<ul>
										<li><em>none</em> - all user levels - default</li>
										<li><em>admin</em> - administrators only</li>
										<li><em>editor</em> - editors and administrators</li>
										<li><em>author</em> - authors, editors, and administrators</li>
										<li><em>contributor</em> - contributors, editors, and administrators</li>
										<li><em>subscriber</em> - subscribers, contributors, editors, and administrators</li>
									</ul>
								</li>
								<li><em>message</em> - the message that is shown to users in place of the short code's content when viewed by an unauthorized user. Default: option defined in the Settings page.</li>
							</ul>
							
							<h4>[is_paid] . . . [/is_paid]</h4>
							<p>This short code is very, very similar to the [restrict] short code but does not accept any parameters. Content placed in this short code will only be displayed if the current user has an active subscription.</p>
							<p>For example:</p>
							<p><em>[is_paid]This content is only shown to paid users[/is_paid]</em></p>
							
							<h4>[is_free] . . . [/is_free]</h4>
							<p>This short code is identical to the [is_paid] short code, except for free, non paid users. Any content placed in this short code will only be available to logged-in users that do NOT have an active subscription. Paid users will NOT see this content.</p>
							<p>For example:</p>
							<p><em>[is_free]This content is only shown to free users[/is_free]</em></p>
							
							<h4>[is_not_paid] . . . [/is_not_paid]</h4>
							<p>This short code is nearly identical to the [is_paid] and [is_free] short codes, except that it is for non-logged-in AND logged-in free users. Any content placed in this short code will only be available to users (logged-in or not) that do NOT have an active subscription. Paid users will NOT see this content.</p>
							<p>For example:</p>
							<p><em>[is_not_paid]This content is only shown to logged-out and logged-in free users[/is_not_paid]</em></p>
							
							<h4>[not_logged_in] . . . [/not_logged_in]</h4>
							<p>This short code is used to show content to users that are NOT logged in. Users who are logged in, regardless of subscription status, will NOT see any content inside this short code.</p>
							<p>For example:</p>
							<p><em>[not_logged_in]This content is only shown to logged-out users[/not_logged_in]</em></p>
							
							<h4>[user_name]</h4>
							<p>This short code can be used to show the Display Name of the currently logged-in user. This is good for personalizing welcome pages and such.</p>
							
							<h4>[register_form]</h4>
							<p>This short code will display the registration form. The form will include all necessary registration fields, such as name, username, email, password, etc, and will also display all of the available subscription levels.</p>
							<p>To show the registration form on a post or page, simply use the short code like this:</p>
							<p><em>[register_form]</em></p>
							<p>Upon successful registration, the user will be redirected to the page that you have defined under the "Signup Forms" options in Settings.</p>
							<p>The optional "registered_message" parameter can be used to customize the message that is displayed to already active users who try to view the registration page. If you want to change the default message, you can do so like this:</p>
							<p><em>[register_form registered_message="Your custom message"]</em></p>
							
							<h4>[login_form]</h4>
							<p>This short code will display the login form. This will allow users to login into their account. Upon successful login, the user will be redirected back to the current page.</p>
							<p>To show the login form on a post or page, simply use the short code like this:</p>
							<p><em>[login_form]</em></p>
							<p>Upon successful registration, the user will be redirected to the page that you have defined under the "Signup Forms" options in Settings.</p>
							
							<h4>[password_form]</h4>
							<p>This short code will display the change password form. This will allow users to change the password to their account. They must be already logged-in.</p>
							<p>To show the change password form on a post or page, simply use the short code like this:</p>
							<p><em>[password_form]</em></p>
							
							<h4>[paid_posts]</h4>
							<p>This short code will display a list of all premium posts / pages on your site.</p>
							<p>To show a list of all premium posts / pages on another post or page, use the short code like this:</p>
							<p><em>[paid_posts]</em></p>
							<p><strong>Note</strong>: this will only show posts/pages that have the "Paid Only?" box checked. It will not show posts/pages that have content restricted by short code.</p>
							
							<h4>[subscription_details]</h4>
							<p>This short code will display the details of the currently logged-in user's subscription.</p>
							<p>The details will be displayed like this:</p>
							<ul>
								<li>Subscription Level: {<em>subscription name</em>}</li>
								<li>Expiration Date: {<em>subscription expiration date</em>}</li>
								<li>Recurring: {<em>yes/no</em>}</li>
								<li>Current Status: {<em>active/pending/expired/cancelled</em>}</li>
							</ul>
							
						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="template-tag-ref">
						<h3><span><?php _e('Template Tag Reference', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>These are the functions available for use inside your theme's template files. These are intended for more advanced users who wish to integrate the plugin more fully into their theme.</p>
							
							<h4>rcp_is_active($user_id = null)</h4>
							<p>This function will check whether the user ID supplied to the function is currently active, meaning they have a paid subscription that is not expired, cancelled, or pending.</p>
							<p>If no user ID is supplied, then the function will check the ID of the currently logged-in user.</p>
							<p>If the user ID is active, the function returns <em>TRUE</em>, otherwise it returns <em>FALSE</em>.</p>
							<p><strong>Example usage</strong>:</p>
<pre class="code php">
if(rcp_is_active(34)) {
	// user ID 34 has an active subscription
} else {
	// user ID 34 does not have an active subscription
}
</pre>
							
							<h4>rcp_is_recurring($user_id = null)</h4>
							<p>This function will check whether the user ID supplied to the function has currently active recurring subscription.</p>
							<p>If no user ID is supplied, then the function will check the ID of the currently logged-in user.</p>
							<p>If the user ID has a recurring subscription, the function returns <em>TRUE</em>, otherwise it returns <em>FALSE</em>.</p>
							<p><strong>Example usage</strong>:</p>
<pre class="code php">
if(rcp_is_recurring(34)) {
	// user ID 34 has an active and recurring subscription
} else {
	// user ID 34 does not have a recurring subscription
}
</pre>
							
							<h4>rcp_is_expired($user_id = null)</h4>
							<p>This function will check whether the subscription of the user ID supplied to the function is expired.</p>
							<p>If no user ID is supplied, then the function will check the ID of the currently logged-in user.</p>
							<p>If the user's subscription is expired, the function returns <em>TRUE</em>, otherwise it returns <em>FALSE</em>.</p>
							<p><strong>Example usage</strong>:</p>
<pre class="code php">
if(rcp_is_expired(34)) {
	// user ID 34's subscription is expired
} else {
	// user ID 34's subscription is active, not expired
}
</pre>

							<h4>rcp_get_subscription_id( $user_id )</h4>
							<p>This function can be used for retrieving the ID number of the subscription the current user is subscribed to. It will return an integer, such as 2, 3, or 4.</p>
							<p><strong>Example usage</strong>:</p>
<pre class="code php">
global $user_ID;
$subscription_id = rcp_get_subscription_id( $user_ID );
if( $subscription_id == 2 ) {
	// do something here
}
</pre>

							<h4>rcp_get_subscription( $user_id )</h4>
							<p>This function can be used for retrieving the name of the subscription the current user is subscribed to. It will return a string, such as Gold, Silver, or Platinum.</p>
							<p><strong>Example usage</strong>:</p>
<pre class="code php">
global $user_ID;
$subscription = rcp_get_subscription( $user_ID );
if( $subscription == 'Gold' ) {
	// do something here
}
</pre>
							
						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="filter-ref">
						<h3><span><?php _e('Filter Reference', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>Filters are used to modify output of the plugin. For example, you can use filters to modify the way the "This is restricted content" messages show.</p>
							<ul>
								<li><em>rcp_restricted_message</em> - used to modify the output of the restricted access messages.</li>
								<li><em>rcp_payment_gateways</em> - used to register extra payment gateways. Parameter: array of gateway IDs and names.</li>
								<li><em>rcp_before_admin_email_active_thanks. Parameter: $user_id</em> - used to add additional info to the admin message sent when new accounts are activated. Parameter: $user_id</li>
								<li><em>rcp_before_admin_email_cancelled_thanks</em> - used to add additional info to the admin message sent when paid accounts are cancelled. Parameter: $user_id</li>
								<li><em>rcp_before_admin_email_expired_thanks</em> - used to add additional info to the admin message sent when paid accounts are expired. Parameter: $user_id</li>
								<li><em>rcp_before_admin_email_free_thanks</em> - used to add additional info to the admin message sent when new free accounts are registered. Parameter: $user_id</li>
								<li><em>rcp_before_admin_email_trial_thanks</em> - used to add additional info to the admin message sent when new trial accounts are activated. Parameter: $user_id</li>
								<li><em>rcp_metabox_excluded_post_types</em> - used to remove the Restrict this Content meta box from certain post types. Parameter: array $posttypes; an array of the post type names to NOT display the meta box on.</li>
								<li><em>rcp_metabox_priority</em> - used to change the priority level of the Restrict this Content meta box. Parameter: $priority.</li>
							</ul>
							
							<p>Sample function to wrap the restricted message in SPAN tags:</p>
<pre class="code php">
function sample_change_restricted_message($message) {

	return '&lt;span style="color: red;"&gt;' . $message . '&lt;span&gt;';
}
add_filter('rcp_restricted_message', 'sample_change_restricted_message', 100);
</pre>
							
						</div> <!-- .inside -->
					</div><!--end postbox-->
					
					<div class="postbox" id="action-ref">
						<h3><span><?php _e('Action Reference', 'rcp'); ?></span></h3>
						<div class="inside">
							<p>There are a variety of action hooks that you can use to modify the output and function of the plugin.</p>
							<p><strong>Content hooks</strong></p>
							<ul>
								<li><em>rcp_before_register_form_fields</em> - used to add extra form fields to the beginning of the registration form</li>
								<li><em>rcp_after_register_form_fields</em> - used to add extra form fields to the end of the registration form</li>
								<li><em>rcp_before_registration_submit_field</em> - used to add additional fields just before the "submit" button on the registration page.</li>
								<li><em>rcp_before_login_form</em> - used to display content just before the login form</li>
								<li><em>rcp_after_login_form</em> - used to display content just after the login form</li>
								<li><em>rcp_before_register_form</em> - used to display content just before the register form</li>
								<li><em>rcp_after_register_form</em> - used to display content just after the register form</li>
								<li><em>rcp_before_password_form</em> - used to display content just before the change password form</li>
								<li><em>rcp_after_password_form</em> - used to display content just after the change password form</li>
								<li><em>rcp_members_page_table_header</em> - used to add a new header column to the members page.</li>
								<li><em>rcp_members_page_table_footer</em> - used to add a new footer column to the members page.</li>
								<li><em>rcp_members_page_table_column</em> - used to add content to a new column to the members page. Parameter: $user_id</li>
								<li><em>rcp_levels_page_table_header</em> - used to add a new header column to the subscription levels page.</li>
								<li><em>rcp_levels_page_table_footer</em> - used to add a new footer column to the subscription levels page.</li>
								<li><em>rcp_levels_page_table_column</em> - used to add content to a new column to the subscription levels page. Parameter: $level_id</li>
								<li><em>rcp_discounts_page_table_header</em> - used to add a new header column to the discount codes page.</li>
								<li><em>rcp_discounts_page_table_footer</em> - used to add a new footer column to the discount codes page.</li>
								<li><em>rcp_discounts_page_table_column</em> - used to add content to a new column to the discount codes page. Parameter: $discount_id</li>
								<li><em>rcp_payments_page_table_header</em> - used to add a new header column to the payments page.</li>
								<li><em>rcp_payments_page_table_footer</em> - used to add a new footer column to the payments page.</li>
								<li><em>rcp_payments_page_table_column</em> - used to add content to a new column to the payments page. Parameter: $discount_id</li>
								<li><em>rcp_messages_settings</em> - used to add additional options in the Messages settings tab. Parameter: $options</li>
								<li><em>rcp_payments_settings</em> - used to add additional options in the Payments settings tab. Parameter: $options</li>
								<li><em>rcp_forms_settings</em> - used to add additional options in the Sign Up Forms settings tab. Parameter: $options</li>
								<li><em>rcp_email_settings</em> - used to add additional options in the Email settings tab. Parameter: $options</li>
								<li><em>rcp_misc_settings</em> - used to add additional options in the Misc settings tab. Parameter: $options</li>
								<li><em>rcp_log_settings</em> - used to add additional options in the Logging settings tab. Parameter: $options</li>
								<li><em>rcp_payments_page_top</em> - used to add content at the top of the payments page.</li>
								<li><em>rcp_payments_page_bottom</em> - used to add content at the bottom of the payments page.</li>
								<li><em>rcp_levels_below_table</em> - used to add content just below the subscription levels table in the admin.</li>
								<li><em>rcp_members_below_table</em> - used to add content just below the members table in the admin.</li>
								<li><em>rcp_discounts_below_table</em> - used to add content just below the discounts table in the admin.</li>
							</ul>
							
							<p>Sample hook to add extra HTML to the login form:</p>
<pre class="code php">
function display_content_before_login() {
	// this will be displayed just before the login form
	echo 'This is extra content';
}
add_action('rcp_before_login_form', 'display_content_before_login');
</pre>
							
							<p><strong>Processing hooks</strong> - These are used in processing form data</p>
							<ul>
								<li><em>rcp_before_form_errors</em> - this happens just before the registration form is validated. The $_POST variable is passed as a parameter. This will contain all information sent with the form.</li>
								<li><em>rcp_form_errors</em> - this happens just after the registration form is validated. It allows you to show errors for custom fields you have added. The $_POST variable is passed as a parameter. This will contain all information sent with the form. For instructions on how to validate your custom form fields, see below.</li>
								<li><em>rcp_before_form_errors</em> - this happens just before the login form is validated. It allows you to show errors for custom fields you have added. The $_POST variable is passed as a parameter. This will contain all information sent with the form. For instructions on how to validate your custom form fields, see below.</li>
								<li><em>rcp_login_form_errors</em> - this happens just after the login form is validated. It allows you to show errors for custom fields you have added. The $_POST variable is passed as a parameter. This will contain all information sent with the form. For instructions on how to validate your custom form fields, see below.</li>
								<li><em>rcp_before_password_form_errors</em> - this happens just before the password form is validated. It allows you to show errors for custom fields you have added. The $_POST variable is passed as a parameter. This will contain all information sent with the form. For instructions on how to validate your custom form fields, see below.</li>
								<li><em>rcp_password_form_errors</em> - this happens just after the change password form is validated. It allows you to show errors for custom fields you have added. The $_POST variable is passed as a parameter. This will contain all information sent with the form. For instructions on how to validate your custom form fields, see below.</li>
								<li><em>rcp_form_processing</em> - this happens just before users are sent to the payment gateway, or just before they are logged in with free subscriptions. This hook has two parameters: the $_POST variable, which contains all data from the registration form, and the ID of the newly created user (or the user we're added a subscription to).</li>
								<li><em>rcp_gateway_{gateway ID}</em> - this hook fires when registration is submitted and is used to send all registration data to the selected payment gateway. Parameter: $subscription_data</li>
								<li><em>rcp_add_discount</em> - runs when a discount code is added. Parameter: $posted - this contains all posted data.</li>
								<li><em>rcp_edit_discount</em> - runs when a discount code is edited. Parameter: $posted - this contains all posted data.</li>
							</ul>
							<p>Sample functions to add an extra required field (perhaps for user agreement) to the registration form:</p>
<pre class="code php">
function add_sample_registration_form_field() {
	ob_start(); ?&gt; 
		&lt;p&gt;
			&lt;input name="rcp_sample_required_field" id="rcp_sample_required_field" type="checkbox" checked="checked"/&gt;
			&lt;label for="rcp_sample_required_field"&gt;Your field label*&lt;/label&gt;
		&lt;/p&gt;
	&lt;?php
	echo ob_get_clean();
}
add_action('rcp_after_register_form_fields', 'add_sample_registration_form_field');

function validate_sample_form_field($posted) {
	if(!isset($posted['rcp_sample_required_field'])) {
		rcp_errors()->add('sample_field_required', __('You must check this field', 'rcp'));
	}
}
add_action('rcp_form_errors', 'validate_sample_form_field');
</pre>
							<p>Now, if users don't check the "Your field label" field, an error will be displayed and no account will be created.</p>
						</div> <!-- .inside -->
					</div><!--end postbox-->

				</div> <!-- #post-body-content -->
				
			</div> <!-- #post-body -->
			
		</div> <!-- .metabox-holder -->
	</div><!--end wrap-->
		
	<?php
}