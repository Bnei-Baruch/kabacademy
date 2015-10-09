<?php
$forumUrl = get_bloginfo ( 'stylesheet_directory' ) . '/forum';
$forumPath = get_stylesheet_directory () . '/forum';

include_once ($forumPath . '/forum-bbpAjaxIntegrator.php');
wp_enqueue_script ( 'bbAjaxForum', $forumUrl . '/js/script.js', array (
		'jquery' 
) );

add_action ( 'init', function () {
	$forum = new ForumBbpAjaxIntegrator ();
	add_action ( 'wp_ajax_forum_getTopicList', array (
			$forum,
			'getTopicList' 
	) );
} );



