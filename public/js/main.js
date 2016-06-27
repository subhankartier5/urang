$(document).ready(function() {
var stickyNavTop = $('.top-header').offset().top;

 
var stickyNav = function(){
var scrollTop = $(window).scrollTop();
//console.log(scrollTop);
      
// if (scrollTop > stickyNavTop) { 
//     $('.top-header').addClass('fixed');
//     $('.fixed .logo img').attr('src','images/logo-white.png');
// } else {
//     $('.top-header').removeClass('fixed');
//     $('.header-bar .logo img').attr('src','images/logo.png'); 
// }

if(scrollTop >= 1540){
	$('.move').css("right","0");
}
};



 
stickyNav();
 
$(window).scroll(function() {
    stickyNav();
    if ($(this).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
});

//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
});