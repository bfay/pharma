<?php
//Set the file type to css
header( "Content-type: text/css" );

//Include WordPress
include( '../../../../wp-load.php' );

//Set the colors
$custom_colors = array(
	//Font Color
	"color_font" => array(
			//Blog Section
			".blog .hentry .post-content",

			//Search Section
			".search .hentry .post-content",

			//Archive Section
			".archive .hentry .post-content",

			//Page Section
			".page .hentry .post-content",

			//Single Section
			".single .hentry .post-content",
			".single .hentry .post-taxonomies",

			//Error 404 Section
			".error404 .hentry .post-content",

			//Single Section Assets
			".section-about-the-author .author-content p",

			//Comments Section
			"#comments .comments-box",
			"#comments ul.commentlist li.comment .comment-main .comment-content",

			//Comments Form
			"#respond .logged-in-as",

			//Sidebar
			"#sidebar",),

	//Primary Color
	"color_primary" => array(
			//Top Menu
			"#header ul li a:hover",
			"#header ul li.current-menu-item a",
			"#header ul li.current_page_item a",

			//Blog Section
			".blog .hentry h2.post-title a:hover",
			".blog .hentry .post-meta .post-author a:hover",
			".blog .hentry .post-meta .post-comments a",
			".blog .hentry .post-content a",
			".blog .hentry a.more-link",

			//Search Section
			".search .hentry h2.post-title a:hover",
			".search .hentry .post-meta .post-author a:hover",
			".search .hentry .post-meta .post-comments a",
			".search .hentry .post-content a",
			".search .hentry a.more-link",

			//Archive Section
			"h2.archive-title span",
			".archive .hentry h2.post-title a:hover",
			".archive .hentry .post-meta .post-author a:hover",
			".archive .hentry .post-meta .post-comments a",
			".archive .hentry .post-content a",
			".archive .hentry a.more-link",

			//Page Section
			".page .hentry .post-content a",

			//Single Section
			".single .hentry .post-meta .post-author a:hover",
			".single .hentry .post-meta .post-comments a",
			".single .hentry .post-content a",

			//Error 404 Section
			".error404 .hentry .post-content a",

			//Single Section Assets
			".section-about-the-author .author-content .author-name",
			".section-about-the-author .author-content .author-name a",
			".section-about-the-author .author-content p a",
			".section-about-the-author .author-content .author-posts",
			".section-about-the-author .author-content .author-posts a",

			//HTML Form Elements
			".hentry input[type=submit]",

			//Comments Section
			"#comments .comments-top .comment-reply-link",
			"#comments .comments-box a",
			"#comments ul.commentlist li.comment .comment-main .comment-meta .comment-author",
			"#comments ul.commentlist li.comment .comment-main .comment-meta .comment-author a",
			"#comments ul.commentlist li.comment .comment-main .comment-content a",
			"#comments ul.commentlist li.comment .comment-main a.comment-reply-link",

			//Comments Form
			"#respond #reply-title a#cancel-comment-reply-link",
			"#respond .logged-in-as a",
			"#respond input[type='submit']",

			//Pagination
			".pagination a:hover",

			//Sidebar
			"#sidebar a",
			"#sidebar ul",
			"#sidebar ul li a:hover",
			"#sidebar .widget-container.latest-comments-widget ul li",
			"#sidebar .widget-container.latest-posts-widget ul li",
			"#sidebar .widget-container.random-posts-widget ul li",
			"#sidebar .widget-container.most-popular-posts-widget ul li",
			"#sidebar .widget-container.widget_recent_comments ul li",
			"#sidebar .widget-container.widget_recent_comments ul li a.url",

			//Footer
			"#footer a"),

	//Secondary Color
	"color_secondary" => array(
			//Blog Section
			".blog .hentry .post-meta .post-comments a:hover",
			".blog .hentry .post-content a:hover",
			".blog .hentry a.more-link:hover",

			//Search Section
			".search .hentry .post-meta .post-comments a:hover",
			".search .hentry .post-content a:hover",
			".search .hentry a.more-link:hover",

			//Archive Section
			".archive .hentry .post-meta .post-comments a:hover",
			".archive .hentry .post-content a:hover",
			".archive .hentry a.more-link:hover",

			//Page Section
			".page .hentry .post-content a:hover",

			//Single Section
			".single .hentry .post-meta .post-comments a:hover",
			".single .hentry .post-taxonomies .post-categories a:hover",
			".single .hentry .post-taxonomies .post-tags a:hover",
			".single .hentry .post-content a:hover",

			//Error 404 Section
			".error404 .hentry .post-content a:hover",

			//Single Section Assets
			".section-about-the-author .author-content p a:hover",
			".section-about-the-author .author-content .author-posts a:hover",

			//HTML Form Elements
			".hentry input[type=submit]:hover",

			//Comments Section
			"#comments .comments-top .comment-reply-link:hover",
			"#comments ul.commentlist li.comment .comment-main .comment-meta .comment-author a:hover",
			"#comments ul.commentlist li.comment .comment-main .comment-content a:hover",
			"#comments ul.commentlist li.comment .comment-main a.comment-reply-link:hover",

			//Comments Form
			"#respond #reply-title a#cancel-comment-reply-link:hover",
			"#respond .logged-in-as a:hover",
			"#respond input[type='submit']:hover",

			//Sidebar
			"#sidebar .widget-container .textwidget a:hover",
			"#sidebar .widget-container.tags-widget a:hover",

			//Footer
			"#footer a:hover")
);

//Unset the colors that are not changed
foreach( $custom_colors as $id => $css ) :
	if( framework_get_option($id) == framework_get_default($id) )
		unset($custom_colors[$id]);
endforeach;

//Display the css
foreach( $custom_colors as $id => $css ) :
	if( is_array($css) ) :
		foreach( $css as $num => $path ) :
			if( $path != end($css) )
				echo $path . ",\n";
			else
				echo $path . " {\n";
		endforeach;

		echo "	color: " . framework_get_option($id) . ";\n";

		echo "}\n";
	else :
		echo $css . " {\n";
		echo "	color: " . framework_get_option($id) . ";\n";
		echo "}\n";
	endif;
		
	if( $id != end($custom_colors)) echo "\n";
endforeach;
?>