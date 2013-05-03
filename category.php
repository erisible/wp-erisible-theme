<?php get_header(); ?>
<section id="primary">
	<div id="content" role="main">

		<?php if (have_posts()) : ?>		
			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php
					get_template_part( 'content');
				?>
	
			<?php endwhile; ?>
	
			<?php wp_paginate();?>
		<?php else: ?>
			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title">Aucune publication</h1>
				</header>
	
				<div class="entry-content article-content">
					<p>Il n'y a pas d'article publié dans cette catégorie pour le moment.</p>
	
				</div>
			</article>
		<?php endif; ?>
	</div>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>