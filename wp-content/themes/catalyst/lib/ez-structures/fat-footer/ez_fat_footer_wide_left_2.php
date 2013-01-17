<?php
/**
 * Build and register the ez_fat_footer_wide_left_2 widget areas.
 *
 * @package Catalyst
 */
 
catalyst_register_sidebar( array(
	'name'=>'EZ Fat Footer #1',
	'id' => 'catalyst_ez_fat_footer_1'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Fat Footer #2',
	'id' => 'catalyst_ez_fat_footer_2'
));

/**
 * Build the ez fat footer wide left 2 HTML.
 *
 * @since 1.1
 */
function ez_fat_footer_wide_left_2()
{
?>
	<div id="ez-fat-footer-container-wrap" class="clearfix">
	
		<div id="ez-fat-footer-container" class="clearfix">

			<div id="ez-fat-footer-1" class="ez-widget-area ez-fat-footer-widget-area  ez-two-thirds ez-first">
				<?php
				if( !dynamic_sidebar( 'EZ Fat Footer #1' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Fat Footer #1', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #fat-footer-1 -->
			
			<div id="ez-fat-footer-2" class="ez-widget-area ez-fat-footer-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Fat Footer #2' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Fat Footer #2', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #fat-footer-2 -->
		
		</div><!-- end #fat-footer-container -->
		
	</div><!-- end #fat-footer-container-wrap -->
<?php
}