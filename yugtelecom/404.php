<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package yugtelecom
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="not-found">
		<div class="error-404">
		<span class="error-4">4</span>
		<span class="error-0">
			<img class="travolta" src="<?= TURI ?>/images/dist/travolta.gif" alt="">
		</span>
		<span class="error-4">4</span>
		</div>
		<h1>Страница не найдена</h1>
	</section><!-- .error-404 -->
</main><!-- #main -->

<?php
get_footer();
