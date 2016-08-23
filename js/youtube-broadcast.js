//Create global youTubePlayer object (singleton)
(function(){
    if(window.youTubePlayer instanceof YouTubePlayer)
    return;
    if(window.youTubePlayer)
        var default_video = window.youTubePlayer.default_video;
    window.youTubePlayer = new YouTubePlayer(default_video);
  function YouTubePlayer(dVideo){
    var _prefix = "l_";
    //
    var _liveListListner = [];
    return {
        default_video: dVideo,
        getLiveListnerList: function(){return _liveListListner;},
      addLiveListner: function(foo){
        var id = _prefix + _liveListListner.length;
        _liveListListner.push({id: id, action: foo});
        if (window.youTubePlayer.isLive)
            foo();
        return id;
      },
      removeLiveListner: function(id){
    	  var index = this.getListnerIndexById(id);
        splice(_liveListListner[index], 1);
      },
      getListnerIndexById: function(id){
    	  var index = _liveListListner.some(function (index, val){
    		  if(val.id === id)
    			  return true;
    		  return false;
    	  });
    	  return index;
      }
    };
  }
} ());

// YouTube API callback
function onYouTubeIframeAPIReady() {
    var url = 'https://www.googleapis.com/youtube/v3/search';

    var param = {
        part : 'snippet',
        eventType: 'live',
        type: 'video',
		order: 'date',
        channelId : window.youtubeBroadcastChannelId,
        key : 'AIzaSyBoMXQDrlRUCQCxv4fjfiyTHXog8OB2Nz0',
    };

    jQuery.get(url, param)
    .done(function (r) {
        if(r.items.length === 0){
            param.eventType = 'upcoming';
            jQuery.get(url, param)
            .done(function (r) {
                if(r.items.length === 0){
                    //if no live dont show anything
                    if (youTubePlayer.timeoutId) 
                        clearTimeout(youTubePlayer.timeoutId);
                    
                    youTubePlayer.timeoutId = setTimeout(function (argument) {
                        onYouTubeIframeAPIReady();
                    }, 1*60*1000); 
                } else {
                    _buildPlayer(r);
                }						
            });
        } else {
            _buildPlayer(r);
        }
    });


    function _buildPlayer(r) {
        var video;
        if (window.youtubeCourseVideoLiveId) {
            initYTPlayer(window.youtubeCourseVideoLiveId);
            return;
        }

        var id = (r.items.length === 0 ) ? "W_0fndxoZIM" : r.items[0].id.videoId;
        

        if (youTubePlayer.timeoutId) 
            clearTimeout(youTubePlayer.timeoutId);
        youTubePlayer.timeoutId = setTimeout(function (argument) {
            onYouTubeIframeAPIReady();
        }, 1*60*1000);    
        
        if (youTubePlayer.id === id) {
            return;
        } else if(!!youTubePlayer.id) {
            youTubePlayer.player.stopVideo();
            youTubePlayer.player.loadVideoById(id);
            youTubePlayer.id = id;
            return;
        }

        initYTPlayer(id);

        //Observe watching of live 
        if(r.items && r.items[0] && r.items[0].snippet.liveBroadcastContent){
            if(
                r.items[0].snippet.liveBroadcastContent === "live"||
                r.items[0].snippet.liveBroadcastContent === "upcoming"
            ){
            runLiveListners();
          } else
            window.youTubePlayer.isLive = false;
        }
    }


    function runLiveListners(){
        window.youTubePlayer.isLive = true;
        window.youTubePlayer.getLiveListnerList().forEach(function(l){
          if(typeof l.action === "function")
            l.action();
        });
    }

    function initYTPlayer(id){
        youTubePlayer.id = id;
        youTubePlayer.player = new YT.Player('lveventplayer', {
            width: '677',
            height: '390',
            videoId: id, 
            playerVars: {
                rel: 0,             
            },
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerReady (event) {		
        youTubePlayer.player.playVideo();
    }

    function onPlayerStateChange (e) {
        window.youtubeCourseVideoLiveId && e.data === 1 && runLiveListners();
    }
}
