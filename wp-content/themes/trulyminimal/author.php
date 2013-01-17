<?php get_header(); ?>

<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>

<div id="main">
	<div id="content">
		<?php if( framework_get_template( 'author' ) ) :
		foreach( framework_get_template( 'author' ) as $section ) :

			framework_get_section( 'author', $section );

		endforeach;
		endif; ?>
	</div><!-- END #content -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>
</div><!-- END #main -->

<?php get_footer(); ?>