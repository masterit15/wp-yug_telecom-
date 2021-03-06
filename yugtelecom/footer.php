<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package yugtelecom
 */

?>

				</div><!-- end container -->
      </div><!-- end wrapper -->
      <footer class="footer">
        <div class="container"><!-- start container -->
          <div class="row">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
					<img src="<?=TURI?>/images/dist/f_logo.svg" alt="">
				</a>
				<?php
				$ul = '<ul id="%1$s" class="%2$s">%3$s
								<li class="menu-item">
									<a href="#">Контакты</a>
									<ul class="sub-menu">
										<li><a href="/">'.get_theme_mod('address').'</a></li>
										<li><a data-phone="'.get_theme_mod('phones').'" href="tel:'.get_theme_mod('phones').'"> '.get_theme_mod('phones').'</a></li>
										<li><a href="mailto:'.get_theme_mod('email').'">'.get_theme_mod('email').'</a></li>
										<li><a href="#">'.get_theme_mod('operating_mode').'</a></li>

                    
									</ul>
								</li>
							</ul>';
					wp_nav_menu(
						array(
							'theme_location' 	=> 'menu-footer',
							'menu_id'        	=> 'footer_menu',
							'menu_class' 			=> 'footer_list',
							'container' 			=> false,
							'items_wrap' => $ul
						)
					);
				?>
      </div>
        </div>
      </footer>
      <div class="cophyright"><?=get_theme_mod('copyright')?></div>
      <ul class="social">
        <li>
          <a href="<?=get_theme_mod('soc_vk')?>" target="_black">
            <svg width="20" height="12" xmlns="http://www.w3.org/2000/svg">
              <path d="M19.16 1.398c.106-.421 0-.773-.633-.773h-2.074c-.527 0-.773.281-.914.598 0 0-1.055 2.566-2.531 4.254-.492.457-.703.632-.985.632-.105 0-.316-.175-.316-.597V1.398c0-.527-.14-.773-.598-.773H7.875c-.352 0-.527.246-.527.492 0 .492.738.598.808 2.004V6.18c0 .668-.105.808-.386.808-.704 0-2.391-2.601-3.41-5.554C4.147.87 3.936.625 3.41.625H1.336c-.563 0-.703.281-.703.598 0 .562.703 3.27 3.27 6.89 1.722 2.461 4.148 3.762 6.327 3.762 1.301 0 1.477-.281 1.477-.773 0-2.356-.105-2.602.527-2.602.317 0 .844.176 2.075 1.371 1.406 1.406 1.652 2.004 2.425 2.004h2.075c.597 0 .878-.281.703-.879-.387-1.195-3.024-3.726-3.164-3.902-.317-.387-.211-.563 0-.914 0 0 2.53-3.586 2.812-4.782z"/>
            </svg>
          </a>
        </li>
        <li>
          <a href="<?=get_theme_mod('soc_inst')?>" target="_black">
            <svg width="17" height="17" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.875 4.207A4.044 4.044 0 004.832 8.25a4.021 4.021 0 004.043 4.043 4.044 4.044 0 004.043-4.043c0-2.215-1.828-4.043-4.043-4.043zm0 6.68A2.633 2.633 0 016.238 8.25c0-1.441 1.16-2.602 2.637-2.602a2.596 2.596 0 012.602 2.602c0 1.477-1.16 2.637-2.602 2.637zm5.133-6.82a.945.945 0 00-.95-.95.945.945 0 00-.949.95c0 .527.422.949.95.949a.946.946 0 00.949-.95zm2.672.949c-.07-1.266-.352-2.391-1.266-3.305C14.5.797 13.375.516 12.11.445c-1.3-.07-5.203-.07-6.504 0C4.34.515 3.25.797 2.301 1.711c-.914.914-1.196 2.039-1.266 3.305-.07 1.3-.07 5.203 0 6.504.07 1.265.352 2.355 1.266 3.304.949.914 2.039 1.196 3.304 1.266 1.301.07 5.204.07 6.504 0 1.266-.07 2.391-.352 3.305-1.266.914-.949 1.195-2.039 1.266-3.304.07-1.301.07-5.204 0-6.504zm-1.688 7.875c-.246.703-.808 1.23-1.476 1.511-1.055.422-3.516.317-4.641.317-1.16 0-3.621.105-4.64-.317a2.665 2.665 0 01-1.512-1.511c-.422-1.02-.317-3.48-.317-4.641 0-1.125-.105-3.586.317-4.64a2.712 2.712 0 011.511-1.477c1.02-.422 3.48-.317 4.641-.317 1.125 0 3.586-.105 4.64.317.669.246 1.196.808 1.477 1.476.422 1.055.317 3.516.317 4.641 0 1.16.105 3.621-.317 4.64z"/>
            </svg>
          </a>
        </li>
        <li>
          <a href="<?=get_theme_mod('soc_fac')?>" target="_black">
            <svg width="16" height="17" xmlns="http://www.w3.org/2000/svg">
              <path d="M14.063.375H1.687C.739.375 0 1.148 0 2.063v12.374c0 .95.738 1.688 1.688 1.688h4.816v-5.344H4.289V8.25h2.215V6.352c0-2.18 1.3-3.41 3.27-3.41.984 0 1.968.175 1.968.175v2.145h-1.09c-1.09 0-1.441.668-1.441 1.37V8.25h2.426l-.387 2.531H9.21v5.344h4.852c.915 0 1.688-.738 1.688-1.688V2.063A1.71 1.71 0 0014.062.375z"/>
            </svg>
          </a>
        </li>
      </ul>
      <div id="toTop" title="web studio 302">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
      <style type="text/css">
        .toTop-st0{fill:#F64400;}
        .toTop-st1{fill:#F5D200;}
        .toTop-st2{fill:#FFFFFF;stroke:#E5E5E5;stroke-miterlimit:10;}
        .toTop-st3{fill:#444444;stroke:#E5E5E5;stroke-miterlimit:10;}
      </style>
      <g id="fire">
        <path class="toTop-st0" d="M199.6,314.3c66.7,3.4,129-9,153.8-33.9c38.9-38.9,41.4-90.7,6.1-126c-35.3-35.3-87.2-32.8-126,6.1
          C208.6,185.4,196.2,247.8,199.6,314.3"/>
        <path class="toTop-st1" d="M296.3,167.7c-10.4,10.4-15.5,36.4-14.1,64.1c27.8,1.4,53.8-3.8,64.1-14.1c16.2-16.2,17.2-37.8,2.5-52.5
          C334.1,150.5,312.5,151.5,296.3,167.7z"/>
      </g>
      <g id="roket" focusable="false">
        <g>
          <path class="toTop-st2" d="M9.6,504.4 M59.1,159.8l-47.7,95.4C10,258.5,9.1,262,9,265.6c0,12.8,10.4,23.2,23.2,23.2h90.2
            c22.6-45.8,58.9-119.1,75.2-151.9c0.5-0.9,1-1.7,1.5-2.6h-98.5C84.8,134.3,66.2,145.7,59.1,159.8z M377.2,316.3
            c-32.8,16.4-106.3,52.8-151.9,75.4V482c0.2,12.7,10.5,22.9,23.1,23c3.5-0.1,7-1,10.3-2.4l95.3-47.7c14.1-7.1,25.6-25.6,25.6-41.4
            v-98c0.1,0,0.1-0.1,0.2-0.1v-0.5C378.9,315.3,378.1,315.8,377.2,316.3z"/>
          <path class="toTop-st2" d="M496.7,29.5c-1.4-6-6.1-10.7-12.1-12.1c-31.3-6.7-56.2-6.7-80.3-6.7c-86.1,0-151.3,39.2-205.2,123.4
            c-0.5,0.9-1,1.8-1.6,2.8C181.3,169.6,145,243,122.4,288.7h10.2c51.2,0,92.7,41.5,92.7,92.7c0,0,0,0,0,0v10.3
            c45.6-22.6,119.1-59,151.9-75.4c0.9-0.5,1.8-1,2.7-1.5c84.2-54.1,123.4-119.2,123.4-205C503.4,85.6,503.5,61,496.7,29.5z
            M364.3,196c-25.6,0-46.3-20.7-46.3-46.3s20.7-46.3,46.3-46.3c25.6,0,46.3,20.7,46.3,46.3C410.6,175.3,389.9,196,364.3,196z"/>
        </g>
        <circle class="toTop-st3" cx="364.3" cy="149.7" r="45.4"/>
      </g>
      </svg>
      <span class="stars">
        <span class="star star-1"></span>
        <span class="star star-2"></span>
        <span class="star star-3"></span>
        <span class="star star-4"></span>
      </span>
      </div>
<?php wp_footer(); ?>
</body>
</html>
