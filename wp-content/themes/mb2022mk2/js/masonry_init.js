jQuery(document).ready(function( $ ) {
 

var grid = document.querySelector('#infinite-scroll');
var msnry;

imagesLoaded( grid, function() {
  // init Isotope after all images have loaded
  msnry = new Masonry( grid, {
    gutter: 0,
    fitWidth: true,
    horizontalOrder: true,
    itemSelector: '.item'
  });
});
      
  // trigger on window load
  $( window ).load( function() {
    msnry = new Masonry( grid, {
      gutter: 0,
      fitWidth: true,
      horizontalOrder: true,
      itemSelector: '.item'
    });
  });    

  $(document.body).on("post-load", function(e) {
    //var elements = $('.infinite-wrap.infinite-view-' + post_count_curr + ' article');
    msnry = new Masonry( grid, {
      gutter: 0,
      fitWidth: true,
      horizontalOrder: true,
      itemSelector: '.item'
    });

})
      


});