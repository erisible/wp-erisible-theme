<?php get_header(); ?>
		<section id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'project'); ?>

				<?php endwhile;  ?>

			</div>
		</section>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>