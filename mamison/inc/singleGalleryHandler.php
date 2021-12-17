<?
add_action('wp_ajax_single_gallery', 'single_gallery'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_single_gallery', 'single_gallery');
function single_gallery(){
		$singlePost = get_post($_POST['id']);
    preg_match('~=(.*?)]~', $singlePost->post_content, $output);
    preg_match('~ids="(.*?)"~', explode(" ", $output[1])[2], $ids);
    $array = explode(",", $ids[1]);
    $custom = get_post_custom($singlePost->ID);
	  $video    = explode(',',$custom["gallery"][0]);
    $elArr = array();
    foreach($array as $key => $id){
      $imgUrl = wp_get_attachment_image_src($id, 'large')[0];
      $elArr[] = '<div class="gallery_item"><a title="'.$singlePost->post_title.'" class="popup-image" href="'.$imgUrl.'"><div class="gallery_item_media" style="background-image: url('.$imgUrl.')"></div></a></div>';
    }
    foreach($video as $key=>$vd){
        if($vd != ''){
          $elArr[] = '<div class="gallery_item"><a title="'.$singlePost->post_title.'" class="popup-youtube" href="http://www.youtube.com/watch?v='.$vd.'"><div class="gallery_item_media videobg" style="background-image: url(https://img.youtube.com/vi/'.$vd.'/0.jpg)"></div><i class="fal fa-play-circle"></i></a></div>';
        }
    }
		?>
    <?
    foreach($elArr as $key => $el){
      echo $el;
    }
    ?>
<?die;} ?>