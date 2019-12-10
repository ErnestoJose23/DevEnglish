(function(){
    "use strict";

	// Init global DOM elements, functions and arrays
  	window.app 			 				= {el : {}, fn : {}};
	app.el['window']     				= $(window);
	app.el['document']   				= $(document);
	app.el['back-top'] 					= $('.back-top');
	app.el['html-body'] 				= $('html,body');
	app.el['animated']   				= $('.animated');
	app.el['loader']        			= $('#loader');
	app.el['mask']          			= $('#mask');
	app.el['header']          			= $('header');
	app.el['navbar-nav'] 				= $('.navbar-nav li.dropdown');

	$(function() {	
	    // Preloader
	    // app.el['loader'].delay(700).fadeOut();
	    // app.el['mask'].delay(1200).fadeOut("slow");

		// Resized based on screen size
		app.el['window'].on('resize',function() {
			app.el['header'].unstick();
			app.el['header'].sticky({ topSpacing: 0 });			
		});	


		function allParallax(){
			$('.orange-bg').laxicon({
			  	bgImgPath: 'assets/img/background/orange-drum.jpg'
			});	

			$('.pink-bg').laxicon({
			  	bgImgPath: 'assets/img/background/pink-desk.jpg'
			});

			$('.world-bg').laxicon({
			  	bgImgPath: 'assets/img/background/worldmap-bg.jpg'
			});	
		}
        allParallax();
		


		$(window).on('load', function(){
			shufflePortfolio();
			allParallax();
		});
		
		function shufflePortfolio(){
			// init var for shuffle
			var $grid = $('#grid'),
				$filterOptions = $('.filter-options');

			// init shuffle
			$grid.shuffle({
				itemSelector: '.picture-item'
			});

			// handle shuffle filter
			var $btns = $filterOptions.children();
			$btns.on('click', function() {
				var $this = $(this),
					isActive = $this.hasClass( 'active' ),
					group = isActive ? 'all' : $this.data('group');
				if ( !isActive ) {
					$('.filter-options .active').removeClass('active');
				}
				$this.toggleClass('active');

				$grid.shuffle( 'shuffle', group );
			});
			$btns = null;
		}
			

		// play video
		$('.button-play').on('click', function(e){
			$('.front-content').removeClass('show').addClass('hide');
			$('.video-background').removeClass('hide').addClass('show');
			$('#video')[0].src += "&autoplay=1";
    		e.preventDefault();
		});

		// youtube video handle
		var player;
		function onYouTubePlayerAPIReady() {
		    player = new YT.Player('video', {
		      events: {
		        'onReady': onPlayerReady
		      }
		    });
		}
		function onPlayerReady(event){
			event.target.playVideo();
				document.id("#play-video").addEvent('click', function() {
				  player.playVideo();
				});
		}
		
		var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/player_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


		// fixed header
		app.el['header'].sticky({ topSpacing: 0 });

		// On hover, open drop down
	    app.el['navbar-nav'].on({
	        mouseenter: function() {
	          $(this).addClass('open');
	        }, mouseleave: function() {
	          $(this).removeClass('open');
	        }
	    });

	    // One page nav header
	    var top_offset = $('#header').height() - 1;
		$('.navbar-nav').onePageNav({
			currentClass: 'active',
			changeHash: true,
    		scrollOffset: top_offset,
			filter: ':not(.external)',
		    begin: function() {
		    	// Hide navbar collapse
		        $('.navbar-dropdown').stop().animate({ height : '0'}, 250); 
		        $('.navbar-collapse').removeClass('in');
		    }
		});

		$('.arrow-down').on('click', function(){
			var target = $(this).data('target');
			app.el['html-body'].animate({
				scrollTop: $(target).offset().top - 105
			}, 1500);
			return false;
		});

		// scroll body to 0px on click
		app.el['back-top'].on('click', function () {
			app.el['html-body'].animate({
				scrollTop: 0
			}, 1500);
			return false;
		});

		// Elements animation
		$('.animated').appear(function() {
	        var element = $(this);
	        var animation = element.data('animation');
	        var animationDelay = element.data('delay');
	        if (animationDelay) {
	          setTimeout(function(){
	            element.addClass( animation + " visible" );
	            element.removeClass('hiding');
	            element.find('.circle-stat').circliful();
	            if (element.hasClass('counter')) {
	              element.find('.value').countTo();
	            }
	          }, animationDelay);
	        }else {
	          element.addClass( animation + " visible" );
	          element.removeClass('hiding');
	          element.find('.circle-stat').circliful();
	          if (element.hasClass('counter')) {
	            element.find('.value').countTo();
	          }
	        }    
	      },{accY: -150});


		// Vertical Center modal
		function centerModals($element) {
			var $modals;
			if ($element.length) {
				$modals = $element;
			} else {
				$modals = $('.modal:visible');
			}
			$modals.each( function(i) {
				var $clone = $(this).clone().css('display', 'block').appendTo('body');
				var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
				top = top > 0 ? top : 0;
				$clone.remove();
				$(this).find('.modal-content').css("margin-top", top);
			});
		}
		$('.modal').on('show.bs.modal', function(e) {
			centerModals($(this));
		});

	});

})();