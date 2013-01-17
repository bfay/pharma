<?php
/**
 * Builds many of the admin options drop-down lists.
 *
 * @package Catalyst
 */
 
/**********
CSS Builder Popup Elements
           **********/

/**
 * Build general CSS elements drop-down list.
 *
 * @since 1.0
 * @return general CSS elements array.
 */
function catalyst_css_elements_array()
{
	$catalyst_css_elements_array = array(
		'-- Page Elements --' => array(
			'Body' => 'body',
			'Universal Link' => 'a, a:visited',
			'Universal Link Hover' => 'a:hover',
			'Main Wrap' => '#wrap'
		),
		'-- Header --' => array(
			'Header Wrap' => '#header-wrap',
			'Header' => '#header',
			'Header Left' => '#header-left',
			'Header Right' => '#header-right',
			'Site Title' => '#title',
			'Site Title Link' => '#title a, #title a:visited',
			'Site Title Link Hover' => '#title a:hover',
			'Site Tagline' => '#tagline',
			'Logo Image' => '.logo-image #header #header-left',
			'Logo Image Area' => '.logo-image #header-left, .logo-image #header-left #title, .logo-image #header-left #title a'
		),
		'-- Navbar 1 --' => array(
			'Navbar 1 Wrap' => '#navbar-1-wrap',
			'Navbar 1' => '#navbar-1',
			'Navbar 1 Left' => '#navbar-1-left',
			'Navbar 1 Right' => '#navbar-1-right',
			'Nav 1' => '#nav-1'
		),
		'-- Navbar 2 --' => array(
			'Navbar 2 Wrap' => '#navbar-2-wrap',
			'Navbar 2' => '#navbar-2',
			'Navbar 2 Left' => '#navbar-2-left',
			'Navbar 2 Right' => '#navbar-2-right',
			'Nav 2' => '#nav-2'
		),
		'-- Containers --' => array(
			'Container Wrap' => '#container-wrap',
			'Container' => '#container',
			'Content Sidebar Wrap' => '#content-sidebar-wrap'
		),
		'-- Main Content --' => array(
			'Content Wrap' => '#content-wrap',
			'Content' => '#content',
			'Content Post' => '#content .post',
			'Content Page' => '#content .page',
			'Post/Page Title' => '#content .entry-title',
			'Content H1' => '#content h1',
			'Content H2' => '#content h2',
			'Content H3' => '#content h3',
			'Content H4' => '#content h4',
			'Content H5' => '#content h5',
			'Content H6' => '#content h6',
			'Content Post/Page UL LI' => '#content .post ul li, #content .page ul li',
			'Content Post/Page OL LI' => '#content .post ol li, #content .page ol li',
			'Content Author Box' => '#entry-author-info',
			'Breadcrumbs' => '.breadcrumbs',
			'Byline Meta' => '.byline-meta',
			'Post Meta' => '.post-meta',
			'Post Navigation' => '.post-nav'
		),
		'-- Author Info Box --' => array(
			'Author Box' => '#entry-author-info',
			'Author Box Title' => '#entry-author-info p',
			'Author Box Link' => '#entry-author-info a, #entry-author-info a:visited',
			'Author Box Link Hover' => '#entry-author-info a:hover',
			'Author Box Avatar' => '#entry-author-info #author-avatar'
		),
		'-- Custom Widgets Areas --' => array(
			'Custom Widget Area' => '.catalyst-widget-area',
			'Custom Widget Area H4' => '.catalyst-widget-area h4'
		),
		'-- Catalyst Excerpt Widgets --' => array(
			'Excerpt Widget' => '.catalyst-excerpt-widget',
			'Excerpt Widget H2' => '.catalyst-excerpt-widget h2',
			'Excerpt Widget Byline Meta' => '.catalyst-excerpt-widget .byline-meta',
			'Excerpt Widget Paragraph' => '.catalyst-excerpt-widget .entry-content p'
		),
		'-- Sidebars --' => array(
			'Dual Sidebar Outer Div' => '#dual-sidebar-outer',
			'Dual Sidebar Inner Div' => '#dual-sidebar-inner',
			'Sidebar 1 Wrap' => '#sidebar-1-wrap',
			'Sidebar 1' => '#sidebar-1',
			'Sidebar 1 H4' => '#sidebar-1 h4',
			'Sidebar 1 Widget' => '#sidebar-1 .widget',
			'Sidebar 2 Wrap' => '#sidebar-2-wrap',
			'Sidebar 2' => '#sidebar-2',
			'Sidebar 2 H4' => '#sidebar-2 h4',
			'Sidebar 2 Widget' => '#sidebar-2 .widget',
			'Sidebar Link' => '#sidebar-1 a, #sidebar-1 a:visited, #sidebar-2 a, #sidebar-2 a:visited, #ez-home-sidebar-1 a, #ez-home-sidebar-1 a:visited',
			'Sidebar Link Hover' => '#sidebar-1 a:hover, #sidebar-2 a:hover, #ez-home-sidebar-1 a:hover'
		),
		'-- Comments --' => array(
			'Comment Wrap' => '#comment-wrap',
			'Comments' => '#comments',
			'Comment List' => '.commentlist',
			'Comment' => '#comment',
			'Comment Meta' => '.commentmetadata',
			'Comment Thread Even' => '.thread-even',
			'Comments Nav' => '.comments-nav',
			'Author/Email/URL' => '#author, #email, #url',
			'Comment Form' => '#commentform',
			'Comment Submit Button' => '#commentform #submit',
			'No Comments Text' => '.nocomments'
		),
		'-- Footer --' => array(
			'Footer Wrap' => '#footer-wrap',
			'Footer' => '#footer',
			'Footer Text' => '#footer p.footer-content',
			'Footer Link' => '#footer .footer-content a, #footer .footer-content a:visited',
			'Footer Link Hover' => '#footer .footer-content a:hover',
			'Footer Left' => '.footer-left',
			'Footer Right' => '.footer-right',
			'Footer Center' => '.footer-center',
			'Catalyst Attribute' => '.catalyst-attribute'
		),
		'-- Images / Alignment --' => array(
			'Image Align None' => 'img.alignnone',
			'Image Align Left' => 'img.alignleft',
			'Image Align Center' => 'img.centered',
			'Image Align Right' => 'img.alignright',
			'Image WP Smiley' => 'img.wp-smiley, img.wp-wink',
			'Align Left' => '.alignleft',
			'Align Center' => '.aligncenter',
			'Align Right' => '.alignright',
			'WP Caption' => '.wp-caption',
			'WP Caption Text' => '.wp-caption p.wp-caption-text',
			'Thumbnail Image' => '.wp-post-image'
		)
	);
	
	return $catalyst_css_elements_array;	
}

/**
 * Build the CSS Builder general elements menu.
 *
 * @since 1.0
 */
function catalyst_build_css_elements_menu( $selected = '' )
{
	$catalyst_css_elements_array = catalyst_css_elements_array();
	
	foreach( $catalyst_css_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build body CSS elements drop-down list.
 *
 * @since 1.0
 * @return body CSS elements array.
 */
function catalyst_body_elements_array()
{
	$catalyst_body_elements_array = array(
		'-- Page Elements --' => array(
			'Body' => 'body',
			'Universal Link' => 'a, a:visited',
			'Universal Link Hover' => 'a:hover',
			'Main Wrap' => '#wrap'
		)
	);
	
	return $catalyst_body_elements_array;
}

/**
 * Build the CSS Builder body elements menu.
 *
 * @since 1.0
 */
function catalyst_build_body_elements_menu( $selected = '' )
{
	$catalyst_body_elements_array = catalyst_body_elements_array();
	
	foreach( $catalyst_body_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build header CSS elements drop-down list.
 *
 * @since 1.0
 * @return header CSS elements array.
 */
function catalyst_header_elements_array()
{
	$catalyst_header_elements_array = array(
		'-- Header --' => array(
			'Header Wrap' => '#header-wrap',
			'Header' => '#header',
			'Header Left' => '#header-left',
			'Header Right' => '#header-right',
			'Site Title' => '#title',
			'Site Title Link' => '#title a, #title a:visited',
			'Site Title Link Hover' => '#title a:hover',
			'Site Tagline' => '#tagline',
			'Logo Image' => '.logo-image #header #header-left',
			'Logo Image Area' => '.logo-image #header-left, .logo-image #header-left #title, .logo-image #header-left #title a'
		)
	);
	
	return $catalyst_header_elements_array;
}

/**
 * Build the CSS Builder header elements menu.
 *
 * @since 1.0
 */
function catalyst_build_header_elements_menu( $selected = '' )
{
	$catalyst_header_elements_array = catalyst_header_elements_array();
	
	foreach( $catalyst_header_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build navbar 1 CSS elements drop-down list.
 *
 * @since 1.0
 * @return navbar 1 CSS elements array.
 */
function catalyst_navbar1_elements_array()
{
	$catalyst_navbar1_elements_array = array(
		'-- Navbar 1 --' => array(
			'Navbar 1 Wrap' => '#navbar-1-wrap',
			'Navbar 1' => '#navbar-1',
			'Navbar 1 Left' => '#navbar-1-left',
			'Navbar 1 Right' => '#navbar-1-right',
			'Nav 1' => '#nav-1',
			'Navbar 1 Right Text' => '#navbar-1-right.navbar-right-text',
			'Navbar 1 Right Search' => '#navbar-1-right.navbar-right-search',
			'Navbar 1 Right Link' => '#navbar-1-right a, #navbar-1-right a:visited',
			'Navbar 1 Right Link Hover' => '#navbar-1-right a:hover',
			'Navbar 1 Page Link' => '#nav-1 li a, #nav-1 li a:link, #nav-1 li a:visited',
			'Navbar 1 Page Link Hover' => '#nav-1 li a:hover, #nav-1 li a:active',
			'Navbar 1 Current Page Link' => '#nav-1 li.current_page_item a, #nav-1 li.current-menu-item a, #nav-1 li.current-cat a',
			'Navbar 1 Page jQuery Sub-Indicator' => '#nav-1 li a .sf-sub-indicator',
			'Navbar 1 Sub-Page Link' => '#nav-1 li li a, #nav-1 li li a:link, #nav-1 li li a:visited',
			'Navbar 1 Sub-Page Link Hover' => '#nav-1 li li a:hover, #nav-1 li li a:active',
			'Navbar 1 Sub-Page jQuery Sub-Indicator' => '#nav-1 li li a .sf-sub-indicator',
			'Navbar 1 UL' => '#nav-1 ul',
			'Navbar 1 LI' => '#nav-1 li',
			'Navbar 1 LI UL' => '#nav-1 li ul',
			'Navbar 1 LI UL UL' => '#nav-1 li ul ul'
		)
	);
	
	return $catalyst_navbar1_elements_array;
}

/**
 * Build the CSS Builder navbar 1 elements menu.
 *
 * @since 1.0
 */
function catalyst_build_navbar1_elements_menu( $selected = '' )
{
	$catalyst_navbar1_elements_array = catalyst_navbar1_elements_array();
	
	foreach( $catalyst_navbar1_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build navbar 2 CSS elements drop-down list.
 *
 * @since 1.0
 * @return navbar 2 CSS elements array.
 */
function catalyst_navbar2_elements_array()
{
	$catalyst_navbar2_elements_array = array(
		'-- Navbar 2 --' => array(
			'Navbar 2 Wrap' => '#navbar-2-wrap',
			'Navbar 2' => '#navbar-2',
			'Navbar 2 Left' => '#navbar-2-left',
			'Navbar 2 Right' => '#navbar-2-right',
			'Nav 2' => '#nav-2',
			'Navbar 2 Right Text' => '#navbar-2-right.navbar-right-text',
			'Navbar 2 Right Search' => '#navbar-2-right.navbar-right-search',
			'Navbar 2 Right Link' => '#navbar-2-right a, #navbar-2-right a:visited',
			'Navbar 2 Right Link Hover' => '#navbar-2-right a:hover',
			'Navbar 2 Page Link' => '#nav-2 li a, #nav-2 li a:link, #nav-2 li a:visited',
			'Navbar 2 Page Link Hover' => '#nav-2 li a:hover, #nav-2 li a:active',
			'Navbar 2 Current Page Link' => '#nav-2 li.current_page_item a, #nav-2 li.current-menu-item a, #nav-2 li.current-cat a',
			'Navbar 2 Page jQuery Sub-Indicator' => '#nav-2 li a .sf-sub-indicator',
			'Navbar 2 Sub-Page Link' => '#nav-2 li li a, #nav-2 li li a:link, #nav-2 li li a:visited',
			'Navbar 2 Sub-Page Link Hover' => '#nav-2 li li a:hover, #nav-2 li li a:active',
			'Navbar 2 Sub-Page jQuery Sub-Indicator' => '#nav-2 li li a .sf-sub-indicator',
			'Navbar 2 UL' => '#nav-2 ul',
			'Navbar 2 LI' => '#nav-2 li',
			'Navbar 2 LI UL' => '#nav-2 li ul',
			'Navbar 2 LI UL UL' => '#nav-2 li ul ul'
		)
	);
	
	return $catalyst_navbar2_elements_array;
}

/**
 * Build the CSS Builder navbar 2 elements menu.
 *
 * @since 1.0
 */
function catalyst_build_navbar2_elements_menu( $selected = '' )
{
	$catalyst_navbar2_elements_array = catalyst_navbar2_elements_array();
	
	foreach( $catalyst_navbar2_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build breadcrumbs CSS elements drop-down list.
 *
 * @since 1.0
 * @return breadcrumbs CSS elements array.
 */
function catalyst_breadcrumbs_elements_array()
{
	$catalyst_breadcrumbs_elements_array = array(
		'-- Breadcrumb Elements --' => array(
			'Breadcrumbs' => '.breadcrumbs',
			'Breadcrumbs Link' => '.breadcrumbs a, .breadcrumbs a:visited',
			'Breadcrumbs Link Hover' => '.breadcrumbs a:hover',
		)
	);
	
	return $catalyst_breadcrumbs_elements_array;
}

/**
 * Build the CSS Builder breadcrumbs elements menu.
 *
 * @since 1.0
 */
function catalyst_build_breadcrumbs_elements_menu( $selected = '' )
{
	$catalyst_breadcrumbs_elements_array = catalyst_breadcrumbs_elements_array();
	
	foreach( $catalyst_breadcrumbs_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build content CSS elements drop-down list.
 *
 * @since 1.0
 * @return content CSS elements array.
 */
function catalyst_content_elements_array()
{
	$catalyst_content_elements_array = array(
		'-- Main Content --' => array(
			'Content Wrap' => '#content-wrap',
			'Content' => '#content',
			'Content Post' => '#content .post',
			'Content Post Paragraph' => '#content .post p',
			'Content Page' => '#content .page',
			'Content Page Paragraph' => '#content .page p',
			'Content Post/Page General Text' => '.entry-content p, .entry-content ul li, .entry-content ol li',
			'Content Post/Page Link' => '.entry-content a, .entry-content a:visited',
			'Content Post/Page Link Hover' => '.entry-content a:hover',
			'Post/Page Title' => '#content .entry-title',
			'Post Title Link' => '#content h2 a, #content h2 a:visited',
			'Post Title Link Hover' => '#content h2 a:hover',
			'Content H1' => '#content h1',
			'Content H2' => '#content h2',
			'Content H3' => '#content h3',
			'Content H4' => '#content h4',
			'Content H5' => '#content h5',
			'Content H6' => '#content h6',
			'Content Post/Page UL LI' => '#content .post ul li, #content .page ul li',
			'Content Post/Page OL LI' => '#content .post ol li, #content .page ol li',
			'Byline Meta' => '.byline-meta',
			'Byline Meta Link' => '.byline-meta a, .byline-meta a:visited',
			'Byline Meta Link Hover' => '.byline-meta a:hover',
			'Post Meta' => '.post-meta',
			'Post Meta Text' => '.post-meta p',
			'Post Meta Link' => '.post-meta a, .post-meta a:visited',
			'Post Meta Link Hover' => '.post-meta a:hover',
			'Post Navigation' => '.post-nav',
			'Post Navigation Link' => '.post-nav a, .post-nav a:visited',
			'Post Navigation Numbered' => '.post-nav li a, .post-nav li a:visited, .post-nav li.disabled, .post-nav li a:hover, .post-nav li.active a',
			'Post Navigation Numbered Link' => '.post-nav li.active a',
			'Post Navigation Numbered Link Hover' => '.post-nav li a:hover'
		),
		'-- Catalyst Hybrid Content Classes --' => array(
			'Hybrid Loop Odd' => '.catalyst-hybrid-odd',
			'Hybrid Loop Even' => '.catalyst-hybrid-even',
			'Hybrid Loop Odd & Even' => '.catalyst-hybrid-odd, .catalyst-hybrid-even',
			'Hybrid Columns Class' => '.catalyst-hybrid-odd.catalyst-hybrid-columns',
			'Hybrid Columns Odd' => '.catalyst-hybrid-odd.catalyst-hybrid-columns',
			'Hybrid Columns Even' => '.catalyst-hybrid-even.catalyst-hybrid-columns',
			'Hybrid Columns Odd & Even' => '.catalyst-hybrid-odd.catalyst-hybrid-columns, .catalyst-hybrid-even.catalyst-hybrid-columns'
		),
		'-- Catalyst Hybrid Focused CSS --' => array(
			'Hybrid Loop Title' => '#content .catalyst-hybrid .entry-title',
			'Hybrid Loop Title Link' => '#content .catalyst-hybrid .entry-title a, #content .catalyst-hybrid .entry-title a:visited',
			'Hybrid Loop Title Link Hover' => '#content .catalyst-hybrid .entry-title a:hover',
			'Hybrid Loop Paragraph' => '#content .catalyst-hybrid .entry-content p',
			'Hybrid Loop Byline Meta' => '#content .catalyst-hybrid .byline-meta',
			'Hybrid Loop Post Meta' => '#content .catalyst-hybrid .post-meta'
		)
	);
	
	return $catalyst_content_elements_array;
}

/**
 * Build the CSS Builder content elements menu.
 *
 * @since 1.0
 */
function catalyst_build_content_elements_menu( $selected = '' )
{
	$catalyst_content_elements_array = catalyst_content_elements_array();
	
	foreach( $catalyst_content_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build author CSS elements drop-down list.
 *
 * @since 1.0
 * @return author CSS elements array.
 */
function catalyst_author_elements_array()
{
	$catalyst_author_elements_array = array(
		'-- Author Info Box --' => array(
			'Author Box' => '#entry-author-info',
			'Author Box Title' => '#entry-author-info p',
			'Author Box Link' => '#entry-author-info a, #entry-author-info a:visited',
			'Author Box Link Hover' => '#entry-author-info a:hover',
			'Author Box Avatar' => '#entry-author-info #author-avatar'
		)
	);
	
	return $catalyst_author_elements_array;
}

/**
 * Build the CSS Builder author elements menu.
 *
 * @since 1.0
 */
function catalyst_build_author_elements_menu( $selected = '' )
{
	$catalyst_author_elements_array = catalyst_author_elements_array();
	
	foreach( $catalyst_author_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build comments CSS elements drop-down list.
 *
 * @since 1.0
 * @return comments CSS elements array.
 */
function catalyst_comments_elements_array()
{
	$catalyst_comments_elements_array = array(
		'-- Comments --' => array(
			'Comment Wrap' => '#comment-wrap',
			'Comments' => '#comments',
			'Comment List' => '.commentlist',
			'Comment' => '#comment',
			'Comment Meta' => '.commentmetadata',
			'Comment Thread Even' => '.thread-even',
			'Comments Nav' => '.comments-nav',
			'Author/Email/URL' => '#author, #email, #url',
			'Comment Form' => '#commentform',
			'Comment Submit Button' => '#commentform #submit',
			'No Comments Text' => '.nocomments'
		)
	);
	
	return $catalyst_comments_elements_array;
}

/**
 * Build the CSS Builder comments elements menu.
 *
 * @since 1.0
 */
function catalyst_build_comments_elements_menu( $selected = '' )
{
	$catalyst_comments_elements_array = catalyst_comments_elements_array();
	
	foreach( $catalyst_comments_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build sidebar 1 CSS elements drop-down list.
 *
 * @since 1.0
 * @return sidebar 1 CSS elements array.
 */
function catalyst_sidebar1_elements_array()
{
	$catalyst_sidebar1_elements_array = array(
		'-- Sidebars --' => array(
			'Sidebar 1 Wrap' => '#sidebar-1-wrap',
			'Sidebar 1' => '#sidebar-1',
			'Sidebar 1 H4' => '#sidebar-1 h4',
			'Sidebar 1 Widget' => '#sidebar-1 .widget',
			'Sidebar 1 Link' => '#sidebar-1 a, #sidebar-1 a:visited',
			'Sidebar 1 UL/OL' => '#sidebar-1 ul, #sidebar-1 ol',
			'Sidebar 1 UL LI' => '#sidebar-1 ul li'
		)
	);
	
	return $catalyst_sidebar1_elements_array;
}

/**
 * Build the CSS Builder sidebar 1 elements menu.
 *
 * @since 1.0
 */
function catalyst_build_sidebar1_elements_menu( $selected = '' )
{
	$catalyst_sidebar1_elements_array = catalyst_sidebar1_elements_array();
	
	foreach( $catalyst_sidebar1_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build sidebar 2 CSS elements drop-down list.
 *
 * @since 1.0
 * @return sidebar 2 CSS elements array.
 */
function catalyst_sidebar2_elements_array()
{
	$catalyst_sidebar2_elements_array = array(
		'-- Sidebars --' => array(
			'Sidebar 2 Wrap' => '#sidebar-2-wrap',
			'Sidebar 2' => '#sidebar-2',
			'Sidebar 2 H4' => '#sidebar-2 h4',
			'Sidebar 2 Widget' => '#sidebar-2 .widget',
			'Sidebar 2 Link' => '#sidebar-2 a, #sidebar-2 a:visited',
			'Sidebar 2 Link Hover' => '#sidebar-2 a:hover',
			'Sidebar 2 UL/OL' => '#sidebar-2 ul, #sidebar-2 ol',
			'Sidebar 2 UL LI' => '#sidebar-2 ul li'
		)
	);
	
	return $catalyst_sidebar2_elements_array;
}

/**
 * Build the CSS Builder sidebar 2 elements menu.
 *
 * @since 1.0
 */
function catalyst_build_sidebar2_elements_menu( $selected = '' )
{
	$catalyst_sidebar2_elements_array = catalyst_sidebar2_elements_array();
	
	foreach( $catalyst_sidebar2_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build footer CSS elements drop-down list.
 *
 * @since 1.0
 * @return footer CSS elements array.
 */
function catalyst_footer_elements_array()
{
	$catalyst_footer_elements_array = array(
		'-- Footer --' => array(
			'Footer Wrap' => '#footer-wrap',
			'Footer' => '#footer',
			'Footer Text' => '#footer p.footer-content',
			'Footer Link' => '#footer .footer-content a, #footer .footer-content a:visited',
			'Footer Link Hover' => '#footer .footer-content a:hover',
			'Footer Left' => '.footer-left',
			'Footer Right' => '.footer-right',
			'Footer Center' => '.footer-center',
			'Catalyst Attribute' => '.catalyst-attribute'
		)
	);
	
	return $catalyst_footer_elements_array;
}

/**
 * Build the CSS Builder footer elements menu.
 *
 * @since 1.0
 */
function catalyst_build_footer_elements_menu( $selected = '' )
{
	$catalyst_footer_elements_array = catalyst_footer_elements_array();
	
	foreach( $catalyst_footer_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build ez feature top CSS elements drop-down list.
 *
 * @since 1.0
 * @return ez feature top CSS elements array.
 */
function catalyst_ezfeaturetop_elements_array()
{
	$catalyst_ezfeaturetop_elements_array = array(
		'-- EZ Feature Top --' => array(
			'EZ Feature Top Container Wrap' => '#ez-feature-top-container-wrap',
			'EZ Feature Top Container' => '#ez-feature-top-container',
			'EZ Feature Top Widget Area H4' => '#ez-feature-top-container .ez-widget-area h4',
			'EZ Feature Top Widget Area Link' => '#ez-feature-top-container .ez-widget-area a, #ez-feature-top-container .ez-widget-area a:visited',
			'EZ Feature Top Widget Area Link Hover' => '#ez-feature-top-container .ez-widget-area a:hover',
			'EZ Feature Top 1' => '#ez-feature-top-1',
			'EZ Feature Top 2' => '#ez-feature-top-2',
			'EZ Feature Top 3' => '#ez-feature-top-3',
			'EZ Feature Top 4' => '#ez-feature-top-4',
			'EZ Feature Top Widget Area' => '#ez-feature-top-container .ez-widget-area',
			'EZ Feature Top Widget Area Paragraph' => '#ez-feature-top-container .ez-widget-area p',
			'ez_feature_top_1 Widget Area' => 'body.ez-feature-top-1 #ez-feature-top-container .ez-widget-area',
			'ez_feature_top_2 Widget Areas' => 'body.ez-feature-top-2 #ez-feature-top-container .ez-widget-area',
			'ez_feature_top_3 Widget Areas' => '#ez-feature-top-container .ez-widget-area',
			'ez_feature_top_4 Widget Areas' => 'body.ez-feature-top-4 #ez-feature-top-container .ez-widget-area',
			'Wide Left/Wide Right Widget Area' => 'body.ez-feature-top-wide-left-2 #ez-feature-top-1.ez-widget-area, body.ez-feature-top-wide-right-2 #ez-feature-top-2.ez-widget-area',
			'First/Only Widget Area' => '#ez-feature-top-container .ez-first, #ez-feature-top-container .ez-only'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '.ez-widget-area',
			'EZ Widget Area H4' => '.ez-widget-area h4',
			'EZ Widget Area UL' => '.ez-widget-area ul',
			'EZ Widget Area OL' => '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '.ez-widget-area ol li'
		)
	);
	
	return $catalyst_ezfeaturetop_elements_array;
}

/**
 * Build the CSS Builder ez feature top elements menu.
 *
 * @since 1.0
 */
function catalyst_build_ezfeaturetop_elements_menu( $selected = '' )
{
	$catalyst_ezfeaturetop_elements_array = catalyst_ezfeaturetop_elements_array();
	
	foreach( $catalyst_ezfeaturetop_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build ez fat footer CSS elements drop-down list.
 *
 * @since 1.0
 * @return ez fat footer CSS elements array.
 */
function catalyst_ezfatfooter_elements_array()
{
	$catalyst_ezfatfooter_elements_array = array(
		'-- EZ Fat Footer --' => array(
			'EZ Fat Footer Container Wrap' => '#ez-fat-footer-container-wrap',
			'EZ Fat Footer Container' => '#ez-fat-footer-container',
			'EZ Fat Footer Widget Area H4' => '#ez-fat-footer-container .ez-widget-area h4',
			'EZ Fat Footer Widget Area Link' => '#ez-fat-footer-container .ez-widget-area a, #ez-fat-footer-container .ez-widget-area a:visited',
			'EZ Fat Footer Widget Area Link Hover' => '#ez-fat-footer-container .ez-widget-area a:hover',
			'EZ Fat Footer 1' => '#ez-fat-footer-1',
			'EZ Fat Footer 2' => '#ez-fat-footer-2',
			'EZ Fat Footer 3' => '#ez-fat-footer-3',
			'EZ Fat Footer 4' => '#ez-fat-footer-4',
			'EZ Fat Footer Widget Area' => '#ez-fat-footer-container .ez-widget-area',
			'EZ Fat Footer Widget Area Paragraph' => '#ez-fat-footer-container .ez-widget-area p',
			'ez_fat_footer_1 Widget Area' => 'body.ez-fat-footer-1 #ez-fat-footer-container .ez-widget-area',
			'ez_fat_footer_2 Widget Areas' => 'body.ez-fat-footer-2 #ez-fat-footer-container .ez-widget-area',
			'ez_fat_footer_3 Widget Areas' => '#ez-fat-footer-container .ez-widget-area',
			'ez_fat_footer_4 Widget Areas' => 'body.ez-fat-footer-4 #ez-fat-footer-container .ez-widget-area',
			'Wide Left/Wide Right Widget Area' => 'body.ez-fat-footer-wide-left-2 #ez-fat-footer-1.ez-widget-area, body.ez-fat-footer-wide-right-2 #ez-fat-footer-2.ez-widget-area',
			'First/Only Widget Area' => '#ez-fat-footer-container .ez-first, #ez-fat-footer-container .ez-only'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '.ez-widget-area',
			'EZ Widget Area H4' => '.ez-widget-area h4',
			'EZ Widget Area UL' => '.ez-widget-area ul',
			'EZ Widget Area OL' => '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '.ez-widget-area ol li'
		)
	);
	
	return $catalyst_ezfatfooter_elements_array;
}

/**
 * Build the CSS Builder ez fat footer elements menu.
 *
 * @since 1.0
 */
function catalyst_build_ezfatfooter_elements_menu( $selected = '' )
{
	$catalyst_ezfatfooter_elements_array = catalyst_ezfatfooter_elements_array();
	
	foreach( $catalyst_ezfatfooter_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build ez home CSS elements drop-down list.
 *
 * @since 1.0
 * @return ez home CSS elements array.
 */
function catalyst_ezhome_elements_array()
{
	$catalyst_ezhome_elements_array = array(
		'-- EZ Home --' => array(
			'EZ Home Hook Wrap' => '#home-hook-wrap',
			'EZ Home Container Wrap' => '#ez-home-container-wrap',
			'EZ Home Widget Area H4' => '#ez-home-container-wrap .ez-widget-area h4',
			'EZ Home Widget Area' => '#ez-home-container-wrap .ez-widget-area',
			'EZ Home Widget Area Paragraph' => '#ez-home-container-wrap .ez-widget-area p',
			'EZ Home Widget Area Link' => '#ez-home-container-wrap .ez-widget-area a, #ez-home-container-wrap .ez-widget-area a:visited',
			'EZ Home Widget Area Link Hover' => '#ez-home-container-wrap .ez-widget-area a:hover',
			'EZ Home Container Area Class' => '.ez-home-container-area',
			'EZ Home Top Container' => '#ez-home-top-container',
			'EZ Home Top 1' => '#ez-home-top-1',
			'EZ Home Top 2' => '#ez-home-top-2',
			'EZ Home Top 3' => '#ez-home-top-3',
			'EZ Home Middle Container' => '#ez-home-middle-container',
			'EZ Home Middle 1' => '#ez-home-middle-1',
			'EZ Home Middle 2' => '#ez-home-middle-2',
			'EZ Home Middle 3' => '#ez-home-middle-3',
			'EZ Home Bottom Container' => '#ez-home-bottom-container',
			'EZ Home Bottom 1' => '#ez-home-bottom-1',
			'EZ Home Bottom 2' => '#ez-home-bottom-2',
			'EZ Home Bottom 3' => '#ez-home-bottom-3'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '.ez-widget-area',
			'EZ Widget Area H4' => '.ez-widget-area h4',
			'EZ Widget Area UL' => '.ez-widget-area ul',
			'EZ Widget Area OL' => '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '.ez-widget-area ol li'
		)
	);
	
	return $catalyst_ezhome_elements_array;
}

/**
 * Build the CSS Builder ez home elements menu.
 *
 * @since 1.0
 */
function catalyst_build_ezhome_elements_menu( $selected = '' )
{
	$catalyst_ezhome_elements_array = catalyst_ezhome_elements_array();
	
	foreach( $catalyst_ezhome_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build ez home sidebar CSS elements drop-down list.
 *
 * @since 1.0
 * @return ez home sidebar CSS elements array.
 */
function catalyst_ezhomesidebar_elements_array()
{
	$catalyst_ezhomesidebar_elements_array = array(
		'-- EZ Home Sidebars --' => array(
			'EZ Home Sidebar 1 Wrap' => '#ez-home-sidebar-1-wrap',
			'EZ Home Sidebar 1' => '#ez-home-sidebar-1',
			'EZ Home Sidebar 1 Widget Area H4' => '#ez-home-sidebar-1 h4',
			'EZ Home Sidebar 1 Widget Area' => '#ez-home-sidebar-1 .ez-widget-area',
			'EZ Home Sidebar 1 Widget Area Link' => '#ez-home-sidebar-1 a, #ez-home-sidebar-1 a:visited',
			'EZ Home Sidebar 1 Widget Area Link Hover' => '#ez-home-sidebar-1 a:hover',
			'EZ Home Sidebar 1 UL/OL' => '#ez-home-sidebar-1 ul, #ez-home-sidebar-1 ol',
			'EZ Home Sidebar 1 UL LI' => '#ez-home-sidebar-1 ul li'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '.ez-widget-area',
			'EZ Widget Area H4' => '.ez-widget-area h4',
			'EZ Widget Area UL' => '.ez-widget-area ul',
			'EZ Widget Area OL' => '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '.ez-widget-area ol li'
		)
	);
	
	return $catalyst_ezhomesidebar_elements_array;
}

/**
 * Build the CSS Builder ez home sidebar elements menu.
 *
 * @since 1.0
 */
function catalyst_build_ezhomesidebar_elements_menu( $selected = '' )
{
	$catalyst_ezhomesidebar_elements_array = catalyst_ezhomesidebar_elements_array();
	
	foreach( $catalyst_ezhomesidebar_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build home slider CSS elements drop-down list.
 *
 * @since 1.0
 * @return home slider CSS elements array.
 */
function catalyst_homeslider_elements_array()
{
	$catalyst_homeslider_elements_array = array(
		'-- EZ Home Slider --' => array(
			'EZ Home Slider Wrap' => '#ez-home-slider-container-wrap',
			'EZ Home Slider' => '#ez-home-slider'
		),
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '.ez-widget-area',
			'EZ Widget Area H4' => '.ez-widget-area h4',
			'EZ Widget Area UL' => '.ez-widget-area ul',
			'EZ Widget Area OL' => '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '.ez-widget-area ol li'
		)
	);
	
	return $catalyst_homeslider_elements_array;
}

/**
 * Build the CSS Builder home slider elements menu.
 *
 * @since 1.0
 */
function catalyst_build_homeslider_elements_menu( $selected = '' )
{
	$catalyst_homeslider_elements_array = catalyst_homeslider_elements_array();
	
	foreach( $catalyst_homeslider_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build custom widget CSS elements drop-down list.
 *
 * @since 1.0
 * @return custom widget CSS elements array.
 */
function catalyst_customwidget_elements_array()
{
	$catalyst_customwidget_elements_array = array(
		'-- Custom Widgets Areas --' => array(
			'Custom Widget Area' => '.catalyst-widget-area',
			'Custom Widget Area H4' => '.catalyst-widget-area h4',
			'Custom Widget Area Link' => '.catalyst-widget-area a, .catalyst-widget-area a:visited',
			'Custom Widget Area Link Hover' => '.catalyst-widget-area a:hover'
		)
	);
	
	return $catalyst_customwidget_elements_array;
}

/**
 * Build the CSS Builder custom widget elements menu.
 *
 * @since 1.0
 */
function catalyst_build_customwidget_elements_menu( $selected = '' )
{
	$catalyst_customwidget_elements_array = catalyst_customwidget_elements_array();
	
	foreach( $catalyst_customwidget_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build excerpt widget CSS elements drop-down list.
 *
 * @since 1.0
 * @return excerpt widget CSS elements array.
 */
function catalyst_excerptwidget_elements_array()
{
	$catalyst_excerptwidget_elements_array = array(
		'-- Catalyst Excerpt Widgets --' => array(
			'Excerpt Widget' => '.catalyst-excerpt-widget, #content .catalyst-excerpt-widget',
			'Excerpt Widget H2' => '.catalyst-excerpt-widget h2',
			'Excerpt Widget H2 Link' => '.catalyst-excerpt-widget h2 a, .catalyst-excerpt-widget h2 a:visited',
			'Excerpt Widget H2 Link Hover' => '.catalyst-excerpt-widget h2 a:hover',
			'Excerpt Widget Byline Meta' => '.catalyst-excerpt-widget .byline-meta',
			'Excerpt Widget Byline Meta Link' => '.catalyst-excerpt-widget .byline-meta a, .catalyst-excerpt-widget .byline-meta a:visited',
			'Excerpt Widget Byline Meta Link Hover' => '.catalyst-excerpt-widget .byline-meta a:hover',
			'Excerpt Widget Paragraph' => '.catalyst-excerpt-widget .entry-content p',
			'Excerpt Widget Link' => '.catalyst-excerpt-widget .entry-content a, .catalyst-excerpt-widget .entry-content a:visited',
			'Excerpt Widget Link Hover' => '.catalyst-excerpt-widget .entry-content a:hover'
		)
	);
	
	return $catalyst_excerptwidget_elements_array;
}

/**
 * Build the CSS Builder excerpt widget elements menu.
 *
 * @since 1.0
 */
function catalyst_build_excerptwidget_elements_menu( $selected = '' )
{
	$catalyst_excerptwidget_elements_array = catalyst_excerptwidget_elements_array();
	
	foreach( $catalyst_excerptwidget_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**********
  Non-Popup Elements
           **********/

/**
 * Build navbar CSS elements drop-down list.
 *
 * @since 1.0
 * @return navbar CSS elements array.
 */
function catalyst_nav_elements_array()
{
	$catalyst_nav_elements_array = array(
		'-- Navbar 1 --' => array(
			'Navbar 1 Wrap' => '#navbar-1-wrap',
			'Navbar 1' => '#navbar-1',
			'Navbar 1 Left' => '#navbar-1-left',
			'Navbar 1 Right' => '#navbar-1-right',
			'Nav 1' => '#nav-1',
			'Navbar 1 Right Text' => '#navbar-1-right.navbar-right-text',
			'Navbar 1 Right Search' => '#navbar-1-right.navbar-right-search',
			'Navbar 1 Right Link' => '#navbar-1-right a, #navbar-1-right a:visited',
			'Navbar 1 Right Link Hover' => '#navbar-1-right a:hover',
			'Navbar 1 Page Link' => '#nav-1 li a, #nav-1 li a:link, #nav-1 li a:visited',
			'Navbar 1 Page Link Hover' => '#nav-1 li a:hover, #nav-1 li a:active',
			'Navbar 1 Current Page Link' => '#nav-1 li.current_page_item a, #nav-1 li.current-menu-item a, #nav-1 li.current-cat a',
			'Navbar 1 Page jQuery Sub-Indicator' => '#nav-1 li a .sf-sub-indicator',
			'Navbar 1 Sub-Page Link' => '#nav-1 li li a, #nav-1 li li a:link, #nav-1 li li a:visited',
			'Navbar 1 Sub-Page Link Hover' => '#nav-1 li li a:hover, #nav-1 li li a:active',
			'Navbar 1 Sub-Page jQuery Sub-Indicator' => '#nav-1 li li a .sf-sub-indicator',
			'Navbar 1 UL' => '#nav-1 ul',
			'Navbar 1 LI' => '#nav-1 li',
			'Navbar 1 LI UL' => '#nav-1 li ul',
			'Navbar 1 LI UL UL' => '#nav-1 li ul ul'
		),
		'-- Navbar 2 --' => array(
			'Navbar 2 Wrap' => '#navbar-2-wrap',
			'Navbar 2' => '#navbar-2',
			'Navbar 2 Left' => '#navbar-2-left',
			'Navbar 2 Right' => '#navbar-2-right',
			'Nav 2' => '#nav-2',
			'Navbar 2 Right Text' => '#navbar-2-right.navbar-right-text',
			'Navbar 2 Right Search' => '#navbar-2-right.navbar-right-search',
			'Navbar 2 Right Link' => '#navbar-2-right a, #navbar-2-right a:visited',
			'Navbar 2 Right Link Hover' => '#navbar-2-right a:hover',
			'Navbar 2 Page Link' => '#nav-2 li a, #nav-2 li a:link, #nav-2 li a:visited',
			'Navbar 2 Page Link Hover' => '#nav-2 li a:hover, #nav-2 li a:active',
			'Navbar 2 Current Page Link' => '#nav-2 li.current_page_item a, #nav-2 li.current-menu-item a, #nav-2 li.current-cat a',
			'Navbar 2 Page jQuery Sub-Indicator' => '#nav-2 li a .sf-sub-indicator',
			'Navbar 2 Sub-Page Link' => '#nav-2 li li a, #nav-2 li li a:link, #nav-2 li li a:visited',
			'Navbar 2 Sub-Page Link Hover' => '#nav-2 li li a:hover, #nav-2 li li a:active',
			'Navbar 2 Sub-Page jQuery Sub-Indicator' => '#nav-2 li li a .sf-sub-indicator',
			'Navbar 2 UL' => '#nav-2 ul',
			'Navbar 2 LI' => '#nav-2 li',
			'Navbar 2 LI UL' => '#nav-2 li ul',
			'Navbar 2 LI UL UL' => '#nav-2 li ul ul'
		)
	);
	
	return $catalyst_nav_elements_array;
}

/**
 * Build the CSS Builder navbar elements menu.
 *
 * @since 1.0
 */
function catalyst_build_nav_elements_menu( $selected = '' )
{
	$catalyst_nav_elements_array = catalyst_nav_elements_array();
	
	foreach( $catalyst_nav_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build ez CSS elements drop-down list.
 *
 * @since 1.0
 * @return ez CSS elements array.
 */
function catalyst_ez_elements_array()
{
	$catalyst_ez_elements_array = array(
		'-- EZ Widget Area Class --' => array(
			'EZ Widget Area' => '.ez-widget-area',
			'EZ Widget Area H4' => '.ez-widget-area h4',
			'EZ Widget Area UL' => '.ez-widget-area ul',
			'EZ Widget Area OL' => '.ez-widget-area ol',
			'EZ Widget Area UL LI' => '.ez-widget-area ul li',
			'EZ Widget Area OL LI' => '.ez-widget-area ol li'
		),
		'-- EZ Home --' => array(
			'EZ Home Container Wrap' => '#ez-home-container-wrap',
			'EZ Home Widget Area H4' => '#ez-home-container-wrap .ez-widget-area h4',
			'EZ Home Widget Area' => '#ez-home-container-wrap .ez-widget-area',
			'EZ Home Widget Area Link' => '#ez-home-container-wrap .ez-widget-area a, #ez-home-container-wrap .ez-widget-area a:visited',
			'EZ Home Widget Area Link Hover' => '#ez-home-container-wrap .ez-widget-area a:hover',
			'EZ Home Container Area Class' => '.ez-home-container-area',
			'EZ Home Top Container' => '#ez-home-top-container',
			'EZ Home Top 1' => '#ez-home-top-1',
			'EZ Home Top 2' => '#ez-home-top-2',
			'EZ Home Top 3' => '#ez-home-top-3',
			'EZ Home Middle Container' => '#ez-home-middle-container',
			'EZ Home Middle 1' => '#ez-home-middle-1',
			'EZ Home Middle 2' => '#ez-home-middle-2',
			'EZ Home Middle 3' => '#ez-home-middle-3',
			'EZ Home Bottom Container' => '#ez-home-bottom-container',
			'EZ Home Bottom 1' => '#ez-home-bottom-1',
			'EZ Home Bottom 2' => '#ez-home-bottom-2',
			'EZ Home Bottom 3' => '#ez-home-bottom-3'
		),
		'-- EZ Feature Top --' => array(
			'EZ Feature Top Container Wrap' => '#ez-feature-top-container-wrap',
			'EZ Feature Top Container' => '#ez-feature-top-container',
			'EZ Feature Top Widget Area H4' => '#ez-feature-top-container .ez-widget-area h4',
			'EZ Feature Top Widget Area' => '#ez-feature-top-container .ez-widget-area',
			'EZ Feature Top Widget Area Link' => '#ez-feature-top-container .ez-widget-area a, #ez-feature-top-container .ez-widget-area a:visited',
			'EZ Feature Top Widget Area Link Hover' => '#ez-feature-top-container .ez-widget-area a:hover',
			'EZ Feature Top 1' => '#ez-feature-top-1',
			'EZ Feature Top 2' => '#ez-feature-top-2',
			'EZ Feature Top 3' => '#ez-feature-top-3',
			'EZ Feature Top 4' => '#ez-feature-top-4'
		),
		'-- EZ Fat Footer --' => array(
			'EZ Fat Footer Container Wrap' => '#ez-fat-footer-container-wrap',
			'EZ Fat Footer Container' => '#ez-fat-footer-container',
			'EZ Fat Footer Widget Area H4' => '#ez-fat-footer-container .ez-widget-area h4',
			'EZ Fat Footer Widget Area' => '#ez-fat-footer-container .ez-widget-area',
			'EZ Fat Footer Widget Area Link' => '#ez-fat-footer-container .ez-widget-area a, #ez-fat-footer-container .ez-widget-area a:visited',
			'EZ Fat Footer Widget Area Link Hover' => '#ez-fat-footer-container .ez-widget-area a:hover',
			'EZ Fat Footer 1' => '#ez-fat-footer-1',
			'EZ Fat Footer 2' => '#ez-fat-footer-2',
			'EZ Fat Footer 3' => '#ez-fat-footer-3',
			'EZ Fat Footer 4' => '#ez-fat-footer-4'
		),
		'-- EZ Home Sidebars --' => array(
			'EZ Home Sidebar 1 Wrap' => '#ez-home-sidebar-1-wrap',
			'EZ Home Sidebar 1' => '#ez-home-sidebar-1',
			'EZ Home Sidebar 1 Widget Area H4' => '#ez-home-sidebar-1 h4',
			'EZ Home Sidebar 1 Widget Area' => '#ez-home-sidebar-1 .ez-widget-area',
			'EZ Home Sidebar 1 Widget Area Link' => '#ez-home-sidebar-1 a, #ez-home-sidebar-1 a:visited',
			'EZ Home Sidebar 1 Widget Area Link Hover' => '#ez-home-sidebar-1 a:hover',
		),
		'-- EZ Home Slider --' => array(
			'EZ Home Slider Wrap' => '#ez-home-slider-container-wrap',
			'EZ Home Slider' => '#ez-home-slider'
		)
	);
	
	return $catalyst_ez_elements_array;
}

/**
 * Build the CSS Builder ez elements menu.
 *
 * @since 1.0
 */
function catalyst_build_ez_elements_menu( $selected = '' )
{
	$catalyst_ez_elements_array = catalyst_ez_elements_array();
	
	foreach( $catalyst_ez_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**
 * Build general content CSS elements drop-down list.
 *
 * @since 1.0
 * @return general content CSS elements array.
 */
function catalyst_generalcontent_elements_array()
{
	$catalyst_generalcontent_elements_array = array(
		'-- Main Content --' => array(
			'Content Wrap' => '#content-wrap',
			'Content' => '#content',
			'Content Post' => '#content .post',
			'Content Post Paragraph' => '#content .post p',
			'Content Page' => '#content .page',
			'Content Page Paragraph' => '#content .page p',
			'Content Post/Page General Text' => '.entry-content p, .entry-content ul li, .entry-content ol li',
			'Content Post/Page Link' => '.entry-content a, .entry-content a:visited',
			'Content Post/Page Link Hover' => '.entry-content a:hover',
			'Post/Page Title' => '#content .entry-title',
			'Post Title Link' => '#content h2 a, #content h2 a:visited',
			'Post Title Link Hover' => '#content h2 a:hover',
			'Content H1' => '#content h1',
			'Content H2' => '#content h2',
			'Content H3' => '#content h3',
			'Content H4' => '#content h4',
			'Content H5' => '#content h5',
			'Content H6' => '#content h6',
			'Content Post/Page UL LI' => '#content .post ul li, #content .page ul li',
			'Content Post/Page OL LI' => '#content .post ol li, #content .page ol li',
			'Content Author Box' => '#entry-author-info',
			'Breadcrumbs' => '.breadcrumbs',
			'Breadcrumbs Link' => '.breadcrumbs a, .breadcrumbs a:visited',
			'Breadcrumbs Link Hover' => '.breadcrumbs a:hover',
			'Byline Meta' => '.byline-meta',
			'Byline Meta Link' => '.byline-meta a, .byline-meta a:visited',
			'Byline Meta Link Hover' => '.byline-meta a:hover',
			'Post Meta' => '.post-meta',
			'Post Meta Text' => '.post-meta p',
			'Post Meta Link' => '.post-meta a, .post-meta a:visited',
			'Post Meta Link Hover' => '.post-meta a:hover',
			'Post Navigation' => '.post-nav',
			'Post Navigation Link' => '.post-nav a, .post-nav a:visited',
			'Post Navigation Numbered' => '.post-nav li a, .post-nav li a:visited, .post-nav li.disabled, .post-nav li a:hover, .post-nav li.active a',
			'Post Navigation Numbered Link' => '.post-nav li.active a',
			'Post Navigation Numbered Link Hover' => '.post-nav li a:hover'
		),
		'-- Catalyst Hybrid Content Classes --' => array(
			'Hybrid Loop Odd' => '.catalyst-hybrid-odd',
			'Hybrid Loop Even' => '.catalyst-hybrid-even',
			'Hybrid Loop Odd & Even' => '.catalyst-hybrid-odd, .catalyst-hybrid-even',
			'Hybrid Columns Class' => '.catalyst-hybrid-odd.catalyst-hybrid-columns',
			'Hybrid Columns Odd' => '.catalyst-hybrid-odd.catalyst-hybrid-columns',
			'Hybrid Columns Even' => '.catalyst-hybrid-even.catalyst-hybrid-columns',
			'Hybrid Columns Odd & Even' => '.catalyst-hybrid-odd.catalyst-hybrid-columns, .catalyst-hybrid-even.catalyst-hybrid-columns'
		),
		'-- Catalyst Hybrid Focused CSS --' => array(
			'Hybrid Loop Title' => '#content .catalyst-hybrid .entry-title',
			'Hybrid Loop Title Link' => '#content .catalyst-hybrid .entry-title a, #content .catalyst-hybrid .entry-title a:visited',
			'Hybrid Loop Title Link Hover' => '#content .catalyst-hybrid .entry-title a:hover',
			'Hybrid Loop Paragraph' => '#content .catalyst-hybrid .entry-content p',
			'Hybrid Loop Byline Meta' => '#content .catalyst-hybrid .byline-meta',
			'Hybrid Loop Post Meta' => '#content .catalyst-hybrid .post-meta'
		)
	);
	
	return $catalyst_generalcontent_elements_array;
}

/**
 * Build the CSS Builder general content elements menu.
 *
 * @since 1.0
 */
function catalyst_build_generalcontent_elements_menu( $selected = '' )
{
	$catalyst_generalcontent_elements_array = catalyst_generalcontent_elements_array();
	
	foreach( $catalyst_generalcontent_elements_array as $element_type => $elements )
	{
		echo '<optgroup label="' . $element_type . '">';
		foreach( $elements as $element_slug => $element_data )
		{
			$option = '<option value="' . $element_data . ' {"';
				
			if( $element_data == $selected )
			{
				$option .= ' selected="selected"';
			}

			$option .= '>' . $element_slug . '</option>';
			
			echo $option;
		}
		echo '</optgroup>';
	}
}

/**********
General Option Arrays
           **********/

/**
 * Build main background options list.
 *
 * @since 1.0
 */
function catalyst_list_bg_options( $selected = '' )
{
	$catalyst_bg_options = array(
		'color' => 'Color',
		'transparent' => 'Transparent',
		'top left no-repeat' => 'No-Repeat Image (Left)',
		'top center no-repeat' => 'No-Repeat Image (Center)',
		'top right no-repeat' => 'No-Repeat Image (Right)',
		'top left repeat-x' => 'Horizontal-Repeat Image (Left)',
		'top center repeat-x' => 'Horizontal-Repeat Image (Center)',
		'top right repeat-x' => 'Horizontal-Repeat Image (Right)',
		'top left repeat-y' => 'Vertical-Repeat Image (Left)',
		'top center repeat-y' => 'Vertical-Repeat Image (Center)',
		'top right repeat-y' => 'Vertical-Repeat Image (Right)',
		'top repeat' => 'Horizontal & Vertical-Repeat Image'
	);
	
	foreach( $catalyst_bg_options as $bg_key => $bg_name )
	{
		$option = '<option value="' . $bg_key . '"';
			
		if( $bg_key == $selected )
		{
			$option .= ' selected="selected"';
		}

		$option .= '>' . $bg_name . '</option>';
		
		echo $option;
	}
}

/**
 * Build border options list.
 *
 * @since 1.0
 */
function catalyst_list_borders( $selected = '' )
{
	$catalyst_border_options = array( 'solid', 'dotted', 'dashed', 'double', 'groove', 'ridge', 'inset', 'outset' );

	foreach ( $catalyst_border_options as $border_option )
	{
		$option = '<option value="' . $border_option . '"';
		
		if( $border_option == $selected )
		{
			$option .= ' selected="selected"';
		}
		
		$option .= '>' . $border_option . '</option>';
		
		echo $option;
	}
}
	
//end lib/functions/catalyst-option-lists.php