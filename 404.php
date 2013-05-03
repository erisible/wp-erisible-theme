<?php get_header(); ?>

<section id="primary">
	<div id="content" role="main">

		<article id="post-0" class="post error404 not-found">
			<header class="entry-header">
				<h1 class="entry-title">Oops</h1>
			</header>

			<div class="entry-content article-content">
				<p>Cette page n'existe pas, ou plus, ou pas encore.</p>

				<?php get_search_form(); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
			</div>
		</article>

	</div>
</section>

<?php get_footer(); ?>