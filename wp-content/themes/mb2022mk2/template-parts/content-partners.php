<?php
global $post;
$partner_url = get_post_meta($post->ID, 'partner_url', true);
if (has_post_thumbnail()) { ?>
    <div class="partner_logo">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 0">
            <a href="<?php echo $partner_url; ?>" target="_blank">
                <img src="<?php the_post_thumbnail_url(); ?>">
            </a>
        </article><!-- #post-## -->
    </div>
<?php } ?>
