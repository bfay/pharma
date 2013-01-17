<?php
/**
 * Build and register the ez_home_3_1_3 widget areas.
 *
 * @package Catalyst
 */
 
//Register Homepage Widget Areas
catalyst_register_sidebar( array(
	'name'=>'EZ Home Top #1',
	'id' => 'catalyst_ez_home_top_1'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Top #2',
	'id' => 'catalyst_ez_home_top_2'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Top #3',
	'id' => 'catalyst_ez_home_top_3'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Middle #1',
	'id' => 'catalyst_ez_home_middle_1'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Bottom #1',
	'id' => 'catalyst_ez_home_bottom_1'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Bottom #2',
	'id' => 'catalyst_ez_home_bottom_2'
));
catalyst_register_sidebar( array(
	'name'=>'EZ Home Bottom #3',
	'id' => 'catalyst_ez_home_bottom_3'
));

/**
 * Build the ez home 3 1 3 HTML.
 *
 * @since 1.1
 */
function ez_home_3_1_3()
{
	global $catalyst_layout_id;
	?>
	<div id="ez-home-container-wrap" class="clearfix">
	
		<?php catalyst_hook_before_ez_home( $catalyst_layout_id . '_catalyst_hook_before_ez_home' ); ?>

		<div id="ez-home-top-container" class="ez-home-container-area clearfix">
	
			<div id="ez-home-top-1" class="ez-widget-area ez-home-widget-area  ez-one-third ez-first">
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
			
			<div id="ez-home-top-2" class="ez-widget-area ez-home-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Home Top #2' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Top #2', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-top-2 -->
			
			<div id="ez-home-top-3" class="ez-widget-area ez-home-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Home Top #3' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Top #3', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-top-3 -->
		
		</div><!-- end #ez-home-top-container -->
		
		<div id="ez-home-middle-container" class="ez-home-container-area clearfix">
	
			<div id="ez-home-middle-1" class="ez-widget-area ez-home-widget-area  ez-only">
				<?php
				if( !dynamic_sidebar( 'EZ Home Middle #1' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Middle #1', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-middle-1 -->
		
		</div><!-- end #ez-home-middle-container -->
		
		<div id="ez-home-bottom-container" class="ez-home-container-area ez-home-bottom clearfix">
	
			<div id="ez-home-bottom-1" class="ez-widget-area ez-home-widget-area  ez-one-third ez-first">
				<?php
				if( !dynamic_sidebar( 'EZ Home Bottom #1' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Bottom #1', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-bottom-1 -->
			
			<div id="ez-home-bottom-2" class="ez-widget-area ez-home-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Home Bottom #2' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Bottom #2', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-bottom-2 -->
			
			<div id="ez-home-bottom-3" class="ez-widget-area ez-home-widget-area  ez-one-third">
				<?php
				if( !dynamic_sidebar( 'EZ Home Bottom #3' ) )
				{
				?>
					<aside class="widget">
						<h4><?php _e( 'EZ Home Bottom #3', 'catalyst' ); ?></h4>
						<p><?php printf( __( 'This is Catalyst Widget Area. You can add content to this area by going to <a href="%s">Appearance > Widgets</a> in your WordPress Dashboard and adding new widgets to this area.', 'catalyst' ), admin_url( 'widgets.php' ) ); ?></p>
					</aside>			
				<?php
				}
				?>
			</div><!-- end #ez-home-bottom-3 -->
		
		</div><!-- end #ez-home-bottom-container -->
		
		<?php catalyst_hook_after_ez_home( $catalyst_layout_id . '_catalyst_hook_after_ez_home' ); ?>
	
	</div><!-- end #ez-home-container-wrap -->
	<?php
}