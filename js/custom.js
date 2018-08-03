 var $= jQuery.noConflict();
 
// masornary layout in CAPABILITY section
var $grid = $('.grid').isotope({
  itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
 //columnWidth: '.grid-sizer',
  percentPosition: true,
  sortBy : 'random' 
});

$grid.imagesLoaded().progress( function() {
  $grid.isotope();
});

// filter items on button click
$('.filter-button-group').on( 'click', 'a', function(e) {
  e.preventDefault();
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});

 // scroll top
$('.top').hide();
$('body').append('<div href="#top" class="top" title="Scroll to Top">&uarr;</div>');
$(window).scroll(function() {
  if ($(this).scrollTop() > 100) $('.top').fadeIn(300);
  else $('.top').fadeOut();
});
$('.top').on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({ scrollTop: 0 }, 300, 'swing');
}); 



