<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vladpitomnik
 */

?>
<div class="content_wrap">

<video width="674" height="674" class="video" loop="loop" autoplay="" muted="">
  <source src="#" type="video/mp4" />
  <source src="#" type="video/ogv" />
  <source src="<?=TURI?>/video/STelecomComposed_final_alpha.webm" type="video/webm" />
</video>

<main class="content">
  <h2 class="page_title title">Часто задаваемые вопросы</h2>
  <ol class="accardeon_list">
  <?
			$reviews = new WP_Query(
			array(
			'post_type' => 'supports',
			'post_status' => 'publish',
			'posts_per_page' => 50,
			'page'=> 1
			// 'category_name' => 'news'
			));
			
			if ($reviews->have_posts()) {
				$speed = 9;
				while ($reviews->have_posts()) {$reviews->the_post();
		?>
    <li class="accardeon_list_item">
      <h4 class="accardeon_list_item_title"><?the_title()?> <svg class="arrow" width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.58594 8.28906C6.9375 8.64062 7.52344 8.64062 7.875 8.28906L13.1875 2.97656C13.5781 2.58594 13.5781 2 13.1875 1.64844L12.3281 0.75C11.9375 0.398438 11.3516 0.398438 11 0.75L7.21094 4.53906L3.46094 0.75C3.10938 0.398438 2.52344 0.398438 2.13281 0.75L1.27344 1.64844C0.882812 2 0.882812 2.58594 1.27344 2.97656L6.58594 8.28906Z" fill="black"/>
        </svg></h4>
      <div class="accardeon_list_item_content"><?the_content()?></div>
    </li>
    <?}}?>
  </ol>
</main>
</div>