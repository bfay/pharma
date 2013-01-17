<?php
/**
 * Build and register the ez_home_slider widget area.
 *
 * @package Catalyst
 */
 
// Register Home Slider Widget Area.
catalyst_register_sidebar( array(
	'name'=>'EZ Home Slider',
	'id' => 'catalyst_ez_home_slider'
));

/**
 * Build the ez home slider HTML.
 *
 * @since 1.3
 */
function ez_home_slider()
{
	if( !is_front_page() )
		return;
?>
	<div id="ez-home-slider-container-wrap" class="clearfix">
	
		<div id="ez-home-slider-container" class="clearfix">

			<div id="ez-home-slider" class="ez-widget-area ez-home-widget-area ez-only">
			
				<?php
				if( !dynamic_sidebar( 'EZ Home Slider' ) )
				{
				?>
					<aside class="widget">
						<?php if( function_exists( 'wp_cycle' ) ) : ?>
							<?php wp_cycle(); ?>
						<?php endif; ?>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-slider -->
		
		</div><!-- end #ez-home-slider-container -->
		
	</div><!-- end #ez-home-slider-container-wrap -->
<?php
}