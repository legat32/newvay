$(document).ready( function() {



		/*прокрутка картинок изделия*/
	$('.other-products').slick({
		draggable:true,
		swipeToSlide:true,
		dots: true,
        arrows: false,
        speed: 200,
        infinite: false,
        //centerMode:true,
       	autoplay:true,
        autoplaySpeed:5000,
        pauseOnHover:true,
        slidesToShow: 5,
  		slidesToScroll: 1,
  		responsive: [{
      		breakpoint: 1250,
      		settings: {
        		slidesToShow: 4
      		}
    	},{
      		breakpoint: 800,
      		settings: {
        		slidesToShow: 3
      		}
    	},{
      		breakpoint: 640,
      		settings: {
        		slidesToShow: 2
      		}
    	},{
      		breakpoint: 480,
      		settings: {
        		slidesToShow: 1
      		}
    	}
    	]
	}).on("mousewheel", function (event) {
        event.preventDefault();
    if ((event.deltaX > 0 || event.deltaY < 0)&&($('.other-products .slick-dots .slick-active').index()<($('.other-products .slick-dots li').length)-1))
    {
    	console.log($('.other-products .slick-dots .slick-active').index()+" - "+($('.other-products .slick-dots li').length-2));
        $(this).stop(true,true).slick('slickNext');
    } else if ((event.deltaX < 0 || event.deltaY > 0)&&($('.other-products .slick-dots .slick-active').index()!=0)) {
        $(this).stop(true,true).slick('slickPrev');
    }
});
			
	});