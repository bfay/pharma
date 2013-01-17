<?php get_header(); ?>

<div id="main">
	<div id="content">
		<?php get_template_part( 'loop', 'attachment' ); ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>
