(function() {
	'use strict';
	
	// Share Menu	
	var shareMenu = function() {
		$(".Share").click(function() {
			$(".share-wrap").fadeToggle("slow");
		});

		$('.qrcode').each(function(index, el) {
			var url = $(this).data('url');
			if ($.fn.qrcode) {
				$(this).qrcode({
					text: url,
					width: 150,
					height: 150,
				});
			}
		});
	}

	//Show love
	var showlove = function() {
	    $.fn.postLike = function() {
	        if ($(this).hasClass('done')) {
	            layer.msg('您已经支持过了', function() {});
	            return false;
	        } else {
	            $(this).addClass('done');
	            layer.msg('感谢您的支持');
	            var id = $(this).data("id"),
	            action = $(this).data('action'),
	            rateHolder = $(this).children('.count');
	            var ajax_data = {
	                action: "love",
	                um_id: id,
	                um_action: action
	            };
	            $.post("/wp-admin/admin-ajax.php", ajax_data,
	            function(data) {
	                $(rateHolder).html(data);
	            });
	            return false;
	        }
	    };
	    $(document).on("click", ".Love",
	        function() {
	            $(this).postLike();
	    });
	}

	//Go Top
	var gotop = function() {
		var offset = 300,
			offset_opacity = 1200,
			scroll_top_duration = 700,
			$back_to_top = $('.cd-top');
		$(window).scroll(function(){
			( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
			if( $(this).scrollTop() > offset_opacity ) { 
				$back_to_top.addClass('cd-fade-out');
			}
		});

		$back_to_top.on('click', function(event){
			event.preventDefault();
			$('body,html').animate({
				scrollTop: 0 ,
			 	}, scroll_top_duration
			);
		});
	}

	var copyright = function() {
		console.log("项目托管：https://github.com/Vtrois/Snape");
	}

	var showPhotos = function() {
		layer.photos({
		  photos: '.post-content'
		  ,anim: 0
		}); 
	}

	$(function() {
		shareMenu();
		showlove();
		gotop();
		copyright();
		showPhotos();
	});

}());