<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area frontpage">
		<main id="main" class="site-main" role="main">

			<section id="s1" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper h100">
				<? include('front-page_s1.php');?>
			</div>
			</section>
			<section id="s2a" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper h100">
				<? include('front-page_s2a.php');?>
			</div>
			</section>
			<section id="s2" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper">
				<? include('front-page_s2.php');?>
			</div>
			</section>

			<section id="s3" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper h100">
				<? include('front-page_s3.php');?>
			</div>
			</section>

			<section id="s4" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper">
				<? include('front-page_s4.php');?>
			</div>
			</section>
			
			<section id="s5" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper h100">
				<? include('front-page_s5.php');?>
			</div>
			</section>

			<section id="s6" class="fullpage" data-aos="fade-in" data-aos-duration="500">
			<div class="wrapper">
				<? include('front-page_s6.php');?>
			</div>
			</section>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
