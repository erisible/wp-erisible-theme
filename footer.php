</div><!-- #main -->
<footer id="footer" role="contentinfo">
	<div id="footer-above-wrap" class="wrapper">
		<a id="footer-show" href="#"><span>Ouvrir</span></a>
		<section id="footer-above">
		<?php
			dynamic_sidebar( 'sidebar-3' );
			dynamic_sidebar( 'sidebar-4' );
			dynamic_sidebar( 'sidebar-5' );
			dynamic_sidebar( 'sidebar-6' );
		?>
		</section>
	</div>
	<section id="footer-below">
		<div class="wrapper">
			<span id="credits">
				<a href="http://creativecommons.org/publicdomain/zero/1.0/" title="CC0 1.0">Licence Creative Commons zero</a> | 
				Site hébergé par <a href="http://www.ovh.com/" title="Hébergement et Solutions Internet">OVH</a> et propulsé par <a href="http://wordpress.org/" title="système de gestion de contenu wordpress">Wordpress</a>.
			</span>
			<a id="top" href="#main" title="Remonter"><span>Top</span></a>
		</div>
	</section>
</footer>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/mediabox.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/mediabox.css" />
<?php wp_footer() ?>
</div><!-- #page -->
</body>
</html>