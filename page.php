<?php get_header(); ?>

<section id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			
				<div class="entry-content article-content">
					<?php the_content(); ?>
				</div>
				<footer class="entry-meta">
					<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
				</footer>
			</article>

		<?php endwhile; ?>

	</div>
</section>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>