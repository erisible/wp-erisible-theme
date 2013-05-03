<?php get_header(); ?>

<section id="primary">
	<div id="content" role="main">

		<header class="page-header">
			<h1 class="page-title">Mot-clef <span>
				<?php echo get_query_var('tag'); ?>
				</span>
				<span>
			</h1>
		</header>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				if ( get_post_type() == 'project' ) {
					get_template_part('content', 'projets');			
				}
				else {
					get_template_part( 'content');				
				}
			?>

		<?php endwhile; ?>
		
		<?php wp_paginate();?>
	</div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>