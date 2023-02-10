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
function addFilterSidebar()
{
    ?>
        <div style="display: inline-grid">
            <button style="background-color: black; border: none; justify-self: end;" class="btn btn-dark" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fas fa-filter"></i> Filtry
            </button>
        </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="staticBackdropLabel">
                Filtry
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php dynamic_sidebar('right-slide-out'); ?>
        </div>
    </div>
    <?php
}
add_action('woocommerce_before_shop_loop', 'addFilterSidebar', 40);