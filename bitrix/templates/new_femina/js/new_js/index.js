(function($) {
    /*слайдер на главной*/
	$( document ).ready(function() {


    $('.cooperation .tab.legal-person').click(
        function(){
            $('.tab.individual').removeClass('active');
            $(this).addClass('active');
            $('.box.individual').fadeOut(100).removeClass('active');
            $('.box.legal-person').fadeIn(300).addClass('active');
        });
        $('.cooperation .tab.individual').click(
        function(){
            $('.tab.legal-person').removeClass('active');
            $(this).addClass('active');
            $('.box.legal-person').fadeOut(100).removeClass('active');
            $('.box.individual').fadeIn(300).addClass('active');
        });

        $('footer .footer-wrap .footer-menu ul > li').click(
        function(){
			if($(window).width() < 976)
			{
				$(this).toggleClass('open');
				$(this).find('ul').slideToggle( "fast" );
			}
        }
    );
    $('footer .footer-wrap .footer-menu ul > li a').click(
        function(){
            event.stopPropagation();
        }
    );
})
    
})(jQuery);

