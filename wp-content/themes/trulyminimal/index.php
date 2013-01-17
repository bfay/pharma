<?php get_header(); ?>

<div id="main">
	<div id="content">
		<?php if( framework_get_template( 'home' ) ) :
		foreach( framework_get_template( 'home' ) as $section ) :

			framework_get_section( 'home', $section );

		endforeach;
		endif; ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>