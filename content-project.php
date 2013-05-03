<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if(is_single()): ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else: ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		<?php endif; ?>
		<div class="entry-meta">
			<span class="entry-date"><?php the_date(); ?></span>
			<span class="entry-tag"><?php the_tags('', ' ', ''); ?></span>
		</div>

	</header>

	<div class="entry-content article-content">
		<?php the_post_thumbnail('large'); ?>
		<?php the_content(); ?>
		<?php
			$progression = get_post_meta(get_the_ID(), 'progression', true);
			$url = get_post_meta(get_the_ID(), 'url', true);
			$sources = get_post_meta(get_the_ID(), 'sources', true);
		?>
		<?php 
		/*
		 *	Pas de progression, en tout cas, pas pour le moment.
		 *  
		 *  <?php if($progression != '' || $url != '' || $sources != ''): ?>
			<ul class="post-meta">
			<?php if($progression != ''): ?>
			<li><span class="post-meta-key post-meta-progression">Progression :</span> <?php echo $progression; ?>%</li>
			<?php endif; ?>
		 * 
		 * 
		 */
		?>
		<?php if($url != '' || $sources != ''): ?>
		<ul class="post-meta">	
			<?php if($url != ''): ?>
			<li><span class="post-meta-key post-meta-url"><a href="<?php echo $url; ?>">Lien vers le projet</a></span></li>
			<?php endif; ?>
			<?php if($sources != ''): ?>
			<li><span class="post-meta-key post-meta-github"><a href="<?php echo $sources; ?>">Sources du projet</a></li>
			<?php endif; ?>
		</ul>
		<?php endif; ?>
	</div>

	<footer class="entry-meta">
		<?php edit_post_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
		
	</footer>
</article>
<?php if (is_single()): ?> 
	<?php get_nav_single() ?>
<?php endif; ?>
<?php erisible_sharethis(); ?>