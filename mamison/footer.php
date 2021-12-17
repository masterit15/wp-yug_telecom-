<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vladpitomnik
 */
?>
		</div><!-- end wrapper -->
		<footer class="footer" id="footer">
			<div class="footer_wrap">
			<div class="footer_start">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
				<img src="<?=TURI?>/images/dist/logoBlue.svg" alt="">
			</a>
			<?php
					wp_nav_menu(
						array(
							'theme_location' 	=> 'menu-socicon',
							'menu_id'        	=> 'menu-socicon',
							'menu_class'      => 'soc_icon',
						)
					);
				?>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu-2',
						)
					);
				?>
			</div>
			<div class="footer_end">
			<h3 class="contact_list_title">Офис:</h3>
			<div class="textwidget custom-html-widget">
				<ul class="contact_list">
					<li><a href="#"><?=get_theme_mod('address')?></a></li>
				</ul>
			</div>
			<h3 class="contact_list_title">Телефон:</h3>
			<div class="textwidget custom-html-widget">
				<ul class="contact_list">
					<li><a data-phone="<?=get_theme_mod('phones')?>" href="tel:<?=get_theme_mod('phones')?>"> <?=get_theme_mod('phones')?></a></li>
				</ul>
			</div>
			</div>
			</div>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-privacy-policy',
						'menu_id'        => 'privacy-policy',
					)
				);
			?>
			<div class="copyright"><?=get_theme_mod('copyright')?></div>
		</footer>
		
	<?php wp_footer(); ?>
</body>
</html>
