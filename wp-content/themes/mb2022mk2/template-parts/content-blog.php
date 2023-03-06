<?php
/**
 * Template used to display post content.
 *
 * @package storefront
 */

?>

<?php $thumbnail_url = get_the_post_thumbnail_url(); ?>

<div id="post-<?php the_ID(); ?>" class="card" style="padding: 0; width: 32%; margin-bottom: 1rem">
    <img src="<?php echo $thumbnail_url; ?>" class="card-img-top" alt="..." style="aspect-ratio: 6/4; object-fit: cover">
    <div class="card-body">
        <?php
        if ( is_single() ) {
            the_title( '<h5 class="card-title" style="text-transform: uppercase">', '</h5>' );
        } else {
            the_title( sprintf( '<h5 class="card-title" style="text-transform: uppercase"><a class="underline" href="%s" rel="bookmark" style="font-size: initial">', esc_url( get_permalink() ) ), '</a></h5>' );
        }?>
        <p class="card-text">
            <?php the_excerpt();?>
            <a class="read-more underline" href="<?php the_permalink() ?>"><?php echo __('Read more');?></a>
        </p>
    </div>
    <div class="card-footer">
        <small class="text-muted"><?php the_date();?></small>
    </div>
</div>
