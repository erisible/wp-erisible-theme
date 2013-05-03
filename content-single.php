<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<span class="entry-date"><?php the_date(); ?></span>
			<span class="entry-category"><?php the_category(); ?></span>
		</div>

	</header>

	<div class="entry-content article-content">
		<?php the_post_thumbnail('large'); ?>
		<?php the_content(); ?>
	</div>

	<footer class="entry-meta">
		<?php if(comments_open()): ?>
		<a class="post-comment-link" href="#respond">Laisser un commentaire</a>
		<?php endif; ?>
		<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
		
	</footer>
</article>

<?php get_nav_single() ?>

<?php erisible_sharethis(); ?>
<?php related_posts(); ?>
<?php comments_template( '', true ); ?>