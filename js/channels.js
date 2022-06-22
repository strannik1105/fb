var App = {
	host: location.protocol + "//fe.smotreshka.tv"
};

ApplicationConfig = {
	host: "//fe.smotreshka.tv",
};

var $channels = [], $packs = [];
App.renderPackageChannelsList = function (id, content) {
	var container = document.querySelector('#pack-' + id),
		length = 0, $pack = [], packName = {};
		packName.id = id;
	if (!container) return;

	content.forEach(function (channelId, i) {
		var channels = App.allChannels;
			
		for (var j = 0; j < channels.length; j++) {
			if (channels[j].id === channelId) {
				var obj = {};
				obj.img = 'https://salesupster.ru/ott/channels/' + channels[j].info.mediaInfo.thumbnails[0].url.slice(34) + '.jpg';
				obj.name = channels[j].info.metaInfo.title.slice(4);
				obj.genre = channels[j].info.metaInfo.genres;
				$pack.push(obj);
				if ($channels.indexOf(channels[j].info.metaInfo.title.slice(4)) === -1) {
				$channels.push(channels[j].info.metaInfo.title.slice(4));
				} 
				length++;

				break;
			}
		}
	});
	packName.channels = $pack;
	$packs.push(packName);
	if(idPackages) {
					$.each(idPackages, function(key, idPackage) {
						$.getJSON(ApplicationConfig.host+"/v2/offers/"+idPackage, function(data) {
							var countChannelItem = $(".tv-channels[data-id='"+idPackage+"']").find(".channels_count");

							countChannelItem.html(data.content.length);
						});
					});
				}
};
var $dop = [];
$('.channels_name').each(function(){
	if ($(this).text() !== 'Viasat Nature/History HD') {
		$channels.push($(this).text());
		$dop.push($(this).text());
	}
	});

App.renderChannelsList = function (place, data) {
	var channelsPlace = document.getElementById(place),
		innerContent = '<div>';
	data.forEach(function (item, i) {
		
		var imgSrc = 'https://salesupster.ru/ott/channels/' + item.info.mediaInfo.thumbnails[0].url.slice(34) + '.jpg';
		var $name = item.info.metaInfo.title.slice(4);
		if ($channels.indexOf($name) !== -1) {
		innerContent += '<img src="' + imgSrc + '" width="68" height="38" title="' + $name + '" alt="' + $name;
//			if ($dop.indexOf($name) === -1) {
//				innerContent += '" class="active" />';
//			} else {
//				innerContent += '" />';
//			}
			innerContent += '" />';
		}
	});

	channelsPlace.innerHTML = innerContent;

};
function pageScroll() {
			$.scrollify({
				overflowScroll: true,
				section : ".section",
				interstitialSection:"footer",
    			scrollSpeed: 1100,
//				setHeights: true,
				updateHash: false,
				touchScroll:false,
				before:function(i,panels) {
					var ref = panels[i].attr("data-section-name");
					$(".pagination .active").removeClass("active");
					$(".pagination").find("a[href=\"#" + ref + "\"]").addClass("active");
				},
				afterRender:function() {
					var pagination = "<ul class=\"pagination\">";
					var activeClass = "";
					$(".section").each(function(i) {
						activeClass = "";
						if(i===0) {
							activeClass = "active";
						}
						pagination += "<li><a class=\"" + activeClass + "\" href=\"#" + $(this).attr("data-section-name") + "\"><span></span></a></li>";
					});
					pagination += "</ul>";
					$("#fullpage").append(pagination);
					$(".pagination a").on("click",$.scrollify.move); 
					$('.header_bannerLink').on("click",$.scrollify.move);  
					$('.smooth').on("click",$.scrollify.move);  
					if (!$('#tarif_base .secTv_item').eq(3).hasClass('active')) {
						 $('#tarif_base .secTv_item').eq(3).click();
					 }
				}
			});
	}
function channelsRender() {
	'use strict';
	$.ajax({
		url: App.host + "/channels"
	}).done(function (data) {
		App.allChannels = data.channels;
		$.ajax({
			url: App.host + "/v2/offers"
		}).done(function (data) {
			var offers = data.offers;
			offers.forEach(function (offer, i) {
				var id = offer.id,
					content = offer.content;
				App.renderPackageChannelsList(offer.id, offer.content);
			});
		}).done(function(){
			App.renderChannelsList('all-channels', App.allChannels);
		}).done(function(){
			var width = $(window).width();
   			if (width > 1199) {
				pageScroll();
			 }
		});
	});
}