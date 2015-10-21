window.youTubePlayer;
//JSONP callback function of youtube API
function onYouTubeIframeAPIReady() {
	//youTubePlayer = new YouTubePlayer();
}
//Create Youtube vide object
function YouTubePlayer (player) {
	var obj = {};
	obj.player =  new YT.Player('player', {
        height: '390',
      	width: '640',
	    videoId: 'qwO2sHR7TdA', 
	    list: 'user_uploads',
	    events: {
	      'onReady': onPlayerReady,
	      'onStateChange': onPlayerStateChange
	    }
	});
	
	function onPlayerReady (event) {		
		youTubePlayer.player.playVideo();
		
		
	}
	function onPlayerStateChange (event) {
	}
	return obj;
}





(function ($) {
	$().ready( function () {
		$('#openAmoForm').on('click', clickAmoFormBtn);
		var space = "mak-autumn";
		initOnAirPlayer({
		  containerId: 'player',
		  channelId: "UC_tICZbwWcHI40UkEd2uP5Q",
		  space: space, 
		  liveIdUrl: 'https://rt.kbb1.com/backend/spaces/' + space + '/live-id',
		  width: 677,
		  height: 390,
		  callback: function  (title, player) {
			window.youTubePlayer = player;
			var title = title || "Нет трансляции";
			var text = title || "Нет трансляции";
			$('#title').text(text).attr('title', title);						
		} 
		  
		});

	} );
	function clickAmoFormBtn (e) {
		$('#amoforms_action_btn').click();
	}

		

}(jQuery));

