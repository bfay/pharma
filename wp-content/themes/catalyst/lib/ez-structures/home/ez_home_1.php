<?php
/**
 * Build and register the ez_home_1 widget area.
 *
 * @package Catalyst
 */
 
//Register Homepage Widget Areas
catalyst_register_sidebar( array(
	'name'=>'EZ Home Top #1',
	'id' => 'catalyst_ez_home_top_1'
));

/**
 * Build the ez home 1 HTML.
 *
 * @since 1.1
 */
function ez_home_1()
{
	global $catalyst_layout_id;
	?>
	<div id="ez-home-container-wrap" class="clearfix">
	
		<?php catalyst_hook_before_ez_home( $catalyst_layout_id . '_catalyst_hook_before_ez_home' ); ?>

		<div id="ez-home-top-container" class="ez-home-container-area ez-home-bottom clearfix">
	
			<div id="ez-home-top-1" class="ez-widget-area ez-home-widget-area  ez-only">
				<?php
				if( !dynamic_sidebar( 'EZ Home Top #1' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Top #1', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-top-1 -->
		
		</div><!-- end #ez-home-top-container -->
		
		<?php catalyst_hook_after_ez_home( $catalyst_layout_id . '_catalyst_hook_after_ez_home' ); ?>
	
	</div><!-- end #ez-home-container-wrap -->
	<?php
}