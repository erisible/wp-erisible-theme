<?php get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">Résultats de recherche <?php echo '<span>' . get_search_query() . '</span>' ?></h1>
				</header>

				<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<div class="entry-meta">
							<span class="entry-date"><?php the_date(); ?></span>
							<?php if(has_category()): ?>
							<span class="entry-category"><?php the_category(); ?></span>
							<?php elseif(has_tag()): ?>
							<span class="entry-tag"><?php the_tags('', ' ', ''); ?></span>
							<?php endif; ?>
						</div>
				
					</header>
				
					<div class="entry-content article-content">
					<?php the_excerpt(); ?>
					</div>
					
					<footer class="entry-meta">

						<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
						
					</footer>
				</article>
				<?php endwhile; ?>
				
				<?php wp_paginate(); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title">Aucun résultat</h1>
					</header>

					<div class="entry-content article-content">
						<p>Aucun contenu ne correspond à ces critères de recherche.</p>
						<?php get_search_form(); ?>
					</div>
				</article>

			<?php endif; ?>

			</div>
		</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>