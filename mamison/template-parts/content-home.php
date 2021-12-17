<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vladpitomnik
 */

?>
	<section class="section_offer" id="offer">
    <div class="offer_bg one_bg paralax" data-speed="1.5" style="background-image: url(<?=TURI?>/images/dist/one_bg.png);"></div>
		<div class="offer_bg two_bg paralax" data-speed="2" style="background-image: url(<?=TURI?>/images/dist/two_bg.png);"></div>
		<div class="offer_bg tree_bg paralax" data-speed="3" style="background-image: url(<?=TURI?>/images/dist/tree_bg.png);"></div>
			<div class="offer_text">
			

				<p><?php bloginfo( 'description' ); ?></p>
				<h1><?php bloginfo( 'name' ); ?></h1>
				<div id="countdown" class="countdown" data-deadline="<?=date("2021-12-31 00:00:00")?>">
					<div class="countdown-number">
						<span class="days countdown-time"></span>
						<span class="countdown-text">Дней</span>
					</div>
					<div class="countdown-number">
						<span class="hours countdown-time"></span>
						<span class="countdown-text">Часов</span>
					</div>
					<div class="countdown-number">
						<span class="minutes countdown-time"></span>
						<span class="countdown-text">Минут</span>
					</div>
					<div class="countdown-number">
						<span class="seconds countdown-time"></span>
						<span class="countdown-text">Секунд</span>
					</div>
				</div>
				<a href="#news" class="btn">Посмотреть проект</a>
			</div>
			<div class="offer_footer">
				<?php
					wp_nav_menu(
						array(
							'theme_location' 	=> 'menu-socicon',
							'menu_id'        	=> 'menu-socicon',
							'menu_class'      => 'soc_icon',
						)
					);
				?>
				<span class="sd">Вся информация <i class="far fa-angle-double-down"></i></span>
				<!-- <div class="home_news">
					<h3 class="home_news_title">Последние новости</h3>
					<span class="notification"><i class="fal fa-exclamation-triangle"></i> В настоящее время сайт находится в стадии разработки</span>
					<ul class="home_news_list">
						<?
						$reviews = new WP_Query(
						array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => 3,
						// 'category_name' => 'news'
						));
						if ($reviews->have_posts()) {while ($reviews->have_posts()) {$reviews->the_post();
						?>
						<li class="home_news_item">
							<a class="home_news_item_link" href="<?the_permalink()?>" target="_blank" rel="noopener noreferrer">
								<div class="home_news_item_media" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);"></div>
								<div class="home_news_item_content">
									<div class="home_news_item_content_head">
										<p class="home_news_item_day_week"><?getDayWeek($reviews->post->post_date)?></p>
										<span class="home_news_item_date"><? dateModify($reviews->post->post_date)?></span>
									</div>
									<h3 class="home_news_item_title"><? the_title(); ?></h3>
								</div>
							</a>
						</li>
					<?}} else {echo 'Ничего не найдено';}wp_reset_postdata();?>
					</ul>
				</div> -->
			</div>
	</section>

	<section class="section_news" id="news">
		<div class="tabs">
			<ul class="tabs_list">
				<li class="tabs_item active" data-item="1"><span>НОВОСТИ</span> </li>
				<li class="tabs_item" data-item="2"><span>МЕДИА</span></li>
				<li class="tabs_item" data-item="3"><span>УЧАСТНИКИ</span></li>
				<li class="tabs_item" data-item="4"><span>КОНТАКТЫ</span></li>
			</ul>
			<ul class="tabs_content_wrap">
				<li class="tabs_content active" data-content="1">
					<h2 class="tabs_content_title">Последние новости.</h2>
					<div class="tabs_column_wrap">
						<div class="column_one">
							<div class="filter">
									<label class="filter_item_wrap">
										<input type="text" data-range="true" data-multiple-dates-separator=" - " class="datepicker-here filter_date datepicker-news"/>
										<i class="far fa-calendar"></i>
									</label>
									<label class="filter_item">
										<span>Сортировать по</span>
										<select class="filter_sort">
											<option value="date">Дате</option>s
											<option value="title">Названию</option>
										</select>
									</label>
								</div>
							<div class="home_news">
								<div class="news_list" data-action="<?php echo site_url ()?>/wp-admin/admin-ajax.php">
								<?
								$reviews = new WP_Query(
								array(
								'post_type' => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 4,
								'page'=> 1
								// 'category_name' => 'news'
								));
								if ($reviews->have_posts()) {while ($reviews->have_posts()) {$reviews->the_post();
								?>
								<div class="news_item">
									<div class="news_item_media" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);"></div>
										<div class="news_item_wrap">
											<div class="news_item_wrap_header">
												<div class="news_item_cat">Новости</div>
												<div class="news_item_date"><? dateModify($reviews->post->post_date) ?></div>
												<div class="news_item_view"><i class="far fa-eye"></i> 322</div>
											</div>
											<h3 class="news_item_title"><? the_title(); ?></h3>
											<div class="news_item_content">
												<? the_excerpt()?>
											</div>
											<!-- <a data-id="<?=get_the_ID()?>" class="news_item_more" href="<?the_permalink()?>" target="_blank" rel="noopener noreferrer">Читать далее <span class="arrow">→</span></a> -->
											<div data-url="<?php echo site_url ()?>/wp-admin/admin-ajax.php" data-id="<?=get_the_ID()?>" class="news_item_more">Читать далее <span class="arrow">→</span></div>
										</div>
									</div>
									<?}} else {echo 'Ничего не найдено';}wp_reset_postdata();?>
								</div>
								<?
								// текущая страница
								$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
								$total_post_count = wp_count_posts();
								$published_post_count = $total_post_count->publish;
								$total_pages = ceil( $published_post_count / $posts_per_page );
								if( $paged < $total_pages ) {
									echo '<div id="loadmore_gs" class="loadmore_btn" data-total_post="'.$published_post_count.'" data-total_pages="' . $total_pages . '" data-paged="' . $paged . '">
													Посмотреть еще
												</div>';
								}?>
							</div>
						</div>
						<div class="column_two">
							<div class="news_single">
							<div class="news_single_bg" style="background-image: url(<?=TURI?>/images/dist/logoBlue.svg);"></div>
							<?
								$reviews = new WP_Query(
								array(
								'post_type' => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 1,
								// 'category_name' => 'news'
								));
								if ($reviews->have_posts()) {while ($reviews->have_posts()) {$reviews->the_post();
								?>
								<div class="news_single_wrap">
									<div class="news_item">
										<div class="news_item_wrap">
											<div class="news_item_wrap_header">
												<div class="news_item_cat">Новости</div>
												<div class="news_item_date"><? dateModify($reviews->post->post_date) ?></div>
												<div class="news_item_view"><i class="far fa-eye"></i> 322</div>
												<div class="news_item_print"><i class="fas fa-print"></i></div>
											</div>
											<h3 class="news_item_title"><? the_title(); ?></h3>
											<div class="news_item_content"><? the_content()?>	</div>
										</div>
										<div class="news_item_media" style="background-image: url(<?=TURI?>/images/dist/pexels-tim-gouw-291732.jpg);"></div>
										<div class="news_share">
											<p>Поделиться:</p>
											<ul id="menu-socicon" class="soc_icon">
												<li id="menu-item-21" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21"><a data-soc="vk" data-purl="<?php the_permalink(); ?>" data-ptitle="<?php the_title(); ?>" data-pimg,="<?=get_the_post_thumbnail_url($post->ID, 'large') ?>" data-text="<? the_excerpt()?>"><i class="fab fa-facebook-f"></i></a></li>
												<li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19"><a data-soc="fb" data-purl="<?php the_permalink(); ?>" data-ptitle="<?php the_title(); ?>" data-pimg,="<?=get_the_post_thumbnail_url($post->ID, 'large') ?>" data-text="<? the_excerpt()?>"><i class="fab fa-vk"></i></a></li>
												<li id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20"><a data-soc="tw" data-purl="<?php the_permalink(); ?>" data-ptitle="<?php the_title(); ?>" data-pimg,="<?=get_the_post_thumbnail_url($post->ID, 'large') ?>" data-text="<? the_excerpt()?>"><i class="fab fa-twitter"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
								<?}} else {echo 'Ничего не найдено';}wp_reset_postdata();?>
							</div>
						</div>
					</div>
				</li>
				<li class="tabs_content" data-content="2">
					<h2 class="tabs_content_title">Фото и видео. </h2>
					<div class="tabs_column_wrap">
						<div class="column_one">
							<div class="filter">
								<label class="filter_item_wrap">
									<input type="text" data-range="true" data-multiple-dates-separator=" - " class="datepicker-here filter_date datepicker-gallery"/>
									<i class="far fa-calendar"></i>
								</label>
								<button class="filter_sort_btn"><i class="far fa-sort-size-down"></i></button>
							</div>
							<!-- begin galleri card slider -->
							<div class="stack_card">
								<ul class="stack_card_list" data-total="<?=wp_count_posts('gallery')->publish?>" data-url="<?php echo site_url ()?>/wp-admin/admin-ajax.php">
									<?
									$reviews = new WP_Query(
									array(
									'post_type' => 'gallery',
									'post_status' => 'publish',
									'posts_per_page' => 3,
									'orderby'=> 'ID',
									'order'=> 'DESC'
									));
									if ($reviews->have_posts()) {while ($reviews->have_posts()) {$reviews->the_post();
									?>
										<li class="stack_card_item" data-id="<?=get_the_ID()?>" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);">
											<span class="stack_card_item_date"><?=$reviews->post->post_date?></span>
											<h3 class="stack_card_item_text"><? the_title()?></h3>
										</li>
									<?}} else {echo 'Ничего не найдено';}wp_reset_postdata();?>
								</ul>	
								<div class="stack_card_actions">
									<span class="buttons prev"><i class="far fa-chevron-left"></i></span>
									<span class="buttons next"><i class="far fa-chevron-right"></i></span>
									<span id="loadmore_g" class="loadmore_btn">Посмотреть еще</span>
								</div>
							</div>
							<!-- end galleri card slider -->
						</div>
						<div class="column_two">
							<div class="gallery_single"></div>
						</div>
					</div>
				</li>
				<li class="tabs_content" data-content="3">
					<h2 class="tabs_content_title">Участники. </h2>
					<p class="tabs_content_text">Значимость этих проблем настолько очевидна, что консультация с широким активом позволяет выполнять важные задания по разработке модели развития. Разнообразный и богатый опыт постоянное информационно-пропагандистское обеспечение нашей деятельности способствует подготовки и реализации форм развития.</p>
					<div class="participant_list owl-carousel">
						<?
						$reviews = new WP_Query(
						array(
						'post_type' => 'participant',
						'post_status' => 'publish',
						'posts_per_page' => 999,
						'orderby'=> 'ID',
						'order'=> 'DESC'
						));
						if ($reviews->have_posts()) {while ($reviews->have_posts()) {$reviews->the_post();
							$cat= wp_get_object_terms( $post->ID, 'participant-cat' )[0]->name;
							// PR($cat)
						?>
						<div class="participant_item">
							<div class="participant_item_media" style="background-image: url(<?=TURI?>/images/dist/man.jpg);"></div>
							<div class="participant_item_content">
								<h3 class="participant_item_name">Георгий <b>Дударь</b></h3>
								<p class="participant_item_post"><?=$cat?></p>
							</div>
						</div>
						<?}} else {echo 'Ничего не найдено';}wp_reset_postdata();?>
					</div>
				</li>
				<li class="tabs_content" data-content="4">
					<h2 class="tabs_content_title">Контакты.</h2>
					<p class="tabs_content_text"></p>
					<div class="contact">
						<div class="contact_item">
							<h3 class="contact_item_title">Адрес:</h3>
							<div class="contact_item_content">
								<ul class="contact_list">
									<li><a href="#"><?=get_theme_mod('address')?></a></li>
								</ul>
							</div>
						</div>
						<div class="contact_item">
							<h3 class="contact_item_title">Телефон:</h3>
							<div class="contact_item_content">
								<ul class="contact_list">
									<li><a data-phone="<?=get_theme_mod('phones')?>" href="tel:<?=get_theme_mod('phones')?>"> <?=get_theme_mod('phones')?></a></li>
								</ul>
							</div>
						</div>
						<div class="contact_item">
							<h3 class="contact_item_title">E-mail:</h3>
							<div class="contact_item_content">
								<ul class="contact_list">
									<li><a href="email:<?=get_theme_mod('email')?>"> <?=get_theme_mod('email')?></a></li>
								</ul>
							</div>
						</div>
						<div class="contact_item">
							<h3 class="contact_item_title">Социальные сети:</h3>
							<div class="contact_item_content">
							<?php
								wp_nav_menu(
									array(
										'theme_location' 	=> 'menu-socicon',
										'menu_id'        	=> 'menu-socicon',
										'menu_class'      => 'soc_icon',
									)
								);
							?>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		
	</section>