<?
add_action('wp_ajax_single_news', 'single_news'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_single_news', 'single_news');
function single_news(){
		$singlePost = get_post($_POST['id']);
		?>
  <div class="news_single_bg" style="background-image: url(<?=get_template_directory_uri()?>/images/dist/logoBlue.svg);"></div>
  <div class="news_single_wrap">
    <div class="news_item">
      <div class="news_item_wrap">
        <div class="news_item_wrap_header">
          <div class="news_item_cat">Новости</div>
          <div class="news_item_date"><? dateModify($singlePost->post_date) ?></div>
          <div class="news_item_view"><i class="far fa-eye"></i> <?//= gt_get_post_view(); ?></div>
          <div class="news_item_print"><i class="fas fa-print"></i></div>
        </div>
        <h3 class="news_item_title"><?=$singlePost->post_title?></h3>
        <div class="news_item_content"><?=$singlePost->post_content?></div>
      </div>
      <div class="news_item_media" style="background-image: url('<?=get_the_post_thumbnail_url($singlePost->ID, 'large')?>');"></div>
      <div class="news_share">
        <p>Поделиться:</p>
        <ul id="menu-socicon" class="soc_icon">
          <li id="menu-item-21" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-21"><a data-soc="vk" data-purl="<?=$singlePost->guid?>" data-ptitle="<?=$singlePost->post_title?>" data-pimg,="<?=get_the_post_thumbnail_url($singlePost->ID, 'large') ?>" data-text="<?=$singlePost->post_excerpt?>"><i class="fab fa-facebook-f"></i></a></li>
          <li id="menu-item-19" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-19"><a data-soc="fb" data-purl="<?=$singlePost->guid?>" data-ptitle="<?=$singlePost->post_title?>" data-pimg,="<?=get_the_post_thumbnail_url($singlePost->ID, 'large') ?>" data-text="<?=$singlePost->post_excerpt?>"><i class="fab fa-vk"></i></a></li>
          <li id="menu-item-20" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20"><a data-soc="tw" data-purl="<?=$singlePost->guid?>" data-ptitle="<?=$singlePost->post_title?>" data-pimg,="<?=get_the_post_thumbnail_url($singlePost->ID, 'large') ?>" data-text="<?=$singlePost->post_excerpt?>"><i class="fab fa-twitter"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
<?die;} ?>