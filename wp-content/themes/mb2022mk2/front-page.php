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

            <!-- Video Section -->
            <section class="fullpage" data-aos="fade-in" data-aos-duration="500">
                <div class="wrapper">
                    <div class="video-overlay"></div>
                    <video class="bg-video"
                           id="video1"
                           autoplay='false'
                           loop
                           muted
                           playsinline
                           data-src-desktop="<?php echo get_stylesheet_directory_uri() ?>/img/s1/marta_desktop.mp4"
                           data-src-mobile="<?php echo get_stylesheet_directory_uri() ?>/img/s1/marta_mobile.mp4">
                    </video>
                </div>
            </section>
            <!-- End Video Section -->

            <section id="s2" class="fullpage " data-aos="fade-in" data-aos-duration="500">
                    <?php include('front-page_s2.php'); ?>
            </section>

            <!-- Video Section -->
            <section class="fullpage" data-aos="fade-in" data-aos-duration="500">
                <div class="wrapper">
                    <div class="video-overlay"></div>
                    <video class="bg-video"
                           id="video2"
                           autoplay='false'
                           loop
                           muted
                           playsinline
                           data-src-desktop="<?php echo get_stylesheet_directory_uri() ?>/img/s2/chapter4_25fps.mp4"
                           data-src-mobile="<?php echo get_stylesheet_directory_uri() ?>/img/s2/chapter4_25fps.mp4">
                    </video>
                    <div class="overlay caption">
                        <h5>Chapter 4</h5>
                        <h1>2022</h1>
                        <a href="https://www.youtube.com/watch?v=m3RFWaTWE_s">
                            <button class="black">Zobacz więcej</button>
                        </a>
                    </div>
                </div>
            </section>
            <!-- End Video Section -->

            <section id="s4" class="fullpage" data-aos="fade-in" data-aos-duration="500">
                <div class="wrapper">
                    <?php include('front-page_s4.php'); ?>
                </div>
            </section>

            <!-- Video Section -->
            <section class="fullpage" data-aos="fade-in" data-aos-duration="500">
                <div class="wrapper">
                    <video class="bg-video"
                           id="video3"
                           autoplay='false'
                           loop
                           muted
                           playsinline
                           data-src-desktop="<?php echo get_stylesheet_directory_uri() ?>/img/s3/chapter2_2.mp4"
                           data-src-mobile="<?php echo get_stylesheet_directory_uri() ?>/img/s3/chapter2_2.mp4">
                    </video>
                    <div class="overlay caption">
                        <h5>Chapter 2</h5>
                        <h1>AW 2019/20</h1>
                        <a href="/sklep/">
                            <button class="black">Zobacz więcej</button>
                        </a>
                    </div>
                </div>
            </section>
            <!-- End Video Section -->

            <section id="s6" class="fullpage" data-aos="fade-in" data-aos-duration="500">
                <div class="wrapper">
                    <?php include('front-page_s6.php'); ?>
                </div>
            </section>

            <!-- Video Section -->
            <section class="fullpage" data-aos="fade-in" data-aos-duration="500">
                <div class="wrapper">
                    <div class="video-overlay"></div>
                    <video class="bg-video"
                           id="video4"
                           autoplay='false'
                           loop
                           muted
                           playsinline
                           data-src-desktop="<?php echo get_stylesheet_directory_uri() ?>/img/s5/martaaneta.mp4"
                           data-src-mobile="<?php echo get_stylesheet_directory_uri() ?>/img/s5/martaaneta.mp4">
                    </video>
                </div>
            </section>
            <!-- End Video Section -->


        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
