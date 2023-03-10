<?php
/**
 * The loop template file.
 */

// Post types
$partners = 'partners';
$portfolio = 'portfolio';
$blog = 'blog';
$post_type = get_post_type();

$args = array(
    'post_type' => $post_type,
);

if ($post_type !== 'post'):
    $args['posts_per_page'] = -1;
    if ($post_type === $partners):
        $args['orderby'] = 'rand';
    endif;

endif;
$query = new WP_Query($args);

if ($query->have_posts()) :
    do_action('storefront_loop_before');

    echo('<div id="infinite-scroll" class="container flex row" style="justify-content: space-between; margin: auto">');

    while ($query->have_posts()) :
        $query->the_post();

        if (get_post_type() === 'portfolio' || get_post_type() === 'blog' || get_post_type() === 'post') {
            get_template_part('template-parts/content', 'post');
        } elseif ($post_type === 'partners') {
            get_template_part('template-parts/content', 'partners');
        } else {
            get_template_part('template-parts/content', 'single');
        }

    endwhile;

    echo('</div>');
else :
    get_template_part('content', 'none');

endif;
