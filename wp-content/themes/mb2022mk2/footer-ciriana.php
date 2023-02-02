<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer black" role="contentinfo">
		<div class="back-to-top"><i class="fas fa-arrow-up"></i></div>
		<div id="cookies-info" class="cookies">
			<p>Strona korzysta z plików cookie.</p>
			<a onclick="cookiesAlertInfo()"><i class="fas fa-info-circle cookies-more-info"></i></a>
			<a onclick="cookiesClose()"><i class="fas fa-times-circle cookies-close"></i></a>
		</div>
	</footer><!-- #colophon -->
	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
