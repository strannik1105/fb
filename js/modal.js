$(document).on('click', '.trigger', function (event) {
	'use strict';
	event.preventDefault();
	$.scrollify.disable();
	let $link = $(this).attr('href');
	let $name = $(this).attr('data-name');
	($name) ? $('input[name="tariff"').val($name) : $('input[name="tariff"').val('Не указан');
    $($link).iziModal('open', this);	
     $('.iziModal-overlay').on('click', function(){
	 	$('.iziModal-button-close').click();
	 });
});
$(document).on('click', '.link_count', function (event) {
	'use strict';
    event.preventDefault();
	let $link = $(this).attr('href');
    $($link).iziModal('open', this);
});
 $(".modal-window").iziModal({
	 	title: '',
	 	fullscreen: false,
	 	headerColor: '',
	 	width:500,
	 	overlayColor: 'rgba(0, 0, 0, 0.4)',
	 	iconColor: '',
	 	iconClass: 'icon-chat',
	 	bodyOverflow: true,
	 	zIndex: '999',
	 	overlayClose: true,
	 	transitionIn: 'comingIn',
    	transitionOut: 'comingOut',
    	afterRender: function(){
			$('.iziModal-button-close').show();
		},
});
 $(".modal-window_full").iziModal({
	 	title: '',
	 	fullscreen: true,
	 	openFullscreen:true,
	 	headerColor: '',
	 	overlayColor: 'rgba(0, 0, 0, 0.4)',
	 	iconColor: '',
	 	iconClass: 'icon-chat',
	 	bodyOverflow: true,
	 	zIndex: '999',
	 	overlayClose: true,
	 	transitionIn: 'comingIn',
    	transitionOut: 'comingOut',
    	afterRender: function(){
			$('.iziModal-button-close').show();
		},
});
 $('.iziModal-button-close').on('click', function(){
// 	$('.modal_content form')[0].reset();
// 	$('.modal_content form').find('.sps').hide(function(){
// 		$('.modal_content form').show();
// 	});
	 $.scrollify.enable();
	 // if (!$('.secTv_item').eq(0).hasClass('active')) { 
		//  $('.secTv_item').eq(0).click();
	 // } else {
	 if (!($('#tarif_base .secTv_item').eq(3).hasClass('active')) && $(window).width() > 767) {
		 $('#tarif_base .secTv_item').eq(3).click();
	 }
	 // }
	 $("#top").get(0).scrollIntoView();
	 $('.channels_item').remove();
 });