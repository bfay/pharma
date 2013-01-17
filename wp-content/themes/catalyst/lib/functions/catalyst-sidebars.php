<?php
/**
 * Builds, registers and hooks in the Sidebar Widget Areas.
 *
 * @package Catalyst
 */

/**
 * Register sidebar widget areas.
 *
 * @since 1.0
 * @return registered sidebar with $args.
 */
function catalyst_register_sidebar( $args )
{
	$defaults = array(
		'description'	=> '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget'  => "</div></aside>\n",
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => "</h4>\n"
	);

	$args = wp_parse_args( $args, $defaults );

	return register_sidebar( $args );
}

catalyst_register_sidebar( array(
	'name'=>'Sidebar 1',
	'id' => 'catalyst_default_sidebar_1'
) );

catalyst_register_sidebar( array(
	'name'=>'Sidebar 2',
	'id' => 'catalyst_default_sidebar_2'
) );

add_action( 'catalyst_hook_after_content_wrap', 'catalyst_dual_sidebars' );
/**
 * Build dual sidebar HTML.
 *
 * @since 1.0
 */
function catalyst_dual_sidebars()
{
	global $catalyst_layout_type, $catalyst_layout_id;

	if( $catalyst_layout_type != 'double-right-sidebar' && $catalyst_layout_type != 'double-left-sidebar' )
		return;
	
	echo '<div id="dual-sidebar-outer">' . "\n";
		catalyst_hook_before_dual_sidebars( $catalyst_layout_id . '_catalyst_hook_before_dual_sidebars' );
		echo '<div id="dual-sidebar-inner">' . "\n";
			build_catalyst_sidebar_1( $catalyst_layout_id );
			build_catalyst_sidebar_2( $catalyst_layout_id );
		echo '</div><!-- end #dual-sidebar-inner -->' . "\n";
		echo '<div style="clear:both;"></div>' . "\n";
		catalyst_hook_after_dual_sidebars( $catalyst_layout_id . '_catalyst_hook_after_dual_sidebars' );
	echo '</div><!-- end #dual-sidebar-outer -->' . "\n";
}

add_action( 'catalyst_hook_after_content_wrap', 'catalyst_sidebar_1' );
/**
 * Determine whether or not to display sidebar 1 based on current layout type.
 *
 * @since 1.0
 */
function catalyst_sidebar_1()
{
	global $catalyst_layout_type, $catalyst_layout_id;

	if( $catalyst_layout_type == 'double-right-sidebar' || $catalyst_layout_type == 'double-left-sidebar' || $catalyst_layout_type == 'no-sidebar' )
		return;
	
	build_catalyst_sidebar_1( $catalyst_layout_id );
}

/**
 * Build sidebar 1 HTML.
 *
 * @since 1.0
 */
function build_catalyst_sidebar_1( $catalyst_layout_id )
{
	if( substr( $catalyst_layout_id, 0, 16 ) != 'default_sidebars' )
	{
		$sidebar_layout_id = $catalyst_layout_id;
	}
	else
	{
		$sidebar_layout_id = 'catalyst_default';
	}
?>
	<div id="sidebar-1-wrap">
		<?php catalyst_hook_before_sidebar_1( $catalyst_layout_id . '_catalyst_hook_before_sidebar_1' ); ?>
		<div id="sidebar-1" role="complementary">
			<?php if( !dynamic_sidebar( $sidebar_layout_id . '_sidebar_1' ) ) : ?>
			
				<aside class="widget widget-text"><div class="widget-wrap">
					<h4 class="widgettitle"><?php _e( 'Sidebar 1 Widget Area', 'catalyst' ); ?></h4>
					<div class="textwidget"><p><?php printf(__( 'This is the Sidebar 1 Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' )); ?></p></div>
				</div></aside>
			
			<?php endif; ?>
		</div><!-- end #sidebar-1 -->
		<div style="clear:both;"></div>
		<?php catalyst_hook_after_sidebar_1( $catalyst_layout_id . '_catalyst_hook_after_sidebar_1' ); ?>
	</div><!-- end #sidebar-1-wrap -->
<?php
}

add_action( 'catalyst_hook_after_content_sidebar_wrap', 'catalyst_sidebar_2' );
/**
 * Determine whether or not to display sidebar 2 based on current layout type.
 *
 * @since 1.0
 */
function catalyst_sidebar_2()
{
	global $catalyst_layout_type, $catalyst_layout_id;

	if( $catalyst_layout_type != 'double-sidebar' )
		return;
	
	build_catalyst_sidebar_2( $catalyst_layout_id );
}

/**
 * Build sidebar 2 HTML.
 *
 * @since 1.0
 */
function build_catalyst_sidebar_2( $catalyst_layout_id )
{
	if( substr( $catalyst_layout_id, 0, 16 ) != 'default_sidebars' )
	{
		$sidebar_layout_id = $catalyst_layout_id;
	}
	else
	{
		$sidebar_layout_id = 'catalyst_default';
	}
?>
	<div id="sidebar-2-wrap">
		<?php catalyst_hook_before_sidebar_2( $catalyst_layout_id . '_catalyst_hook_before_sidebar_2' ); ?>
		<div id="sidebar-2" role="complementary">
			<?php if( !dynamic_sidebar( $sidebar_layout_id . '_sidebar_2' ) ) : ?>
			
				<aside class="widget widget-text"><div class="widget-wrap">
					<h4 class="widgettitle"><?php _e( 'Sidebar 2 Widget Area', 'catalyst' ); ?></h4>
					<div class="textwidget"><p><?php printf(__( 'This is the Sidebar 2 Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' )); ?></p></div>
				</div></aside>
			
			<?php endif; ?>
		</div><!-- end #sidebar-2 -->
		<div style="clear:both;"></div>
		<?php catalyst_hook_after_sidebar_2( $catalyst_layout_id . '_catalyst_hook_after_sidebar_2' ); ?>
	</div><!-- end #sidebar-2-wrap -->
<?php
}

//end lib/functions/catalyst-sidebars.php