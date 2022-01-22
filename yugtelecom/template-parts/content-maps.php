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
  <main class="content">
    <h2 class="page_title title">Карта покрытия сети</h2>
    <?
    if(current_user_can( 'edit_page')){?>
    <div class="map_actions">
      <button class="edit_polygon">Редактировать</button>
      <button class="add_polygon">Добавить</button>
    </div>
    <div class="map_actions_message"></div>
    <?}?>
    <script>
      const mapPoligons = '<?=get_theme_mod('maps')?>'
    </script>
    <div id="y_maps" data-action="<?php echo site_url ()?>/wp-admin/admin-ajax.php"></div>
  </main>
</div>