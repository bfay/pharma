<?php get_header(); ?>

<div id="main">
	<div id="content">
		<?php if( framework_get_template( 'tag' ) ) :
		foreach( framework_get_template( 'tag' ) as $section ) :

			framework_get_section( 'tag', $section );

		endforeach;
		endif; ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>