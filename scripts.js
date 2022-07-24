(function($) {
 $(function() {
  $(window).scroll(function() {    
var scroll = $(window).scrollTop();
 //console.log(scroll);
if (scroll >= 50) {
    //console.log('a');
    $(".site-header").addClass("sticky");
$('.scroll-top').fadeIn();
} else {
    //console.log('a');
    $(".site-header").removeClass("sticky");
$('.scroll-top').fadeOut();
}
});
 });
})(jQuery);