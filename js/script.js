(function($) {  
	$(window).load(function () {
		$('#settings-show').css('display', 'inline-block');
		
		resizeFooterAbove();
	});
	
	$(window).resize(function() {
		resizeFooterAbove();
	});
	
	$(document).ready( function() {
		var stylesheet = $('#theme-stylesheet').attr('href').split('/'),
			theme = stylesheet[stylesheet.length-1].toString().replace('.css', ''),
			size = getCookie('fontsize') === undefined ? 100 : getCookie('fontsize'),
			columns  =  getCookie('columns') === undefined ? 2 : getCookie('columns');
		
		$('.article-content').css('font-size', size+'%');
		
		$('.fontsize-pct').each(function(index) {
			if (size == $(this).text()) {
				$('#fontsize-slider').css('left', (index * $('#fontsize-slider').width()) + '%');
				return false;
			}
		});
		
		if ($.browser.opera){
			$('html').addClass('opera');
		}
		
		setBodyColumnClass(columns);
		
		$('#theme-'+theme+', #columns-'+columns).addClass('disabled');
		
		$('#search-show, #settings-show').addClass('js');

		$('#footer').addClass('closed stop');
				
		$('#top').on('click', function(e) {
			e.preventDefault();
		
			$("html, body").animate({
				scrollTop: $($(this).attr("href")).offset().top + "px"
			}, {
				duration: 500,
				easing: "swing"
			});
			return false;
		});
		
		$('#search-show').on('click', function(e) {
			e.preventDefault();
			
			if ($(window).innerWidth() > 980) {
				$('#header input#s').focus();
			}
			else {
				if ($('#page').hasClass('active-search')) {
					$('#page').removeClass();
				}
				else {
					$('#page').removeClass().addClass('active active-search');
					$('#header input#s').focus();
				}
			}
		});
		
		$('#access-show').on('click', function(e) {
			e.preventDefault();
			
			if ($('#page').hasClass('active-menu')) {
				$('#page').removeClass();
			}
			else {
				$('#page').removeClass().addClass('active active-menu');
			}
		});
		
		$('#settings-show').on('click', function(e) {
			e.preventDefault();
			
			if ($('#page').hasClass('active-settings')) {
				$('#page').removeClass();
			}
			else {
				$('#page').removeClass().addClass('active active-settings');
			}
		});

		$('.theme').on('click', function(e) {
			e.preventDefault();
		
			$('.theme').removeClass('disabled');
			$(this).addClass('disabled');

		 	var style = $('#theme-stylesheet').attr('href').split('/'),
		 	    theme = $(this).text().toLowerCase();
		 	style[style.length-1] = theme +'.css';
		 	$('#theme-stylesheet').attr('href', style.join('/'));
		 	
      $('.no-thumb').attr('src', function() {
        return $(this).attr('src').replace(/(no-thumb-)(\w+)(.png)/, '$1'+theme+'$3');        
      });

		 	setCookie('style', theme, 365, '/');
		});
		
		$('.columns').on('click', function(e) {
			e.preventDefault();
			
			$('.columns').removeClass('disabled');
			$(this).addClass('disabled');
			
			var col = parseInt($(this).attr('id').replace('columns-', ''));
			setBodyColumnClass(col);
			setCookie('columns', col, 365, '/');
		})
		
		$('#fontsize-slider').on('movestart', function(e) {
				start = {
					x: parseInt($(this).css('left'))
				};
		});
		
		$('#fontsize-slider').on('move', function(e) {
			max = $('#fontsize').width() - $(this).width();
			left = start.x+e.distX;
			left = left <= 0 ? 0 : left >= max ? max : left;
			
			$(this).css('left', left);
		});
		
		$('#fontsize-slider').on('moveend', function(e) {
			var index = Math.round(parseInt($(this).css('left')) / $(this).width())
			$(this).animate({
				left: index * Math.round($('#fontsize').width() / $(this).width()) + '%'
			}, 200, function() {
				$('.article-content').css('font-size', $('.fontsize-pct').eq(index).text()+'%');
				setCookie('fontsize', $('.fontsize-pct').eq(index).text(), 365, '/');
			});
		});
		
		$('#fontsize').on('click', function(e) {
      if (e.target === e.currentTarget) {
        e.preventDefault();
        
        if(typeof e.offsetX === "undefined") {
          var targetOffset = $(e.target).offset();
          e.offsetX = e.pageX - targetOffset.left;
        }
        
        var index = parseInt(e.offsetX / $('#fontsize-slider').width());
          $('#fontsize-slider').animate({
          left: index * Math.round($('#fontsize').width() / $('#fontsize-slider').width()) + '%'
        }, 200, function() {
          $('.article-content').css('font-size', $('.fontsize-pct').eq(index).text()+'%');
          setCookie('fontsize', $('.fontsize-pct').eq(index).text(), 365, '/');         
        });
      }
		});
		
		$('#footer-show').on('click', function(e) {
			e.preventDefault();
			
			
			$('#footer').removeClass('stop').addClass('playing');
			$('#footer').hasClass('closed') ? $('#footer').removeClass('closed').addClass('opened') : $('#footer').removeClass('opened').addClass('closed');
		
			$('html, body').animate({
				scrollTop: $(document).height()
			}, 400, function() {
				$('#footer').removeClass('playing').addClass('stop');
			}); 
		})
		
		$('#primary .closed .entry-title, #primary .closed .entry-readmore').on('click', function(e) {
		  console.log(e);
			if ($(this).parents('article').hasClass('closed') && !e.altKey && !e.ctrlKey && !e.metaKey  && !e.shiftKey) {
				e.preventDefault();
				$(this).parents('.closed').removeClass('closed');		
			}
		});
		
		$('.entry-close').on('click', function(e) {
			e.preventDefault();
			$(this).parents('article').addClass('closed');
		});
		
	});
	
	function resizeFooterAbove() {
		if ($(window).innerWidth() <= 800 && $(window).innerWidth() > 480) {
			$('#footer-above aside').each(function(index) {			
				if (index % 2 == 1) {
					$(this).css('height', Math.max($(this).height(),$('#footer-above aside').eq(index-1).height()+1));
				}
			});
		}
		else {
			$('#footer-above aside').each(function(index) {
				$(this).css('height', '');
			});
		}
	}
	
	function setBodyColumnClass(column) {
		if (column == 1) {
			$('body').removeClass('two-column').addClass('one-column');
		}
		else if (column == 2) {
			$('body').removeClass('one-column').addClass('two-column');
		}
	}
	
	function setCookie(name, value, expire, path) {
		var cookie_value, date = new Date();
		date.setDate(date.getDate() + expire);
		cookie_value = escape(value) + ((expire == null) ? "" : ";expires="+date.toUTCString()) + ((path == null) ? "" : ";path="+path);
		document.cookie = name + "=" + cookie_value;
	}
	
	function getCookie(name) {
		var i, x, y, nbARRcookies, ARRcookies = document.cookie.split(";");
		nbARRcookies = ARRcookies.length;
		
		for (i = 0; i < nbARRcookies; i++) {
			x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
			y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			
			x = x.replace(' ', '');
			y = y.replace(' ', '');
			
			if (x == name)
			{
				return unescape(y);
			}
		}
	}
})(jQuery);