(function($) {
	var barsTimer,
		mouseTimer,
		slideTimer,
		mousePosition = {
			x: null,
			y: null
		},
		scrollPosition,
		activeIndex;
		
	$(window).load(function () {
	});
	
	$(window).resize(function() {
		if ($('#mediabox').hasClass('active')) {
			resetAllSizes();
	
			$('#mediabox-container').height($(window).innerHeight());
			
			$('#mediabox-container img').each(function(e) {	
				setImageSize($(this));
			});
			
			$('#mediabox-container').width($('#mediabox-container img').length*$(window).innerWidth());
			
			if ($.browser.msie && $.browser.version == "8.0") {
				$('#mediabox-container').width($('#mediabox-container').width()+100);
			}
		}
	});
	
	$(document).ready( function() {
		$('body').append('<div id="mediabox"><div id="mediabox-header"><div id="mediabox-close"><span>Close</span></div></div><div id="mediabox-wrapper"><div id="mediabox-container"></div></div><div id="mediabox-footer"></div></div>');

		$('#primary a img').on('click', function(e) {
			if (isLinkedToFile($(this))) {
				e.preventDefault();
				onMouseMoveBarsShowHide();	
				scrollPosition = $(window).scrollTop();
				$('html').addClass('active-mediabox');
				$('#mediabox').addClass('active');

				$('#mediabox-container').height($(window).innerHeight());
				
				if($(this).parents('.gallery').length) {
					activeIndex = $(this).parents('.gallery-item').index('.gallery-item');
					$('#mediabox-header').after('<div id="mediabox-nav"><div id="mediabox-prev"><span>Précédent</span></div><div id="mediabox-next"><span>Suivant</span></div></div>');
					
					if ($.browser.msie && $.browser.version == "7.0"){
						$('#mediabox-prev').css('top', '40%');
						$('#mediabox-next').css('top', '40%');
					}

					$(this).parents('.gallery').find('img').each(function(index) {
						var active = (activeIndex === index);
						getImage($(this), index, active);
						getInfos($(this), index, active);
					});
					
					$('#mediabox-container img').each(function() {
						$(this).load(function() {
							setImageSize($(this));
						});
					});
					
					$('#mediabox-container').width($('#mediabox-container img').length * $(window).innerWidth());
					if ($.browser.msie && $.browser.version == "8.0") {
						$('#mediabox-container').width($('#mediabox-container').width()+100);
					}

					$('#mediabox-container').css('left', '-'+(activeIndex*100)+'%');
					
					$('#mediabox-header').append('<div id="mediabox-player" class="play"></div><div id="mediabox-counter"><span id="mediabox-active">'+(activeIndex+1)+'</span>/<span id="mediabox-total">'+$('#mediabox-container img').length+'</span></div>');

					$('#mediabox-prev').on('click', function(e) {
						e.preventDefault();
						selectPrev();
					});
		
					$('#mediabox-next').on('click', function(e) {
						e.preventDefault();
						selectNext();
					});
					
					$(window).on('keydown', function(e) {
						if (e.keyCode === 27) {
							closeMediabox();
						}
						if (e.keyCode === 37) {
							selectPrev();
						}
						if (e.keyCode === 39) {
							selectNext();
						}
					});
					
					$('#mediabox-container').on('movestart', function(e) {
							start = {
								x: parseInt($(this).css('left'))
							};
					});
					
					$('#mediabox-container').on('move', function(e) {
						left = start.x+e.distX;
						$(this).css('left', left);
					});
					
					$('#mediabox-container').on('moveend', function(e) {
						if (Math.abs(e.distX) < ($('#mediabox-container img.active').width() / 2)) {
						
							$(this).animate({
								left: '-'+($('#mediabox-container img.active').index()*100)+'%'
							}, 200);
						}
						else if (e.distX < 0) {
							selectNext();
						}
						else if (e.distX > 0) {
							selectPrev();
						}
					});
									
					$('#mediabox-player').on('click', function(e) {
						e.preventDefault();
						if ($(this).hasClass('play')) {
							$(this).removeClass('play').addClass('pause');
							slideTimer = setInterval(selectNext, 6000);
						}
						else {
							$(this).removeClass('pause').addClass('play');
							clearInterval(slideTimer);			
						}
					});
				}
				else {
					getImage($(this), 0, true);
					getInfos($(this), 0, true);
					
					$('#mediabox-container img').load(function() {
						setImageSize($(this));
					});
					$('#mediabox-container').width($('#mediabox-container img').length * $(window).innerWidth());
					
					$(window).on('keydown', function(e) {
						if (e.keyCode === 27) {
							closeMediabox();
						}
					});			
				}
				barsTimer = setTimeout(hideBars, 5000);

				$('#mediabox-close').on('click', function(e) {
					e.preventDefault();
					closeMediabox();
				});
				
				$('#mediabox').on('click', function(e) {
					showBars();
				});
			}
		});
	});
	
	function isLinkedToFile(file) {
		var link = file.parent().attr('href'),
			extension = link.substr(link.length-4, 4).toLowerCase();
	
		if (extension === '.png' || extension === '.gif' || extension === '.jpg' || extension === '.jpeg') {
			return true;
		}
		else {
			return false;
		}
	}

	function getImage(elem, index, active) {
		var img = elem.parent().attr('href'),
			enabled = active ? ' class="active"' : '';

		$('#mediabox-container').append('<img id="mediabox-img-'+index+'"'+enabled+' src="'+img+'"/>')
	}
	
	function getInfos(elem, index, active) {
		var title = elem.prop('title');
			caption = elem.parents('.wp-caption, .gallery-item').children('.wp-caption-text').text(),
			enabled = active ? ' active' : '';
		
		if (title.length) {
			$('#mediabox-footer').append('<h3 id="mediabox-title-'+index+'" class="mediabox-title'+enabled+'">'+title+'</h3>');
		}
		
		if (caption.length) {
			$('#mediabox-footer').append('<p id="mediabox-caption-'+index+'" class="mediabox-caption'+enabled+'">'+caption+'</p>');
		}
	}
	
	function setImageSize(image) {	
		if ((image.width() > $(window).innerWidth()) && (image.height() > $(window).innerHeight())) {
			(image.width() / image.height()) > ($(window).innerWidth() / $(window).innerHeight()) ? image.width($(window).innerWidth()).height('auto').css('margin', ($(window).innerHeight() - image.height()) / 2 + 'px 0px') : image.height('100%').width('auto').css('margin', '0px ' + ($(window).innerWidth() - image.width()) / 2 + 'px');	
		}
		else if (image.width() > $(window).innerWidth()) {
			image.width($(window).innerWidth()).height('auto').css('margin', ($(window).innerHeight() - image.height()) / 2 + 'px 0px');
		}
		else if (image.height() > $(window).innerHeight()) {
			image.height('100%').width('auto').css('margin', '0px ' + ($(window).innerWidth() - image.width()) / 2 + 'px');
		}
		else {
			image.width('auto').height('auto').css('margin', ($(window).innerHeight() - image.height()) / 2 + 'px ' + ($(window).innerWidth() - image.width()) / 2 + 'px');
		}
	}
	
	function resetAllSizes() {
		$('#mediabox-container').css('width', '').css('height', '');
		$('#mediabox-container img').each(function(e) {
			$(this).removeAttr('style');
		});
	}
	
	function hideBars() {
		$('#mediabox-header').animate({
			top: '-' + $('#mediabox-header').height() + 'px'
		}, 400),
    hideFooter();
		
		if ($('#mediabox-nav').length) {
			$('#mediabox-prev').animate({
				left: '-50px'
			}, 400),
			$('#mediabox-next').animate({
				right: '-50px'
			}, 400);
		}
	}
	
	function hideFooter() {
    $('#mediabox-footer').animate({
      height: '0px'
    }, 400);	  
	}
	
	function showBars() {
		clearTimeout(barsTimer);
		
		$('#mediabox-header').animate({
				top: '0px'
		}, 400),
    showFooter();
		
		if ($('#mediabox-nav').length) {
			$('#mediabox-prev').animate({
				left: '0px'
			}, 400),
			$('#mediabox-next').animate({
				right: '0px'
			}, 400);
		}
		
		barsTimer = setTimeout(hideBars, 5000);
	}
	
	function showFooter() {
    var titleHeight = $('.mediabox-title.active').length ? $('.mediabox-title.active').height() + parseInt($('.mediabox-title.active').css('margin-top')) + parseInt($('.mediabox-title.active').css('margin-bottom')) : 0,
      captionHeight = $('.mediabox-caption.active').length ? $('.mediabox-caption.active').height() + parseInt($('.mediabox-caption.active').css('margin-bottom')) : 0;

    $('#mediabox-footer').animate({
      height: (titleHeight + captionHeight) + 'px'
    }, 400);	  
	}
		
	function onMouseMoveBarsShowHide() {
		$('#mediabox').on('mousemove', function(e) {
			if ((mousePosition.x !== e.pageX) || (mousePosition.y !== e.pageY)) {
				clearTimeout(mouseTimer);
				mousePosition.x = e.pageX;
				mousePosition.y = e.pageY;
				showBars();
				$('#mediabox').off('mousemove');
				mouseTimer = setTimeout(onMouseMoveBarsShowHide, 1000);
			}
		});
	}
	
	function selectPrev() {
		if ($('#mediabox-container img.active').prev('img').length) {
			activeIndex -= 1;
			$('#mediabox-container img.active').removeClass('active').prev('img').addClass('active');
		}
		else {
			activeIndex = $('#mediabox-container img').last().index();
			$('#mediabox-container img').removeClass('active').last().addClass('active');
		}
		
		$('#mediabox-container').animate({
			left: '-'+($('#mediabox-container img.active').index()*100)+'%'
		}, 400);
		
		
		selectInfos();
		setActiveCounter();

		if ($('#mediabox-player.pause').length) {
			clearInterval(slideTimer);
			slideTimer = setInterval(selectNext, 6000);
		}
	}
	
	function selectNext() {
		if ($('#mediabox-container img.active').next('img').length) {
			activeIndex += 1;
			$('#mediabox-container img.active').removeClass('active').next('img').addClass('active');
		}
		else {
			activeIndex = 0;
			$('#mediabox-container img').removeClass('active').first().addClass('active');
		}
		
		$('#mediabox-container').animate({
			left: '-'+($('#mediabox-container img.active').index()*100)+'%'
		}, 400);
		
		selectInfos();	
    showFooter();
		setActiveCounter();

		if ($('#mediabox-player.pause').length) {
			clearInterval(slideTimer);
			slideTimer = setInterval(selectNext, 6000);
		}
	}
	
	function selectInfos() {
		$('.mediabox-title.active').removeClass('active').animate({
			opacity: 0
		}, 400);
		
		if ($('#mediabox-title-'+activeIndex).length) {
			$('#mediabox-title-'+activeIndex).addClass('active').animate({
				opacity: 1
			}, 400);
		}
		
		$('.mediabox-caption.active').removeClass('active').animate({
			opacity: 0
		}, 400);
		
		if ($('#mediabox-caption-'+activeIndex).length) {
			$('#mediabox-caption-'+activeIndex).addClass('active').animate({
				opacity: 1
			}, 400);
		}
	}
	
	function setActiveCounter() {
		$('#mediabox-active').text(activeIndex+1);
	}
	
	function closeMediabox() {	
		$(window).off('keydown'),
		$('#mediabox').off('mousemove'),
		$('#mediabox').off('click'),
		$('#mediabox-player').off('click'),
		$('#mediabox-close').off('click'),
		$('#mediabox-prev').off('click'),
		$('#mediabox-next').off('click'),
		$('#mediabox-container').off('movestart'),
		$('#mediabox-container').off('move'),
		$('#mediabox-container').off('moveend');
		clearTimeout(mouseTimer);
		clearTimeout(barsTimer);
		clearInterval(slideTimer);
		$('html').removeClass('active-mediabox');
		$(window).scrollTop(scrollPosition);
		$('#mediabox').removeClass('active');
		$('#mediabox-player').remove();
		$('#mediabox-counter').remove();
		$('#mediabox-nav').remove();
		$('#mediabox-container').empty().removeAttr('style');
		$('#mediabox-footer').empty();
	}
})(jQuery);