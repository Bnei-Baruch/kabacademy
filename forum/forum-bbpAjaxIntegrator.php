<?php
class ForumBbpAjaxIntegrator {
	private $buddypress_id = - 1;
	private $forumId = - 1;
	public function __construct($post_id = -1) {
		// maybe bugs with this
		$post_id = ($post_id != - 1) ? $post_id : $post_id = url_to_postid ( wp_get_referer () );
		$this->buddypress_id = get_post_meta ( $post_id, 'buddypress_id', true );
		$forum_id = bbp_get_group_forum_ids ( $this->buddypress_id );
		$forum_id = ! empty ( $forum_id ) ? $forum_id [0] : null;
		
		$this->forumId = $forum_id;
	}
	public function getTopicList() {
		if (is_null ( $_POST ['param'] ) || empty ( $_POST ['param'] ))
			$this->_die ();
		
		$return = array ();
		$loadFrom = empty ( $_POST ['param'] ['from'] ) ? 0 : $_POST ['param'] ['from'];
		$loadTo = empty ( $_POST ['param'] ['to'] ) ? 0 : $_POST ['param'] ['to'];
		
		$param = array (
				'post_parent' => $this->forumId,
				'posts_per_page' => 11 
		);
		if (! bbp_has_topics ( $param ))
			$this->_die ();
		
		while ( bbp_topics () ) {
			$return [] = $this->_getSinglTopic ();
		}
		return $return;
	}
	private function _getSinglTopic() {
		$autorId = bbp_get_topic_author_id();
		$topicId = bbp_get_topic_id();
		$content = bbp_get_topic_content();
		$data = array (
				'autor'=> array(
						'isCurrentUser'=> $autorId == get_current_user_id(),
						'url'=>bp_core_get_user_domain($autorId),
						'avatar' => bp_core_fetch_avatar(array('item_id' => $autorId, 'height' => 40, 'width' => 40)),
						'name' => bbp_get_topic_author_display_name($topicId)
				),
				'sDate' => get_post_time('j F ', false, $topicId, true) . __('at', 'qode') . get_post_time(' H:i', false, $topicId, true),
				'sContentShort' => mb_substr($content, 0, 500),
				'sContent' => $content,
				'like' => null 
		);
		$replay = array (
				'replayList' => null,
				'attachmentList' => null,
				'data' => $data,
				'id' => null,
				'likes' => 0 
		);
		return $replay;
	}
	public function getReplays($topicId = -1) {
		$topicId = ($topicId == - 1) ? $_POST ['param'] ['topicId'] : $topicId;
		$loadFrom = empty ( $_POST ['param'] ['from'] ) ? 0 : $_POST ['param'] ['from'];
		$loadTo = empty ( $_POST ['param'] ['to'] ) ? 0 : $_POST ['param'] ['to'];
		
		$param = array ();
		if (! bbp_has_replies ())
			$this->_die ();
		while ( bbp_replies () ) {
			bbp_the_reply ();
		}
	}
	private function _getSinglReplay() {
		$replay = array (
				'attachmentList' => array (),
				'id' => - 1,
				'likes' => 0 
		);
	}
	private function _die($msg = "error") {
		$return = array (
				'status' => 0,
				'errorMessage' => $msg 
		);
		return $return;
		wp_die ();
	}
}