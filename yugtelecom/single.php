<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package yugtelecom
 */

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?// $post = get_post(the_ID());?>
	<div class="news_detail_item">
		<div class="news_detail_item_header">
			<h3 class="news_detail_item_title"><? the_title() ?></h3>
			<span class="news_detail_item_date"><? dateModify($post->post_date) ?></span>
		</div>
		<div class="news_detail_item_content">
			<div class="news_detail_item_media" style="background-image: url(<?= get_the_post_thumbnail_url($post->ID, 'large') ?>);"></div>
			<div class="news_detail_item_desc"><? the_content() ?></div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
// get_sidebar();
get_footer();
