<article id="post-<?php the_ID(); ?>" <?php post_class('closed'); ?>>
	<header class="entry-header">
		<a class="entry-close" href="#"><span>Close</span></a>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<div class="entry-meta">
      <span class="entry-date"><?php the_date(); ?></span>
			<span class="entry-category"><?php the_category(); ?></span>
		</div>

	</header>

	<div class="entry-content article-content home-excerpt">
	  <?php the_post_thumbnail('small-thumb'); ?>
		<?php the_excerpt(); ?>
	</div>

	<div class="entry-content article-content home-content">	
		<?php the_post_thumbnail('large'); ?>
		<?php the_content('Lire la suite'); ?>
	</div>

	<footer class="entry-meta">
		<?php if(comments_open()): ?>
		<a class="post-comment-link" href="<?php the_permalink(); ?>#respond">Laisser un commentaire</a>
		<?php endif; ?>
		
		<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
		
		<?php erisible_sharethis(); ?>
		<?php comments_number( '', '<h4 class="comments-title"><a href="'.get_permalink().'#comments">1 <span>Commentaire</span></a></h4>', '<h4 class="comments-title"><a href="'.get_permalink().'#comments">% <span>Commentaires</span></a></h4>' ); ?>	
	</footer>
</article>