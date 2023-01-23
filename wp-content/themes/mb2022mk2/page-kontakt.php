<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Contact page
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area two-column">
		<main id="main" class="site-main" role="main" data-aos="fade-right" data-aos-duration="1000" data-aos-anchor-placement="top-center">

			<?php
			while ( have_posts() ) :
				the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		<aside data-aos="zoom-in" data-aos-duration="1000" data-aos-anchor-placement="top-center">

		<div id="map-canvas"></div>
		<script type="text/javascript"> 

    function initMap() {
      var geocoder;
      var map;
      geocoder = new google.maps.Geocoder();
      var latlng = new google.maps.LatLng(52.1340188, 21.0687654);
      var mapOptions = {
	    zoom: 12,
	    center: latlng,
	    scrollwheel: false
      }
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      
      var address = 'Bronikowskiego 53, Warszawa, Polska';
      geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);
	      var marker = new google.maps.Marker({
		      map: map,
		      position: results[0].geometry.location,
		      icon: '<?php echo get_stylesheet_directory_uri()?>/img/pin.png'
	      });
	    }
      });
      
					    
      var styles = [
	      {
		    featureType: "road",
		    elementType: "geometry",
		    stylers: [
		      { visibility: "simplified" }
		    ]
	      },{
		    featureType: "road",
		    elementType: "labels",
	      },{
		    featureType: "poi",
		    stylers: [
		      { visibility: "off" }
		    ]   
		  }
	    ];					
	    map.setOptions({styles: styles});					
    google.maps.event.addDomListener(window, 'load', initMap);
					      
    }
    $(document).ready(function() {
	    var counter = 0;
	    $(window).resize(function() {
		    if (counter>10) {
			    initMap();
			    var old = $(window).width();
			    counter = 0;
		    } else {
			    counter++;
		    }
	    });
    });
		</script>
		<script async defer
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDD1CSg3BKagWpMQeh9RtZgejIRnSS5KGs&callback=initMap">
	    </script>


		</aside>
	</div><!-- #primary -->

<?php
get_footer();
