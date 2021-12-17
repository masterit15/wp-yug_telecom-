<?
add_action('wp_ajax_newsFilter', 'news_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_newsFilter', 'news_filter_function');
function news_filter_function(){
		$sort = isset($_POST['sort']) ? $_POST['sort'] : 'date';
		$dateFrom = $_POST['dateFrom'] ? date_format(new DateTime($_POST['dateFrom']), 'Y-m-d') : '';
		$dateTo = $_POST['dateTo'] ? date_format(new DateTime($_POST['dateTo']), 'Y-m-d') : '';
		$paged = $_POST['current_page'] + 1;
		$ppp = isset($_POST['ppp']) ? $_POST['ppp'] : 4;
		$params = array(
			'sort'=>$sort,
			'dateFrom'=>$dateFrom,
			'dateTo'=>$dateTo,
			'paged'=>$paged,
		);
		$args = array(
			'orderby' => $sort, // we will sort posts by date
			'post_status' => 'publish',
			'posts_per_page'=> $ppp,
			'paged' => $paged
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
				<div class="news_item" data-ppp="<?=$ppp?>" data-page="<?=$paged?>">
				<div class="news_item_media" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);"></div>
					<div class="news_item_wrap">
						<div class="news_item_wrap_header">
							<div class="news_item_cat">Новости</div>
							<div class="news_item_date"><? dateModify($reviews->post->post_date) ?></div>
							<div class="news_item_view"><i class="far fa-eye"></i> <?= gt_get_post_view(); ?></div>
						</div>
						<h3 class="news_item_title"><? the_title(); ?></h3>
						<div class="news_item_content"><? the_excerpt()?></div>
						<div data-url="<?php echo site_url ()?>/wp-admin/admin-ajax.php" data-id="<?=get_the_ID()?>" class="news_item_more">Читать далее <span class="arrow">→</span></div>
					</div>
				</div>
				<?
			}?>
			<!-- <span class="params" data-params="<?//=join(',',$params)?>"></span> -->
		<?}
			wp_reset_postdata();
		die();
}
?>