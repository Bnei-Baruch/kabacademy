function playVid() {
	$("#player-thumbnail").hide();
	if (!emb) {
		var emb = $("<embed>")
				.attr(
						{
							src : 'http://www.tv.kabbalah.info/sites/all/modules/jwplayermodule/player-4-licensed-viral.swf',
							allowscriptaccess : 'always',
							allowfullscreen : 'true',
							width : '623px',
							height : '382px',
							flashvars : '&anvatoanalytics.tracker=40837556&bandwidth=5000&config=http%3A%2F%2Fwww.tv.kabbalah.info%2Fsites%2Fall%2Fmodules%2Fjwplayermodule%2Fconfigs%2Fvodplayer-2.xml&controlbar.margin=0&controlbar.size=32&dock=true&file=%2Feng%2Fshows%2Fpaths%2Feng_ravvsakm_paths_spirituality_2010-04-22_tweb-360.mp4&frontcolor=FFFFFF&gapro.accountid=UA-15821782-2&hd.file=%2Feng%2Fshows%2Fpaths%2Feng_ravvsakm_paths_spirituality_2010-04-22_tweb-720.mp4&hd.state=false&image=http%3A%2F%2Fwww.tv.kabbalah.info%2Fsites%2Fdefault%2Ffiles%2Fimagecache%2Fvideo_img%2Fpathspirituality1.jpg&level=0&plugins=gapro-1%2Canvatoanalytics%2Cviral-2%2Cwowzalb-1%2Chd-1&skin=http%3A%2F%2Ftv.kabbalah.info%2Fsites%2Fall%2Fmodules%2Fjwplayermodule%2Fskins%2Fmodieus.swf&streamer=rtmp%3A%2F%2Fflash1.na.kab.tv%2Ffastplay&title=What%20Exactly%20Is%20Spirituality%3F&viral.bgcolor=333333&viral.callout=none&viral.email_footer=http%3A%2F%2Fwww.tv.kabbalah.info&viral.functions=link%2Cembed&viral.matchplayercolors=true&viral.menu=true&viral.onpause=false&autostart=true',
							id : 'interview-video'
						});
		$('#player').append(emb);

	}
}
$(function() {

	var $tabs = $("#tabs").tabs();
	var $subtabs = $("#course-description").tabs();
	$('.reg-button').click(function() {
		$tabs.tabs('select', 2);
		$subtabs.tabs('select', 1);
		/* $("div#register").scrollTop(-200); */
		$("body,html").scrollTop(0);

		return false;
	});

	$('.slideshow').cycle({
		fx : 'fade',
		speed : 1200,
		timeout : 5000

	});

	$("a#scrollTop").click(function() {

		$("html, body").scrollTop(0);

	});
	/***************************************************************************
	 * $("#navigation ul li").hover(function () {
	 * $(this).not('.ui-tabs-selected').find('a').css({"opacity" : "1"}); },
	 * function () { var cssObj = { "opacity" : "0.75", "font-weight" : "" }
	 * $(this).not('.ui-tabs-selected').find('a').css(cssObj); });
	 **************************************************************************/
});