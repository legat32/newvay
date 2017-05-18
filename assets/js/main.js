$(document).ready( function() {

	// Countdown
	/*
	function CountdownTimer(elm,tl,mes){
	 this.initialize.apply(this,arguments);
	}
	CountdownTimer.prototype={
	 initialize:function(elm,tl,mes) {
	  this.elem = document.getElementById(elm);
	  this.tl = tl;
	  this.mes = mes;
	 },countDown:function(){
	  var timer='';
	  var today=new Date();
	  var day=Math.floor((this.tl-today)/(24*60*60*1000));
	  var hour=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*60*1000));
	  var min=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*1000))%60;
	  var sec=Math.floor(((this.tl-today)%(24*60*60*1000))/1000)%60%60;
	  var me=this;

	  if( ( this.tl - today ) > 0 ){
	   timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">ДЕНЬ</div><span class="number day">'+day+'</span></span>';
	   timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">ЧАСОВ</div><span class="number hour">'+hour+'</span></span>';
	   timer += '<span class="number-wrapper"><div class="line"></div><div class="caption">МИНУТ</div><span class="number min">'+this.addZero(min)+'</span></span><span class="number-wrapper"><div class="line"></div><div class="caption">СЕКУНД</div><span class="number sec">'+this.addZero(sec)+'</span></span>';
	   this.elem.innerHTML = timer;
	   tid = setTimeout( function(){me.countDown();},10 );
	  }else{
	   this.elem.innerHTML = this.mes;
	   return;
	  }
	 },addZero:function(num){ return ('0'+num).slice(-2); }
	}
	function CDT(){

	 // Set countdown limit
	 var tl = new Date('2016/12/20 18:00:00');

	 // You can add time's up message here
	 var timer = new CountdownTimer('CDT',tl,'<span class="number-wrapper"><div class="line"></div><span class="number end">Время вышло!</span></span>');
	 timer.countDown();
	}
	window.onload=function(){
	 CDT();
	}
	*/

	
	// auth
	
	$('.fancybox-auth').fancybox({
		'width'				: 160,
		'autoHeight'		: true,
		'type'				: 'iframe'
		});
		
	$('.fancybox-ask').fancybox({
		'width'				: 440,
		'autoHeight'		: true,
		'type'				: 'iframe'
		});
		
	$('.fancybox-ajax').fancybox({
		'autoSize'			: true,
		'type'				: 'ajax'
		});
		
	$('.fancybox-iframe').fancybox({
		'autoSize'			: true,
		'minHeight'			: 250,
		'type'				: 'iframe'
		});
	
		
	// Button "To top"
	
	var top_show = 150; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
	var delay = 1000;
	$(window).scroll(function () {
		if ($(this).scrollTop() > top_show) $('.to-top').fadeIn();
		else $('.to-top').fadeOut();
		});
	$(".to-top").on("click", function() {
		$('html, body').stop().animate({
            'scrollTop': '0px'
			}, 300, 'swing');
		});
		
	
	
	
	// Accordion Menu
	
	if($('#accordion').size() > 0) {
		$('#accordion').dcAccordion({
			eventType: 'click',
			hoverDelay: 100,
			saveState: true,
			disableLink: false,
			autoClose: true,
			autoExpand: true,
			classExpand: 'current-item',
			speed: 'fast',
			//showCount: true,
			cookie  : 'dcjq-accordion'
			});
		$("#accordion li a.root-item-selected").parent("li").find("ul").show();
		}


// Call Sly on frame
	var $frame  = $('#slider');
	var $slidee = $frame.children('ul').eq(0);
	var $wrap   = $frame.parent();
	$frame.sly({
		horizontal: 1,
		itemNav: 'basic',
		smart: 0,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		scrollBar: $wrap.find('.scrollbar'),
		scrollBy: 0,
		pagesBar: $wrap.find('.pages'),
		activatePageOn: 'click',
		speed: 300,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,
		cycleBy: 'pages',
		cycleInterval: 5000,
		startPaused:   0,
		pauseOnHover:  1,
		// Buttons
		prevPage: $wrap.find('.prevPage'),
		nextPage: $wrap.find('.nextPage')
	});
	
// Call Sly on frame
	var $frame  = $('#oneperframe');
	var $slidee = $frame.children('ul').eq(0);
	var $wrap   = $frame.parent();
	$frame.sly({
		horizontal: 1,
		itemNav: 'basic',
		smart: 0,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		scrollBar: $wrap.find('.scrollbar'),
		scrollBy: 0,
		pagesBar: $wrap.find('.pages'),
		activatePageOn: 'click',
		speed: 300,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,
		cycleBy: 'pages',
		cycleInterval: 6000,
		startPaused:   0,
		pauseOnHover:  1,
		// Buttons
		prevPage: $wrap.find('.prevPage'),
		nextPage: $wrap.find('.nextPage')
	});

	

// Fancybox
		
		$(".fancybox").fancybox({
			'padding'     : 4,
			'loop'		: false,
			tpl: {
				closeBtn : '<a class="fancybox-item fancybox-close" href="javascript:;"></a>',
				next     : '<a class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
				prev     : '<a class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
				}
			});
				
				
		$("a.iframe").fancybox({
			'modal'				: true,
			'type'				: 'iframe',
			'width'				: '2',
			'height'			: '2',
			'showCloseButton'	: true,
			'centerOnScroll'	: true
			});
			
		/*			$('#title-search-input').bind("focus", function() {
			if($(this).val()=='Поиск по артикулу') $(this).val('').removeClass("empty_field");
			});
		$('#title-search-input').bind("blur", function() {
			var txt=$.trim($(this).val());
			if(txt.length<1) $(this).val('Поиск по артикулу').addClass("empty_field");
			});
		$('#title-search-input').bind("change", function() {
			$(this).removeClass("empty_field");
			});
			*/
});