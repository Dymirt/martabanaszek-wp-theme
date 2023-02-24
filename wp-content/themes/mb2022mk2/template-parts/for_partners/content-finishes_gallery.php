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