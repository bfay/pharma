<?php
/**
 * Build and register the ez_feature_top_3 widget areas.
 *
 * @package Catalyst
 */
 
catalyst_register_sidebar( array(
	'name'=>'EZ Feature Top #1',
	'id' => 'catalyst_ez_feature_top_1'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Feature Top #2',
	'id' => 'catalyst_ez_feature_top_2'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Feature Top #3',
	'id' => 'catalyst_ez_feature_top_3'
));

/**
 * Build the ez feature top 3 HTML.
 *
 * @since 1.1
 */
function ez_feature_top_3()
{
?>
	<div id="ez-feature-top-container-wrap" class="clearfix">
	
		<div id="ez-feature-top-container" class="clearfix">

			<div id="ez-feature-top-1" class="ez-widget-area ez-feature-top-widget-area  ez-one-third ez-first">
				<?php
				if( !dynamic_sidebar( 'EZ Feature Top #1' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Feature Top #1', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #feature-top-1 -->
			
			<div id="ez-feature-top-2" class="ez-widget-area ez-feature-top-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Feature Top #2' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Feature Top #2', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #feature-top-2 -->
			
			<div id="ez-feature-top-3" class="ez-widget-area ez-feature-top-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Feature Top #3' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Feature Top #3', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #feature-top-3 -->
		
		</div><!-- end #feature-top-container -->
		
	</div><!-- end #feature-top-container-wrap -->
<?php
}