<?php
/**
 * Builds and hooks in the Navbar functions.
 *
 * @package Catalyst
 */

if( function_exists( 'register_nav_menus' ) )
{
	if( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_core( 'dynamik_responsive' ) || defined( 'CHILD_RESPONSIVE' ) )
	{
		register_nav_menus( array(
			'primary' => __( 'Navbar 1', 'catalyst' ),
			'secondary' => __( 'Navbar 2', 'catalyst' ),
			'primary_dropdown' => __( 'Responsive Dropdown 1', 'catalyst' ),
			'secondary_dropdown' => __( 'Responsive Dropdown 2', 'catalyst' )
		) );
	}
	else
	{
		register_nav_menus( array(
			'primary' => __( 'Navbar 1', 'catalyst' ),
			'secondary' => __( 'Navbar 2', 'catalyst' )
		) );
	}
}

if( function_exists( 'add_theme_support' ) )
{
	// Adds Wordpress 3.0 Custom Nav Menus Support.
	add_theme_support( 'nav-menus' );
	// Adds Wordpress 3.0 Automatic Feed Links Support.
	add_theme_support( 'automatic-feed-links' );
}

add_action( 'init', 'catalyst_hook_navbars' );
/**
 * Determine which Navbars to display and where to display them.
 *
 * @since 1.0
 */
function catalyst_hook_navbars()
{
	if( defined( 'DYNAMIK_ACTIVE' ) )
	{
		if( catalyst_get_dynamik_alt( 'nav1_location' ) == "Above Header" ){ add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar1' ); add_action( 'catalyst_hook_before_header', 'catalyst_dropdown_nav_1' ); }
		elseif( catalyst_get_dynamik_alt( 'nav1_location' ) == "Below Header" ){ add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar1' ); add_action( 'catalyst_hook_after_header', 'catalyst_dropdown_nav_1' ); }
		elseif( catalyst_get_dynamik_alt( 'nav1_location' ) == "Beside Header" ){ add_action( 'catalyst_hook_header_right', 'catalyst_build_navbar1' ); add_action( 'catalyst_hook_header_right', 'catalyst_dropdown_nav_1' ); }
	
		if( catalyst_get_dynamik_alt( 'nav2_location' ) == "Above Header" ){ add_action( 'catalyst_hook_before_header', 'catalyst_build_navbar2' ); add_action( 'catalyst_hook_before_header', 'catalyst_dropdown_nav_2' ); }
		elseif( catalyst_get_dynamik_alt( 'nav2_location' ) == "Below Header" ){ add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar2' ); add_action( 'catalyst_hook_after_header', 'catalyst_dropdown_nav_2' ); }
	}
	else
	{
		add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar1' );
		add_action( 'catalyst_hook_after_header', 'catalyst_build_navbar2' );
	}
}

add_filter( 'twitter_text', 'twitter_text' );
/**
 * Filter in the twitter_text custom text.
 *
 * @since 1.5.1
 */
function twitter_text()
{
	return catalyst_get_core( 'twitter_text' );
}

/**
 * Build Navbar 1 HTML.
 *
 * @since 1.0
 */
function catalyst_build_navbar1()
{
	global $catalyst_layout_id;
		
	if( catalyst_get_core( 'nav1_type' ) == "None" || substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
		return;
		
	if( catalyst_get_core( 'nav1_type' ) == "Custom" && function_exists( 'wp_nav_menu' ) )
	{
		$nav1 = wp_nav_menu( array(
			'theme_location' => 'primary',
			'container' => '',
			'menu_id' => 'nav-1',
			'menu_class' => catalyst_get_core( 'nav1_enable_superfish' ) ? 'nav-1 superfish' : 'nav-1',
			'echo' => 0,
			'fallback_cb' => false
		) );
	}
	elseif( catalyst_get_core( 'nav1_type' ) == "Default" )
	{
		$nav1 = catalyst_nav( array(
			'theme_location' => 'primary',
			'menu_id' => 'nav-1',
			'menu_class' => catalyst_get_core( 'nav1_enable_superfish' ) ? 'nav-1 superfish' : 'nav-1',
			'show_home' => catalyst_get_core( 'nav1_home_tab_text' ),
			'type' => catalyst_get_core( 'nav1_content' ),
			'depth' => catalyst_get_core( 'nav1_submenu_depth' ),
			'exclude' => catalyst_get_core( 'nav1_exclude_pages' ),
			'include' => catalyst_get_core( 'nav1_include_pages' ),
			'echo' => false
		) );
	}
	else
	{
		return;
	}
	
	if( catalyst_get_core( 'nav1_right_content' ) == 'Empty' )
	{
		$nav1_right = '';
	}
	elseif( catalyst_get_core( 'nav1_right_content' ) == 'Blog Feeds' )
	{
		$feeds = '<a href="' . catalyst_rss_link() . '" ><img style="vertical-align:text-top; display:inline;" src="' . get_template_directory_uri() . '/images/rss.png" alt="RSS" /></a> <a href="' . catalyst_rss_link() . '">' . __( 'RSS', 'catalyst' ) . '</a> ';
		$feeds .= '<a href="' . catalyst_get_core( 'email_feed_link' ) . '" ><img style="vertical-align:text-top; display:inline;" src="' . get_template_directory_uri() . '/images/rss.png" alt="RSS" /></a> <a href="' . catalyst_get_core( 'email_feed_link' ) . '">' . __( 'Email', 'catalyst' ) . '</a>';
		
		$nav1_right = '<div id="navbar-1-right" class="navbar-right-text">' . $feeds . '</div>';
	}
	elseif( catalyst_get_core( 'nav1_right_content' ) == 'Search' )
	{				
		$nav1_right = '<div id="navbar-1-right" class="navbar-right-search">' . catalyst_search_form() . '</div>';
	}
	elseif( catalyst_get_core( 'nav1_right_content' ) == 'Twitter' )
	{
		$twitter = '<a href="http://twitter.com/' . catalyst_get_core( 'twitter_id' ) . '" ><img style="vertical-align:middle;" src="' . get_template_directory_uri() . '/images/twitter.png" alt="Twitter" /></a> ' . apply_filters( 'twitter_text', __( 'Follow On', 'catalyst' ) ) . ' <a href="http://twitter.com/' . catalyst_get_core( 'twitter_id' ) . '">' . __( 'Twitter', 'catalyst' ) . '</a>';
		
		$nav1_right = '<div id="navbar-1-right" class="navbar-right-text">' . $twitter . '</div>';
	}
	elseif( catalyst_get_core( 'nav1_right_content' ) == 'Text' )
	{
		$nav1_right_text = htmlspecialchars_decode( catalyst_get_core( 'nav1_right_text' ) );
		
		$recovery_mode = 'off';
		
		if( $recovery_mode == 'off' )
		{
			ob_start();
			eval( '?>'.$nav1_right_text);
			$nav1_right_text = ob_get_contents();
			ob_end_clean();
		}
		
		$nav1_right = '<div id="navbar-1-right" class="navbar-right-text">' . $nav1_right_text . '</div>';
	}
	
	echo '<div id="navbar-1-wrap"><nav id="navbar-1" class="clearfix" role="navigation"><div id="navbar-1-left">' . $nav1 . '</div>' . $nav1_right . '</nav></div>' . "\n";
}

/**
 * Build Navbar 2 HTML.
 *
 * @since 1.0
 */
function catalyst_build_navbar2()
{
	global $catalyst_layout_id;
		
	if( catalyst_get_core( 'nav2_type' ) == "None" || substr( $catalyst_layout_id, 0, 21 ) == 'catalyst_landing_page' )
		return;
		
	if( catalyst_get_core( 'nav2_type' ) == "Custom" && function_exists( 'wp_nav_menu' ) )
	{
		$nav2 = wp_nav_menu( array(
			'theme_location' => 'secondary',
			'container' => '',
			'menu_id' => 'nav-2',
			'menu_class' => catalyst_get_core( 'nav2_enable_superfish' ) ? 'nav-2 superfish' : 'nav-2',
			'echo' => 0,
			'fallback_cb' => false
		) );
	}
	else
	{
		$nav2 = catalyst_nav( array(
			'theme_location' => 'secondary',
			'menu_id' => 'nav-2',
			'menu_class' => catalyst_get_core( 'nav2_enable_superfish' ) ? 'nav-2 superfish' : 'nav-2',
			'show_home' => catalyst_get_core( 'nav2_home_tab_text' ),
			'type' => catalyst_get_core( 'nav2_content' ),
			'depth' => catalyst_get_core( 'nav2_submenu_depth' ),
			'exclude' => catalyst_get_core( 'nav2_exclude_pages' ),
			'include' => catalyst_get_core( 'nav2_include_pages' ),
			'echo' => false
		) );
	}
	
	if( catalyst_get_core( 'nav2_right_content' ) == 'Empty' )
	{
		$nav2_right = '';
	}
	elseif( catalyst_get_core( 'nav2_right_content' ) == 'Blog Feeds' )
	{
		$feeds = '<a href="' . catalyst_rss_link() . '" ><img style="vertical-align:text-top; display:inline;" src="' . get_template_directory_uri() . '/images/rss.png" alt="RSS" /></a> <a href="' . catalyst_rss_link() . '">' . __( 'RSS', 'catalyst' ) . '</a> ';
		$feeds .= '<a href="' . catalyst_get_core( 'email_feed_link' ) . '" ><img style="vertical-align:text-top; display:inline;" src="' . get_template_directory_uri() . '/images/rss.png" alt="RSS" /></a> <a href="' . catalyst_get_core( 'email_feed_link' ) . '">' . __( 'Email', 'catalyst' ) . '</a>';
		
		$nav2_right = '<div id="navbar-2-right" class="navbar-right-text">' . $feeds . '</div>';
	}
	elseif( catalyst_get_core( 'nav2_right_content' ) == 'Search' )
	{	
		$nav2_right = '<div id="navbar-2-right" class="navbar-right-search">' . catalyst_search_form() . '</div>';
	}
	elseif( catalyst_get_core( 'nav2_right_content' ) == 'Twitter' )
	{
		$twitter = '<a href="http://twitter.com/' . catalyst_get_core( 'twitter_id' ) . '" ><img style="vertical-align:middle;" src="' . get_template_directory_uri() . '/images/twitter.png" alt="Twitter" /></a> ' . apply_filters( 'twitter_text', __( 'Follow On', 'catalyst' ) ) . ' <a href="http://twitter.com/' . catalyst_get_core( 'twitter_id' ) . '">' . __( 'Twitter', 'catalyst' ) . '</a>';
		
		$nav2_right = '<div id="navbar-2-right" class="navbar-right-text">' . $twitter . '</div>';
	}
	elseif(catalyst_get_core( 'nav2_right_content' ) == 'Text' )
	{
		$nav2_right_text = htmlspecialchars_decode( catalyst_get_core( 'nav2_right_text' ) );
		
		$recovery_mode = 'off';
		
		if( $recovery_mode == 'off' )
		{
			ob_start();
			eval( '?>'.$nav2_right_text);
			$nav2_right_text = ob_get_contents();
			ob_end_clean();
		}
		
		$nav2_right = '<div id="navbar-2-right" class="navbar-right-text">' . $nav2_right_text . '</div>';
	}
	
	echo '<div id="navbar-2-wrap"><nav id="navbar-2" class="clearfix" role="navigation"><div id="navbar-2-left">' . $nav2 . '</div>' . $nav2_right . '</nav></div>' . "\n";
}

/**
 * Build Navbar Left (UL/LI) HTML.
 *
 * @since 1.0
 */
function catalyst_nav( $args = array() )
{
	$defaults = array(
		'theme_location' => '',
		'type' => 'pages',
		'sort_column' => 'menu_order, post_title',
		'menu_id' => false,
		'menu_class' => 'nav',
		'echo' => true,
		'link_before' => '',
		'link_after' => ''
	);
	
	$defaults = apply_filters( 'catalyst_nav_default_args', $defaults );
	$args = wp_parse_args( $args, $defaults );
	
	// Allow child theme to short-circuit this function.
	$pre = apply_filters( 'catalyst_pre_nav', false, $args );
	if( $pre ) return $pre;
	
	$menu = '';
	
	$list_args = $args;
	
	if( isset( $args['show_home'] ) && ! empty( $args['show_home'] ) )
	{
		if( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = apply_filters( 'catalyst_nav_home_text', __( 'Home', 'catalyst' ), $args );
		else
			$text = $args['show_home'];
		
		$class = '';
		
		if( is_front_page() && !is_paged() )
			$class = 'class="home current_page_item"';
		else 
			$class = 'class="home"';
			
		$home = '<li ' . $class . '><a href="' . trailingslashit( home_url() ) . '" title="' . esc_attr( $text ) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		
		$menu .= $home;
		
		if(get_option( 'show_on_front' ) == 'page' && $args['type'] == 'pages' )
		{
			if( !empty( $list_args['exclude'] ) )
			{
				$list_args['exclude'] .= ',';
			}
			else
			{
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option( 'page_on_front' );
		}
	}
	
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	
	if( $args['type'] == 'pages' )
		$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages( $list_args ) );
	elseif( $args['type'] == 'categories' )
		$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_categories( $list_args ) );
		
	// Apply filters to the nav items.
	$menu = apply_filters( 'catalyst_nav_items', $menu, $args );
		
	$menu_class = ( $args['menu_class'] ) ? ' class="' . esc_attr( $args['menu_class'] ) . '"' : '';
	$menu_id = ( $args['menu_id'] ) ? ' id="' . esc_attr( $args['menu_id'] ) . '"' : '';
	
	if( $menu )
		$menu = '<ul'. $menu_id . $menu_class . '>' . $menu . '</ul>';
	
	// Apply filters to the final nav output.
	$menu = apply_filters( 'catalyst_nav', $menu, $args );
	
	if( $args['echo'] )
		echo $menu;
	else
		return $menu;
}

/**
 * Build Dropdown Nav 1 HTML.
 *
 * @since 1.5
 */
function catalyst_dropdown_nav_1()
{
	if( !catalyst_get_core( 'dynamik_responsive' ) || catalyst_get_core( 'nav1_type' ) == "None" || ( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_responsive( 'navbar_media_query_default' ) != 'tablet_dropdown' && catalyst_get_responsive( 'navbar_media_query_default' ) != 'mobile_dropdown' ) )
		return;
?>
	<div id="dropdown-nav-1-wrap">	
		<!-- dropdown nav for responsive design -->
		<nav id="dropdown-nav-1" role="navigation">
			<form id="dropdown-nav-1-form" action="" method="post">
			<select class="nav-1-chosen-select">
			<option value=""><?php echo catalyst_get_responsive( 'dropdown_menu_1_text' ) ?></option>
			<?php 
			$menu = wp_nav_menu( array( 'theme_location' => 'primary_dropdown', 'echo' => false ) );
			   if( preg_match_all( '#(<a [^<]+</a>)#', $menu,$matches ) )
			   {
				  $hrefpat = '/(href *= *([\"\']?)([^\"\' ]+)\2)/';
				  foreach( $matches[0] as $link )
				  {
					 if( preg_match( $hrefpat, $link,$hrefs ) )
					 {
						$href = $hrefs[3];
					 }
					 if( preg_match( '#>([^<]+)<#', $link,$names ) )
					 {
						$name = $names[1];
					 }
					 echo "<option value=\"$href\">$name</option>";
				  }
			   }				
			?>
			</select>
			</form>
		</nav><!-- #dropdown-nav-1 -->
		<!-- /end dropdown nav 1 -->
	</div>
<?php
}

/**
 * Build Dropdown Nav 2 HTML.
 *
 * @since 1.5
 */
function catalyst_dropdown_nav_2()
{
	if( !catalyst_get_core( 'dynamik_responsive' ) || catalyst_get_core( 'nav2_type' ) == "None" || ( defined( 'DYNAMIK_ACTIVE' ) && catalyst_get_responsive( 'navbar_media_query_default' ) != 'tablet_dropdown' && catalyst_get_responsive( 'navbar_media_query_default' ) != 'mobile_dropdown' ) )
		return;
?>
	<div id="dropdown-nav-2-wrap">	
		<!-- dropdown nav for responsive design -->
		<nav id="dropdown-nav-2" role="navigation">
			<form id="dropdown-nav-2-form" action="" method="post">
			<select class="nav-2-chosen-select">
			<option value=""><?php echo catalyst_get_responsive( 'dropdown_menu_2_text' ) ?></option>
			<?php 
			$menu = wp_nav_menu( array( 'theme_location' => 'secondary_dropdown', 'echo' => false ) );
			   if( preg_match_all( '#(<a [^<]+</a>)#', $menu,$matches ) )
			   {
				  $hrefpat = '/(href *= *([\"\']?)([^\"\' ]+)\2)/';
				  foreach( $matches[0] as $link )
				  {
					 if( preg_match( $hrefpat, $link,$hrefs ) )
					 {
						$href = $hrefs[3];
					 }
					 if( preg_match( '#>([^<]+)<#', $link,$names ) )
					 {
						$name = $names[1];
					 }
					 echo "<option value=\"$href\">$name</option>";
				  }
			   }				
			?>
			</select>
			</form>
		</nav><!-- #dropdown-nav-2 -->
		<!-- /end dropdown nav 2 -->
	</div>
<?php
}

//end lib/functions/catalyst-navbar.php