<?php get_header(); ?>
<?php
	$args = array(
	    'post_type' => 'project',
	    'nopaging'  => true
	);
	
	$loop = new WP_Query($args);
?>

<section id="primary">
	<div id="content" role="main">
	<?php if ($loop->have_posts()) : ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	
			<?php get_template_part('content', 'projects'); ?>
	
		<?php endwhile; ?>
	<?php else: ?>
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title">Aucun projet</h1>
			</header>

			<div class="entry-content article-content">
				<p>Il n'y a pas de projet publié pour le moment.</p>

			</div>
		</article>
	<?php endif; ?>
	
	<?php wp_reset_postdata(); ?>

	</div>
</section>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>