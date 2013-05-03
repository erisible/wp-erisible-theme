<?php get_header(); ?>
<?php
	$page = (get_query_var('paged')) ? get_query_var('paged') : 1;  

	$args = array(
	    'post_type' => 'post',
	    'paged'  => $page
	);
	
	$loop = new WP_Query($args);
?>

<section id="primary">
	<div id="content" role="main">
		<?php if ($loop->have_posts()) : ?>
			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php
					global $more;
					$more = 0;
				?>
	
				<?php get_template_part( 'content'); ?>
	
			<?php endwhile; ?>
			
			<?php wp_paginate(false, $loop); ?>
		<?php else: ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title">Aucune publication</h1>
				</header>
	
				<div class="entry-content article-content">
					<p>Il n'y a pas d'article publié pour le moment.</p>
	
				</div>
			</article>
		<?php endif; ?>
		
		<?php wp_reset_postdata(); ?>

	</div>
</section>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>