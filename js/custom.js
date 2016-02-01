(function($){
    $(document).ready(function(){
        // $('#tabii2slider').liquidSlider();
        $('.add_topic_form textarea').autosize();
        $('.topics_list .single_topic_reply_form textarea').autosize();

/** Bind events */
        $(".reply_content_edit_textarea").on('keypress', keypress_replies_handler);
        $('.topics_list').on("keypress", ".single_topic_reply_form .reply-form textarea", custom_bbp_reply_create_keypress);

        
        $('.topics_list').on('click',".single_topic_reply .addi_actions_open", single_topic_reply_open);
        $('.topics_list').on('click', ".single_topic_header .addi_actions_open", addi_actions_open);
        
        $(".topics_list").on('click', '.single_topic_content_edit .edit_actions .save', single_topic_content_edit);
        $(".topics_list").on('click', '.single_topic_reply .remove_action', single_topic_reply_remove);
        $('.topics_list').on('click', ".single_topic_header .remove_action",single_topic_header_remove);
        
        $(".topics_list").on('click', '.reply_content_edit .cancel', reply_content_edit_cancel);
        $(".topics_list").on('click', '.single_topic_content_edit .cancel', single_topic_content_edit_cancel);

        $(".topics_list").on('click', '.single_topic_header .edit_action', single_topic_header_edit);
        $(".topics_list").on('click', '.single_topic_reply .edit_action', single_topic_reply_edit);
        
        $(".topics_list").on('click', '.single_topic_reply_form .smiles_open', single_topic_reply_form_smiles_open);
        $(".topics_list").on('click', '.reply_content_edit .smiles_open', reply_content_edit_smiles_open);
       
        $(".topics_list").on('click', '.single_topic_actions .like, .single_topic_reply .like', single_topic_actions_like);
        
        $(".topics_list").on('click', '.single_topic_reply_form .smile', smiles_list);
        
        $(".single_topic_content .show_all").on('click', show_all);
        $(".load_all_replies").on('click', load_all_replies);
        $(".load_more_topics").on('click', load_more_topics);

        $(document).on('click', function(e) {
            if(!$(e.target).hasClass('opened')){
                $('.single_topic_header .addi_actions').hide();
                $('.single_topic_header .addi_actions_open.opened').removeClass('opened');
            }            
            if ($(e.target).closest('.smiles_list').length == 0 && !$(e.target).hasClass('smiles_open'))
                $('.reply-form .smiles_list').hide();
        });
    });

        var opts = {
            on: {
                load: function(e, file) {
                    var upl     = $("#image-uploader"),
                        type    = upl.data('type'),
                        id      = upl.data('id'),
                        name    = file.extra.nameNoExtension,
                        ext     = file.extra.extension;

                    if(ext != 'jpg' && ext != 'jpeg' && ext != 'png' && ext != 'gif'){
                        return;
                    }
                    $("#popUpForum").show()
                    $.post( customjs.ajaxurl, {
                        'action': 'upload-forum-file',
                        'type': type,
                        'file': e.target.result,
                        'id': id,
                        'ext': ext,
                        'name': name
                    }, function( response ) {
                    	$("#popUpForum").hide();
                        var input = '';

                        if(id == '') {
                            if(type == 'post') {
                                input = $('.add_topic_form_container .attaches-input');
                                $('.add_topic_form_container .add_topic_form_files').append(response.content);
                            } else {
                                input = $('.single_topic_reply_form .attaches-input');
                                var topicId = $("#image-uploader").attr('data-topicId');
                                $('#topic-' + topicId).find('.add_reply_form_files').append(response.content);
                            }
                        }else{
                            if(type == 'post') {
                                input = $('#topic-' + id + ' .attaches-input');
                                $('#topic-' + id + ' .single_topic_attaches').append(response.content);
                            } else {
                                input = $('#reply-' + id + ' .attaches-input');
                                $('#reply-' + id + ' .single_reply_attaches').append(response.content);
                            }
                        }

                        input.val((input.val() != '') ? input.val() + ',' + response.id : response.id);

                    }, 'json')
                    .fail(function(error) {
                    	$("#popUpForum").hide();
                		//$("#popUpForum").show().html(response);
                		alert('The image is too big.');
                    });
                }
            }
        };

        $("#image-uploader").fileReaderJS(opts);
        $(".add_topic_form_actions")
        .on("click", "button", custom_bbp_topic_create)
        .on('click', ".image-load", function(e) {
            e.preventDefault();
            $("#image-uploader")
            .attr({ value: '' })
            .data('type', 'post')
            .data('id', '')
            .click();
        });
        $(".single_topic_reply_form").on('click', ".image-load", function(e) {
            e.preventDefault();
            var topicId = $(this).closest(".topics_list_single_topic").attr('data-id');
            $("#image-uploader")
            .attr({ value: '' })
            .data('type', 'comment')
            .data('id', '')
            .attr('data-topicId', topicId)
            .click();
        });
        
        $(".single_topic_content_edit").on('click', ".image-load", function(e) {
            e.preventDefault();
            $("#image-uploader")
            .attr({ value: '' })
            .data('type', 'post')
            .data('id', $(this).closest(".topics_list_single_topic").data('id'))
            .click();
        });
        $(".single_topic_reply").on('click', ".image-load", function(e) {
            e.preventDefault();

            $("#image-uploader")
            .attr({ value: '' })
            .data('type', 'comment')
            .data('id', $(this).closest(".single_topic_reply").data('id'))
            .click();
        });


        $(".add_topic_form_container").on('click', ".delete-attachment", function(e){
        	e.preventDefault();            
            deleteAttachment.apply(this);
        });

        $(".single_topic_replies_container").on('click', ".delete-attachment", function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var ptid = $(this).closest('.single_topic_reply').data('id');
            $("#popUpForum").show()
            $.post( customjs.ajaxurl, {
                'action': 'delete-attachment',
                'id': id,
                'type': 'comment',
                'ptid': ptid
            }, function( response ) {$("#popUpForum").hide()}, 'json');
            deleteAttachment.apply(this);
        });

  
    
    function deleteAttachment(){
    	$(this).closest('.single_topic_reply_form')
    	.find('.attaches-input')
    	.val(
    		input.val()
    		.replace(new RegExp($(this).data('id')), '')
			.replace(new RegExp(',$'), '')
			.replace(new RegExp('^,'), '')
			.replace(new RegExp(',,'), ',')
		);
    
    	$(this).closest('.single_reply_single_attachment').remove();
    }
    
    
    
/** * Binded functions */

    function keypress_replies_handler(e) {
        var key, $this;
        key = e.which;
        if(key != 13 && key != 10)
        	return;
        $this = $(this);
        if(e.ctrlKey) {
        	$this.val($this.val() + "\r\n").trigger('autosize.resize');
        } else {
        	var reply = $this.closest('.single_topic_reply');
        	$("#popUpForum").show();
        	$.post( customjs.ajaxurl, {
        		'action': 'update-reply-custom',
        		'id': reply.data('id'),
        		'content': reply.find('.reply_content_edit_textarea').val(),
        		'attaches': reply.find('.attaches-input').val()
        	}, function( response ) {
        		$("#popUpForum").hide();
        		if(response.result == 'OK'){
        			reply.find('.reply_content_edit').hide();
        			var link = reply.find('.reply_content a').clone();
        			
        			reply.find('.reply_content').html(link.prop('outerHTML') + response.content).show();
        			reply.find('.actions').show();
        		}
        	}, 'json');
        }
    }
    function custom_bbp_topic_create (e) {
        e.preventDefault();
        $el = $(e.currentTarget);
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'custom_bbp_topic_create',
            'bbp_forum_id': $el.parents("form").attr("data-bbp_forum_id"),
            'content': $el.parents("form").find("textarea[name=content]").val(),
            'attaches': $el.parents("form").find('.attaches-input').val()
        }, function( r ) {
        	$("#popUpForum").hide();
            if(jQuery.isNumeric(r)){
                location.reload();
            }
        }, 'json');
    }
    function custom_bbp_reply_create_keypress(e) {
        var key, $this; 
        key = e.which;
        if(key != 13 && key != 10)
            return;

        e.preventDefault();
        $this = $(this);
        
        if(e.ctrlKey)
            $this.val($this.val() + "\r\n").trigger('autosize.resize');
        else{
            e.preventDefault();
            custom_bbp_reply_create(e);
        }
    }
    function custom_bbp_reply_create(e) {
        var $el = $(e.currentTarget).parents("form");
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'custom_bbp_reply_create',
            'bbp_topic_id': $el.attr('data-bbp_topic_id'),
            'bbp_forum_id': $el.attr('data-bbp_forum_id'),
            'content': $el.find('.reply-form textarea').val(),
            'attaches': $el.find('.attaches-input').val()
        }, function( r ) {
        	$("#popUpForum").hide();
            if(jQuery.isNumeric(r)){
                location.reload();
            }
        }, 'json');
    }
    
    function addi_actions_open (e) {
        e.preventDefault();
        var wind = $(this).closest('.single_topic_header').find('.addi_actions');

        if(!$(this).hasClass('opened')){
            $(".single_topic_header, .single_topic_reply").find(".addi_actions").hide();
            $(".single_topic_header, single_topic_reply").find(".addi_actions_open.opened").removeClass("opened");
            wind.show();
            $(this).addClass('opened');
        } else {
            wind.hide();
            $(this).removeClass('opened');
        }
    }
    function single_topic_header_remove(e){
        e.preventDefault();

        var topic = $(this).closest('.topics_list_single_topic');
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'remove-topic-custom',
            'id': topic.data('id')
        }, function( response ) {
        	$("#popUpForum").hide();
            if(response.result == 'OK'){
                topic.remove();
            }
        }, 'json');
    }
    function single_topic_reply_open (e) {
        e.preventDefault();

        var wind = $(this).closest('.single_topic_reply').find('.addi_actions');

        if(!$(this).hasClass('opened')){
            $('.single_topic_reply .addi_actions').hide();
            $('.single_topic_reply .addi_actions_open.opened').removeClass('opened');
            $('.single_topic_header .addi_actions').hide();
            $('.single_topic_header .addi_actions_open.opened').removeClass('opened');
            wind.show();
            $(this).addClass('opened');
        }else {
            wind.hide();
            $(this).removeClass('opened');
        }
    }
    
    function single_topic_reply_remove(e){
        e.preventDefault();

        var reply = $(this).closest('.single_topic_reply');
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'remove-reply-custom',
            'id': reply.data('id')
        }, function( response ) {
        	$("#popUpForum").hide();
            if(response.result == 'OK'){
                reply.remove();
            }
        }, 'json');
    }
    function show_all(e){
        e.preventDefault();
        var content = $(this).closest('.single_topic_content');
        content.find('.show').hide();
        content.find('.hide').show();
    }
    function single_topic_content_edit(e){
        e.preventDefault();

        var topic = $(this).closest('.topics_list_single_topic');
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'update-topic-custom',
            'id': topic.data('id'),
            'content': topic.find('.single_topic_content_edit .edit_content').val(),
            'attaches': topic.find('.single_topic_content_edit .attaches-input').val()
        }, function( response ) {
        	$("#popUpForum").hide();
            if(response.result == 'OK'){
                topic.find('.single_topic_content .show').hide();
                topic.find('.single_topic_content_edit').hide();
                topic.find('.single_topic_content .hide').html(response.content).show();
                topic.find('.single_topic_content').show();
            }
        }, 'json');
    }
    function single_topic_content_edit_cancel (e) {
        e.preventDefault();

        var topic = $(this).closest('.topics_list_single_topic');

        topic.find('.single_topic_content_edit').hide();
        topic.find('.single_topic_content').show();
    }
    function reply_content_edit_cancel (e) {
        e.preventDefault();

        var reply = $(this).closest('.single_topic_reply');

        reply.find('.reply_content_edit').hide();
        reply.find('.reply_content').show();
        reply.find('.content_wrapper > .actions').show();
    }
    
    function single_topic_header_edit(e){
        e.preventDefault();

        var topic = $(this).closest('.topics_list_single_topic');

        topic.find('.single_topic_content').hide();
        topic.find('.single_topic_content_edit').show();
        topic.find('.single_topic_content_edit textarea').trigger('autosize.resize');
    }
    
    function single_topic_reply_edit(e){
        e.preventDefault();

        var reply = $(this).closest('.single_topic_reply');

        reply.find('.reply_content').hide();
        reply.find('.actions').hide();
        reply.find('.reply_content_edit').show();
        reply.find('.reply_content_edit textarea').trigger('autosize.resize');
    }
    function single_topic_reply_form_smiles_open(e){
        e.preventDefault();

        var smiles_list = $(e.target).closest('.reply-form').find('.smiles_list');

        if(smiles_list.length == 0) {
            $(e.target).after($('.smiles_list').first().clone());
            smiles_list = $(e.target).closest('.reply-form').find('.smiles_list');
        }

        if(!smiles_list.is(':visible'))
            smiles_list.show();
        else
            smiles_list.hide();
    }
    function reply_content_edit_smiles_open(e){
        e.preventDefault();

        var smiles_list = $(e.target).closest('.reply_content_edit').find('.smiles_list');

        if(smiles_list.length == 0) {
            $(e.target).after($('.smiles_list').first().clone());
            smiles_list = $(e.target).closest('.reply_content_edit').find('.smiles_list');
        }
        if(!smiles_list.is(':visible'))
            smiles_list.show();
        else
            smiles_list.hide();
    }
    function smiles_list(e){
        e.preventDefault();

        var val = $(this).data('replace');

        var textarea = $(this).parent().siblings('textarea');

        textarea.focus();
        textarea.val(textarea.val() + val);
    }
	function single_topic_actions_like(e){
        e.preventDefault();

        var $this = $(this);
        var $parent = $this.closest('.topics_list_single_topic');
        if(!$parent)
            $parent = $this.closest('.single_topic_reply');

        var id = $parent.data('id');

        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'like-custom',
            'id': id
        }, function( response ) {
        	$("#popUpForum").hide();
            if(response.result == 'OK'){
                var needles = $this.closest('.single_topic_actions');

                if(response.count == 0){
                    needles.find('.like-count').hide();
                }else{
                    needles.find('.like-count').show();
                }

                needles.find('.count').text(response.count);

                if($this.hasClass('dislike')){
                    $this.hide();
                    $this.prev().show();
                }else{
                    $this.hide();
                    $this.next().show();
                }
            }
        }, 'json');
    }
	function load_all_replies(e){
        e.preventDefault();

        var id = $(this).closest('.topics_list_single_topic').data('id'),
            $this = $(this),
            cont = $this.parent();

        $this.remove();
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'load-all-replies',
            'id': id
        }, function( response ) {
        	$("#popUpForum").hide();
            if(response.result == 'OK'){
                cont.prepend(response.content);
            }
        }, 'json');
    }
	function load_more_topics(e){
        e.preventDefault();

        var forum = $(this).closest('.topics_list').data('forum'),
            list = $(this).closest('.topics_list'),
            $this = $(this),
            cont = $this.parent();

        $this.remove();
        $("#popUpForum").show();
        $.post( customjs.ajaxurl, {
            'action': 'load-more-topics',
            'forum': forum,
            'list': list.data('list')
        }, function( response ) {
        	$("#popUpForum").hide();
            if(response.result == 'OK'){
                cont.append(response.content);

                list.data('list', parseInt(list.data('list')) + 1)
            }
        }, 'json');
    }
})(jQuery);
function add_points(pointsType, userId, courseId, newLink) {
		
	if(pointsType =="" || userId == "" || courseId ==""){
		return false;
	}

	//userId is number
	if ( !jQuery.isNumeric(userId) || !jQuery.isNumeric(courseId) ){
		return false;
	}

	//is correct point's type
	if(pointsType != 'workshop' && pointsType != 'webinar' && pointsType != 'forum' && pointsType != 'archive' && pointsType != 'webinarTT' && pointsType != 'webinarSF' && pointsType != 'webinarPH' && pointsType != 'webinarMS' && pointsType != 'webinarVS') {
		return false;
	}


	var the_data = {
		action: 'update_points_system',
		userId: userId,
		courseId: courseId,
		pointsType: pointsType
	}

	jQuery.ajax({
	   url: custom_ajax_vars.ajax_url,
	   data: the_data,
	   type: "post",
	   success: function (response){
	   	console.log(response);
			if (response == 1) {
				if (pointsType == 'workshop') {
					window.open(newLink, '_blank');
				};
			}
			else{
				console.log(response);
			}
	   },
	   error: function() {
		   console.log('Ajax not submited');
	   }
	});

	return false;
}