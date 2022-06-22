$(function(){
	'use strict';
	$('.header_trigger').click(function(){
		$('.header_navOuter').slideToggle();
	});
//$('.close').click(function(){
//	$('#podkluch').find('.sps').remove();
//	$('#podkluch').find('form')[0].reset();
//	$('#podkluch').find('form').show(1000);
//});
$('.secTv_listItem a').click(function(){
		let $link = $(this).attr('href');
		$('.channels_all img, .secTv_item').removeClass('active');
		$(this).addClass('active');
		$('.secTv_listItem a').not(this).removeClass('active');
		$($link).show();
		$('.secTv_box').not($link).hide();
		return false;
	});
$('.channels_link').click(function(){
	var text = $(this).text();
	$(this).text(
		text === "Смотреть весь список" ? "Скрыть список" : "Смотреть весь список");
	$('.channels_all').toggleClass('active');
	return false;
});
$('.secTv_item').click(function(){
	$('.channels_all img').removeClass('active');
	var $name, $link, arr = [],
	$id = $(this).data('id');
	for(var i = 0;i<$packs.length; i++) {
		if ($id === $packs[i].id) {
			for(var l = 0;l<$packs[i].channels.length; l++) { 
				$link = $packs[i].channels[l].name;
				arr.push($link);	
			}
		}
	}
	$(this).toggleClass('active');
	$('.secTv_item').not(this).removeClass('active');
	if ($(this).hasClass('active')) {
		$('.channels_all img').each(function(){
			$name = $(this).attr('alt');
			for (var i=0;i<arr.length;i++) {
				if (arr[i] === $name) {
					$(this).addClass('active');
				}
			}
		});
	}
	$('.channels_all').removeClass('active');
	$('.channels_link').text('Смотреть весь список');
});
$('.secTv_btn').click(function(){
	$('#channels_genre').animate({
		scrollTop: ($('.tariff_name').offset().top)
	},0);
	var $genres,$id = $(this).parents('.tv-channels').data('id');
	var $name = $(this).parents('.tv-channels').find('.title-channels').text();
	var $count = $(this).parents('.tv-channels').find('.secTv_link span').text();
	$('.tariff_name').text($name);
	$('.tariff_channels_count span').text($count);
	createList($id, $genres);
});
function createList($id, $genres) {
	const $genre = ['HD-каналы', 'Детские', 'Кино', 'Музыкальные', 'Новостные', 'Познавательные', 'Развлекательные', 'Эфирные'];
	const $genreIcons = ['hd', 'kids', 'cinema', 'music', 'news', 'knows', 'fun', 'online'];
	let $blockContent= '', 
	$block = '', 
	$countGenres = 0;
	console.log($packs.indexOf($id));
	for(let i = 0;i<$packs.length; i++) {
		if ($id === $packs[i].id) {
			for(let j = 0;j<$genre.length; j++) {
				for(let l = 0; l<$packs[i].channels.length; l++) { 
					$genres = $packs[i].channels[l].genre;
					if ($genres.indexOf($genre[j]) !== -1) {
						$countGenres += 1;
						$blockContent += '<span><img src="' + $packs[i].channels[l].img + '" width="178" height="100" alt="' + $packs[i].channels[l].name + '" /><span class="channels_name">' + $packs[i].channels[l].name + '</span></span>';
					}
				}
				$block = `<div class="channels_item flex_row" data-name="${$genre[j]}"><div class="channels_left"><svg class="channels_icon" viewBox="0 0 24 24"><use xlink:href="img/sprite.svg#channels_${$genreIcons[j]}"></use></svg><h2 class="genres_title">${$genre[j]}</h2><h3 class="genres_count">Каналов: <span>${$countGenres}</span></h3></div><div class="channels_right"><div class="channels_content flex_row flex_wrap">${$blockContent}</div></div></div>`;
				$blockContent = '';
				if ($countGenres > 0) {
					$('.channels_boxContent').append($block);
				}
				$countGenres = 0;
			}
		}	
	};
};
$('.header_navItem_more').click(function(e){
	$('.header_navItem_more').find('.icon_arrow').toggleClass('active');
	$('.header_submenu').slideToggle();
	var item = $(this);
	if (!item.is(e.target) && item.has(e.target).length === 0) {
		$('.header_navItem_more').find('.icon_arrow').removeClass('active');
		$('.header_submenu').slideUp();
	}
});
$('.secTv_link').click(function(){
	$(this).siblings('.secTv_btn').click();
	return false;
});
$(document).click(function(e) {
	var item = $('.header_navItem_more');
	if (!item.is(e.target) && item.has(e.target).length === 0) {
		$('.header_navItem_more').find('.icon_arrow').removeClass('active');
		$('.header_submenu').slideUp();
	}

});
$(window).on("resize", function () {
	var width = $(window).width();
	channelsRender();
	$('.secTv_slider').trigger('destroy.owl.carousel');
	if (width < 1199) {
		$.scrollify.destroy();
		if (width < 850) {
			$('.secTv_slider').addClass('owl-carousel slider');
			$('.secTv_slider').owlCarousel({
				nav:true,
				navText : ["",""],
				dots:true,
				loop:true,
				mouseDrag:false,
				pullDrag:false,
				freeDrag:false,
				center:true,
				autoplay:false,
				items:1
			});
		}
		if (width < 767) {
			$('.secTv_item.active').removeClass('active');
			$('.channels_all img').removeClass('active');
			$('.smooth').click(function(){
				var scroll_el = $(this).attr('href'); 
				if ($(scroll_el).length !== 0) { 
					$('html, body').animate({ scrollTop: $(scroll_el).offset().top }, 800); 
				}
				$('.header_navOuter').hide();
				return false;
			});
		}
	}
}).resize();
$('.phone').mask("+7(999) 999-99-99"); 
$('.slider').each(function(){$(this).owlCarousel({
	nav:true,
	navText : ["",""],
	dots:true,
	loop:true,
	mouseDrag:false,
	pullDrag:false,
	freeDrag:false,
	items:1
});
});
$('.main_slider').each(function(){$(this).data('owl.carousel').options.autoplay = true;});
$('.main_slider').each(function(){$(this).data('owl.carousel').options.autoplayTimeout = 8000;});
$('.secTv_slider').each(function(){$(this).data('owl.carousel').options.items = 3;});
$('.secTv_slider').each(function(){$(this).data('owl.carousel').options.margin = 16;});
$('.secTv_slider').each(function(){$(this).data('owl.carousel').options.loop = false;});
$('.secTv_slider').each(function(){$(this).data('owl.carousel').options.dots = false;});
$('.secTv_slider').each(function(){$(this).data('owl.carousel').options.responsive = {"0":{"autoWidth": false, items:1}, "576":{"autoWidth": true}, "1025":{"autoWidth": false}};});

$('.owl-carousel').each(function(){$(this).trigger( 'refresh.owl.carousel' );});
});
//$(document).ready(function(){
//		$('a[target="_blank"]').removeAttr('target');
//	}); 
//$(document).ready(function(){
//	'use strict';
//	timeout = setTimeout(function(){
//	$('.secTv_item').each(function(){
//		var $this = $(this);
//		var $id = $(this).data('id');
//		for(var i = 0;i<$packs.length; i++) {
//		if ($id === $packs[i].id) {
//			for(var l = 0;l<$packs[i].channels.length; l++) { 
//				$this.find('.channels_count').html($packs[i].channels.length);
//			}
//		}
//	}
//	});
//		}, 2500);
//});