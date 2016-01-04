window.youTubePlayer = {};

// YouTube API callback
function onYouTubeIframeAPIReady() {
    var url = 'https://www.googleapis.com/youtube/v3/search';

    var param = {
        part : 'snippet',
        eventType: 'upcoming',
        type: 'video',
		order: 'date',
        // channelId : 'UCAhq4ttjWzWAT4zmPXm0DZw',
        // channelId : 'UCYi0-Xrr-B7Ap4sAwR6iEpg',
        channelId : window.youtubeBroadcastChannelId,
        key : 'AIzaSyBoMXQDrlRUCQCxv4fjfiyTHXog8OB2Nz0',
    };

    jQuery.get(url, param)
    .done(function (r) {
        if(r.items.length === 0){
            param.eventType = 'live';
            jQuery.get(url, param)
            .done(function (r) {
                if(r.items.length === 0){
                    //if no live dont show anything
                    if (youTubePlayer.timeoutId) 
                        clearTimeout(youTubePlayer.timeoutId);
                    
                    youTubePlayer.timeoutId = setTimeout(function (argument) {
                        onYouTubeIframeAPIReady();
                    }, 1*60*1000); 

                    /*
                    param.eventType = 'completed';
                    jQuery.get(url, param)
                    .done(_done)
                    .fail(function() {
                       // alert("error");
                    });*/
                } else {
                    _done(r);
                }						
            })
            .fail(function() {
                //alert("error");
            });
        } else {
            _done(r);
        }
    })
    .fail(function() {
       // alert("error");
    });
    function _done(r) {
        var video;
        // здесь надо комментить, 
        var id = (r.items.length === 0 ) ? "W_0fndxoZIM" : r.items[0].id.videoId;
        // var id = "C4CyuxSbDXo";

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

        youTubePlayer.id = id;

        youTubePlayer.player =  new YT.Player('lveventplayer', {
            width: '677',
            height: '390',
            videoId: id, 
            playerVars:{
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
        add_points(pointsType,user_id, cousrse_id, '');	
    }

    function onPlayerStateChange (event) {
    }
}
