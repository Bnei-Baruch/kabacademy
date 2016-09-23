(function($) {
	$(document).ready(function() {
		var topicTpl, attachesTpl, replayTpl;

		/*topicTpl = Handlebars.compile($('#singleTopicTpl').html());
		attachesTpl = Handlebars.compile($('#attachmentsTpl').html());
		replayTpl = Handlebars.compile($('#replayTpl').html());
*/
		var param = {
			'action' : 'forum_getTopicList',
			'param' : {
				'from' : 0,
				'to' : 20
			}
		}
		//_post(param, renderTopic);

		$('#test').on('click', function() {
			_post(param, renderTopic);
		});

	});
	function renderTopic(data) {
		var html = topicTpl(data);
	}

	function _post(data, callback) {
		$.post(ajaxurl, data, function(data) {
			callback(data);
		}, 'json').fail(function() {
			alert("error");
		});
	}

}(jQuery));