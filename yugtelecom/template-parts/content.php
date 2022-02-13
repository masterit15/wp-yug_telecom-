<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yugtelecom
 */

?>
<article class="news_list_item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="news_list_item_media" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);"></div>
        <div class="news_list_item_content">
          <h3 class="news_list_item_title"><a href="<?=get_permalink()?>"><?the_title()?></a></h3>
          <div class="news_list_item_desc"><?the_excerpt()?></div>
          <span class="news_list_item_date"><? dateModify($reviews->post->post_date)?></span>
        </div>
      </article>

