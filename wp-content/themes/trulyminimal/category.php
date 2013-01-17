<?php get_header(); ?>

<div id="main">
	<div id="content">
		<?php if( framework_get_template( 'category' ) ) :
		foreach( framework_get_template( 'category' ) as $section ) :

			framework_get_section( 'category', $section );

		endforeach;
		endif; ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>