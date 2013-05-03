<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="go-to-hell" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="go-to-hell" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="go-to-hell" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<title><?php bloginfo( 'name' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" id="theme-stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo erisible_init_style(); ?>.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	wp_head();
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.event.move.js" type="text/javascript"></script>
</head>
<body <?php body_class(); ?>>
	<div id="page">
		<header id="header" role="banner">
			<section class="wrapper">
				<hgroup>
					<h1 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span><?php bloginfo( 'name' ); ?></span></a></h1>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<section id="menu">
				<a id="access-show" href="#"><span>Show menu</span></a>
					<nav id="access" role="navigation">
						<h3 class="assistive-text">Menu principal</h3>
						<div class="skip-link"><a class="assistive-text" href="#content" title="Aller au contenu principal">Aller au contenu principal</a></div>
						<div class="skip-link"><a class="assistive-text" href="#secondary" title="Aller au contenu secondaire">Aller au contenu secondaire</a></div>
						<?php wp_nav_menu( array( 'theme_location' => 'menu' ) ); ?>
					</nav>
					<?php
						if (is_page('blog'))
							$list = wp_list_categories("orderby=name&order=ASC&hide_empty=1&hierarchical=false&exclude=".get_category_by_slug('non-classe')->term_id.",".get_category_by_slug('productions')->term_id."&echo=0&depth=1&title_li=&show_option_none=");
						else if (is_category()) {
								$cat = get_category(get_query_var('cat'))->term_id;
								$parent = get_term_by('name', 'productions', 'category')->term_id;
							if(is_category('productions') || cat_is_ancestor_of($parent, $cat))
								$list = wp_list_categories("orderby=name&order=ASC&hide_empty=1&hierarchical=false&child_of=".get_category_by_slug('productions')->term_id."&echo=0&title_li=&show_option_none=");
							else
								$list = wp_list_categories("orderby=name&order=ASC&hide_empty=1&hierarchical=false&exclude=".get_category_by_slug('non-classe')->term_id.",".get_category_by_slug('productions')->term_id."&echo=0&depth=1&title_li=&show_option_none=");
						}
					?>
					<?php if(isset($list) && !empty($list)): ?>
					<nav id="submenu" role="navigation">
						<h3 class="assistive-text">Catégories</h3>
						<ul class="wrapper">
					<?php echo $list; ?>
						</ul>
					</nav>
					<?php endif; ?>
				</section>
				<div id="tools">
					<a id="search-show" href="#"><span>Search box</span></a>
					<a id="settings-show" href="#"><span>Settings box</span></a>
					<div id="search-box" class="box"><?php get_search_form(); ?></div>
					<div id="settings-box" class="box">
						<div class="setting" id="setting-theme">
							<div class="setting-wrapper">
								<h3 class="setting-title">Thème</h3>
								<a id="theme-dark" class="theme">Dark</a>
								<a id="theme-light" class="theme">Light</a>
							</div>
						</div>
						<div class="setting" id="setting-fontsize">
							<div class="setting-wrapper">
								<h3 class="setting-title">Taille de police</h3>
								<span class="fontsize-pct">50</span>
								<span class="fontsize-pct">75</span>
								<span class="fontsize-pct">87.5</span>
								<span class="fontsize-pct">100</span>
								<span class="fontsize-pct">125</span>
								<span class="fontsize-pct">150</span>
								<span class="fontsize-pct">175</span>
								<span class="fontsize-pct">200</span>
								<span class="fontsize-pct">250</span>
								<span class="fontsize-pct">300</span>
								<div id="fontsize">
									<span id="fontsize-slider"></span>
								</div>
							</div>
							<span id="fontsize-unit">%</span>
						</div>
						<div class="setting" id="setting-columns">
							<div class="setting-wrapper">
								<h3 class="setting-title">Présentation</h3>
								<a id="columns-2" class="columns"><span>Deux colonnes</span></a>
								<a id="columns-1" class="columns"><span>Une colonne</span></a>
							</div>
						</div>
					</div>
				</div>
			</section>
		</header>
		<div id="main" class="wrapper">