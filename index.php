<?php get_header(); ?>
<?php
	$cat_id = get_category_by_slug('productions')->term_id;
	$cat_childs_id = array();
	$cats = get_categories("child_of=".$cat_id. "&title_li=&hide_empty=true");

	foreach($cats as $cat) {
		array_unshift($cat_childs_id,$cat->cat_ID);
	}
	
	$args_latest_news = array(
	    'post_type' => 'post',
	    'category__not_in'  => $cat_childs_id,
	    'orderby' => date
	);
	
	$args_latest_prod = array(
	    'post_type' => 'post',
	    'category__in'  => $cat_childs_id,
	    'orderby' => date
	);
	
	$args_latest_projects = array(
		'post_type' => 'project',
		'nopaging' => true
	);
	
	$loop_latest_news = new WP_Query($args_latest_news);
	$loop_latest_prod = new WP_Query($args_latest_prod);
	$loop_latest_projects = new WP_Query($args_latest_projects);
?>

<section id="primary">
	
	<div id="content" role="main">
		
		<?php if ($loop_latest_news->have_posts()): ?>
		<section id="latest-news">
			
			<header class="page-header">
				<h3 class="page-title">Articles récents</h3>
			</header>
	
			<?php while ( $loop_latest_news->have_posts() ) : $loop_latest_news->the_post(); ?>
	
				<?php get_template_part( 'content', 'home'); ?>
	
			<?php endwhile; ?>
			
		</section>
		<?php endif; ?>

		<?php if ($loop_latest_prod->have_posts()): ?>
		<section id="latest-prod">
			
			<header class="page-header">
				<h3 class="page-title">Productions récentes</h3>
			</header>
	
			<?php while ( $loop_latest_prod->have_posts() ) : $loop_latest_prod->the_post(); ?>
	
				<?php get_template_part( 'content', 'home'); ?>
	
			<?php endwhile; ?>
			
		</section>
		<?php endif; ?>
		<?php if ($loop_latest_projects->have_posts()): ?>		<section id="latest-projects">						<header class="page-header">				<h3 class="page-title">Projets</h3>			</header>					<?php while ( $loop_latest_projects->have_posts() ) : $loop_latest_projects->the_post(); ?>					<?php get_template_part( 'content', 'projects'); ?>				<?php endwhile; ?>						</section>		<?php endif; ?>

	</div></section><?php wp_reset_postdata(); ?><?php get_sidebar(); ?><?php get_footer(); ?>