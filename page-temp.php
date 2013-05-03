<!DOCTYPE html>
<html lang="fr-FR">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php bloginfo( 'name' ); ?></title>
<style>	
	@font-face {
	    font-family: 'SourceSansProLight';
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/SourceSansPro-Light-webfont.eot');
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/SourceSansPro-Light-webfont.eot?#iefix') format('embedded-opentype'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/SourceSansPro-Light-webfont.woff') format('woff'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/SourceSansPro-Light-webfont.ttf') format('truetype'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/SourceSansPro-Light-webfont.svg#SourceSansProLight') format('svg');
	    font-weight: normal;
	    font-style: normal;
	}
	
	body {
		background-color: #2a2a2a;
		color: #eeeeee;
		font-family: 'SourceSansProLight', Fallback, sans-serif;
		font-size: 1em;
	}
	#wrapper {
		max-width: 800px;
		width: 100%;
		margin: auto;
		padding-top: 13%;
		position: relative;
	}
	#logo {
		width: 100%;
		height: auto;
	}
	p {
		text-align: center;
		padding: 1em;
		font-family: 'SourceSansProLight';
		font-size: 2.8em;
		text-transform: uppercase;
		letter-spacing: -0.1em;
	}
</style>
<?php wp_head(); ?>
</head>
<body>
	<div id="wrapper">
		<img id="logo" src="<?php echo get_template_directory_uri(); ?>/images/erisible-logo_temp.png" alt="Érisible" title="Érisible"/>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</body>
</html>