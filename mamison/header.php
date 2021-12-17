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
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php language_attributes(); ?>">
	<title><?php bloginfo( 'name' ); ?></title>
	<meta name="description" content="Startup HTML template OptimizedHTML 5">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="icon" href="images/favicon.png">
	<meta property="og:image" content="images/dist/preview.jpg">
	<!-- <script src='https://www.google.com/recaptcha/api.js?render=6LcIQRobAAAAAJTkDMK6jAduINgRvPq-nB3jhKo4'></script> -->
	<?php wp_head(); ?>
	<?
	define("TURI",     get_template_directory_uri().'/');
	?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<header class="header <?if(!is_front_page()){echo 'white';}?>">
		<!-- <a href="<?//php echo esc_url( home_url( '/' ) ); ?>" class="logo">
			<?//$custom_logo__url = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )?>
			<img src="<?//=$custom_logo__url[0]?>" alt="">
		</a> -->
		<div id="mobnav">
			<span></span>
		</div>
		<a class="moblogo" href="#offer" data-section="#offer">
			<img src="<?=TURI?>/images/dist/moblogo.svg" alt="">
		</a>
		<div class="nav_wrap_mob">
			<nav class="top_nav">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
				?>
			</nav>
		</div>
		
			<nav class="top_nav">
			<ul class="menu">
				<li class="logo">
					<a href="#offer" data-section="#offer">
						<img src="<?= wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0] ?>" alt="">
						<span class="circle"></span>
					</a>
				</li>
			</ul>
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'top',
						)
					);
				?>
			</nav>
	</header>
	<div class="wrapper"><!-- begin wrapper -->