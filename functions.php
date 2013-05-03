<?php
add_action( 'after_setup_theme', 'erisible_setup' );
if ( ! function_exists( 'erisible_setup' ) ):
function erisible_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_editor_style();
	
	add_image_size('project-thumb', 400, 400, TRUE);
	add_image_size('small-thumb', 260, 162.5, TRUE);
	register_nav_menu( 'menu', 'Menu' );
	register_sidebar( array(
		'name' => 'Sidebar 1',
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Sidebar 2',
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer 1',
		'id' => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => sprintf( '<h3 class="widget-title"><a href="%1$s">',esc_url(get_permalink( get_page_by_path( 'blog' )))),
		'after_title' => '</a></h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer 2',
		'id' => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</a></h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer 3',
		'id' => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => sprintf( '<h3 class="widget-title"><a href="%1$s">',esc_url(get_permalink( get_page_by_path( 'projets' )))),
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => 'Footer 4',
		'id' => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
endif;
function create_custom_post_type() {
	
	$labels = array(
		'name' => 'Projets',
		'singular_name' => 'Projet',
		'menu_name' => 'Projets',
		'add_new' => 'Ajouter',
		'add_new_item' => 'Ajouter',
		'edit' => 'Modifier',
		'edit_item' =>'Modifier',
		'new_item' => 'Ajouter',
		'view' => 'Afficher',
		'view_item' => 'Afficher',
		'search_items' => 'Chercher dans les projets',
		'not_found' => 'Aucun projet trouvé',
		'not_found_in_trash' => 'Aucun projet trouvé dans la corbeille',
		'parent' => 'Projet parent',
	);
	$args = array(
		'label' => 'Projets',
		'description' => 'Projet',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'projet'),
		'query_var' => true,
		'has_archive' => true,
		'supports' => array('title',
							'editor',
							'excerpt',
							'thumbnail',
							),
		'labels' => $labels
	);
	
	register_post_type('project', $args);
	register_taxonomy_for_object_type('post_tag', 'project');
}

function custom_post_project_add_custom_box() {
    add_meta_box( 
        'progression',
        'Progression',
        'project_progression_custom_box',
        'project',
        'normal',
        'high'
    );
	
	add_meta_box(
		'url',
		'Url',
		'project_url_custom_box',
		'project',
		'normal',
		'high'
	);
	add_meta_box(
		'sources',
		'Sources',
		'project_sources_custom_box',
		'project',
		'normal',
		'high'
	);
}
function project_progression_custom_box( $post ) {

	// Use nonce for verification
	wp_nonce_field( plugin_basename( __FILE__ ), 'project_progression_nonce' );

	// The actual fields for data entry
	$progressiondata = get_post_meta($post->ID, 'progression', true) == '' ? 0 : get_post_meta($post->ID, 'progression', true);
	echo '<label for="progression" class="hide-if-no-js" style="visibility:hidden;">';
	echo 'Progression';
	echo '</label> ';
	echo '<p style="width:100%"><input type="number" id="progression" name="progression" value="'.$progressiondata.'" min="0" max="100" style="width:100px;margin-bottom:10px;"/>';
	echo '<progress value="'.$progressiondata.'" max="100" style="width:100%;"></progress></p>';
}
function project_url_custom_box($post) {
	wp_nonce_field(plugin_basename(__FILE__), 'project_url_nonce');
	$urldata = get_post_meta($post->ID, 'url', true);
	
	echo '<label for="url" class="hide-if-no-js" style="visibility:hidden;">';
	echo 'Url';
	echo '</label>';
	echo '<input type="url" id="url" name="url" value="'.$urldata.'" style="width:100%;" />';
}
function project_sources_custom_box($post) {
	wp_nonce_field(plugin_basename(__FILE__), 'project_sources_nonce');
	
	$sourcesdata = get_post_meta($post->ID, 'sources', true);
	echo '<label for="sources" class="hide-if-no-js" style="visibility:hidden;">';
	echo 'Sources';
	echo '</label>';
	echo '<input type="url" id="sources" name="sources" value="'.$sourcesdata.'" style="width:100%;" />';
}
function custom_post_project_save_postdata( $post_id, $post ) {
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !wp_verify_nonce( $_POST['project_progression_nonce'], plugin_basename( __FILE__ ) ) )
		return;
	else if (!wp_verify_nonce( $_POST['project_url_nonce'], plugin_basename( __FILE__ ) ) )
		return;
	else if (!wp_verify_nonce( $_POST['project_sources_nonce'], plugin_basename( __FILE__ ) ) )
		return;

	$post_type = get_post_type_object( $post->post_type );
	
	// Check permissions
	if ( $post_type == 'project' ) 
	{
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return;
	}

	// OK, we're authenticated: we need to find and save the data
	if (isset($_POST['progression']))
		update_post_meta($post_id, 'progression', absint(intval($_POST['progression'])));
	else
		update_post_meta($post_id, 'progression', 0);
	
	if (isset($_POST['url']))
		update_post_meta($post_id, 'url', esc_url($_POST['url']));
	
	if (isset($_POST['sources']))
		update_post_meta($post_id, 'sources', esc_url($_POST['sources']));
}

add_action('init', 'create_custom_post_type');
add_action( 'add_meta_boxes', 'custom_post_project_add_custom_box' );
add_action( 'save_post', 'custom_post_project_save_postdata', 10, 2 );

function erisible_nav_menu_css_class($classes, $item) {
	$cat = get_category(get_query_var('cat'))->term_id;
	$parent = get_term_by('name', 'productions', 'category')->term_id;
	
	if (is_category() && (!is_category('productions') && !cat_is_ancestor_of($parent, $cat)) && $item->title == "Blog") {
		$classes[] = "current-menu-item";
	}
	else if (cat_is_ancestor_of($parent, $cat) && $item->title == "Productions") {
		$classes[] = "current-menu-item";	
	}
	else if (get_post_type() == 'project' && $item->title == "Projets") {
		$classes[] = "current-category-ancestor";	
	}
	return $classes;
}

add_filter('nav_menu_css_class' , 'erisible_nav_menu_css_class' , 10 , 2);

function category_template_redirect() {
	if (is_category()) {
		$cat = get_category(get_query_var('cat'));
		$parent = get_category($cat->category_parent);
		
		if ( file_exists(TEMPLATEPATH . '/category-' . $cat->cat_ID . '.php') ) {
     		include( TEMPLATEPATH . '/category-' . $cat->cat_ID . '.php');
			exit;
    	}
		else if ( file_exists(TEMPLATEPATH . '/category-' . $cat->slug . '.php') ) {
     		include( TEMPLATEPATH . '/category-' . $cat->slug . '.php');
			exit;
    	}
		else if ( file_exists(TEMPLATEPATH . '/category-' . $parent->cat_ID . '.php') ) {
     		include( TEMPLATEPATH . '/category-' . $parent->cat_ID . '.php');
			exit;
    	}
		else if ( file_exists(TEMPLATEPATH . '/category-' . $parent->slug . '.php') ) {
     		include( TEMPLATEPATH . '/category-' . $parent->slug . '.php');
			exit;
    	} 
	}
}

add_action('template_redirect', 'category_template_redirect');

function erisible_pre_get_posts($query) {
	if(is_category() || is_tag()) {
		$post_type = $query->query_vars['post_type'];
		if($post_type)
			$post_type = $post_type;
		else
			$post_type = array('post','project');
		$query->set('post_type',$post_type);
		return $query;
	}
}

add_filter('pre_get_posts', 'erisible_pre_get_posts');

function erisible_excerpt_more( $more ) {
	return '... <a class="entry-readmore" href="'.get_permalink().'">Lire la suite</a>';
}

add_filter('excerpt_more', 'erisible_excerpt_more');

function erisible_excerpt_length( $length ) {
  global $post;
  
  if (is_home() && $post->post_type == 'post') {  
    return 20;
  }
  else {
    return 55;
  }
}

add_filter( 'excerpt_length', 'erisible_excerpt_length', 999 );

if (!function_exists('erisible_sharethis')):
function erisible_sharethis() {
?>
	<h4 class="share-title">Partager</h4><span st_via='erisible' st_username='erisible' class='st_twitter_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='twitter'></span><span class='st_plusone_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='plusone'></span><span class='st_email_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span><span class='st_tumblr_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='tumblr'></span><span class='st_sharethis_buttons' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='sharethis'></span>
<?php
}
endif;

if (!function_exists('get_nav_single')):
function get_nav_single() {
?>
<nav id="nav-single">
	<h3 class="assistive-text">Naviguer dans les articles</h3>
	<span class="nav-previous"><?php previous_post_link( '%link', '<span>&larr; Précédent</span>' ); ?></span>
	<span class="nav-next"><?php next_post_link( '%link', '<span>Suivant &rarr;</span>' ); ?></span>
</nav>
<?php
}
endif;

if ( ! function_exists( 'erisible_content_nav' ) ) :
function erisible_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h3 class="assistive-text">Naviguer dans les pages</h3>
			<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Précédent' ); ?></div>
			<div class="nav-next"><?php previous_posts_link( 'Suivant <span class="meta-nav">&rarr;</span>'); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif;

if ( ! function_exists( 'erisible_comment' ) ) :
function erisible_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p>Pingback: <?php comment_author_link(); ?><?php edit_comment_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta">
				<div class="comment-author">
					<?php
						$avatar_size = 150;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 100;

						/* translators: 1: comment author, 2: date and time */
						printf('%1$s %2$s ',
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a class="comment-date" href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( '%1$s à %2$s', get_comment_date(), get_comment_time() )
							)
						);

					?>

					<?php edit_comment_link( 'Éditer', '<span class="edit-link">', '</span>' ); ?>
				</div>
				
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, $avatar_size ); ?>				
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation">Votre commentaire est en attente de modération.</em>
					<br />
				<?php endif; ?>

			</header>

			<div class="comment-content article-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Répondre', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</article>

	<?php
			break;
	endswitch;
}
endif;

function erisible_body_classes( $classes ) {
	
	if(is_home())
		$classes = array_diff($classes, array("blog"));
	
	if(is_page('blog') )
		$classes[] = 'blog';
	
	if(is_page('projets'))
		$classes[] = 'projects';
	
	if(is_page('contact'))
		$classes[] = 'contact';

	return $classes;
}

add_filter( 'body_class', 'erisible_body_classes' );

function erisible_post_classes($classes) {
	global $currentday, $previousday;
	
	if ( $currentday != $previousday && (!is_page() || is_page('blog')))
		$classes[] = 'with-date';
	return $classes;
}

add_filter( 'post_class', 'erisible_post_classes' );

if (!function_exists('follow_me')):
function follow_me() {
?>
<aside class="widget widget-follow">
	<h3 class="widget-title">
		<span>Me suivre</span>
	</h3>
		<ul>
			<li id="follow-twitter">
				<a href="http://twitter.com/erisible" title="Me suivre sur Twitter"><span>Twitter</span></a>
			</li>
			<li id="follow-soundcloud">
				<a href="http://soundcloud.com/erisible" title="Me suivre sur Soundcloud"><span>Souncloud</span></a>	
			</li>
			<li id="follow-github">
				<a href="https://github.com/erisible" title="Me suivre sur Github"><span>Github</span></a>				
			</li>
			<li id="follow-feed">
				<a href="<?php bloginfo('rss2_url'); ?>" title="S'inscrire au flux RSS du site"><span>Feed</span></a>	
			</li>
		</ul>
</aside>
<?php
}
endif;

if (!function_exists('erisible_style')):
function erisible_init_style() {
	$time =  date('G', current_time('timestamp'));
	
	if (isset($_COOKIE['style'])) {
		return $_COOKIE['style'];
	}
	else if ($time >= 6 && $time < 22 ) {
		return 'light';
	}
	else {
		return 'dark';
	}
}
endif;

add_action('wp_syntax_init_geshi', 'erisible_syntax_init_geshi');

function erisible_syntax_init_geshi(&$geshi)
{	
	$geshi->set_keyword_group_style(1, 'color: #cda869;');
    $geshi->set_keyword_group_style(2, 'color: default; font-weight: bold;');
	$geshi->set_keyword_group_style(4, 'color: #cf6a4c;');

	$geshi->set_numbers_style('color: #cf6a4c;');

	$geshi->set_symbols_style('color: default;', false, 0);
	$geshi->set_symbols_style('color: default; font-weight: bold;', false, 1);

	$geshi->set_regexps_style(0, 'color: #7587a6;');

	$geshi->set_brackets_style('color: default;');
	$geshi->set_strings_style('color: #8f9d6a;');

	$geshi->set_escape_characters_style('color: #548fa0;', false, 0);
	$geshi->set_escape_characters_style('color: #548fa0;', false, 1);
	
	$geshi->set_comments_style(1, 'color: #808080; font-style: italic;');
	$geshi->set_comments_style(2, 'color: #808080; font-style: italic;');
	$geshi->set_comments_style(4, 'color: #808080; font-style: italic;');
	$geshi->set_comments_style('MULTI', 'display: hidden;');
	
	$geshi->set_highlight_lines_extra_style('background-color: #ffffff;');
}

function erisible_gallery_style() {
	global $post;
	$columns = intval($columns);
	return "<div id='gallery-id' class='gallery gallery-column-$columns'>";
}

add_filter( 'use_default_gallery_style', '__return_false' );

add_shortcode('wp_caption', 'erisible_img_caption_shortcode');
add_shortcode('caption', 'erisible_img_caption_shortcode');

function erisible_img_caption_shortcode($attr, $content = null) {	
	// New-style shortcode with the caption inside the shortcode with the link and image tags.
	if ( ! isset( $attr['caption'] ) ) {
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}
	}

	// Allow plugins/themes to override the default caption template.
	$output = apply_filters('img_caption_shortcode', '', $attr, $content);
	if ( $output != '' )
		return $output;

	extract(shortcode_atts(array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr));

	if ( 1 > (int) $width || empty($caption) )
		return $content;

	if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

	return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . ( (int) $width) . 'px">'
	. do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

?>