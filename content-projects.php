<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
	</header>

	<div class="entry-content article-content">
		<?php the_post_thumbnail('project-thumb'); ?>
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-meta">
		<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
		
	</footer>
</article>