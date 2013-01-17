<?php
/*-------------------------------------------------------------
*   Framework Options
*------------------------------------------------------------*/
$panel_options = array(

// Welcome
array( "name" => "Welcome",
	"id" => "welcome",
	"type" => "welcome",
	"options" => array(
		array( "name" => "Settings & Setup",
			"text" => '<p>Our advanced theme panel is loaded with easy to use settings that make the setup of your theme simple and fun. Use the Left navigation bar to browse and configure your theme\'s settings.</p>',
			"id" => "settings-setup" ),

		array( "name" => "Drag & Drop",
			"text" => '<p>Alongside the custom widgets section, the theme panel allows you to arrange the order of elements on your pages using a simple drag and drop platform (see <strong>Templates Section</strong>).</p>',
			"id" => "drag-drop" ),

		array( "name" => "Typography",
			"text" => '<p>Using the Typography panel, you will be able to change the default font used on your pages. You can choose between web safe fonts and fonts from the Google Web Fonts library.</p>',
			"id" => "typography" ),

		array( "name" => "Color changer",
			"text" => '<p>Customize nearly every color setting of your theme. Use our color palettes to choose the colors that represent your blog.</p>',
			"id" => "colorscheme" ),

		array( "name" => "Automatic Thumbnails",
			"text" => '<p>The theme will automatically create all required thumbnail images. If you have posts prior to installing the theme, ' . THEMENAME . ' will cache the images and create all necessary thumbnails.</p>',
			"id" => "autothumb" ),

		array( "name" => "JavaScript",
			"text" => '<p>The theme comes infused with lots of fancy javascripts that make your site load faster and the user experience more pleasant. LazyLoad optimizes your images to improve page load. ImageFit and our very own YouTubeFit java script will resize all images and YouTube videos larger than the content area.</p>',
			"id" => "javascript" ),

		array( "name" => "Help and Support",
			"text" => '<p>Before getting started we really encourage you consult ' . THEMENAME . '\'s documentation, where you will find answers to common issues and setup questions. If you are facing any issues that aren\'t answered in the documentation, feel free to open a ticket in your <a href="http://www.flarethemes.com/customers/">customer area</a>.</p>',
			"id" => "support" ),
	),
),

// Global Options
array( "name" => "Global Options",
	"id" => "global-options",
	"type" => "options",
	"options" => array(
		array( "name" => "Header Logo",
			"desc" => "To upload your logo browse your computer and select your logo.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Logo",
				"id" => "logo",
				"type" => "upload",
				"default" => get_bloginfo('stylesheet_directory') . "/images/logo.png" ),

		array( "type" => "close-inputs" ),

			array( "info" => "<p>The uploaded logo will replace the default one.</p>",
				"type" => "info"),

		array( "type" => "close" ),


		array( "name" => "Favicon",
			"desc" => "To upload your favicon browse your computer and select your favicon.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Favicon",
				"id" => "favicon",
				"type" => "upload",
				"default" => get_bloginfo('stylesheet_directory') . "/images/favicon.ico" ),

		array( "type" => "close-inputs" ),

			array( "info" => '<p>For a favicon to work properly it must be converted to <strong>.ico</strong> format, and HEIGHT x WIDTH must be <strong>equal</strong>.<p><a href="http://www.convertico.com/" target="_blank">Convert PNG to ICO</a>',
				"type" => "info"),

		array( "type" => "close" ),



		array( "name" => "Post display options",
			"desc" => "Choose the preferred layout scheme for your home, category and search templates.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Post Thumbnail",
				"id" => "index_post_thumbnail_type",
				"type" => "select",
				"select" => array( "none" => "None", "big" => "Big", "small" => "Small" ),
				"default" => "big" ),

			array( "name" => "Display full post content",
				"id" => "index_post_display_full_content",
				"type" => "checkbox",
				"default" => false ),

		array( "type" => "close-inputs" ),

			array( "info" => '<p><strong>None</strong> - The post will not display the featured image.<br /><strong>Small</strong> - A small thumbnail will be displayed on the left of each post.<br /><strong>Big</strong> - A large (jumbo sized) thumbnail will be displayed below the title of each post.</p>',
				"type" => "info"),

		array( "type" => "close" ),
	),
),

// Typography
array( "name" => "Typography",
	"id" => "typography",
	"type" => "options",
	"options" => array(
		array( "name" => "Homepage Content Font",
			"desc" => "Select the default font for the posts displayed on the blog homepage.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Blog Homepage Font",
				"id" => "font_homepage",
				"type" => "font",
				"default" => array("font-family" => "'Droid Serif', arial, serif", "letter-spacing" => "0.00em", "text-transform" => "none", "font-size" => "14px", "font-weight" => "normal", "font-style" => "normal", "text-decoration" => "none"), ),

		array( "type" => "close-inputs" ),

		array( "type" => "close" ),


		array( "name" => "Search Page Content Font",
			"desc" => "Select the default font for the posts displayed in search queries.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Search Font",
				"id" => "font_search",
				"type" => "font",
				"default" => array("font-family" => "'Droid Serif', arial, serif", "letter-spacing" => "0.00em", "text-transform" => "none", "font-size" => "14px", "font-weight" => "normal", "font-style" => "normal", "text-decoration" => "none"), ),

		array( "type" => "close-inputs" ),

		array( "type" => "close" ),


		array( "name" => "Archives Content Font",
			"desc" => "Select the default font for the posts displayed on archive pages.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Archive Font",
				"id" => "font_archive",
				"type" => "font",
				"default" => array("font-family" => "'Droid Serif', arial, serif", "letter-spacing" => "0.00em", "text-transform" => "none", "font-size" => "14px", "font-weight" => "normal", "font-style" => "normal", "text-decoration" => "none"), ),

		array( "type" => "close-inputs" ),

		array( "type" => "close" ),


		array( "name" => "Post And Page Font",
			"desc" => "Select the default font for your inner pages.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Post Font",
				"id" => "font_single",
				"type" => "font",
				"default" => array("font-family" => "'Droid Serif', arial, serif", "letter-spacing" => "0.00em", "text-transform" => "none", "font-size" => "14px", "font-weight" => "normal", "font-style" => "normal", "text-decoration" => "none"), ),

			array( "name" => "Page Font",
				"id" => "font_page",
				"type" => "font",
				"default" => array("font-family" => "'Droid Serif', arial, serif", "letter-spacing" => "0.00em", "text-transform" => "none", "font-size" => "14px", "font-weight" => "normal", "font-style" => "normal", "text-decoration" => "none"), ),
			
			array( "name" => "Comments Font",
				"id" => "font_comments",
				"type" => "font",
				"default" => array("font-family" => "'Droid Serif', arial, serif", "letter-spacing" => "0.00em", "text-transform" => "none", "font-size" => "12px", "font-weight" => "normal", "font-style" => "normal", "text-decoration" => "none"), ),

		array( "type" => "close-inputs" ),

		array( "type" => "close" ),
	),
),

// Color Settings
array( "name" => "Color Settings",
	"id" => "design-control",
	"type" => "options",
	"options" => array(
		array( "name" => "Color Scheme",
			"desc" => "Use the default color scheme or create your own using the color pickers below.",
			"type" => "open" ),

		array( "type" => "open-inputs-full" ),

			array( "name" => "Color Scheme",
				"id" => "color_scheme",
				"type" => "select",
				"select" => array( "default.css" => "Default", "custom" => "Custom", "darkblue.css" => "Darkblue", "pink.css" => "Pink" ),
				"default" => "default.css" ),

		array( "type" => "close-inputs" ),

			array( "info" => "<p>Use our default color scheme or create your own using the color pickers. Remember to save your settings.</p>",
				"type" => "large-info"),

		array( "type" => "close" ),


		array( "name" => "Stylesheet Colors",
			"desc" => "Setup your theme's color configuration.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Font Color",
				"id" => "color_font",
				"type" => "colorpicker",
				"default" => "#574d4d" ),

			array( "name" => "Primary Color",
				"id" => "color_primary",
				"type" => "colorpicker",
				"left" => "yes",
				"default" => "#05c1c3" ),

			array( "name" => "Secondary Color",
				"id" => "color_secondary",
				"type" => "colorpicker",
				"left" => "yes",
				"default" => "#ff5c0c" ),

		array( "type" => "close-inputs" ),

		array( "type" => "close" ),
	),
),

// JavaScript
array( "name" => "JavaScript",
	"id" => "javascript",
	"type" => "options",
	"options" => array(
		array( "name" => "FancyBox",
			"desc" => "Set the options for FancyBox script.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Select this is you want to be active",
				"id" => "script_fancybox_active",
				"type" => "checkbox",
				"default" => true ),

		array( "type" => "close-inputs" ),

			array( "info" => "<p>FancyBox is a tool for displaying images in a Mac-style lightbox that floats overtop of web page.</p>",
				"type" => "info"),

		array( "type" => "close" ),


		array( "name" => "FocusForm",
			"desc" => "Set the options for FocusForm script.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Select this is you want to be active",
				"id" => "script_focusform_active",
				"type" => "checkbox",
				"default" => true ),

		array( "type" => "close-inputs" ),

			array( "info" => "<p>This plugin is meant to expedite the basic process of making form fields empty on focus and refill on blur.</p>",
				"type" => "info"),

		array( "type" => "close" ),


		array( "name" => "YouTubeFit",
			"desc" => "Set the options for YouTubeFit script.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Select this is you want to be active",
				"id" => "script_youtubefit_active",
				"type" => "checkbox",
				"default" => true ),

		array( "type" => "close-inputs" ),

			array( "info" => "<p>This plugin makes it easy to have YouTube Videos resize horizontally and vertically to fit the available container width.</p>",
				"type" => "info"),

		array( "type" => "close" ),


		array( "name" => "ImageFit",
			"desc" => "Set the options for ImageFit script.",
			"type" => "open" ),

		array( "type" => "open-inputs" ),

			array( "name" => "Select this is you want to be active",
				"id" => "script_imagefit_active",
				"type" => "checkbox",
				"default" => true ),

		array( "type" => "close-inputs" ),

			array( "info" => "<p>This plugin makes it easy to have images resize horizontally and vertically to fit the available container width.</p>",
				"type" => "info"),

		array( "type" => "close" ),
	),
),

// Template Setup
array( "name" => "Template Setup",
	"id" => "template-setup",
	"type" => "template",
	"options" => array(
		array( "name" => "Template Setup",
			"desc" => "Add or remove preset sections to your pages.",
			"type" => "open" ),

			array( "name" => "Select page",
				"id" => "templates",
				"type" => "templates",
				"templates" => array(
					array( "name" => "Home Section",
						"id" => "home",
						"default" => array("home.loop", "home.pagination"),
						"sections" => array(
							array( "name" => "The Loop",
								"desc" => "Posts displayed hierarhicaly according to general wordpress settings.",
								"id" => "home.loop",
								"required" => "yes"),

							array( "name" => "Pagination",
								"desc" => "Displays the pagination links.",
								"id" => "home.pagination"),
						),
					),

					array( "name" => "Archive Section",
						"id" => "archive",
						"default" => array("archive.title", "archive.loop", "archive.pagination"),
						"sections" => array(
							array( "name" => "Archives Heading",
								"desc" => "Displays the archive date.",
								"id" => "archive.title"),

							array( "name" => "The Loop",
								"desc" => "Posts displayed hierarhicaly according to general wordpress settings.",
								"id" => "archive.loop",
								"required" => "yes"),

							array( "name" => "Pagination",
								"desc" => "Displays the pagination links.",
								"id" => "archive.pagination"),
						),
					),

					array( "name" => "Author Section",
						"id" => "author",
						"default" => array("author.biographical", "author.loop", "author.pagination"),
						"sections" => array(
							array( "name" => "Author Biographical",
								"desc" => "Displays the author biographical.",
								"id" => "author.biographical"),

							array( "name" => "The Loop",
								"desc" => "Posts displayed hierarhicaly according to general wordpress settings.",
								"id" => "author.loop",
								"required" => "yes"),

							array( "name" => "Pagination",
								"desc" => "Displays the pagination links.",
								"id" => "author.pagination"),
						),
					),

					array( "name" => "Category Section",
						"id" => "category",
						"default" => array("category.title", "category.loop", "category.pagination"),
						"sections" => array(
							array( "name" => "Category Heading",
								"desc" => "Displays the title of the category.",
								"id" => "category.title"),

							array( "name" => "The Loop",
								"desc" => "Posts displayed hierarhicaly according to general wordpress settings.",
								"id" => "category.loop",
								"required" => "yes"),

							array( "name" => "Pagination",
								"desc" => "Displays the pagination links.",
								"id" => "category.pagination"),
						),
					),

					array( "name" => "Search Section",
						"id" => "search",
						"default" => array("search.title", "search.loop", "search.pagination"),
						"sections" => array(
							array( "name" => "Search Heading",
								"desc" => "Displays the current search query.",
								"id" => "search.title"),

							array( "name" => "The Loop",
								"desc" => "Posts displayed hierarhicaly according to general wordpress settings.",
								"id" => "search.loop",
								"required" => "yes"),

							array( "name" => "Pagination",
								"desc" => "Displays the pagination links.",
								"id" => "search.pagination"),
						),
					),

					array( "name" => "Tag Section",
						"id" => "tag",
						"default" => array("tag.title", "tag.loop", "tag.pagination"),
						"sections" => array(
							array( "name" => "Tag Heading",
								"desc" => "Displays the title of the selected tag.",
								"id" => "tag.title"),

							array( "name" => "The Loop",
								"desc" => "Posts displayed hierarhicaly according to general wordpress settings.",
								"id" => "tag.loop",
								"required" => "yes"),

							array( "name" => "Pagination",
								"desc" => "Displays the pagination links.",
								"id" => "tag.pagination"),
						),
					),

					array( "name" => "404 Section",
						"id" => "error404",
						"default" => array("error404.loop"),
						"sections" => array(
							array( "name" => "Error message",
								"desc" => "Displays the default not found error message.",
								"id" => "error404.loop",
								"required" => "yes"),

							array( "name" => "Ad",
								"desc" => "Displays the preset advertisement.",
								"id" => "error404.ad"),
						),
					),

					array( "name" => "Page Section",
						"id" => "page",
						"default" => array("page.loop", "page.authordetails"),
						"sections" => array(
							array( "name" => "Page content",
								"desc" => "Displays the content of the page.",
								"id" => "page.loop",
								"required" => "yes"),

							array( "name" => "Ad",
								"desc" => "Displays the preset advertisement.",
								"id" => "page.ad"),

							array( "name" => "Author Details",
								"desc" => "Displays information about the author (editable in profile section).",
								"id" => "page.authordetails"),

							array( "name" => "Comments",
								"desc" => "Displays the comments hierarhicaly according to general wordpress settings.",
								"id" => "page.comments"),
						),
					),

					array( "name" => "Post Section",
						"id" => "single",
						"default" => array("single.loop", "single.authordetails", "single.comments"),
						"sections" => array(
							array( "name" => "Post content",
								"desc" => "Displays the content of the post.",
								"id" => "single.loop",
								"required" => "yes"),

							array( "name" => "Ad",
								"desc" => "Displays the preset advertisement.",
								"id" => "single.ad"),

							array( "name" => "Author Details",
								"desc" => "Displays information about the author (editable in profile section).",
								"id" => "single.authordetails"),

							array( "name" => "Comments",
								"desc" => "Displays the comments hierarhicaly according to general wordpress settings.",
								"id" => "single.comments"),
						),
					),
				),
			),

			array( "info" => "<p>Here you can change the order or to remove some sctions from different parts and pages from your website.</p>",
				"type" => "info"),

		array( "type" => "close" ),
	),
),

// Layout Editor
array( "name" => "Layout Editor",
	"id" => "layout-editor",
	"type" => "layout",
	"options" => array(
		array( "name" => "Layout Style",
			"desc" => "Choose your blog's layout style.",
			"type" => "open" ),

			array( "name" => "Select page",
				"id" => "layout_style",
				"type" => "layouts",
				"layouts" => array("home" => "Home template", "archive" => "Archive template", "search" => "Search template", "error404" => "Error 404", "page" => "Page template", "single" => "Post template", "defaultp" => "Default template"),
				"options" => array("fullwidth" => "Full Width", "one-sidebar-right" => "One Right Sidebar", "one-sidebar-left" => "One Left Sidebar"),
				"default" => array("home" => "one-sidebar-right", "error404" => "one-sidebar-right", "archive" => "one-sidebar-right", "search" => "one-sidebar-right", "page" => "one-sidebar-right", "single" => "one-sidebar-right", "defaultp" => "one-sidebar-right"), ),

			array( "info" => "<p>Quickly set a default layout style of any of your pages.</p>",
				"type" => "info"),

		array( "type" => "close" ),
	),
),

// Custom Code
array( "name" => "Custom Code",
	"id" => "custom-code",
	"type" => "options",
	"options" => array(

		array( "name" => "Custom CSS",
			"desc" => "Insert Custom CSS styling here.",
			"type" => "open" ),

		array( "type" => "open-inputs-full" ),

			array( "name" => "Custom CSS",
				"id" => "code_customcss",
				"type" => "textarea",
				"default" => "" ),


		array( "type" => "close-inputs" ),

			array( "info" => "<p>If you want you can enter your custom css.</p>",
				"example" => "&lt;style type=\"text/css\"&gt;<br />body {<br />&nbsp;&nbsp;&nbsp;font-size: 11px;<br />&nbsp;&nbsp;&nbsp;text-align: left;</br>}<br />&lt;/style&gt;",
				"type" => "large-info"),

		array( "type" => "close" ),


		array( "name" => "Header Scripts",
			"desc" => "Insert custom scripts in header.",
			"type" => "open" ),

		array( "type" => "open-inputs-full" ),

			array( "name" => "Custom Header Scripts",
				"id" => "code_headerscripts",
				"type" => "textarea",
				"default" => "" ),


		array( "type" => "close-inputs" ),

			array( "info" => "<p>If you have any javascript code you want to enter on header you can set it here.</p>",
				"example" => "&lt;script type=\"text/javascript\"&gt;<br />&nbsp;&nbsp;&nbsp;jQuery(document).ready( );<br />&lt;/script&gt;",
				"type" => "large-info"),

		array( "type" => "close" ),


		array( "name" => "Footer Scripts",
			"desc" => "Insert custom scripts in footer.",
			"type" => "open" ),

		array( "type" => "open-inputs-full" ),

			array( "name" => "Custom Footer Scripts",
				"id" => "code_footerscripts",
				"type" => "textarea",
				"default" => "" ),


		array( "type" => "close-inputs" ),

			array( "info" => "<p>Enter the javascript code to show on footer.</p>",
				"example" => "&lt;script type=\"text/javascript\"&gt;<br />&nbsp;&nbsp;&nbsp;jQuery(document).ready( );<br />&lt;/script&gt;",
				"type" => "large-info"),

		array( "type" => "close" ),
	),
),

// Report an issue
array( "name" => "Report an issue",
	"id" => "feedback",
	"type" => "feedback",
	"options" => false
),

//Affiliate
array( "name" => "Become an affiliate! Earn 30%",
	"id" => "affiliate",
	"type" => "affiliate",
	"options" => false
),

);

/*-------------------------------------------------------------
*   Default Ads
*------------------------------------------------------------*/
$default_ads = array (
"after-post-zone" => array (
	"zone_key"		=> "after-post-zone",
	"zone_name"		=> "After post zone",
	"zone_description"	=> "This area will appear after each post or page.",
	"zone_maxads"		=> "1",
	"zone_mode"		=> "latest",
	"zone_format"		=> "468x60"),

"sidebar-zone" => array (
	"zone_key"		=> "sidebar-zone",
	"zone_name"		=> "Sidebar zone",
	"zone_description"	=> "This area is for sidebar. To use you need to add a widget where to select this area.",
	"zone_maxads"		=> "4",
	"zone_mode"		=> "latest",
	"zone_format"		=> "125x125")
);
?>