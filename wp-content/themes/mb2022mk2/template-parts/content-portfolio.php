<?php if ( has_post_thumbnail() ) { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'medium_large' );?>
				<div class="overlay">
					<h2 class="alpha entry-title">
						<?php
						the_title();
						?>
					</h2>
				</div>
			</a>
			<?php
			do_action( 'storefront_post_content_after' );

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'storefront' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</article><!-- #post-## -->
<?php } ?>
