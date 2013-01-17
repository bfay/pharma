<?php
/**
 * Build and register the ez_home_dual_sidebars widget area.
 *
 * @package Catalyst
 */
 
// Register Homepage Dual Sidebars Widget Areas.
catalyst_register_sidebar( array(
	'name'=>'EZ Home Sidebar 1',
	'id' => 'catalyst_ez_home_sidebar_1'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Sidebar 2',
	'id' => 'catalyst_ez_home_sidebar_2'
));

/**
 * Build the ez home dual sidebars HTML.
 *
 * @since 1.1
 */
function ez_home_dual_sidebars()
{
?>
	<div id="ez-home-dual-sidebars-wrap" class="clearfix">
	
		<div id="ez-home-sidebar-1" class="ez-widget-area ez-home-widget-area">
			<?php if ( !dynamic_sidebar( 'EZ Home Sidebar 1' ) ) : ?>
			
				<aside class="widget widget-text"><div class="widget-wrap">
					<h4 class="widgettitle"><?php _e( 'Home Sidebar 1 Widget Area', 'catalyst' ); ?></h4>
					<div class="textwidget"><p><?php printf( __( 'This is the Home Sidebar 1 Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p></div>
				</div></aside>
			
			<?php endif; ?>
		</div><!-- end #ez-home-sidebar-1 -->

		<div id="ez-home-sidebar-2" class="ez-widget-area ez-home-widget-area">
			<?php if ( !dynamic_sidebar( 'EZ Home Sidebar 2' ) ) : ?>
			
				<aside class="widget widget-text"><div class="widget-wrap">
					<h4 class="widgettitle"><?php _e( 'Home Sidebar 2 Widget Area', 'catalyst' ); ?></h4>
					<div class="textwidget"><p><?php printf( __( 'This is the Home Sidebar 2 Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p></div>
				</div></aside>
			
			<?php endif; ?>
		</div><!-- end #ez-home-sidebar-2 -->

	</div><!-- end #ez-home-dual-sidebars-wrap -->
<?php
}