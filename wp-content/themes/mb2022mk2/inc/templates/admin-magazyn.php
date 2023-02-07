<?php
$args = array(
    'post_type' => 'product',
    'posts_per_page' => 100,
    'post_status' => 'publish',
    'tax_query'   => array(
        array(
            'taxonomy'  => 'product_visibility',
            'terms'     => array( 'exclude-from-catalog' ),
            'field'     => 'name',
            'operator'  => 'NOT IN',
        )
    )
); ?>

<h1>Stany magazynowe</h1>
<style>
    table, th, td {
        border: 1px solid;
    }
</style>

<table>
    <thead>
    <tr>
        <th>Zdjęcie</th>
        <th>Nazwa</th>
        <th>Status</th>
        <th>Warianty</th>
    </tr>
    </thead>
 <?php
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) : $loop->the_post();
            wc_get_template_part('content', 'product_magazyn');
        endwhile;
    } else {
        echo __('No products found');
    }
    wp_reset_postdata();
    ?>
</table>
