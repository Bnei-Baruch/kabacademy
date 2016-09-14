(function () {
	window.hypercommentsAPI = {
		initById: initById,
		initModerator: initModerator
	}
	function initById(id){
	    if("HC_LOAD_INIT" in window)
	    	return;

	    HC_LOAD_INIT = true;
	    
	    var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "en").substr(0, 2).toLowerCase();
	    
	    var hcc = document.createElement("script"); 
	    hcc.type = "text/javascript"; 
	    hcc.async = true;
	    
	    hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/"+id+"/"+lang+"/widget.js";

	    var s = document.getElementsByTagName("script")[0];
	    s.parentNode.insertBefore(hcc, s.nextSibling);

	}

	function initModerator(param) {
		//setTimeout(function () {}, 1000);
		var url = 'http://c1api.hypercomments.com/1.0/users/add_moderator';
        $.ajax({
          method: "GET",
          url: url,
          data: param,
          crossDomain: true,
          dataType: "jsonp"
        })
        .done(function( msg ) {
           //alert( "Data Saved: " + msg );
        });
	}

	
}())