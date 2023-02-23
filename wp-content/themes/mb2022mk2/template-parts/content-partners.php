<?php
global $post;
$partner_url = get_post_meta($post->ID, 'partner_url', true);
if (has_post_thumbnail()) { ?>
    <div class="" style="flex: 0 0 auto; width: 11.111%;}">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 0">
            <a href="<?php echo $partner_url; ?>">
                <img src="<?php the_post_thumbnail_url(); ?>"
                     style="object-fit: contain; aspect-ratio: 1/1; width: 100%;">
            </a>
        </article><!-- #post-## -->
    </div>
<?php } ?>
