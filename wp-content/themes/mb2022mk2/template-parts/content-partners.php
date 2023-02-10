<?php
global $post;
$partner_url = get_post_meta($post->ID, 'partner_url', true);
if (has_post_thumbnail()) { ?>
    <div class="col">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <a href="<?php echo $partner_url; ?>">
                <img src="<?php the_post_thumbnail_url(); ?>"
                     style="object-fit: contain; aspect-ratio: 1/1; width: 100%;">
            </a>
        </article><!-- #post-## -->
    </div>
<?php } ?>
