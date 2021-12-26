<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vladpitomnik
 */
define("TURI",     get_template_directory_uri().'/');
//if(!is_front_page()){echo 'white';}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php language_attributes(); ?>">
	<title><?php bloginfo( 'name' ); ?></title>
	<meta name="description" content="Startup HTML template OptimizedHTML 5">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="icon" href="<?=TURI?>/images/dist/f_logo.svg">
	<meta property="og:image" content="images/dist/preview.jpg">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div class="wrapper"><!-- strat wrapper -->
		<span class="elips-big"></span>
		<span class="elips-big-light"></span>
		<div class="container"><!-- start container -->
		<header class="header">
			<a href="/" class="logo"><img src="<?=TURI?>/images/dist/logo.svg" alt=""></a>
			<nav class="top_nav">
				<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container' 		 => false
							)
						);
				?>
			</nav>
			<ul class="contact_list">
				<li class="contact_list_item"><a data-phone="<?=get_theme_mod('phones')?>" href="tel:<?=get_theme_mod('phones')?>"><?=get_theme_mod('phones')?></a></li>
				<li class="contact_list_item"><a href="mailto:<?=get_theme_mod('email')?>"><?=get_theme_mod('email')?></a></li>
			</ul>
			<div class="burger">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<div class="nav_wrap_mob">
				<nav class="top_nav">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'container' 		 => false
							)
						);
					?>
				</nav>
			</div>
		</header>