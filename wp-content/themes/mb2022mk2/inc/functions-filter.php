<?php
function mb_offcanvas_right_init()
{
    register_sidebar(array(
        'name' => 'Filter',
        'id' => 'right-slide-out',
        'class' => 'right-slide-out menu-wrap',
        'before_widget' => '<div class="menu-sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'mb_offcanvas_right_init');
function addFilterButton()
{
    ?>
        <div>
            <button style="background-color: black; border: none; justify-self: end;" class="btn btn-dark" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fas fa-filter"></i> Filtry
            </button>
        </div>
    <?php
}
add_action('woocommerce_archive_description', 'addFilterButton', 31);

function addFilterOffcanvas()
{
    ?>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header" style="padding: 24px 24px 12px 24px">
            <?php woocommerce_catalog_ordering(); ?>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="padding: 0 24px">
            <?php
            dynamic_sidebar('right-slide-out');
             ?>
        </div>
    </div>
    <?php
}

add_action('woocommerce_before_shop_loop', 'addFilterOffcanvas', 40);
