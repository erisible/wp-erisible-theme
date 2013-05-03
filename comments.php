<div id="comments">
<?php if ( post_password_required() ) : ?>
	<p class="nopassword"Mot de passe requis.</p>
</div>
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
	<h4 id="comments-title">
		<?php
			if (get_comments_number() >= 1)
				echo get_comments_number();
			
			if (get_comments_number() == 1)
				echo ' <span>Commentaire</span>';
			else
				echo ' <span>Commentaires</span>';
		?>
	</h4>

	<ol class="commentlist">
		<?php
			wp_list_comments( array( 'callback' => 'erisible_comment' ) );
		?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		
	<?php  wp_paginate_comments(); ?>
	
	<?php endif; ?>

<?php
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
	<p class="nocomments">Commentaires fermés.</p>
<?php endif; ?>
<?php
$commenter = wp_get_current_commenter();
$comments_args = array(
	'fields' =>  array(
		'author' => '<p class="comment-form-author">' . '<label for="author">Nom </label><span class="required">(requis)</span>
		            <input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" aria-required="true" /></p>',
		'email'  => '<p class="comment-form-email"><label for="email">Email </label><span class="required">(requis)</span>
					<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" aria-required="true" /></p>',
		'url'    => '<p class="comment-form-url"><label for="url">Site web</label>' .
		            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>',
	),
	'comment_notes_before' => '',
	'label_submit' => 'Envoyer le commentaire',
);
comment_form($comments_args);
?>
</div>