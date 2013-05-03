<?php
/*
YARPP Template: Erisible
Description: This template returns the related posts as a comma-separated list.
Author: Erisible
*/
?>
<?php if (have_posts()): ?>
<h4>Articles similaires</h4>
  <div class="related-posts">
    <?php while (have_posts()) : the_post(); ?>
      <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="related-entry"> 
        <span class="related-thumb">
          <?php if (has_post_thumbnail()) :?>
            <?php the_post_thumbnail('small-thumb') ?>
          <?php else: ?>
            <img width="260" height="162" src="<?php echo get_template_directory_uri(); ?>/images/no-thumb-<?php echo erisible_init_style(); ?>.png" class="no-thumb" />
          <?php endif; ?>
        </span>
        <span class="related-title">
          <?php the_title(); ?>          
        </span>
      </a>
    <?php endwhile; ?>
  </div>
<?php endif; ?>