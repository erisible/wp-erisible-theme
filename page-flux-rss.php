<?php get_header(); ?>

<section id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
			
				<div class="entry-content article-content">
					<ul>
						<li><a href="<?php bloginfo('rss2_url'); ?>">Tous les flux</a></li>
						<?php 
						$categories = get_categories("orderby=name&order=ASC&hierarchical=false&exclude=".get_category_by_slug('non-classe')->term_id);
						foreach ($categories as $category) {
							if ($category->category_parent == 0) {
								$list = '<li><a href="';
								$list .= get_category_feed_link($category->term_id);
								$list .= '">';
								$list .= $category->name;
								$list .= '</a></li>';
								echo $list;
							}
						}
			 			?>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); echo get_post_type_object('project')->rewrite['slug']; ?>/feed/">Projets</a></li>
					</ul>
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