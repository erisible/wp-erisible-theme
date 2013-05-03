<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="entry-meta">
			<span class="entry-date"><?php the_date(); ?></span>
			<span class="entry-category"><?php the_category(); ?></span>
		</div>

	</header>

	<div class="entry-content article-content">
		<?php the_post_thumbnail('large'); ?>
		<?php the_content('Lire la suite'); ?>
	</div>

	<footer class="entry-meta">
		<?php if(comments_open()): ?>
		<a class="post-comment-link" href="<?php the_permalink(); ?>#respond">Laisser un commentaire</a>
		<?php endif; ?>
		
		<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
		
	</footer>
</article>
<?php erisible_sharethis(); ?>
<?php comments_number( '', '<h4 class="comments-title"><a href="'.get_permalink().'#comments">1 <span>Commentaire</span></a></h4>', '<h4 class="comments-title"><a href="'.get_permalink().'#comments">% <span>Commentaires</span></a></h4>' ); ?>