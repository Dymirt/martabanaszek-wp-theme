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
    <div id="carouselExampleCaptions" class="carousel slide" style="margin-bottom: 60px;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner" style="height: 50vh;">
            <style>
                h1, p {
                    color: white;
                }
            </style>
            <div class="carousel-item active h-100">
                <img src="https://martabanaszek.pl/wp-content/uploads/2023/01/Marta-Banaszek-scaled.jpg" class="d-block w-100 h-100" alt="..." style="object-fit:cover ">
                <div class="carousel-caption d-none d-md-block" style="background-color: black; opacity: 0.9;">
                    <h1>First slide label</h1>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item  h-100">
                <img src="..." class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block" >
                    <h1>Third slide label</h1>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
        <div class="container content-wrapper content-offer">
            <div class="photo-with-text right">
                <div class="photo"><img src="https://martabanaszek.pl/wp-content/uploads/2023/01/Marta-Banaszek-scaled.jpg" alt=""></div>
                <div class="text">
                    <div class="desc">
                        <div class="content">
                            <h2>Krok I</h2>
                            <h3>Wybór tkaniny</h3>
                            <p>Na początku zaczynasz od wybrania tkaniny. Korzystając z naszej wiedzy znajdziesz materiał, który będzie Ci najbardziej odpowiadał pod względem kolorystycznym oraz ze względu na właściwości techniczne (gniecenie się, gramatura, przewiewność, skład). Weźmiemy pod uwagę sytuacje, w których ubranie musi się sprawdzać i zaproponujemy najlepsze rozwiązanie. Ostateczna decyzja należy do Ciebie, ale niezależnie od tego, czy będzie to garnitur ślubny granatowy, czy smoking ślubny, pomożemy w wyborze.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container content-wrapper content-offer">
                <div class="photo-with-text left">
                    <div class="photo"><img src="https://buczynski-tailoring.pl/wp-content/uploads/2021/12/szycie-garniturow-na-miare-poznan-warszawa-najlepsze-tkaniny3.webp" alt=""></div>
                    <div class="text">
                        <div class="desc">
                            <div class="content">
                                <h2>Krok I</h2>
                                <h3>Wybór tkaniny</h3>
                                <p>Na początku zaczynasz od wybrania tkaniny. Korzystając z naszej wiedzy znajdziesz materiał, który będzie Ci najbardziej odpowiadał pod względem kolorystycznym oraz ze względu na właściwości techniczne (gniecenie się, gramatura, przewiewność, skład). Weźmiemy pod uwagę sytuacje, w których ubranie musi się sprawdzać i zaproponujemy najlepsze rozwiązanie. Ostateczna decyzja należy do Ciebie, ale niezależnie od tego, czy będzie to garnitur ślubny granatowy, czy smoking ślubny, pomożemy w wyborze.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container">
        Image gallery
    </div>
        <div class="container">
            <h2 style="text-align: center; color: white;">Wykończenia</h2>
            <?php
            $args = array(
                'post_type' => 'attachment',
                'post_mime_type' => 'image',
                'post_status' => 'inherit',
                'posts_per_page' => 100,
                'orderby' => 'rand',
                's' => '#forpartnersfinishes',
            );
            $query_images = new WP_Query($args);
            $images = array();
            foreach ($query_images->posts as $image) {
                $images[] = $image->ID;
            }
            $gallery_shortcode = '[gallery ids="' . implode(", ", $images) . '" size="large"  link="file"]';
            echo do_shortcode($gallery_shortcode); ?>
        </div>
    <div>
        Looks
    </div>




<?php
//do_action( 'storefront_sidebar' );
get_footer();
