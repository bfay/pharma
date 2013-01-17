<?php get_header(); ?>

<div id="main">
	<div id="content">
		<?php if( framework_get_template( 'error404' ) ) :
		foreach( framework_get_template( 'error404' ) as $section ) :

			framework_get_section( 'error404', $section );

		endforeach;
		endif; ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>