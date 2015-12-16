window.youTubePlayer = window.youTubePlayer||{};
// JSONP callback function of youtube API /////////////
function onYouTubeIframeAPIReady() {
	var url = 'https://www.googleapis.com/youtube/v3/search';
	var param = {
			part : 'snippet',
			eventType: 'upcoming',
			type: 'video',
			channelId : window.youTubePlayer.channel_id,
			order: 'date',
			//channelId : 'UCAhq4ttjWzWAT4zmPXm0DZw',
			// channelId : 'UCXBGJ0iWWa5jmSrLTvgARRQ',
			key : 'AIzaSyBoMXQDrlRUCQCxv4fjfiyTHXog8OB2Nz0',
	}
	jQuery.get(url, param)
		.done(function (r) {
			if(r.items.length == 0){				
				param.eventType = 'live';
				jQuery.get(url, param)
					.done(function (r) {

						if(r.items.length == 0){				
							//if no live video take spacial playlist (use simulation of request)
							r.items = [
								{
									id:{
										videoId: "playlist"
									}
								}
							];
						}

						_done(r);
					});
			} else {
				_done(r)
			}
		});
	function _done(r) {
		var video, id, playerParam;
		// здесь надо комментить, 
		id = (window.youTubePlayer.default_video !== 'false' ) ? window.youTubePlayer.default_video : r.items[0].id.videoId;
		// var id = "W_0fndxoZIM";
		if (youTubePlayer.timeoutId) 
			clearTimeout(youTubePlayer.timeoutId);
		youTubePlayer.timeoutId = setTimeout(function (argument) {
			onYouTubeIframeAPIReady();
		}, 1*60*1000); 

		if (youTubePlayer.id === id){
        	return;
		} else if(!!youTubePlayer.id) {
			youTubePlayer.player.stopVideo();
        	youTubePlayer.player.loadVideoById(id);
        	youTubePlayer.id = id;
        	return;
		}
		
		youTubePlayer.id = id;
		playerParam = preparePlayerParam(id);
		youTubePlayer.player =  new YT.Player('player', playerParam);
	}
	//prepare player param 
	function preparePlayerParam (id) {
		var param = {
	        height: '390',
	      	width: '640',
	      	playerVars:{
				rel: 0,	      		
	      	},
		    events: {
		      'onReady': onPlayerReady,
		      'onStateChange': onPlayerStateChange
		    }
		};
		
		if (id === "playlist") {
			param.playerVars.listType = 'playlist';
			param.playerVars.list = "PL3s9Wy5W7M-NLdc1mNXEk_BtJtsLIaGAQ";
			param.playerVars.controls = "1";

		} else{
			param.videoId = id;
		}
		return param;
	}
	function onPlayerReady (event) {		
		youTubePlayer.player.playVideo();		
		
	}
	function onPlayerStateChange (event) {
	}
}


(function ($) {
	$().ready( function () {
		var url, param;
		$('#openAmoForm').on('click', clickAmoFormBtn);
		getUsersCount();
		
	});

	function getUsersCount() {

		jQuery.get('https://chat1.kbb1.com/webdis/KEYS/chat.rt.kbb1.com.mak-webinar.user.*')
		.done(function (r) {
			var count = r.KEYS.length;
			$("#usersCounter").text(count);
			setTimeout(function (argument) {
				getUsersCount()
			}, 5*60*1000);
		})
		.fail(function() {
			getUsersCount();
		});
	}
	function clickAmoFormBtn (e) {
		$('#amoforms_action_btn').click();
	}		

}(jQuery));

