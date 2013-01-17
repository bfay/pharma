<?php
/**
 * Builds the Dynamik Responsive admin content.
 *
 * @package Catalyst
 */
?>

<div id="catalyst-dynamik-options-nav-<?php echo $nav_alt_id; ?>responsive-box" class="catalyst-all-options">
	<h3 style="margin-bottom:15px;"><?php _e( 'Responsive', 'catalyst' ); ?> <span id="show-hide-responsive-options" class="catalyst-custom-fonts-button dynamik-structure-settings-hide" style="color:#777; float:none;"><?php _e( 'Show/Hide Options', 'catalyst' ); ?></span> <span id="responsive-design-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
	<div class="tooltip tooltip-500">
		<h5><?php _e( 'What Is Responsive Web Design?', 'catalyst' ); ?></h5>
		<p>
			<?php _e( 'Responsive Web Design is a type of web design practice which involves the use of certain types of CSS code (as well as js code in many cases) to allow a website to "respond" to different browser widths.', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( 'Responsive Design is a great way to make your website more mobile friendly, adjusting to the size of the different smart phone and tablet browser sizes while still looking great in a regular desktop browser.', 'catalyst' ); ?>
		</p>
		
		<p>
			<?php _e( 'The options below provide you with the ability to easily add your own Custom CSS for each media query (transition point), allowing you to refine the responsive styles which have already been added. Just click the icon below that represents the transition point you would like your styles to focus on and that particular textarea will be displayed.', 'catalyst' ); ?>
		</p>
			
		<span class="tooltip-credit">
			<?php _e( 'Learn more about Responsive Design here:', 'catalyst' ); ?>
			<a href="http://thinkvitamin.com/design/beginners-guide-to-responsive-web-design/" target="_blank">Beginner's Guide to Responsive Web Design</a>
		</span>
	</div>
	
	<form action="/" id="responsive-options-form" name="responsive-options-form">
	<input type="hidden" name="action" value="catalyst_responsive_options_save" />
	<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'responsive-options' ); ?>" />
	<div id="show-hide-responsive-options-box" class="catalyst-custom-fonts-box" style="background:none; border:none; width:804px; padding:0; float:left; display:none; position:inherit;">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Meta/Script Options', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<code>&#60;meta name=&#34;viewport&#34; content=&#34;</code><input type="text" id="catalyst-viewport-meta-content" class="responsive-option" name="catalyst[viewport_meta_content]" value="<?php if( catalyst_get_responsive( 'viewport_meta_content' ) != '' ) { echo catalyst_get_responsive( 'viewport_meta_content' ); } else { echo 'width=device-width, initial-scale=1.0'; } ?>" style="width:450px;" /><code>&#34;&#62;</code>
					<span id="viewport-meta-content-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
				</p>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'What Is The Viewport Meta Tag?', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'The Viewport Meta Tag, which is added to the <code>&lt;head&gt;</code> of your site when these Dynamik Responsive features are enabled in Core Options, provides a means to specify to mobile browsers how your site should be displayed with regard to its scale.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'The default settings provided below, for example, tell mobile browsers to display your site in it\'s actual scale as apposed to zooming in or out to compensate for the smaller browser dimensions. This is ideal for a responsive site because without it your site would most likely be displayed in it\'s desktop browser form, but much smaller in size.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( 'In most cases you can just leave the default setting as is.', 'catalyst' ); ?>
					</p>
						
					<span class="tooltip-credit">
						<?php _e( 'Learn more about the Viewport Meta Tag here:', 'catalyst' ); ?>
						<a href="https://developer.mozilla.org/en/Mobile/Viewport_meta_tag#section_1" target="_blank">Using the viewport meta tag to control layout on mobile browsers</a>
					</span>
					
					<p style="float:left; margin-bottom:0;"><?php _e( '<strong>Default Value: <code>width=device-width, initial-scale=1.0</code></strong>', 'catalyst' ); ?></p>
				</div>
			</div>
			
			<div class="bg-box">
				<p>
					<?php _e( 'Enable/Disable HTML5/CSS3 browser compatibility scripts', 'catalyst' ); ?>
					<b><a href="<?php echo admin_url( 'admin.php?page=catalyst&activetab=catalyst-core-options-nav-scripts' ); ?>"><?php _e( 'HERE', 'catalyst' ); ?></a></b>
					<?php _e( '(read each script option\'s [?]Tooltip for more information)', 'catalyst' ); ?>
				</p>
			</div>
		</div>
		
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Default Media Query Options', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box" style="width:364px; margin-right:0; float:left;">
				<p>
					<?php _e( 'Site #wrap Media Query Styles:', 'catalyst' ); ?> <select id="catalyst-wrap-media-query-default" class="responsive-option" name="catalyst[wrap_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( catalyst_get_responsive( 'wrap_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
						<option value="none"<?php if( catalyst_get_responsive( 'wrap_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					</select>
					<span id="wrap-media-query-default-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
				</p>
				
				<div class="tooltip tooltip-400">
					<h5><?php _e( 'Site #wrap "Default" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 1st', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>1st trigger point</strong> = Your site #wrap margins, borders and box shadow styles are stripped to reduce unnecessary spacing around your site.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Default Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">#wrap { margin: 0 auto; border: 0; -webkit-border-radius: 0; border-radius: 0; -webkit-box-shadow: none; box-shadow: none; }</textarea>', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div class="bg-box" style="width:364px; margin-left:0; float:right;">
				<p>
					<?php _e( 'Header Media Query Styles:', 'catalyst' ); ?> <select id="catalyst-header-media-query-default" class="responsive-option" name="catalyst[header_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( catalyst_get_responsive( 'header_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
						<option value="none"<?php if( catalyst_get_responsive( 'header_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					</select>
					<span id="header-media-query-default-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
				</p>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'Header "Default" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 1st', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>1st trigger point</strong> = Header Left and Header Right will span the full width of your Header with the Header Right area displaying below Header Left, ensuring Header Left and Right content have room to display. The Title and Tagline (or logo image) will be centered.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Default Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">#header { height: auto; } #header-left { height: 70px; padding-left: 0; text-align: center; float: none; } #header-left, #header-right { max-width: none; width: 100%; } #header-right { padding: 0; } .logo-image #header #header-left { margin: 0 auto; float: none; }</textarea>', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div style="clear:both;"></div>
			
			<div class="bg-box" style="width:364px; margin-right:0; float:left;">
				<p>
					<?php _e( 'Navbar Media Query Styles:', 'catalyst' ); ?> <select id="catalyst-navbar-media-query-default" class="responsive-option" name="catalyst[navbar_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
						<option value="vertical"<?php if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'vertical' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical Menu', 'catalyst' ); ?></option>
						<option value="tablet_dropdown"<?php if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' ) echo ' selected="selected"'; ?>><?php _e( 'Tablet Dropdown', 'catalyst' ); ?></option>
						<option value="mobile_dropdown"<?php if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' ) echo ' selected="selected"'; ?>><?php _e( 'Mobile Dropdown', 'catalyst' ); ?></option>
						<option value="none"<?php if( catalyst_get_responsive( 'navbar_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					</select>
					<span id="navbar-media-query-default-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
				</p>
				
				<div class="tooltip tooltip-400 tooltip-scroll-400">
					<p>
						<?php _e( '<em>Note that both Navbars are effected by everything mentioned below.</em>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Navbar "Default" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 1st', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>1st trigger point</strong> = Navbar Left becomes full width and Navbar Right is removed (eg. Blog Feeds, Twitter, Search, etc..). Navbar pages/text are centered.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Default Code:', 'catalyst' ); ?></h5>
					
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin-bottom:20px;">#navbar-1-wrap, #navbar-2-wrap { height: auto; } #navbar-1-left, #navbar-2-left { width: 100%; } #navbar-1-right, #navbar-2-right { display: none; } ul#nav-1, ul#nav-2 { float: none; text-align: center; } #nav-1 li, #nav-2 li { display: inline-block; float: none; } #nav-1 li li, #nav-2 li li { text-align: left; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( '"Vertical Menu" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger points:</strong> 1st & 6th', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Vertical Menu styles:</strong> <strong>1st trigger point</strong> = Navbar Left becomes full width and Navbar Right is removed (eg. Blog Feeds, Twitter, Search, etc..). Navbar pages/text are centered. <strong>6th trigger point</strong> = Navbar is turned into a vertical menu.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Vertical Menu Code:', 'catalyst' ); ?></h5>
					
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">#navbar-1-wrap, #navbar-2-wrap { height: auto; } #navbar-1-left, #navbar-2-left { width: 100%; } #navbar-1-right, #navbar-2-right { display: none; } ul#nav-1, ul#nav-2 { float: none; text-align: center; } #nav-1 li, #nav-2 li { display: inline-block; float: none; } #nav-1 li li, #nav-2 li li { text-align: left; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '6th trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin-bottom:20px;">#navbar-1-wrap, #navbar-2-wrap { height: 100%; border-bottom: 0; } #navbar-1, #navbar-2, #navbar-1-left, #navbar-2-left, #nav-1 li, #nav-2 li, #nav-1 li ul, #nav-2 li ul { width: 100%; } #nav-1 li ul, #nav-2 li ul { display: block; visibility: visible; height: 100%; left: 0; position: relative; } #nav-1 li a, #nav-1 li a:link, #nav-1 li a:visited { border-right: 0 !important; border-bottom: 1px solid #E8E8E8; } #nav-2 li a, #nav-2 li a:link, #nav-2 li a:visited { border-right: 0 !important; border-bottom: 1px solid #E8E8E8; } #nav-1 li li, #nav-2 li li { text-align: center; } #nav-1 li li a, #nav-1 li li a:link, #nav-1 li li a:visited, #nav-2 li li a, #nav-2 li li a:link, #nav-2 li li a:visited { width: auto; } #nav-1 li ul ul, #nav-2 li ul ul { margin: 0; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( '"Tablet Dropdown" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 1st', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Tablet Dropdown styles:</strong> <strong>1st trigger point</strong> = The regular navbar is replaced with a dropdown menu.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Tablet Dropdown Code:', 'catalyst' ); ?></h5>
					
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin-bottom:20px;">#navbar-1-wrap, #navbar-2-wrap { display: none; } #dropdown-nav-1-wrap, #dropdown-nav-2-wrap { display: block; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( '"Mobile Dropdown" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger points:</strong> 1st & 6th', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Mobile Dropdown styles:</strong> <strong>1st trigger point</strong> = Navbar Left becomes full width and Navbar Right is removed (eg. Blog Feeds, Twitter, Search, etc..). Navbar pages/text are centered. <strong>6th trigger point</strong> = The regular navbar is replaced with a dropdown menu.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Mobile Dropdown Code:', 'catalyst' ); ?></h5>
					
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">#navbar-1-wrap, #navbar-2-wrap { height: auto; } #navbar-1-left, #navbar-2-left { width: 100%; } #navbar-1-right, #navbar-2-right { display: none; } ul#nav-1, ul#nav-2 { float: none; text-align: center; } #nav-1 li, #nav-2 li { display: inline-block; float: none; } #nav-1 li li, #nav-2 li li { text-align: left; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '6th trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">#navbar-1-wrap, #navbar-2-wrap { display: none; } #dropdown-nav-1-wrap, #dropdown-nav-2-wrap { padding: 0 20px 0 20px; display: block; }</textarea>', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div class="bg-box" style="width:364px; margin-left:0; float:right;">
				<p>
					<?php _e( 'Content/Sidebar Media Query Styles:', 'catalyst' ); ?> <select id="catalyst-content-media-query-default" class="responsive-option" name="catalyst[content_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( catalyst_get_responsive( 'content_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
						<option value="progressive"<?php if( catalyst_get_responsive( 'content_media_query_default' ) == 'progressive' ) echo ' selected="selected"'; ?>><?php _e( 'Progressive', 'catalyst' ); ?></option>
						<option value="none"<?php if( catalyst_get_responsive( 'content_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					</select>
					<span id="content-media-query-default-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
				</p>
				
				<div class="tooltip tooltip-500 tooltip-scroll-500">
					<h5><?php _e( 'Content/Sidebar "Default" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger points:</strong> 1st, 2nd & 4th', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>1st trigger point</strong> = The sidebars get pushed below the content, with both the main content and sidebars stretching to full width, enabling both Content and Sidebars ample room to display in any browser width. Catalyst Hybrid Columns stretch to full width, sitting one on top of the other. <strong>2nd trigger point</strong> = In cases where two sidebars are being displayed they will display side-by-side, below the main content. <strong>4th trigger point</strong> = These side-by-side sidebars will stretch to full width and display one on top of the other.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Default Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">.catalyst-hybrid-odd.catalyst-hybrid-columns, .catalyst-hybrid-even.catalyst-hybrid-columns { width: 100%; } .double-left-sidebar #container-wrap, .double-right-sidebar #container-wrap, .left-sidebar #container-wrap, .right-sidebar #container-wrap, .double-sidebar #container-wrap { padding-bottom: 0; } #content, .left-sidebar #content, .right-sidebar #content, .double-left-sidebar #content, .double-sidebar #content { margin: 0; } #dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer { width: 100%; margin: 20px 0 0; float: left; } .right-sidebar #sidebar-1-wrap, .left-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap { width: 100%; margin: 20px 0 0; } #sidebar-1, .double-left-sidebar #sidebar-1, .right-sidebar #sidebar-1, .left-sidebar #sidebar-1, .double-sidebar #sidebar-1, #sidebar-2, .double-left-sidebar #sidebar-2, .double-sidebar #sidebar-2 { width: 100%; } #catalyst-125-ads { margin: 0 0 0 5px; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '2nd trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">.double-sidebar #sidebar-2-wrap { margin: 20px 0 0; } #sidebar-1-wrap, .double-left-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap, #sidebar-2-wrap, .double-left-sidebar #sidebar-2-wrap, .double-sidebar #sidebar-2-wrap { width: 48.7%; } body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap, body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap, body.double-sidebar.slider-inside #ez-home-slider-container-wrap, body.left-sidebar.slider-inside #ez-home-slider-container-wrap, body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '4th trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin-bottom:20px;">#sidebar-1-wrap, .double-left-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap, #sidebar-2-wrap, .double-left-sidebar #sidebar-2-wrap, .double-sidebar #sidebar-2-wrap { width: 100%; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( '"Progressive" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger points:</strong> 1st, 2nd & 4th', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Progressive styles:</strong> <strong>1st trigger point</strong> = Catalyst Hybrid Columns stretch to full width, sitting one on top of the other. <strong>2nd trigger point</strong> = The Sidebars (in any case where two sidebars are sitting side-by-side) display one on top of the other to allow for more horizontal space for the main content. <strong>4th trigger point</strong> = The sidebars get pushed below the content, with both the main content and sidebars stretching to full width, enabling both Content and Sidebars ample room to display in any browser width.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Progressive Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">.catalyst-hybrid-odd.catalyst-hybrid-columns, .catalyst-hybrid-even.catalyst-hybrid-columns { width: 100%; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '2nd trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">.double-sidebar #container-wrap { padding-bottom: 0; } #content { margin: 0 300px 0 0; } .double-left-sidebar #content { margin: 0 0 0 300px; } .double-sidebar #content { margin: 0; } #dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer { width: 280px; margin: 0 0 0 -280px; } .double-left-sidebar #dual-sidebar-outer { margin: 0 -280px 0 0; } #sidebar-1-wrap, #sidebar-2-wrap, .double-left-sidebar #sidebar-1-wrap, .double-left-sidebar #sidebar-2-wrap, #sidebar-1, #sidebar-2, .double-left-sidebar  #sidebar-1, .double-left-sidebar #sidebar-2 { width: 280px; } .double-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-2-wrap { margin: 20px 0 0; width: 49%; } .double-sidebar #sidebar-1, .double-sidebar #sidebar-2 { width: 100%; } #catalyst-125-ads { margin: 0 0 0 5px; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '4th trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">.double-left-sidebar #container-wrap, .double-right-sidebar #container-wrap, .left-sidebar #container-wrap, .right-sidebar #container-wrap, .double-sidebar #container-wrap { padding-bottom: 0; } #content, .left-sidebar #content, .right-sidebar #content, .double-left-sidebar #content, .double-sidebar #content { margin: 0; } #dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer { margin: 20px 0 0; float: left; } .left-sidebar #sidebar-1-wrap, .right-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap { margin: 20px 0 0; } #dual-sidebar-outer, .double-left-sidebar #dual-sidebar-outer, #sidebar-1-wrap, .double-left-sidebar #sidebar-1-wrap, .left-sidebar #sidebar-1-wrap, .right-sidebar #sidebar-1-wrap, .double-sidebar #sidebar-1-wrap, #sidebar-2-wrap, .double-left-sidebar #sidebar-2-wrap, .double-sidebar #sidebar-2-wrap, #sidebar-1, .double-left-sidebar #sidebar-1, .right-sidebar #sidebar-1, .left-sidebar #sidebar-1, .double-sidebar #sidebar-1, #sidebar-2, .double-left-sidebar #sidebar-2, .double-sidebar #sidebar-2 { width: 100%; }</textarea>', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div style="clear:both;"></div>
			
			<div class="bg-box" style="width:364px; margin-right:0; float:left;">
				<p>
					<?php _e( 'EZ Widget Area Media Query Styles:', 'catalyst' ); ?> <select id="catalyst-ez-media-query-default" class="responsive-option" name="catalyst[ez_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( catalyst_get_responsive( 'ez_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
						<option value="delayed"<?php if( catalyst_get_responsive( 'ez_media_query_default' ) == 'delayed' ) echo ' selected="selected"'; ?>><?php _e( 'Delayed', 'catalyst' ); ?></option>
						<option value="none"<?php if( catalyst_get_responsive( 'ez_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					</select>
					<span id="ez-media-query-default-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
				</p>
				
				<div class="tooltip tooltip-400 tooltip-scroll-400">
					<h5><?php _e( 'EZ "Default" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 1st', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>1st trigger point</strong> = The EZ Home Container, the EZ Widget Areas and any content wrapped in EZ Column Classes that have two or more side-by-side columns will be set to full width, displaying one on top of the other. This will ensure that as the browser narrows the content still has adequate horizontal space to properly display.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Default Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin-bottom:20px;">#ez-home-container-wrap, #ez-home-sidebar-1-wrap { width: 100%; } #ez-home-sidebar-1-wrap { margin: 20px 0 0; float: left; } .ez-five-sixths, .ez-four-fifths, .ez-four-sixths, .ez-one-fifth, .ez-one-fourth, .ez-one-half, .ez-one-sixth, .ez-one-third, .ez-three-fifths, .ez-three-fourths, .ez-three-sixths, .ez-two-fifths, .ez-two-fourths, .ez-two-sixths, .ez-two-thirds { width: 100%; padding: 0 0 20px; } #ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; } #home-hook-wrap { padding-bottom: 0; } #ez-home-container-wrap, .ez-home-container-area, #ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; } #ez-home-container-wrap .ez-widget-area, #ez-feature-top-container .ez-widget-area, #ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; } #ez-home-sidebar-1-wrap { margin: 0; } body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap, body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap, body.double-sidebar.slider-inside #ez-home-slider-container-wrap, body.left-sidebar.slider-inside #ez-home-slider-container-wrap, body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'EZ "Delayed" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger points:</strong> 1st & 4th', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Delayed styles:</strong> <strong>1st trigger point</strong> = The EZ Home Container and the EZ Home Sidebar both stretch to full width with the Home Sidebar displaying below the rest of the EZ Homepage Content (this, of course, has no effect if you are not currently using the EZ Home Sidebar). <strong>4th trigger point</strong> = The EZ Widget Areas and any content wrapped in EZ Column Classes that have two or more side-by-side columns will be set to full width, displaying one on top of the other. This will ensure that as the browser narrows the content still has adequate horizontal space to properly display.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Delayed Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">#ez-home-container-wrap, #ez-home-sidebar-1-wrap { width: 100%; } #ez-home-sidebar-1-wrap { margin: 20px 0 0; float: left; } body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap, body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap, body.double-sidebar.slider-inside #ez-home-slider-container-wrap, body.left-sidebar.slider-inside #ez-home-slider-container-wrap, body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<p style="margin-bottom:0;">
						<?php _e( '4th trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin-bottom:20px;">.ez-five-sixths, .ez-four-fifths, .ez-four-sixths, .ez-one-fifth, .ez-one-fourth, .ez-one-half, .ez-one-sixth, .ez-one-third, .ez-three-fifths, .ez-three-fourths, .ez-three-sixths, .ez-two-fifths, .ez-two-fourths, .ez-two-sixths, .ez-two-thirds { width: 100%; padding: 0 0 20px; } #ez-home-slider.ez-widget-area, .slider-inside #ez-home-slider.ez-widget-area { padding-bottom: 0; } #home-hook-wrap { padding-bottom: 0; } #ez-home-container-wrap, .ez-home-container-area, #ez-feature-top-container, #ez-fat-footer-container { margin: 0 auto; padding-bottom: 0; } #ez-home-container-wrap .ez-widget-area, #ez-feature-top-container .ez-widget-area, #ez-fat-footer-container .ez-widget-area { width: 100%; padding-bottom: 20px; padding-left: 0 !important; } #ez-home-sidebar-1-wrap { margin: 0; }</textarea>', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Alternate Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( 'When the "Content/Sidebar Media Query Styles" are set to "Progressive" a slight variation of the above code takes place to accommodate certain scenarios where the Home Slider needs to account for the Sidebars on the 2nd trigger point.', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 2nd', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>2nd trigger point</strong> = When the EZ Static Homepage is not active, but your Home Slider is, the styles in this trigger point will stretch your Home Slider to full width of the Content area, accounting for the Sidebars if set to "Inside Sidebar".', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Alternate Code:', 'catalyst' ); ?></h5>
					<p style="margin-bottom:0;">
						<?php _e( '2nd trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:70px; margin:0;">body.double-left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px 300px; } body.double-right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 300px 20px 0; } body.double-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px; } body.left-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 0 20px 300px; } body.right-sidebar.slider-inside #ez-home-slider-container-wrap { margin: 0 300px 20px 0; }</textarea>', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div class="bg-box" style="width:364px; margin-left:0; float:right;">
				<p>
					<?php _e( 'Footer Media Query Styles:', 'catalyst' ); ?> <select id="catalyst-footer-media-query-default" class="responsive-option" name="catalyst[footer_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( catalyst_get_responsive( 'footer_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'catalyst' ); ?></option>
						<option value="none"<?php if( catalyst_get_responsive( 'footer_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'catalyst' ); ?></option>
					</select>
					<span id="footer-media-query-default-tooltip" class="tooltip-mark tooltip-center-left">[?]</span>
				</p>
				
				<div class="tooltip tooltip-500">
					<h5><?php _e( 'Footer "Default" Info:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '<strong>@media query trigger point:</strong> 1st', 'catalyst' ); ?>
					</p>
					
					<p>
						<?php _e( '<strong>Effect of Default styles:</strong> <strong>1st trigger point</strong> = Footer text will center, accommodating narrower screens.', 'catalyst' ); ?>
					</p>
					
					<h5><?php _e( 'Default Code:', 'catalyst' ); ?></h5>
					<p>
						<?php _e( '1st trigger point:', 'catalyst' ); ?><br />
						<?php _e( '<textarea style="width:100%; min-height:50px; margin:0;">.footer-left, .footer-right { padding: 0; float: none; text-align: center; clear: both; }</textarea>', 'catalyst' ); ?>
					</p>
				</div>
			</div>
			
			<div style="clear:both;"></div>
			
			<div style="display:none;" id="catalyst-display-dropdown-menu-text-box">
			
				<div class="bg-box" style="width:364px; margin-right:0; float:left;">
					<p>
						<?php _e( 'Dropdown Menu 1 Text:', 'catalyst' ); ?>
						<input type="text" id="catalyst-dropdown-menu-1-text" class="responsive-option" name="catalyst[dropdown_menu_1_text]" value="<?php echo catalyst_get_responsive( 'dropdown_menu_1_text' ) ?>" style="width:205px;" />
						<span id="dropdown-menu-1-text-tooltip" class="tooltip-mark tooltip-center-right">[?]</span>
					</p>
					
					<div class="tooltip tooltip-300">
						<p>
							<?php _e( 'This is the text that displays in your Tablet or Mobile Dropdown menus by default.', 'catalyst' ); ?>
						</p>
						
						<p>
							<?php _e( '<strong>Please Note:</strong> To assign specific Custom Menus to these Dropdown Menus go to', 'catalyst' ); ?>
							<a href="<?php echo admin_url( 'nav-menus.php' ); ?>"><?php _e( '<b>(Appearance > Menus)</b>', 'catalyst' ); ?></a>
							<?php _e( 'and set them in the "Theme Locations" section.', 'catalyst' ); ?>
						</p>
					</div>
				</div>
				
				<div class="bg-box" style="width:364px; margin-left:0; float:right;">
					<p>
						<?php _e( 'Dropdown Menu 2 Text:', 'catalyst' ); ?>
						<input type="text" id="catalyst-dropdown-menu-2-text" class="responsive-option" name="catalyst[dropdown_menu_2_text]" value="<?php echo catalyst_get_responsive( 'dropdown_menu_2_text' ) ?>" style="width:230px;" />
					</p>
				</div>
				
				<div style="clear:both;"></div>
			
			</div>
		</div>
	</div>
	
	<div class="dynamik-structure-settings-hide">
	
	<div id="responsive-nav">
		<span id="query-1" class="responsive-icon responsive-icon-first responsive-hover-first"></span>
		<span id="query-2" class="responsive-icon"></span>
		<span id="query-3" class="responsive-icon"></span>
		<span id="query-4" class="responsive-icon"></span>
		<span id="query-5" class="responsive-icon"></span>
		<span id="query-6" class="responsive-icon"></span>
	</div>
	
	<div id="query-1-box" class="query-box-all">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Tablet Landscape Cascading @media query <strong>(1st)</strong>', 'catalyst' ); ?> <span id="media-query-large-cascading-tooltip" class="tooltip-mark tooltip-bottom-center">[?]</span></h3>
		<div class="tooltip tooltip-500">
			<p>
				<?php _e( 'The max-width value below is based on your default layout\'s "Wrap Width" plus your Wrap\'s "Left/Right Padding" value times two (to account for both left and right). So the default equation to reach the below max-width value is: ', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'Wrap Width: 960px + Left/Right Wrap Padding: 0px x 2 = 960px', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( 'So as you change those values the max-width value in the 1st, 2nd and 3rd media queries will change as well.', 'catalyst' ); ?>
			</p>
			
			<p>
				<?php _e( '<strong>Please Note:</strong> Therefore your Custom Layout Widths will play no role in determining this max-width value. So this first media query transition will be dependent on your Default Layout dimensions meaning your Custom Layouts, ideally, should reflect the same Wrap Width as your Default Layout. Really, this should be the case in the vast majority of situations since a site\'s Wrap Width should not change as you click through its pages. Maybe a Landing Page is an exception, but even then it doesn\'t have to be.', 'catalyst' ); ?>
			</p>
		</div>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (max-width: <span class="responsive-wrap-width">960</span>px) { }</code></strong>
					<textarea id="catalyst-media-query-large-cascading-content" class="responsive-option" name="catalyst[media_query_large_cascading_content]" style="width:100%; height:250px;"><?php if( catalyst_get_responsive( 'media_query_large_cascading_content' ) ) echo catalyst_get_responsive( 'media_query_large_cascading_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-2-box" class="query-box-all">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Tablet Landscape Specific @media query <strong>(2nd)</strong>', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (min-width: 768px) and (max-width: <span class="responsive-wrap-width">960</span>px) { }</code></strong><br />
					<textarea id="catalyst-media-query-large-content" class="responsive-option" name="catalyst[media_query_large_content]" style="width:100%; height:250px;"><?php echo catalyst_get_responsive( 'media_query_large_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-3-box" class="query-box-all">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Tablet Portrait to Tablet Landscape Specific @media query <strong>(3rd)</strong>', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (min-width: 480px) and (max-width: <span class="responsive-wrap-width">960</span>px) { }</code></strong><br />
					<textarea id="catalyst-media-query-medium-large-content" class="responsive-option" name="catalyst[media_query_medium_large_content]" style="width:100%; height:250px;"><?php echo catalyst_get_responsive( 'media_query_medium_large_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-4-box" class="query-box-all">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Tablet Portrait Cascading @media query <strong>(4th)</strong>', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (max-width: 767px) { }</code></strong><br />
					<textarea id="catalyst-media-query-medium-cascading-content" class="responsive-option" name="catalyst[media_query_medium_cascading_content]" style="width:100%; height:250px;"><?php if( catalyst_get_responsive( 'media_query_medium_cascading_content' ) ) echo catalyst_get_responsive( 'media_query_medium_cascading_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-5-box" class="query-box-all">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Mobile Landscape to Tablet Portrait Specific @media query <strong>(5th)</strong>', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (min-width: 480px) and (max-width: 767px) { }</code></strong><br />
					<textarea id="catalyst-media-query-medium-content" class="responsive-option" name="catalyst[media_query_medium_content]" style="width:100%; height:250px;"><?php echo catalyst_get_responsive( 'media_query_medium_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-6-box" class="query-box-all">
		<h3 class="catalyst-wide-option-heading"><?php _e( 'Mobile Portrait Specific @media query <strong>(6th)</strong>', 'catalyst' ); ?></h3>
		<div style="padding-top:10px; margin-bottom:15px; border:1px solid #E3E3E3; border-top:0; background:#FFFFFF; width:802px;">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (max-width: 479px) { }</code></strong><br />
					<textarea id="catalyst-media-query-small-content" class="responsive-option" name="catalyst[media_query_small_content]" style="width:100%; height:250px;"><?php echo catalyst_get_responsive( 'media_query_small_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	</div><!-- End .dynamik-structure-settings-hide -->
	
	</form>
</div>