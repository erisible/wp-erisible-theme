<h4 id="comment-preview-title">Prévisualiser le commentaire</h4>

<article id="comment-preview" class="comment">
	<header class="comment-meta">
		<div class="comment-author">
			<span class="fn">COMMENT_AUTHOR</span>
			<a href="<?php the_permalink(); ?>#comment-preview">
				<time pubdate="" datetime="<?php echo date('c', current_time('timestamp')); ?>"><?php echo date_i18n('j F Y \à G\:i\:s', current_time('timestamp')); ?></time>
			</a>
		</div>
		<div class="comment-avatar">
			<img alt="" src="AVATAR_URL" class="avatar avatar-150 photo" height="150" width="150">
		</div>
	</header>

	<div class="comment-content article-content">COMMENT_CONTENT</div>

</article>
