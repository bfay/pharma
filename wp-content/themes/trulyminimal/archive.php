<?php get_header(); ?>

<div id="main">
	<div id="content">
		<?php if( framework_get_template( 'archive' ) ) :
		foreach( framework_get_template( 'archive' ) as $section ) :

			framework_get_section( 'archive', $section );

		endforeach;
		endif; ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>