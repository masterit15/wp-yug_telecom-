<?
add_action('wp_ajax_next_album', 'next_album'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_next_album', 'next_album');
function next_album(){
		$nextId = nextAlbum($_POST['id']);
		$post = get_post($nextId);
		?>
		<li class="stack_card_item first" data-id="<?=$post->ID?>" style="background-image: url(<?=get_the_post_thumbnail_url($post->ID, 'large')?>);">
			<span class="stack_card_item_date"><?=$post->post_date?></span>
			<h3 class="stack_card_item_text"><?=$post->post_title?></h3>
		</li>
<?

die;} ?>