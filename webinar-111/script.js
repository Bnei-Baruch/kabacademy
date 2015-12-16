window.youTubePlayer = {};
// JSONP callback function of youtube API /////////////
function onYouTubeIframeAPIReady() {
	url = 'https://www.googleapis.com/youtube/v3/search';
	param = {
			part : 'snippet',
			order : 'date',
			maxResults : 20,
			channelId : 'UCAhq4ttjWzWAT4zmPXm0DZw',
			key : 'AIzaSyBoMXQDrlRUCQCxv4fjfiyTHXog8OB2Nz0'
	}
	jQuery.get(url, param)
		.done(_done)
		.fail(function() {
			alert("error");
		});
	function _done(r) {
		var video;
		r.items.some(function(item){
			if(item.snippet.liveBroadcastContent === 'live'){
				video = item;
				return true; 
			}
		});
		var id = !video ? "Pk1xJ37Zjdg" : video.id.videoId;
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
		youTubePlayer.player =  new YT.Player('player', {
	        height: '390',
	      	width: '640',
	      	videoId: id, 
		    events: {
		      'onReady': onPlayerReady,
		      'onStateChange': onPlayerStateChange
		    }
		});
		
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
		/* 
		 * get viewers counter
		 * 
		 jQuery.get('https://chat1.kbb1.com/webdis/KEYS/chat.rt.kbb1.com.mak-webinar.user.*')
		.done(_done)
		.fail(function() {
			alert("error");
		});*/
		
	});
	function clickAmoFormBtn (e) {
		$('#amoforms_action_btn').click();
	}		

}(jQuery));

