<?
add_action('wp_ajax_galleryFilter', 'gallery_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_galleryFilter', 'gallery_filter_function');
 
function gallery_filter_function(){
		$dateFrom = $_POST['dateFrom'] ? date_format(new DateTime($_POST['dateFrom']), 'Y-m-d') : '';
		$dateTo = $_POST['dateTo'] ? date_format(new DateTime($_POST['dateTo']), 'Y-m-d') : '';
		$args = array(
			'post_type' => 'gallery',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'orderby'=> 'ID',
			'order'=> 'DESC'
		);
		if($dateFrom && !$dateTo){
			$date = explode('-', $dateFrom);
			$args['date_query'] = array(
				array(
					'year'  => $date[0],
					'month' => $date[1],
					'day'   => $date[2],
				)
			);
		}
		if($dateFrom && $dateTo){
			$args['date_query'] = array(
				'before' => $dateTo,
				'after' => $dateFrom,
				'inclusive' => true,
				// 'compare'   => 'BETWEEN'
			);
		}

		$reviews = new WP_Query($args);
		if ($reviews->have_posts()) {while ($reviews->have_posts()) {
			$reviews->the_post();
			?>
			<li data-url="<?php echo site_url ()?>/wp-admin/admin-ajax.php" class="stack_card_item" data-id="<?=get_the_ID()?>" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);">
				<span class="stack_card_item_date"><?=$reviews->post->post_date?></span>
				<h3 class="stack_card_item_text"><? the_title()?></h3>
			</li>
			<?
			}
		} else {
			echo 'Ничего не найдено';
		}
			wp_reset_postdata();
		die();
}
?>