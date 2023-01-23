<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NJDTS87');</script>
<!-- End Google Tag Manager -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145492556-5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-145492556-5');
</script>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NJDTS87"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header black" role="banner" style="<?php storefront_header_styles(); ?>">

		<?php
		/**
		 * Functions hooked into storefront_header action
		 *
		 * @hooked storefront_header_container                 - 0
		 * @hooked storefront_skip_links                       - 5
		 * @hooked storefront_social_icons                     - 10
		 * @hooked storefront_site_branding                    - 20
		 * @hooked storefront_secondary_navigation             - 30
		 * @hooked storefront_product_search                   - 40
		 * @hooked storefront_header_container_close           - 41
		 * @hooked storefront_primary_navigation_wrapper       - 42
		 * @hooked storefront_primary_navigation               - 50
		 * @hooked storefront_header_cart                      - 60
		 * @hooked storefront_primary_navigation_wrapper_close - 68
		 */
		//do_action( 'storefront_header' );

			//hamburgermenu

			//logo

			//language switcher
			//favourites
			//cart
			//facebook
			//instagram
		?>
		<?php
    	if ( is_active_sidebar( 'right-slide-out' ) && 0==1 ) : ?>
		<div class="slide-out-pane white">
			<div class="menu-wrap click right">
                <?php dynamic_sidebar( 'right-slide-out' ); ?>
			</div>
		</div>
    	<?php endif;?>
		<div class="header-row">
			<div class="header-col">
				<span class="toggle-button left">
					<div class="menu-bar menu-bar-top"></div>
					<div class="menu-bar menu-bar-middle"></div>
					<div class="menu-bar menu-bar-bottom"></div>
				</span>
				<?php do_action( 'menu_hidden'); ?>
			</div>
			<div class="header-col">
				<?php //storefront_site_title_or_logo(); ?>
				<a href="<?php echo get_site_url(); ?>" class="custom-logo-link" rel="home"><img width="276" height="67" src="/wp-content/uploads/2021/12/cropped-logo_final_poziom_white.png" class="custom-logo" alt="Marta Banaszek"></a>
			</div>
			<div class="header-col">		
				<!-- outputs a list of languages names -->
				<ul class="language-list d-none">
					<?php 
						//pll_the_languages(); 
						$translations = pll_the_languages( array( 'raw' => 1 ) );
						//var_dump($translations);
					?>
					<li><a class="underline" href="<? echo ($translations['pl']['url'])?>"><? echo ($translations['pl']['slug'])?></a></li>
					|
					<li><a class="underline" href="<? echo ($translations['en']['url'])?>"><? echo ($translations['en']['slug'])?></a></li>
				</ul>
				<?
				wp_nav_menu(
					array(
						'theme_location'  => 'secondary',
						'container_class' => 'secondary-navigation',
						'menu_class'	  => 'icon-list'
					)
				);
				?>
			</div>
		</div>

		


	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	//do_action( 'storefront_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full no-margin">

		<?php
		do_action( 'storefront_content_top' );
