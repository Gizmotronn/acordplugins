<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Youzer - Documentation</title>
	<link rel="stylesheet" href="css/style.css" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
	<link rel="stylesheet" href="css/fonts/css/font-awesome.min.css" />
	<script src="js/modernizr.js"></script> <!-- Modernizr -->
</head>
<body>
<div id="wrapper">

	<!-- Docs Headers -->
	<header id="uk-docs-header">
		<div id="logo"><img src="img/youzer.png" alt="" /></div>
	</header>

	<div id="uk-docs" class="uk-content">

		<div id="sidebar">
			<ul class="uk-docs-index animated">


				<li class="has-children">
					<input type="checkbox" name ="group-1" id="group-1" checked>
					<label for="group-1">Getting Started</label>
					<ul>
						<li class="quick-start-link">
							<a href="#quick-start"><i class="fa fa-space-shuttle" aria-hidden="true"></i>Quick Start</a>
						</li>
						<li>
							<a href="#introduction"><i class="fa fa-handshake-o" aria-hidden="true"></i>Introduction</a>
						</li>
						<li>
							<a href="#installation"><i class="fa fa-wrench" aria-hidden="true"></i>Installation</a>
						</li>
					</ul>
				</li>

				<li class="has-children">
					<input type="checkbox" name ="group-2" id="group-2">
					<label for="group-2">General Settings</label>
					<ul>
						<li><a href="#general-settings"><i class="fa fa-gear" aria-hidden="true"></i>general settings</a></li>
						<li><a href="#wall-settings"><i class="fa fa-address-card-o" aria-hidden="true"></i>wall settings</a></li>
						<li><a href="#groups-settings"><i class="fa fa-users" aria-hidden="true"></i>groups settings</a></li>
						<li><a href="#schemes-settings"><i class="fa fa-paint-brush" aria-hidden="true"></i>schemes settings</a></li>
						<li><a href="#panel-settings"><i class="fa fa-cogs" aria-hidden="true"></i>panel settings</a></li>
						<li><a href="#emoji-settings"><i class="fa fa-smile-o" aria-hidden="true"></i>emoji settings</a></li>
						<li><a href="#author-box-settings"><i class="fa fa-address-card-o" aria-hidden="true"></i>author box settings</a></li>
						<li><a href="#custom-styling-settings"><i class="fa fa-code" aria-hidden="true"></i>custom styling settings</a></li>
						<li><a href="#networks-settings"><i class="fa fa-share-alt" aria-hidden="true"></i>social networks settings</a></li>
						<li><a href="#verification-settings"><i class="fa fa-check-circle" aria-hidden="true"></i>Account verification settings</a></li>
						<li><a href="#groups-directory-settings"><i class="fa fa-list-alt" aria-hidden="true"></i>groups directory settings</a></li>
						<li><a href="#members-directory-settings"><i class="fa fa-list" aria-hidden="true"></i>members directory settings</a></li>
					</ul>
				</li>

				<li class="has-children">
					<input type="checkbox" name ="group-3" id="group-3">
					<label for="group-3">profile Settings</label>
					<ul>
						<li><a href="#profile-settings"><i class="fa fa-user-circle" aria-hidden="true"></i>General settings</a></li>
						<li><a href="#profile-structure"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i>profile structure</a></li>
						<li><a href="#header-settings"><i class="fa fa-header" aria-hidden="true"></i>header settings</a></li>
						<li><a href="#navbar-settings"><i class="fa fa-list" aria-hidden="true"></i>navbar settings</a></li>
						<li><a href="#ads-settings"><i class="fa fa-bullhorn" aria-hidden="true"></i>ads settings</a></li>
						<li><a href="#tabs-settings"><i class="fa fa-list-alt" aria-hidden="true"></i>tabs settings</a></li>
						<li><a href="#custom-tabs-settings"><i class="fa fa-plus" aria-hidden="true"></i>custom tabs settings</a></li>
						<li><a href="#infos-tab-settings"><i class="fa fa-info" aria-hidden="true"></i>infos tab settings</a></li>
						<li><a href="#posts-tab-settings"><i class="fa fa-file-text" aria-hidden="true"></i>posts tab settings</a></li>
						<li><a href="#comments-tab-settings"><i class="fa fa-comments-o" aria-hidden="true"></i>comments tab settings</a></li>
						<li><a href="#profile404-settings"><i class="fa fa-warning" aria-hidden="true"></i>Profile 404 settings</a></li>
					</ul>
				</li>

				<li class="has-children">
					<input type="checkbox" name ="group-4" id="group-4">
					<label for="group-4">widgets settings</label>

					<ul>
						<li><a href="#general-widgets-settings"><i class="fa fa-cogs" aria-hidden="true"></i>widget settings</a></li>
						<li><a href="#aboutme-settings"><i class="fa fa-user" aria-hidden="true"></i>about me settings</a></li>
						<li><a href="#post-settings"><i class="fa fa-pencil" aria-hidden="true"></i>post settings</a></li>
						<li><a href="#project-settings"><i class="fa fa-suitcase" aria-hidden="true"></i>project settings</a></li>
						<li><a href="#skills-settings"><i class="fa fa-tasks" aria-hidden="true"></i>skills settings</a></li>
						<li><a href="#services-settings"><i class="fa fa-wrench" aria-hidden="true"></i>services settings</a></li>
						<li><a href="#portfolio-settings"><i class="fa fa-photo" aria-hidden="true"></i>portfolio settings</a></li>
						<li><a href="#slideshow-settings"><i class="fa fa-film" aria-hidden="true"></i>slideshow settings</a></li>
						<li><a href="#quote-settings"><i class="fa fa-quote-right" aria-hidden="true"></i>quote settings</a></li>
						<li><a href="#link-settings"><i class="fa fa-unlink" aria-hidden="true"></i>link settings</a></li>
						<li><a href="#video-settings"><i class="fa fa-video-camera" aria-hidden="true"></i>video settings</a></li>
						<li><a href="#instagram-settings"><i class="fa fa-instagram" aria-hidden="true"></i>instagram settings</a></li>
						<li><a href="#flickr-settings"><i class="fa fa-flickr" aria-hidden="true"></i>flickr settings</a></li>
						<li><a href="#user-friends-settings"><i class="fa fa-handshake-o" aria-hidden="true"></i>friends settings</a></li>
						<li><a href="#user-groups-settings"><i class="fa fa-users" aria-hidden="true"></i>groups settings</a></li>
						<li><a href="#infos-box-settings"><i class="fa fa-clipboard" aria-hidden="true"></i>infos box settings</a></li>
						<li><a href="#recent-posts-settings"><i class="fa fa-newspaper-o" aria-hidden="true"></i>recent posts settings</a></li>
						<li><a href="#social-networks-settings"><i class="fa fa-share-alt" aria-hidden="true"></i>social networks settings</a></li>
						<li><a href="#custom-widgets-settings"><i class="fa fa-plus" aria-hidden="true"></i>custom widgets settings</a></li>
					</ul>
				</li>

				<li class="has-children">
					<input type="checkbox" name ="group-5" id="group-5">
					<label for="group-5">Membership Settings</label>
					<ul>
						<li>
							<a href="#logy-general-settings"><i class="fa fa-cogs" aria-hidden="true"></i>General Settings</a>
						</li>
						<li>
							<a href="#login-settings"><i class="fa fa-sign-in" aria-hidden="true"></i>Login Settings</a>
						</li>
						<li>
							<a href="#register-settings"><i class="fa fa-pencil" aria-hidden="true"></i>Register Settings</a>
						</li>
						<li>
							<a href="#lostpswd-settings"><i class="fa fa-lock" aria-hidden="true"></i>lost password settings</a>
						</li>
						<li>
							<a href="#captcha-settings"><i class="fa fa-user-secret" aria-hidden="true"></i>captcha settings</a>
						</li>
						<li>
							<a href="#social-login-settings"><i class="fa fa-share-alt" aria-hidden="true"></i>social login settings</a>
						</li>
						<li>
							<a href="#login-attempts-settings"><i class="fa fa-lock" aria-hidden="true"></i>login attempts settings</a>
						</li>
						<li>
							<a href="#login-styling"><i class="fa fa-paint-brush" aria-hidden="true"></i>login styling settings</a>
						</li><li>
							<a href="#register-styling"><i class="fa fa-paint-brush" aria-hidden="true"></i>register styling settings</a>
						</li>
					</ul>
				</li>
			</ul>

		</div><!-- /sidebar -->
		<div class="uk-main-content">

			<div class="uk-inner-main-content">

			<section class="uk-docs-section" id="quick-start">

				<h1>Quick Start</h1>

				<div class="uk-inner-content">

				<div class="note blue">
					<p>Before installing <strong>Youzer</strong> Make sure that you <strong>installed & activated Buddypress</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>1. Installation & Activation</h2>
					<p>1 - Go to the WordPress admin panel and then navigate to <strong>Plugins > Add New > Upload</strong> .</p>
					<p>2 - Choose the Youzer plugin zip .</p>
					<p>3 - Wait untill the installation process ends .</p>
					<p>4- Congratulations you are ready to bring life to your author page.</p>
				</div>

				<div class="uk-option-item">
					<h2>2. Set Up Youzer Pages</h2>
					<p>Once You Install Youzer, 2 Pages Will Be added Automatically to your website : <br> <strong>( Login, Lost Password )</strong></p>
					<p>1- Go To <strong>Appearance > Menus</strong>.</p>
					<p>2- Add ( <strong>Login</strong> ) to your website navigation menu.</p>
					<img src="img/menu1.png" alt="">
					<p>3- After you click on the <strong>"Add to menu"</strong> Button. they will be added to the <strong>menu structure.</strong></p>
					<img src="img/menu2.png" alt="">

					<div class="note green">
						<p>The login page will be named <strong>"logout"</strong> for logged-in Users.</p>
					</div>

				</div>

				<div class="uk-option-item">
					<h2>4. How to Access the Youzer Panel ?</h2>
					<p>1- <strong>Wordpress Admin Bar.</strong></p>
					<img src="img/panel1.png" alt="">
					<p>2- <strong>Dashboard Menu.</strong></p>
					<img src="img/panel2.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>4. Want to disable the Youzer Membeship System ?</h2>
					<p>in case you want to use <strong>another membership system</strong> go to  <strong>Youzer Panel > General Settings > Membership System Settings > Activate Membership System</strong> and disable the button.</p>
				</div>

				</div>
			</section>

			<!-- Docs Main Content -->
			<section class="uk-docs-section" id="introduction">
				<h1>Introduction</h1>
				<div class="uk-inner-content">
					<p>
						Thank you for purchasing this plugin. i will be happy to help you if you have any questions you might consider visiting the forums and ask your question in the <strong>"item discussion"</strong> section.
					</p>
				</div>
			</section>

			<section class="uk-docs-section" id="installation">
				<h1>installation</h1>
				<div class="uk-inner-content">
					<p>1 - Go to the WordPress admin panel and then navigate to <strong>Plugins > Add New > Upload</strong> .</p>
					<img src="img/install1.png" alt="">
					<p>2 - Choose the Youzer plugin zip .</p>
					<img src="img/install2.png" alt="">
					<img src="img/install3.png" alt="">
					<img src="img/install4.png" alt="">
					<p>3 - Wait untill the installation process ends .</p>
					<img src="img/install5.png" alt="">
					<p>4- Congratulations you are ready to bring life to your author page.</p>
					<img src="img/install6.png" alt="">
				</div>
			</section>

			<section class="uk-docs-section" id="general-settings">

				<h1>general settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Pages Background</h2>
						<p>choose from color Picker youzer <strong>pages</strong> background color.</p>
					</div>

					<div class="uk-option-item">
						<h2>youzer plugin content width</h2>
						<p>set youzer <strong>pages</strong> content width by pixel. default pages is <strong>1170px</strong>.</p>
					</div>

					<div class="note red">
						<p>to disable the <strong>buddypress registration</strong> you should disable <strong>youzer membership system</strong> first or it will have no effect.</p>
					</div>

					<div class="uk-option-item">
						<h2>Buttons Style</h2>
						<p>Specify youzer <strong>pages</strong> buttons ( Ex. Add Friend Button, Message Button ... ) border style and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Flat</strong></li>
							<li><strong>Oval</strong></li>
							<li><strong>Radius</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Tabs Icons Style</h2>
						<p>Specify youzer <strong>pages</strong> Tab ( Ex. Profile - Wall Tab - Sub Nav : Personal, Mentions, Favorites ... ) icons style and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Gradient</strong></li>
							<li><strong>Colorful</strong></li>
							<li><strong>Silver</strong></li>
							<li><strong>White</strong></li>
							<li><strong>Gray</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Enable Membership System</h2>
						<p>activate youzer <strong>membership system</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>Disable Buddypress Registration</h2>
						<p>This option helps you to <strong>deactivate</strong> Buddypress Default <strong>Membership system</strong>.</p>
					</div>

					<div class="note green">
						<p>if the youzer <strong> membership system</strong> is <strong>active</strong> the Login Pages Settings below won't work.</p>
					</div>

					<div class="uk-option-item">
						<h2>Login Page Settings</h2>
						<p>In this section you can set the <strong>login page url</strong> in case you are using a <strong>diffrent membership system</strong> or disabled the <strong>youzer membership system</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>Use Login Option</h2>
						<p>Choose <strong>Login Page</strong> Option Type and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>URL</strong></li>
							<li><strong>Page</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Login Page</h2>
						<p>in case you choosed the value <strong>"Page"</strong> from the option <strong>"Use Login Option"</strong> you will need this field to set the login page from your website.</p>
					</div>
					
					<div class="uk-option-item">
						<h2>Login Page Url</h2>
						<p>in case you choosed the value <strong>"Url"</strong> from the option <strong>"Use Login Option"</strong> you will need this field to set the login page <strong>URL</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>margin settings</h2>
						<p>Specify <strong>MARGIN</strong> around youzer pages content and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>margin top</strong></li>
							<li><strong>margin bottom</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>padding settings</h2>
						<p>Specify <strong>PADDING</strong> around youzer pages content and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>padding top</strong></li>
							<li><strong>padding left</strong></li>
							<li><strong>padding right</strong></li>
							<li><strong>padding bottom</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>scroll to top settings</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> scroll to top button and also the ability to change button hover color.</p>
					</div>

					<div class="uk-option-item">
						<h2>reset settings</h2>
						<p><strong>reset</strong> all the youzer plugin settings.</p>
					</div>

				</div>
			</section>

			<section class="uk-docs-section" id="wall-settings">

				<h1>Wall settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Display Wall Filter</h2>
						<p>Show Wall <strong>Filter Bar</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>Display Activity Filter</h2>
						<p>Show Activity Page <strong>Filter Bar</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>Control Posts Buttons Visibility</h2>
						<p>Choose <strong>Allowed Posts Buttons</strong> and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Likes</strong></li>
							<li><strong>Comments</strong></li>
							<li><strong>Delete Button</strong></li>
							<li><strong>Comments Replies</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Maximum File Size</h2>
						<p>Set Max Attachments <strong>file size</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>Attachments Settings</h2>
						<p>Choose <strong>Allowed Attachments Extentions</strong> and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Image Extentions</strong></li>
							<li><strong>Video Extentions</strong></li>
							<li><strong>Audio Extentions</strong></li>
							<li><strong>Files Extentions</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Enable Posts Embeds</h2>
						<p>Activate <strong>Embeds ( Videos, Posts ... )</strong> Inside Wall Posts.</p>
					</div>

					<div class="uk-option-item">
						<h2>Enable Comments Embeds</h2>
						<p>Activate Embeds <strong>( Videos, Posts ... )</strong> Inside Wall Post Comments.</p>
					</div>

					<div class="uk-option-item">
						<h2>Posts Per Page Settings</h2>
						<p>Specify Wall <strong>Posts Per Page</strong> and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Activity - Posts Per Page</strong></li>
							<li><strong>Profile - Posts Per Page</strong></li>
							<li><strong>Groups - Posts Per Page</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Control Wall Posts Visibility</h2>
						<p>Choose Wall <strong>Allowed Posts Types</strong> and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Status</strong></li>
							<li><strong>Photo</strong></li>
							<li><strong>Slideshow</strong></li>
							<li><strong>Link</strong></li>
							<li><strong>Quote</strong></li>
							<li><strong>Video</strong></li>
							<li><strong>Audio</strong></li>
							<li><strong>File</strong></li>
							<li><strong>New Cover</strong></li>
							<li><strong>New Avatar</strong></li>
							<li><strong>Friendship Created</strong></li>
							<li><strong>Friendship Accepted</strong></li>
							<li><strong>Group Created</strong></li>
							<li><strong>Group Joined</strong></li>
							<li><strong>New Blog Post</strong></li>
							<li><strong>New Blog Comment</strong></li>
							<li><strong>Comment Post</strong></li>
						</ul>
					</div>

				</div>

			</section>

			<section class="uk-docs-section" id="groups-settings">

				<h1>Groups Settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Display Scroll To Top</h2>
						<p>Show Group <strong>Scroll To Top</strong> Button.</p>
					</div>

					<div class="uk-option-item">
						<h2>group avatar format</h2>
						<p>select <strong>group avatar</strong> format, the available formats are :</p>
						<img src="img/img-formats.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>Header Visibility Settings</h2>
						<p>control the <strong>visibility</strong> of all the group header elements, the available elements are :</p>
						<ul class="uk-options-items">
							<li><strong>Avatar Border</strong></li>
							<li><strong>Privacy</strong></li>
							<li><strong>Activity</strong></li>
							<li><strong>Members</strong></li>
							<li><strong>Posts</strong></li>
						</ul>
					</div>


				<div class="uk-option-item">
					<h2>Cover Overlay Settings</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> Group Cover <strong>Overlay</strong> and control the overlay <strong>Opacity</strong> value.</p>
				</div>

				<div class="uk-option-item">
					<h2>Cover Pattern Settings</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> Group Cover <strong>Pattern</strong> and control the pattern <strong>Opacity</strong> value.</p>
				</div>

				<div class="uk-option-item">
					<h2>header styling settings</h2>
					<p>style all the group header elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>meta's colors</strong></li>
						<li><strong>icons colors</strong></li>
						<li><strong>group name color</strong></li>
						<li><strong>statistics titles color</strong></li>
						<li><strong>statistics numbers color</strong></li>
						<li><strong>header background color</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Groups Header Layouts</h2>
					<p>select the <strong>group layouts</strong>, there's <strong>08</strong> available layouts :</p>
					<img src="img/group-header-layouts.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Default Groups Avatar</h2>
					<p>upload default <strong>"Groups avatar"</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Default Groups Cover</h2>
					<p>upload default <strong>"Groups cover"</strong>.</p>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="author-box-settings">

				<h1>Author Box settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Enable Author Photo Border</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Photo transparent border.</p>
					</div>

					<div class="uk-option-item">
						<h2>Author Box meta</h2>
						<p>choose the <strong>auhtor box meta</strong>, the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>E-mail</strong></li>
							<li><strong>website</strong></li>
							<li><strong>location</strong></li>
							<li><strong>username</strong></li>
							<li><strong>phone number</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Statistics Borders</h2>
						<p>Use Box borders between statistics numbers</p>
					</div>

					<div class="uk-option-item">
						<h2>Statistics Background</h2>
						<p>Use Box statistics silver background.</p>
					</div>

					<div class="uk-option-item">
						<h2>author box layouts</h2>
						<p>select the <strong>author box layout</strong>, the available layouts are :</p>
						<img src="img/author-box-layout.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>Author Box Image Format</h2>
						<p>select <strong>profile photo</strong> format, the available formats are :</p>
						<img src="img/img-formats.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>Author Box Networks Settings</h2>
						<p>1 - <strong>Display</strong> or <strong>Hide</strong> author box social networks.</p>
						<p>2 - Select social networks <strong>Border Style</strong>, the available styles are :</p>
						<ul class="uk-options-items">
							<li><strong>flat</strong></li>
							<li><strong>radius</strong></li>
							<li><strong>circle</strong></li>
						</ul>
						<p>3 - Select social networks <strong>Color Type</strong>, the available types are :</p>
						<ul class="uk-options-items">
							<li><strong>silver</strong></li>
							<li><strong>colorful</strong></li>
							<li><strong>transparent</strong></li>
							<li><strong>no background</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Statistics Visibility Settings</h2>
						<p>control the <strong>visibility</strong> of all the statistics elements, the available elements are :</p>
						<ul class="uk-options-items">
							<li><strong>views</strong></li>
							<li><strong>posts</strong></li>
							<li><strong>Comments</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2> Box Button Styling settings</h2>
						<p>style the author box button, the available elements are :</p>
						<ul class="uk-options-items">
							<li><strong>button text color</strong></li>
							<li><strong>button icon color</strong></li>
							<li><strong>button background color</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Auhtor Box Margin Settings</h2>
						<p>Specify <strong>MARGIN</strong> around the author box and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>margin top</strong></li>
							<li><strong>margin bottom</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Cover Overlay Settings</h2>
						<p><strong>Enable</strong> or <strong>Disable</strong> Profile Cover <strong>Overlay</strong> and control the overlay <strong>Opacity</strong> value.</p>
					</div>

					<div class="uk-option-item">
						<h2>Cover Pattern Settings</h2>
						<p><strong>Enable</strong> or <strong>Disable</strong> Profile Cover <strong>Pattern</strong> and control the pattern <strong>Opacity</strong> value.</p>
					</div>

				</div>
			</section>

			<section class="uk-docs-section" id="custom-styling-settings">

				<h1>Custom Styling settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<p>this setting tab will allow you to write a <strong>custom css code</strong> in many youzer pages and the available pages are :</p>
						<ul class="uk-options-items">
							<li><strong>Global Styling :</strong>Works on all your website pages.</li>
							<li><strong>Profile Styling :</strong>Works only in the user profile page.</li>
							<li><strong> account styling :</strong>Works only in the user account settings pages.</li>
							<li><strong>Groups Styling :</strong>Works only in the groups pages.</li>
							<li><strong>Activity Styling :</strong>Works only in the global activity page.</li>
							<li><strong>Groups Directory Styling :</strong>Works only in the groups directory page.</li>
							<li><strong>Members Directory Styling :</strong> Works only in the members directory page.</li>
						</ul>
					</div>
				</div>
			</section>

			<section class="uk-docs-section" id="groups-directory-settings">

				<h1>Groups Directory settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Enable Cards Cover</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards Cover.</p>
					</div>

					<div class="uk-option-item">
						<h2>Enable Cards Action Buttons</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards Action Buttons.</p>
					</div>
					
					<div class="uk-option-item">
						<h2>Enable Cards Avatar Border</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards Avatar Border.</p>
					</div>

					<div class="uk-option-item">
						<h2>Groups Per Page</h2>
						<p>Max Groups Cards to show <strong>Per Page</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>Card avatar format</h2>
						<p>select <strong>card avatar</strong> format, the available formats are :</p>
						<img src="img/img-formats.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>Card Statistics Visibility Settings</h2>
						<p>control the <strong>visibility</strong> of all the statistics elements, the available elements are :</p>
						<ul class="uk-options-items">
							<li><strong>All Statistics</strong></li>
							<li><strong>Group Posts</strong></li>
							<li><strong>Group Activity</strong></li>
							<li><strong>Group Members</strong></li>
						</ul>
					</div>

				</div>

			</section>

			<section class="uk-docs-section" id="members-directory-settings">

				<h1>Members Directory settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Enable Cards Cover</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards Cover.</p>
					</div>

					<div class="uk-option-item">
						<h2>Enable User Status</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards User Status.</p>
					</div>

					<div class="uk-option-item">
						<h2>Display User Online Status Only</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards User Online Status Only.</p>
					</div>

					<div class="uk-option-item">
						<h2>Enable Cards Action Buttons</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards Action Buttons.</p>
					</div>
					
					<div class="uk-option-item">
						<h2>Enable Cards Avatar Border</h2>
						<p><strong>Display</strong> or <strong>Hide</strong> Cards Avatar Border.</p>
					</div>

					<div class="uk-option-item">
						<h2>Members Per Page</h2>
						<p>Max Members Cards to show <strong>Per Page</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>Card avatar format</h2>
						<p>select <strong>card avatar</strong> format, the available formats are :</p>
						<img src="img/img-formats.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>Card Statistics Visibility Settings</h2>
						<p>control the <strong>visibility</strong> of all the statistics elements, the available elements are :</p>
						<ul class="uk-options-items">
							<li><strong>All Statistics</strong></li>
							<li><strong>User Comments</strong></li>
							<li><strong>User Friends</strong></li>
							<li><strong>User Posts</strong></li>
							<li><strong>User Views</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Buttons Layout</h2>
						<p>select the cards <strong>Action Buttons Layout</strong> and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Block</strong></li>
							<li><strong>Inline-block</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Buttons Border Style</h2>
						<p>select the cards <strong>Buttons Border Style</strong> Layout and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Oval</strong></li>
							<li><strong>Flat</strong></li>
							<li><strong>Radius</strong></li>
						</ul>
					</div>

				</div>

			</section>
			<section class="uk-docs-section" id="ads-settings">

				<h1>ads settings</h1>

				<div class="uk-inner-content">

					<div class="note green">
						<p>all the ads created will be added automatically to the bottom of the profile sidebar to change their placement or control their visibility go to <strong>Youzer Panel > Profile Settings > Profile Structure</strong>.</p>
					</div>

					<p>once you install the youzer plugin go to <strong>Youzer Panel > General Settings > Ads Settings</strong> , since there's no ads yet you will see this :</p>
					<img src="img/no-ads.png" alt="">

					<div class="uk-option-item">
						<h2>how to create new ad ?</h2>
						<p>to create a new ad click on the button below :</p>
						<img src="img/add-new-ad.png" alt="">
						<p>once you clicked the button above a popup window will show up and it contains these fields :</p>
						<ul class="uk-options-items">
							<li><strong>is sponsored ? :</strong>Display or Hide "Sponsored" title above the ad in the users profile.</li>
							<li><strong>ad name :</strong>You'll use it in the profile structure to recognize each ad from the other and also to change your ad placement in the profile page.</li>
							<li><strong>ad type :</strong>There's two types available : ( <strong>banner</strong>, <strong>adsense code</strong> ).</li>
							<li><strong>ad url :</strong>The ad link.</li>
							<li><strong>ad banner :</strong>upload ad banner or paste a valide image url.</li>
							<li><strong>ad code :</strong>if you choosed '<strong>adsense code</strong>' as a ad type you will see this field so you can paste here your adsense code.</li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>how to update ads ?</h2>
						<p>to <strong>update</strong> an ad click on the <strong>'pencil' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
						<img src="img/update-ad.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>how to delete ads ?</h2>
						<p>to <strong>remove</strong> an ad click on the <strong>'X' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
						<img src="img/delete-ad.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>ad loading effect</h2>
						<p>select how you want your ad to be loaded ?, the available effects are : </p>
						<ul class="uk-options-items">
							<li><strong>fadeIn</strong></li>
							<li><strong>fadeInUp</strong></li>
							<li><strong>fadeInLeft</strong></li>
							<li><strong>fadeInDown</strong></li>
							<li><strong>fadeInRight</strong></li>
							<li><strong>bounceInLeft</strong></li>
							<li><strong>fadeInUpDelay</strong></li>
							<li><strong>bounceInRight</strong></li>
						</ul>
					</div>

				</div>
			</section>

			<section class="uk-docs-section" id="networks-settings">

				<h1>social networks settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>how to add new social networks ?</h2>
					<p>to create a new social network click on the button below :</p>
					<img src="img/add-new-network.png" alt="">
					<p>once you clicked the button above a popup window will show up and it contains these fields :</p>
					<ul class="uk-options-items">
						<li><strong>network name :</strong>Add social network name</li>
						<li><strong>network color :</strong>Select icon color from the color picker.</li>
						<li><strong>network icon :</strong>Select the network icon from the icons picker.</li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>how to update social networks ?</h2>
					<p>to <strong>update</strong> a social network click on the <strong>'pencil' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
					<img src="img/update-network.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>how to delete social networks ?</h2>
					<p>to <strong>remove</strong> a social network click on the <strong>'X' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
					<img src="img/delete-network.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Networks Settings</h2>
					<p>1 - Select social networks <strong>Border Style</strong>, the available styles are :</p>
					<ul class="uk-options-items">
						<li><strong>flat</strong></li>
						<li><strong>radius</strong></li>
						<li><strong>circle</strong></li>
					</ul>
					<p>2 - Select social networks <strong>Color Type</strong>, the available types are :</p>
					<ul class="uk-options-items">
						<li><strong>silver</strong></li>
						<li><strong>colorful</strong></li>
						<li><strong>transparent</strong></li>
						<li><strong>no background</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="verification-settings">

				<h1>Account Verification settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Enable Verified Badges?</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> Verified Badges.</p>
				</div>

				<div class="uk-option-item">
					<h2>Badges styling settings</h2>
					<p>style the bagdes, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>badge icon color</strong></li>
						<li><strong>badge background color</strong></li>
					</ul>
				</div>

				</div>
			
			</section>

			<section class="uk-docs-section" id="schemes-settings">

				<h1>schemes settings</h1>

				<div class="uk-inner-content">

				<div class="note green">
					<p>if you want to use the <strong>custom profile scheme color</strong> , make sure that you <strong>enabled</strong> the custom scheme button.</p>
				</div>

				<div class="uk-option-item">
					<h2>Enable Custom Scheme Color ?</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using custom scheme color.</p>
				</div>

				<div class="uk-option-item">
					<h2>Custom Scheme color</h2>
					<p>select <strong>custom color scheme </strong> from the color picker. make sure that you enabled the custom scheme option or this option will not have any effect.</p>
				</div>

				<div class="uk-option-item">
					<h2>Profile Ready Schemes</h2>
					<p>select the <strong>profile color scheme</strong>, the available schemes are :</p>
					<img src="img/profile-schemes.png" alt="">
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="panel-settings">

				<h1>panel settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Enable Fixed Save Icon</h2>
					<p>Enable fixed <strong>save icon</strong> button</p>
				</div>

				<div class="uk-option-item">
					<h2>panel schemes</h2>
					<p>select the <strong>panel color scheme</strong>, the available schemes are :</p>
					<img src="img/panel-schemes.png" alt="">
				</div>

				</div>

			</section>
			<section class="uk-docs-section" id="emoji-settings">

				<h1>emoji settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Posts Emoji</h2>
					<p>Enable emoji in <strong>posts</strong></p>
				</div>

				<div class="uk-option-item">
					<h2>Comments Emoji</h2>
					<p>Enable emoji in <strong>Comments</strong></p>
				</div>

				<div class="uk-option-item">
					<h2>Messages Emoji</h2>
					<p>Enable emoji in <strong>Messages</strong></p>
				</div>

				</div>

			</section>

			<section class="uk-docs-section" id="profile404-settings">

				<h1>profile 404 settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Error Description</h2>
					<p>type the error page description.</p>
				</div>

				<div class="uk-option-item">
					<h2>Button title</h2>
					<p>type the <strong>"go back home"</strong> button title.</p>
				</div>

				<div class="uk-option-item">
					<h2>Photo</h2>
					<p>upload profile 404 <strong>"header photo"</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>cover</h2>
					<p>upload profile 404 <strong>"header cover"</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>profile 404 styling settings</h2>
					<p>style the page elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>title color</strong></li>
						<li><strong>description color</strong></li>
						<li><strong>button text color</strong></li>
						<li><strong>button background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="profile-settings">

				<h1>profile settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Allow Private Profiles</h2>
					<p>Allow Users To Make Their Profiles <strong>Private</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>profile effects</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using elements loading effects.</p>
				</div>

				<div class="uk-option-item">
					<h2>Display Login Button ?</h2>
					<p>Show Profile Sidebar <strong>Login Button</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Allow Delete Accounts</h2>
					<p>Allow <strong>Registered</strong> Members To <strong>Delete</strong> Their Own <strong>Accounts</strong>.</p>
				</div>
					
				<div class="uk-option-item">
					<h2>Enable Account Copyright</h2>
					<p>Show Account Settings Footer <strong>Copyright</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Enable Account Scroll to Top</h2>
					<p>Show Account <strong>Scroll to top</strong> button.</p>
				</div>

				<div class="uk-option-item">
					<h2>Default Profile Avatar</h2>
					<p>upload default <strong>"profile avatar"</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Default Profile Cover</h2>
					<p>upload default <strong>"profile cover"</strong>.</p>
				</div>

				</div>

			</section>

			<section class="uk-docs-section" id="profile-structure">

				<h1>profile structure</h1>

				<div class="uk-inner-content">

				<div class="note green">
					<p>you have to know that theses widgets <strong>( email, website, address, phone number, recent posts , keep in touch )</strong> can't be moved to the <strong>"main widgets"</strong> column.</p>
				</div>

				<div class="uk-option-item">
					<h2>Default Profile Layouts</h2>
					<p>here's the default <strong>profile structure</strong>.</p>
					<img src="img/default-profile-structure.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>How to change profile structure ?</h2>
					<p>you can change the <strong>profile structure</strong> just by drag and drop the widgets.</p>
				</div>

				<div class="uk-option-item">
					<h2>How to hide profile widget ?</h2>
					<p>if you want to <strong>hide</strong> a widget follow the next steps :</p>
					<p>1 - Put the mouse above the widget and then an <strong>"EYE"</strong> icon will show up : </p>
					<img src="img/hide-widget-1.png" alt="">
					<p>2 - Click on it and you will see the <strong>"HIDDEN"</strong> flag next to the widget name : </p>
					<img src="img/hide-widget-2.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>How to display a hidden profile widget ?</h2>
					<p>if you want to <strong>display</strong> a hidden widget follow the next steps :</p>
					<p>1 - Put the mouse above the hidden widget and then an <strong>"EYE"</strong> icon will show up : </p>
					<img src="img/display-widget-1.png" alt="">
					<p>2 - Click on it and you will see the <strong>"HIDDEN"</strong> flag disappeared from the widget name : </p>
					<img src="img/display-widget-2.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>widgets can't be moved to the "main widgets" column ?</h2>
					<p>here's the list of the widgets that you can't move it to the <strong>"main widgets"</strong> column :</p>
					<ul class="uk-options-items">
						<li><strong>email</strong></li>
						<li><strong>address</strong></li>
						<li><strong>website</strong></li>
						<li><strong>phone number</strong></li>
						<li><strong>recent posts</strong></li>
						<li><strong>keep in touch</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>where i can find ads widgets ?</h2>
					<p>1 - In case you added an ad you will find that ad at the bottom of the <strong>"sidebar widgets"</strong> .</p>
					<p>2- All the ad widgets have an <strong>"AD"</strong> flag : </p>
					<img src="img/ad-widget.png" alt="">
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="header-settings">

				<h1>header settings</h1>

				<div class="uk-inner-content">

				<div class="note green">
					<p>this option works only with the <strong>vertical header layouts</strong>. if you use it with horizontal layouts it will have <strong>no effect</strong>!</p>
				</div>

				<div class="uk-option-item">
					<h2>Use Photo As Cover?</h2>
					<p>If cover not exist use profile photo as cover?</p>
				</div>

				<div class="uk-option-item">
					<h2>Vertical Header Meta</h2>
					<p>choose the <strong>header meta</strong>, the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>website</strong></li>
						<li><strong>location</strong></li>
						<li><strong>username</strong></li>
						<li><strong>phone number</strong></li>
					</ul>

				</div>

				<div class="uk-option-item">
					<h2>Statistics Borders</h2>
					<p>Use borders between statistics numbers</p>
				</div>

				<div class="uk-option-item">
					<h2>Statistics Background</h2>
					<p>Use statistics silver background.</p>
				</div>

				<div class="uk-option-item">
					<h2>header Image Format</h2>
					<p>select <strong>profile photo</strong> format, the available formats are :</p>
					<img src="img/img-formats.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>header effects settings</h2>
					<p><strong>enable</strong> or <strong>disable</strong> effects, the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>Header Photo Effect</strong></li>
						<li><strong>Header Loading Effect</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>header Networks Settings</h2>
					<p>1 - <strong>Display</strong> or <strong>Hide</strong> header social networks.</p>
					<p>2 - Select social networks <strong>Border Style</strong>, the available styles are :</p>
					<ul class="uk-options-items">
						<li><strong>flat</strong></li>
						<li><strong>radius</strong></li>
						<li><strong>circle</strong></li>
					</ul>
					<p>3 - Select social networks <strong>Color Type</strong>, the available types are :</p>
					<ul class="uk-options-items">
						<li><strong>silver</strong></li>
						<li><strong>colorful</strong></li>
						<li><strong>transparent</strong></li>
						<li><strong>no background</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>header visibility settings</h2>
					<p>control the <strong>visibility</strong> of all the header elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>posts</strong></li>
						<li><strong>views</strong></li>
						<li><strong>location</strong></li>
						<li><strong>website</strong></li>
						<li><strong>comments</strong></li>
						<li><strong>photo border</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Cover Overlay Settings</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> Profile Cover <strong>Overlay</strong> and control the overlay <strong>Opacity</strong> value.</p>
				</div>

				<div class="uk-option-item">
					<h2>Cover Pattern Settings</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> Profile Cover <strong>Pattern</strong> and control the pattern <strong>Opacity</strong> value.</p>
				</div>

				<div class="uk-option-item">
					<h2>header styling settings</h2>
					<p>style all the header elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>meta's colors</strong></li>
						<li><strong>icons colors</strong></li>
						<li><strong>username color</strong></li>
						<li><strong>statistics titles color</strong></li>
						<li><strong>statistics numbers color</strong></li>
						<li><strong>header background color</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Profile Layouts</h2>
					<p>select the <strong>profile layouts</strong>, there's <strong>14</strong> available layouts :</p>
					<img src="img/profile-layouts.png" alt="">
				</div>

				</div>

			</section>

			<section class="uk-docs-section" id="navbar-settings">

				<h1>navbar settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>navbar loading effect</h2>
					<p>select how you want your navbar to be loaded ?, the available effects are : </p>
					<ul class="uk-options-items">
						<li><strong>fadeIn</strong></li>
						<li><strong>fadeInUp</strong></li>
						<li><strong>fadeInLeft</strong></li>
						<li><strong>fadeInDown</strong></li>
						<li><strong>fadeInRight</strong></li>
						<li><strong>bounceInLeft</strong></li>
						<li><strong>fadeInUpDelay</strong></li>
						<li><strong>bounceInRight</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Display Navbar Icons</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using navbar tabs icons.</p>
				</div>

				<div class="uk-option-item">
					<h2>Navbar icons Settings</h2>
					<p>select the <strong>navbar icons style</strong>, there's <strong>02</strong> available styles :</p>
					<img src="img/navbar-icons-styles.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Vertical Layout Navbar Settings</h2>
					<p>select the <strong>navbar layout</strong>, there's <strong>02</strong> available layouts :</p>
					<img src="img/navbar-layouts.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>navbar styling settings</h2>
					<p>style all the navbar elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>tabs titles color</strong></li>
						<li><strong>tabs icons colors</strong></li>
						<li><strong>bottom border color</strong></li>
						<li><strong>tabs titles hover color</strong></li>
						<li><strong>navbar background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="tabs-settings">

				<h1>tabs settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>general tabs Settings</h2>
					<ul class="uk-options-items">
						<li><strong>display tabs count :</strong> display profile tabs count next to tab title.</li>
						<li><strong>set default tab :</strong> select default profile tab.</li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>tabs Settings</h2>
					<ul class="uk-options-items">
						<li><strong>delete tab :</strong> delete profile tab.</li>
						<li><strong>tab order :</strong> change profile tab order.</li>
						<li><strong>tab title :</strong> change current tab title .</li>
						<li><strong>display tab :</strong> hide tab from the profile navbar .</li>
						<li><strong>tab icon :</strong> change tab icon from the <strong>icon Picker</strong>.</li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2> Pagination Styling Settings</h2>
					<p>style the <strong>pagination</strong> of the <strong>"posts tab"</strong> and <strong>"comments tab"</strong>, and the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>Active Page Number Color</strong></li>
						<li><strong>Pagination Numbers Color</strong></li>
						<li><strong>Pagination Numbers Background Color</strong></li>
						<li><strong>Active Page Number Background Color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="custom-tabs-settings">

				<h1>custom tabs settings</h1>

				<div class="uk-inner-content">

				<p>go to <strong>Youzer Panel > Profile Settings > Custom Tabs Settings</strong>, since there's no custom tabs yet you will see this :</p>

				<img src="img/no-tab.png" alt="">

				<div class="note green">
					<p>you can <strong>change</strong> the order of the <strong>custom tabs</strong> by <strong>drag and drop</strong> .</p>
				</div>

				<div class="uk-option-item">
					<h2>how to create new tab ?</h2>
					<p>to create a new tab click on the button below :</p>
					<img src="img/add-new-tab.png" alt="">
					<p>once you clicked the button above a popup window will show up and it contains these fields :</p>
					<img src="img/tab-modal.png" alt="">
					<ul class="uk-options-items">
						<li><strong>tab icon :</strong>Select tab icon from the <strong>icon picker</strong>.</li>
						<li><strong>display tab :</strong>Show or hide tab.</li>
						<li><strong>Show For Non Logged-In :</strong>Display Tab For <strong>Non Logged-In</strong> Users</li>
						<li><strong>tab title :</strong>Type tab title.</li>
						<li><strong>tab type :</strong>There's two types available : <strong>( Link, Shortcode )</strong>. </li>
						<p>- if you clicked the option <strong>Url</strong> a new field will appear: </p>
						<ul>
							<li><strong>tab url :</strong>Add tab <strong>link Url</strong>.</li>
						</ul>
						<p>- if you clicked the option <strong>Shortcode</strong> 2 new fields will appear: </p>
						<ul>
							<li><strong>Display Page Sidebar :</strong> Show Page Sidebar Works Only On Horizontal Layout.</li>
							<li><strong>Tab Content:</strong>Paste your shortcode or any html code.</li>
						</ul>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>how to update a custom tab ?</h2>
					<p>to <strong>update</strong> a tab click on the <strong>'pencil' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
					<img src="img/update-tab.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>how to delete a custom tab ?</h2>
					<p>to <strong>remove</strong> a tab click on the <strong>'X' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
					<img src="img/delete-tab.png" alt="">
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="infos-tab-settings">

				<h1>infos tab settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>infos tab styling settings</h2>
					<p>style all the <strong>infos</strong> tab elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>infos title</strong></li>
						<li><strong>infos value</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="posts-tab-settings">

				<h1>posts tab settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Posts Per Page</h2>
					<p>how many <strong>post</strong> you want to display per page ?</p>
				</div>

				<div class="uk-option-item">
					<h2>Posts Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the posts tab elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>post meta</strong></li>
						<li><strong>post icon</strong></li>
						<li><strong>post date</strong></li>
						<li><strong>read more</strong></li>
						<li><strong>post excerpt</strong></li>
						<li><strong>post comments</strong></li>
						<li><strong>post categories</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>post styling settings</h2>
					<p>style all the <strong>post</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>post title</strong></li>
						<li><strong>post meta</strong></li>
						<li><strong>post excerpt</strong></li>
						<li><strong>post meta icons</strong></li>
						<li><strong>read more text</strong></li>
						<li><strong>read more icon</strong></li>
						<li><strong>read more background</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="comments-tab-settings">

				<h1>comments tab settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>comments Per Page</h2>
					<p>how many <strong>comment</strong> you want to display per page ?</p>
				</div>

				<div class="uk-option-item">
					<h2>Comments Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the comments tab elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>username</strong></li>
						<li><strong>comments date</strong></li>
						<li><strong>"view comment" button</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>comments styling settings</h2>
					<p>style all the <strong>comment</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>date</strong></li>
						<li><strong>fullname</strong></li>
						<li><strong>username</strong></li>
						<li><strong>button icon</strong></li>
						<li><strong>button text</strong></li>
						<li><strong>comment text</strong></li>
						<li><strong>button background</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="general-widgets-settings">

				<h1>general widget settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Widgets Border Style</h2>
					<img src="img/widgets-formats.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Display Title Icon</h2>
					<p>Show widget title icon.</p>
				</div>

				<div class="uk-option-item">
					<h2>Use Title Icon Background</h2>
					<p>Use widget icon background.</p>
				</div>

				<div class="uk-option-item">
					<h2> Title Styling Settings</h2>
					<p>style all the <strong>widget title</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>title color</strong></li>
						<li><strong>title background</strong></li>
						<li><strong>title border</strong></li>
						<li><strong>icon color</strong></li>
						<li><strong>icon background color</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Display Title</h2>
					<p><strong>Display</strong> or <strong>Hide</strong> widget title .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget Title</h2>
					<p><strong>change</strong> widget title .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget loading effect</h2>
					<p>select how you want the widget to be loaded ?, the available effects are : </p>
					<ul class="uk-options-items">
						<li><strong>fadeIn</strong></li>
						<li><strong>fadeInUp</strong></li>
						<li><strong>fadeInLeft</strong></li>
						<li><strong>fadeInDown</strong></li>
						<li><strong>fadeInRight</strong></li>
						<li><strong>bounceInLeft</strong></li>
						<li><strong>fadeInUpDelay</strong></li>
						<li><strong>bounceInRight</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="aboutme-settings">

				<h1>about me settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Image Format</h2>
					<p>select <strong>widget photo</strong> format, the available formats are :</p>
					<img src="img/img-formats.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>Title</strong></li>
						<li><strong>position</strong></li>
						<li><strong>Biography</strong></li>
						<li><strong>Title Border</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="post-settings">

				<h1>post settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Post Types</h2>
					<p>add <strong>post</strong> types, the default types are <strong>( featured post, recent post )</strong> .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the widget elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>post date</strong></li>
						<li><strong>read more</strong></li>
						<li><strong>post meta</strong></li>
						<li><strong>post excerpt</strong></li>
						<li><strong>post comment</strong></li>
						<li><strong>post meta icon</strong></li>
						<li><strong>comments date</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>tags</strong></li>
						<li><strong>title</strong></li>
						<li><strong>excerpt</strong></li>
						<li><strong>post meta</strong></li>
						<li><strong>read more</strong></li>
						<li><strong>tags hashtag</strong></li>
						<li><strong>post type text</strong></li>
						<li><strong>read more icon</strong></li>
						<li><strong>post meta icons</strong></li>
						<li><strong>tags background</strong></li>
						<li><strong>post type background</strong></li>
						<li><strong>read more background</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="project-settings">

				<h1>project settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>project Types</h2>
					<p>add <strong>project</strong> types, the default types are <strong>( featured project, recent project )</strong> .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the widget elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>project tags</strong></li>
						<li><strong>project meta</strong></li>
						<li><strong>project meta icons</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>project tags</strong></li>
						<li><strong>project title</strong></li>
						<li><strong>project meta</strong></li>
						<li><strong>project type text</strong></li>
						<li><strong>project meta icons</strong></li>
						<li><strong>project description</strong></li>
						<li><strong>project tags hashtag</strong></li>
						<li><strong>project tags background</strong></li>
						<li><strong>project type background</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="skills-settings">

				<h1>skills settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Allowed Skills Number</h2>
					<p>maximum number of <strong>skills</strong> that user can add .</p>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="services-settings">

				<h1>services settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Allowed services Number</h2>
					<p>maximum number of <strong>services</strong> that user can add .</p>
				</div>

				<div class="uk-option-item">
					<h2>Services Box Layout</h2>
					<p>select <strong>services</strong> layout, the available formats are :</p>
					<img src="img/services-layouts.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>services icon background format</h2>
					<p>select <strong>icon</strong> format, the available formats are :</p>
					<img src="img/img-formats.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>widget Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the widget elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>service icon</strong></li>
						<li><strong>service title</strong></li>
						<li><strong>service description</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>service icon color</strong></li>
						<li><strong>service title color</strong></li>
						<li><strong>service description color</strong></li>
						<li><strong>service icon background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="portfolio-settings">

				<h1>portfolio settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Allowed portfolio Number</h2>
					<p>maximum number of <strong>photos</strong> that user can add .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the widget elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>photo url</strong></li>
						<li><strong>photo zoom</strong></li>
						<li><strong>photo title</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>buttons color</strong></li>
						<li><strong>buttons icon color</strong></li>
						<li><strong>buttons hover color</strong></li>
						<li><strong>buttons icon hover color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="slideshow-settings">

				<h1>slideshow settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Allowed slides Number</h2>
					<p>maximum number of <strong>slides</strong> that user can add .</p>
				</div>

				<div class="uk-option-item">
				</div>

				<div class="uk-option-item">
					<h2>slides height</h2>
					<p>set slides <strong>height</strong> type, the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>fixed</strong></li>
						<li><strong>auto</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>pagination color</strong></li>
						<li><strong>slideshow buttons color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="quote-settings">

				<h1>quote settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Cover Gradient Settings</h2>
					<p>select <strong>gradient</strong> colors <strong>( left color, right color )</strong> .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>quote icon color</strong></li>
						<li><strong>quote text color</strong></li>
						<li><strong>quote owner color</strong></li>
						<li><strong>quote icon background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="link-settings">

				<h1>link settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>link url color</strong></li>
						<li><strong>link icon color</strong></li>
						<li><strong>link description color</strong></li>
						<li><strong>link icon background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="video-settings">

				<h1>video settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>video title color</strong></li>
						<li><strong>video description color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="instagram-settings">

				<h1>instagram settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Allowed photos Number</h2>
					<p>maximum number of <strong>photos</strong> that user can add .</p>
				</div>

				<div class="uk-option-item">
					<h2>widget Visibility Settings</h2>
					<p>control the <strong>visibility</strong> of all the widget elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>photo url</strong></li>
						<li><strong>photo zoom</strong></li>
						<li><strong>photo title</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>buttons color</strong></li>
						<li><strong>buttons icon color</strong></li>
						<li><strong>buttons hover color</strong></li>
						<li><strong>buttons icon hover color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="flickr-settings">

				<h1>flickr settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>zoom icon hover color</strong></li>
						<li><strong>zoom icon hover background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="user-friends-settings">

				<h1>User Friends settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Widget Layout</h2>
							<p>select <strong>widget layout</strong> format, the available layouts are :</p>
							<ul class="uk-options-items">
							<li><strong>List</strong></li>
							<li><strong>Avatars Only</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Allowed Friends Number</h2>
						<p>Maximum Number Of <strong>Friends</strong> To Display</p>
					</div>

					<div class="uk-option-item">
						<h2>Friends Avatar Border Style</h2>
						<p>select <strong>avatars</strong> format, the available formats are :</p>
						<img src="img/img-formats.png" alt="">
					</div>

				</div>

			</section>

			<section class="uk-docs-section" id="user-groups-settings">

				<h1>User Groups settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Allowed Groups Number</h2>
						<p>Maximum Number Of <strong>Groups</strong> To Display</p>
					</div>

					<div class="uk-option-item">
						<h2>Groups Avatar Border Style</h2>
						<p>select <strong>avatars</strong> format, the available formats are :</p>
						<img src="img/img-formats.png" alt="">
					</div>

				</div>

			</section>

			<section class="uk-docs-section" id="infos-box-settings">

				<h1>infos boxes settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>infos boxes loading effect</h2>
					<p>select how you want your boxes to be loaded ?, the available effects are : </p>
					<ul class="uk-options-items">
						<li><strong>fadeIn</strong></li>
						<li><strong>fadeInUp</strong></li>
						<li><strong>fadeInLeft</strong></li>
						<li><strong>fadeInDown</strong></li>
						<li><strong>fadeInRight</strong></li>
						<li><strong>bounceInLeft</strong></li>
						<li><strong>fadeInUpDelay</strong></li>
						<li><strong>bounceInRight</strong></li>
					</ul>
					<p>the available boxes are : </p>
					<ul class="uk-options-items">
						<li><strong>email</strong></li>
						<li><strong>website</strong></li>
						<li><strong>address</strong></li>
						<li><strong>phone number</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>boxes gradient settings</h2>
					<p>select boxes <strong>gradient</strong> colors <strong>( left color, right color )</strong> .</p>
					<p>the available boxes are : </p>
					<ul class="uk-options-items">
						<li><strong>email</strong></li>
						<li><strong>website</strong></li>
						<li><strong>address</strong></li>
						<li><strong>phone number</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="recent-posts-settings">

				<h1>recent posts settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>allowed posts number</h2>
					<p>maximum number of <strong>posts</strong> to show inside the widget.</p>
				</div>

				<div class="uk-option-item">
					<h2>Posts Thumbnail Border Style</h2>
					<p>select <strong>Thumbnail</strong> format, the available formats are :</p>
					<img src="img/img-formats.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>widget styling settings</h2>
					<p>style all the <strong>widget</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>post date color</strong></li>
						<li><strong>post title color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="social-networks-settings">

				<h1>social networks settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2> Networks Styling Settings</h2>
					<p>1 - <strong>Display</strong> or <strong>Hide</strong> widget social networks.</p>
					<p>2 - Select social networks <strong>Border Style</strong>, the available styles are :</p>
					<ul class="uk-options-items">
						<li><strong>flat</strong></li>
						<li><strong>radius</strong></li>
						<li><strong>circle</strong></li>
					</ul>
					<p>3 - Select social networks <strong>Color Type</strong>, the available types are :</p>
					<ul class="uk-options-items">
						<li><strong>silver</strong></li>
						<li><strong>colorful</strong></li>
						<li><strong>transparent</strong></li>
						<li><strong>no background</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="custom-widgets-settings">

				<h1>custom widgets settings</h1>

				<div class="uk-inner-content">

				<p>go to <strong>Youzer Panel > widgets Settings > Custom widgets Settings</strong>, since there's no custom widgets yet you will see this :</p>

				<img src="img/no-custom-widgets.png" alt="">

				<div class="note green">
					<p>you can <strong>change</strong> the order of the <strong>custom widgets</strong> by <strong>drag and drop</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>how to create new custom widget ?</h2>
					<p>to create a new widget click on the button below :</p>
					<img src="img/add-new-custom-widget.png" alt="">
					<p>once you clicked the button above a popup window will show up and it contains these fields :</p>
					<img src="img/custom-widget-modal.png" alt="">
					<ul class="uk-options-items">
						<li><strong>widget icon :</strong>Select widget icon from the <strong>icon picker</strong>.</li>
						<li><strong>widget title :</strong>Type widget title.</li>
						<li><strong>display widget title:</strong>Show or hide widget title.</li>
						<li><strong>Use Widget Padding :</strong>Display widget padding users</li>
						<li><strong>widget content :</strong>put your shortcode or any html code.</li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>how to update a custom widget ?</h2>
					<p>to <strong>update</strong> a widget click on the <strong>'pencil' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
					<img src="img/update-custom-widget.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>how to delete a custom widget ?</h2>
					<p>to <strong>remove</strong> a widget click on the <strong>'X' button</strong> ( Check the image below ) and <strong>don't forget to save changes</strong>.</p>
					<img src="img/delete-custom-widget.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>custom widgets loading effect</h2>
					<p>select how you want your custom widgets to be loaded ?, the available effects are : </p>
					<ul class="uk-options-items">
						<li><strong>fadeIn</strong></li>
						<li><strong>fadeInUp</strong></li>
						<li><strong>fadeInLeft</strong></li>
						<li><strong>fadeInDown</strong></li>
						<li><strong>fadeInRight</strong></li>
						<li><strong>bounceInLeft</strong></li>
						<li><strong>fadeInUpDelay</strong></li>
						<li><strong>bounceInRight</strong></li>
					</ul>
				</div>
				</div>
			</section>

			<section class="uk-docs-section" id="logy-general-settings">

				<h1>general settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>membership system pages settings</h2>
						<p>In this section you can change the <strong>membership system</strong> default pages :</p>
						<ul class="uk-options-items">
							<li><strong>login :</strong>Users sign-in page.</li>
							<li><strong>Lost Password :</strong>Lost Password page.</li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Hide Dashboard For Subscribers</h2>
						<p>Hide Admin <strong>Toolbar</strong> And <strong>Dashboard</strong> For Subscribers.</p>
					</div>

					<div class="uk-option-item">
						<h2>margin settings</h2>
						<p>Specify <strong>MARGIN</strong> around membership pages content and the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>margin top</strong></li>
							<li><strong>margin bottom</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>panel schemes</h2>
						<p>select the <strong>membership system color scheme</strong>, the available schemes are :</p>
						<img src="img/panel-schemes.png" alt="">
					</div>

					<div class="uk-option-item">
						<h2>reset settings</h2>
						<p><strong>reset</strong> all the <strong>membership system</strong> settings.</p>
					</div>

				</div>

			</section>

			<section class="uk-docs-section" id="login-settings">

				<h1>login page settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Enable Ajax Login</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> ajaxed login.</p>
				</div>

				<div class="uk-option-item">
					<h2>Enable Login Popup</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> login popup.</p>
				</div>

				<div class="uk-option-item">
					<h2>Login Button Title</h2>
					<p>Type form <strong>login</strong> button title.</p>
				</div>

				<div class="uk-option-item">
					<h2>Register Button Title</h2>
					<p>Type form <strong>register</strong> button title.</p>
				</div>

				<div class="uk-option-item">
					<h2>Lost Password Link Title</h2>
					<p>Type <strong>lost password</strong> link title.</p>
				</div>

				<div class="uk-option-item">
					<h2>Custom Registration Link</h2>
					<p>Set custom <strong>registration link</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>After Login Redirect User To?</h2>
					<p>After user login <strong>redirect</strong> to which page ?,the available pages are :</p>
					<ul class="uk-options-items">
						<li><strong>home</strong></li>
						<li><strong>profile</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>After Login Redirect Admin To?</h2>
					<p>After admin login <strong>redirect</strong> to which page ?, the available pages are :</p>
					<ul class="uk-options-items">
						<li><strong>home</strong></li>
						<li><strong>profile</strong></li>
						<li><strong>dashboard</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>After Logout Redirect User To?</h2>
					<p>After logout <strong>redirect</strong> to which page ?, the available pages are :</p>
					<ul class="uk-options-items">
						<li><strong>home</strong></li>
						<li><strong>login</strong></li>
						<li><strong>User Profile</strong></li>
						<li><strong>members directory</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Enable form cover</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using form cover.</p>
				</div>

				<div class="uk-option-item">
					<h2>form title</h2>
					<p>type form header <strong>title</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>form subtitle</h2>
					<p>type form header <strong>subtitle</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>form cover</h2>
					<p>upload <strong>login</strong> form cover or paste a valid image url.</p>
				</div>

				<div class="uk-option-item">
					<h2>Form Fields Layouts</h2>
					<p>select the form <strong>fields layout</strong>, the available layouts are :</p>
					<img src="img/fields-layouts.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Fields Icons Position</h2>
					<p>Select <strong>fields</strong> icons position ( <strong>works only with layouts that support icons !</strong> ), the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>left</strong></li>
						<li><strong>right</strong></li>
					</ul>
				</div>
				<div class="uk-option-item">
					<h2>Fields Border Style</h2>
					<p>Select <strong>fields</strong> border style,the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>flat</strong></li>
						<li><strong>radius</strong></li>
						<li><strong>rounded</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Form Buttons Layouts</h2>
					<p>select the form <strong>buttons layout</strong>, the available layouts are :</p>
					<img src="img/buttons-layouts.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Buttons Icons Position</h2>
					<p>Select <strong>buttons</strong> icons position ( <strong>works only with buttons that support icons !</strong> ), the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>left</strong></li>
						<li><strong>right</strong></li>
					</ul>
				</div>
				<div class="uk-option-item">
					<h2>Buttons Border Style</h2>
					<p>Select <strong>buttons</strong> border style,the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>flat</strong></li>
						<li><strong>radius</strong></li>
						<li><strong>rounded</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Login Widget margin settings</h2>
					<p>Specify <strong>MARGIN</strong> around login widget, the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>margin top</strong></li>
						<li><strong>margin bottom</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="register-settings">

				<h1>registration page settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Enable Registration</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> users registration</p>
				</div>

				<div class="uk-option-item">
					<h2>New User Default Role</h2>
					<p>Select New User Default <strong>Role</strong>, By default the available roles are :</p>
					<ul class="uk-options-items">
						<li><strong>administrator</strong></li>
						<li><strong>contributor</strong></li>
						<li><strong>editor</strong></li>
						<li><strong>author</strong></li>
						<li><strong>subscriber</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Register Button Title</h2>
					<p>Type form <strong>register</strong> button title.</p>
				</div>

				<div class="uk-option-item">
					<h2>Login Button Title</h2>
					<p>Type form <strong>login</strong> button title.</p>
				</div>

				<div class="uk-option-item">
					<h2>Display Note</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> Terms And Privacy Policy Note.</p>
				</div>

				<div class="uk-option-item">
					<h2>Terms Url</h2>
					<p>Enter <strong>Terms</strong> And <strong>Conditions</strong> Link.</p>
				</div>

				<div class="uk-option-item">
					<h2>Privacy Policy Url</h2>
					<p>Enter <strong>Privacy Policy</strong> Link.</p>
				</div>

				<div class="uk-option-item">
					<h2>Enable form cover</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using form cover.</p>
				</div>

				<div class="uk-option-item">
					<h2>form title</h2>
					<p>type form header <strong>title</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>form subtitle</h2>
					<p>type form header <strong>subtitle</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>form cover</h2>
					<p>upload <strong>register</strong> form cover or paste a valid image url.</p>
				</div>

				<div class="uk-option-item">
					<h2>Form Buttons Layouts</h2>
					<p>select the form <strong>buttons layout</strong>, the available layouts are :</p>
					<img src="img/register-buttons-layout.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Buttons Icons Position</h2>
					<p>Select <strong>buttons</strong> icons position ( <strong>works only with buttons that support icons !</strong> ), the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>left</strong></li>
						<li><strong>right</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Buttons Border Style</h2>
					<p>Select <strong>buttons</strong> border style,the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>flat</strong></li>
						<li><strong>radius</strong></li>
						<li><strong>rounded</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>form buttons styling settings</h2>
					<p>select <strong>registration</strong> form buttons colors, the available options are :</p>
					<ul class="uk-options-items">
						<li><strong>Login button text color</strong></li>
						<li><strong>register button text color</strong></li>
						<li><strong>login button background color</strong></li>
						<li><strong>register button background color</strong></li>
					</ul>
				</div>

				</div>
			</section>

			<section class="uk-docs-section" id="lostpswd-settings">

				<h1>Lost Password settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>form title</h2>
					<p>type form header <strong>title</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>form subtitle</h2>
					<p>type form header <strong>subtitle</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Reset Button Title</h2>
					<p>type form reset button <strong>title</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Enable form cover</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using form cover.</p>
				</div>

				<div class="uk-option-item">
					<h2>form cover</h2>
					<p>upload <strong>lost password</strong> form cover or paste a valid image url.</p>
				</div>

				</div>

			</section>

			<section class="uk-docs-section" id="captcha-settings">

				<h1>captcha settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>how to get your captcha keys ?</h2>
					<p>1 - Visit <strong><a href="https://www.google.com/recaptcha/intro/index.html">the reCAPTCHA site</a></strong>.</p>
					<p>2 - Click on the <strong>"Get reCAPTCHA"</strong> button to access the reCAPTCHA admin page.</p>
					<img src="img/captcha1.png" alt="">
					<p>3 - You'll find the following form. type your <strong>site name</strong> and <strong>url</strong> and click <strong>register</strong></p>
					<img src="img/captcha2.png" alt="">
					<p>4 - Once you have submitted the form, you will see a page with your two keys <strong>site key</strong> and <strong>secret key</strong>.</p>
					<img src="img/captcha3.png" alt="">
				</div>

				<div class="uk-option-item">
					<h2>Enable Captcha</h2>
					<p><strong>Enable</strong> or <strong>Disable</strong> using captcha in registartion form.</p>
				</div>

				<div class="uk-option-item">
					<h2>Captcha Site Key</h2>
					<p>The reCaptcha <strong>site key</strong>.</p>
				</div>

				<div class="uk-option-item">
					<h2>Captcha Secret Key</h2>
					<p>The reCaptcha <strong>secret key</strong>.</p>
				</div>

				</div>

			</section>

			<section class="uk-docs-section" id="social-login-settings">

				<h1>Login Attempts Settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Enable Limit Login</h2>
						<p>Enable <strong>Social Login</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>Select Buttons Type</h2>
						<p>select social login <strong>buttons type</strong>, the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Only Icons</strong></li>
							<li><strong>Full Width</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Buttons Icons Position</h2>
						<p>select social login buttons <strong>icons position</strong>, the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Left</strong></li>
							<li><strong>Right</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>Buttons Border Style</h2>
						<p>select social login buttons <strong>border style</strong>, the available options are :</p>
						<ul class="uk-options-items">
							<li><strong>Flat</strong></li>
							<li><strong>Radius</strong></li>
							<li><strong>Rounded</strong></li>
						</ul>
					</div>

					<div class="uk-option-item">
						<h2>How to get Facebook Keys?</h2>
						<p>1. Go to <b><a href="https://developers.facebook.com/apps">https://developers.facebook.com/apps</a></b></p>
						<p>2. Create a new application by clicking <strong>"Create New App"</strong>.</p>
						<p>3. Fill out any required fields such as the application name and description.</p>
						<p>4. Put your website domain in the Site Url field.</p>
						<p>5. Go to the Status & Review page.</p>
						<p>6. Enable <strong>"Do you want to make this app and all its live features available to the general public?"</strong>.</p>
						<p>7. Facebook Login > Settings > Valid OAuth redirect URIs:</p>
						<p>8. OAuth Url : <b><a href="http://yourwebsite.com/?hauth_done=Facebook">http://yourwebsite.com/?hauth_done=Facebook</a></b></p>
						<p>9. Go to dashboard and get your <strong>App ID</strong> and <strong>App Secret</strong></p>
					</div>

					<div class="note red">
						<p><strong>Note:</strong> Twitter do not provide their users email address, to make that happen you have to submit your application for review untill that time we will request the email from users while registration.</p>
					</div>

					<div class="uk-option-item">
						<h2>How to get Twitter Keys?</h2>
						<p>1. Go to <b><a href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a></b></p>
						<p>2. Create a new application by clicking <strong>"Create New App"</strong>.</p>
						<p>3. Fill out any required fields such as the application name and description.</p>
						<p>4. Put your website domain in the Site Url field.</p>
						<p>5. Provide URL below as the Callback URL for your application.</p>
						<p>6. OAuth Url : <b><a href="http://yourwebsite.com/?hauth.done=Twitter">http://yourwebsite.com/?hauth.done=Twitter</a></b></p>
						<p>7. Register Settings and get <strong>Consumer Key</strong> and <strong>Secret</strong>.</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>How to get Google Plus Keys?</h2>
						<p>1. Go to <b><a href="https://code.google.com/apis/console/">https://code.google.com/apis/console/</a></b></p>
						<p>2. Create a new application by clicking <strong>"Create a new project"</strong>.</p>
						<p>3. Go to API Access under API Project.</p>
						<p>4. After that click on Create an OAuth 2.0 client ID to create a new application.</p>
						<p>5. A pop-up named <strong>"Create Client ID"</strong> will appear, fill out any required fields such as the application name and description and Click on Next.</p>
						<p>6. On the popup set Application type to Web application and switch to advanced settings by clicking on ( more options ) .</p>
						<p>7. Provide URL below as the Callback URL for your application.</p>
						<p>8. Callback Url: <b><a href="http://localhost/osef/?hauth.done=Google">http://localhost/osef/?hauth.done=Google</a></b></p>
						<p>9. Once you have registered, copy the created application credentials ( <strong>Client ID</strong> and <strong>Secret</strong> ) .</p>
					</div>


					<div class="uk-option-item">
						<h2>How to get Linked-In Keys?</h2>
						<p>1. Go to <b><a href="https://www.linkedin.com/developer/apps">https://www.linkedin.com/developer/apps</a></b></p>
						<p>2. Create a new application by clicking <strong>"Create Application"</strong>.</p>
						<p>3. Fill out any required fields such as the application name and description.</p>
						<p>4. Put the below url in the OAuth 2.0 Authorized Redirect URLs:</p>
						<p>5. Redirect Url: <b><a href="http://localhost/osef/?hauth.done=LinkedIn">http://localhost/osef/?hauth.done=LinkedIn</a></b></p>
						<p>6. Once you have registered, copy the created application credentials ( <strong>Client ID</strong> and <strong>Secret</strong> ) .</p>
					</div>

					<div class="note red">
						<p><strong>Note:</strong> Instagram do not provide their users email address, to make that happen you have to submit your application for review untill that time we will request the email from users while registration.</p>
					</div>

					<div class="uk-option-item">
						<h2>How to get Instagram Keys?</h2>
						<p>1. Go to <b><a href="instagram.com/developer/clients/manage/">instagram.com/developer/clients/manage/</a></b></p>
						<p>2. Create a new application by clicking <strong>"Register new Client"</strong>.</p>
						<p>3. Fill out any required fields such as the application name and description.</p>
						<p>4. Put the below url as OAuth redirect_uri <strong>Authorized Redirect URLs</strong> :</p>
						<p>5. Redirect Url: <b><a href="http://localhost/osef/?hauth.done=Instagram">http://localhost/osef/?hauth.done=Instagram</a></b></p>
						<p>6. Once you have registered, copy the created application credentials ( <strong>Client ID</strong> and <strong>Secret</strong> ) .</p>
					</div>

				</div>

			</section>

			<section class="uk-docs-section" id="login-attempts-settings">

				<h1>Login Attempts Settings</h1>

				<div class="uk-inner-content">

					<div class="uk-option-item">
						<h2>Enable Limit Login</h2>
						<p>Enable Limit Login <strong>Attempts</strong>.</p>
					</div>

					<div class="uk-option-item">
						<h2>Allowed Login Retries</h2>
						<p><strong>Lock Out</strong> After This Many Tries. <strong>( Default: 4 )</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>Short Lockouts Number</h2>
						<p>Apply <strong>Long Lockout</strong> After This Many Lockouts. <strong>( Default: 2 )</strong> </p>
					</div>

					<div class="uk-option-item">
						<h2>Retries Duration</h2>
						<p><strong>Reset Retries</strong> After This Many Seconds. <strong>( Default: 20 Min )</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>Short Lockouts Duration</h2>
						<p><strong>Short Lockout</strong> For This Many Seconds. <strong>( Default: 12 Hour )</strong></p>
					</div>

					<div class="uk-option-item">
						<h2>Long Lockouts Duration</h2>
						<p><strong>Long Lockout</strong> For This Many Seconds <strong>( Default: 24 Hour )</strong></p>
					</div>

				</div>
			</section>

			<section class="uk-docs-section" id="login-styling">

				<h1>Login Styling settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Header Styling Settings</h2>
					<p>style the <strong>header</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>form title</strong></li>
						<li><strong>form subtitle</strong></li>
						<li><strong>cover title background</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Fields Styling Settings</h2>
					<p>style the <strong>fields</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>icons</strong></li>
						<li><strong>labels</strong></li>
						<li><strong>placeholders</strong></li>
						<li><strong>Inputs text</strong></li>
						<li><strong>Inputs border</strong></li>
						<li><strong>icons background</strong></li>
						<li><strong>Inputs background</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Remember Me Styling Settings</h2>
					<p>style the <strong>"remember me"</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>"Remember Me" Color</strong></li>
						<li><strong>Checkbox Border</strong></li>
						<li><strong>Checkbox Icon</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Buttons Styling Settings</h2>
					<p>style the <strong>buttons</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>"Lost Password" Color</strong></li>
						<li><strong>Login Button Color</strong></li>
						<li><strong>Login Button Text</strong></li>
						<li><strong>Register Button Color</strong></li>
						<li><strong>Register Button Text</strong></li>
					</ul>
				</div>

				</div>

			</section>

			<section class="uk-docs-section" id="register-styling">

				<h1>register Styling settings</h1>

				<div class="uk-inner-content">

				<div class="uk-option-item">
					<h2>Header Styling Settings</h2>
					<p>style the <strong>header</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>form title</strong></li>
						<li><strong>form subtitle</strong></li>
						<li><strong>cover title background</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Fields Styling Settings</h2>
					<p>style the <strong>fields</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>labels</strong></li>
						<li><strong>placeholders</strong></li>
						<li><strong>Inputs text</strong></li>
						<li><strong>Inputs border</strong></li>
						<li><strong>Inputs background</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Password Note Styling Settings</h2>
					<p>style the <strong>"Password Note"</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>"Note" Word Color</strong></li>
						<li><strong>Note Description Color</strong></li>
					</ul>
				</div>

				<div class="uk-option-item">
					<h2>Buttons Styling Settings</h2>
					<p>style the <strong>buttons</strong> elements, the available elements are :</p>
					<ul class="uk-options-items">
						<li><strong>Register Button Color</strong></li>
						<li><strong>Register Button Text</strong></li>
						<li><strong>Login Button Color</strong></li>
						<li><strong>Login Button Text</strong></li>
					</ul>
				</div>

				</div>

			</section>
		</div>

		</div><!-- /.uk-main-content -->
	</div><!-- /#content -->
</div>

<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->

</body>
</html>