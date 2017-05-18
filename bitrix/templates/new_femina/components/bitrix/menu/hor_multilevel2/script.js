/*var jshover = function()
{
	var menuDiv = document.getElementById("horizontal-multilevel-menu")
	if (!menuDiv)
		return;

	var sfEls = menuDiv.getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) 
	{
		sfEls[i].onmouseover=function()
		{
			this.className+=" jshover";
		}
		sfEls[i].onmouseout=function() 
		{
			this.className=this.className.replace(new RegExp(" jshover\\b"), "");
		}
	}
}
*/
$(document).ready( function() {
	
	$('ul#horizontal-multilevel-menu li.contains').hover(
		function() {
			$e=$(this);
			interval = setTimeout(function(){
					//$e.find('ul').eq(0).slideDown(300);
					$e.find('ul').eq(0).css('display', 'flex');
			}, 200);
			},
		function() {
			clearInterval(interval);
			$e.find('ul').eq(0).css('display', 'none');
		});
	
	
	$("li.sale a").on("mousemove", function() {$("li.podarki a.parent").css("text-decoration", "none");});
	$("li.podarki a.parent").on("mousemove", function() {$("li.podarki a.parent").css("text-decoration", "underline");});
	
	$("#horizontal-multilevel-menu li:last-child a[href='/']").on("click", function() {
		document.location.href = 'http://www.sogrevay.ru';
		return false;
	});
	$('ul.level-1 > li,nav #horizontal-multilevel-menu > li.contains:nth-child(2)').click(
		function(){
			if($(window).width() < 976)
			{
				$(this).toggleClass('open');
				$(this).find('ul').slideToggle( "fast" );
			}
		}
		
	);
	$('ul.level-1 > li a,nav #horizontal-multilevel-menu > li.contains:nth-child(2) a').click(
		function(){
			event.stopPropagation();
		}
	);

    $(function(){
        $('#nav-icon4').click(function(){
            $(this).toggleClass('open');
            $('header .mobile-wrap').toggleClass('active-trigger');
            $('body').toggleClass('body-hidden');
        });
        $('.overlay').click(
            function () {
                $('#nav-icon4').removeClass('open');
                $('#block-system-main-menu, #block-views-exp-product-search-page').removeClass('active-trigger');
                $('.overlay').removeClass('open');
            }
        );
    });


});

if (window.attachEvent) 
	window.attachEvent("onload", jshover);