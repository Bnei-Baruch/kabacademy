
                                    	<style>
                                    		.column2{position: relative;}
                                    		#popUpForum{
                                    			position: absolute; 
                                    			top: 0; bottom: 0; left: 0; right: 0; 
                                    			background: #FFF url("./ajax-loader.gif") center center no-repeat;
                                    			opacity: 0.8;
                                    			display: none;
                                    			z-index: 10;
                                    		}
										</style>
                                    	<div id="popUpForum"></div>
                                        <div class="add_topic_form_container">
                                            <form action="" method="post" data-bbp_forum_id = "<?php echo $forum_id ?>" >
                                                <div class="add_topic_form_header">
                                                    <div class="publication"><i
                                                            class="icon"></i><?php _e('Publication', 'qode'); ?></div>
                                                </div>
                                                <div class="add_topic_form">
                                                    <textarea
                                                        placeholder="<?php _e('Введите текст сообщения...', 'qode'); ?>"
                                                        name="content"></textarea>
                                                </div>
                                                <div class="add_topic_form_files">
                                                </div>
                                                <div class="add_topic_form_actions">
                                                    <a class="image-load" href="#"></a>
                                                    <button type="submit"><?php _e('Publish', 'qode'); ?></button>
                                                </div>
                                                <input type="hidden" name="bbp_forum_id" value="<?php echo $forum_id; ?>">
                                                <input type="hidden" name="action" value="custom-bbp-topic-create">
                                                <input type="hidden" name="security"
                                                       value="<?php echo wp_create_nonce('custom-bbp-topic-create'); ?>">
                                                <input class="attaches-input" type="hidden" name="attaches"/>
                                            </form>
                                        </div>

                                        <div
                                            class="topics_list_divider"><?php _e('Недавние обсуждения', 'qode'); ?></div>

                                            
                                    <div class="topics_list" data-list="2" data-forum="<?php echo $forum_id; ?>">
                                        <?php  
                                        $isForumModerator = (bbp_get_user_role( get_current_user_id() ) != 'bbp_moderator') && (bbp_get_user_role( get_current_user_id() ) != 'bbp_keymaster');
                                        if ( bbp_has_forums($buddypress_id) ) : 
                                            $topics = false;

                                            while ( bbp_forums() ) : bbp_the_forum();
                                                
                                                if($forum_id != bbp_get_forum_id()){

		                                        	continue;
	                                        	}
	
	                                        	$topics = bbp_has_topics( array(
                                        			'post_parent' => $forum_id,
                                        			'posts_per_page' => 11
	                                        	) );
	                                        	
	                                            if(!$topics){
	                                            	_e('This forum does not have topics', 'qode');
	                                            	break;
	                                            }
                                                $counter = 0;
                                                if (bp_group_is_visible($group))
                                                {
                                                	global $post;
                                                	$post = bbp_get_forum($forum_id);
                                                	$counter = 0;
                                                	while (bbp_topics()) : bbp_the_topic();
                                                	if (++$counter == 12) break;
                                                	?>
										            <div class="topics_list_single_topic <?php $postUser = new WP_User(bbp_get_topic_author_id());echo ($postUser->has_cap('bbp_keymaster') || $postUser->has_cap('bbp_moderator')) ? "isAdmin" : "";?>"
										                id="topic-<?php echo bbp_get_topic_id(); ?>"
										                data-id="<?php echo bbp_get_topic_id(); ?>">
										                <div class="single_topic_header">
										                    <div class="photo"><a
										                            href="<?php echo bp_core_get_user_domain(bbp_get_topic_author_id()); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => bbp_get_topic_author_id(), 'height' => 40, 'width' => 40)); ?></a>
										                    </div>
										                    <div class="info">
										                        <div class="name"><a
										                                href="<?php echo bp_core_get_user_domain(bbp_get_topic_author_id()); ?>"><?php echo bbp_get_topic_author_display_name(bbp_get_topic_id()); ?></a>       
                                                                <?php 
                                                                    if ($postUser->has_cap('bbp_keymaster'))  echo "<small>(Администратор форума)</small>"; 
                                                                    elseif ($postUser->has_cap('bbp_moderator'))  echo "<small>(Преподаватель)</small>"; 
                                                                ?>
										                        </div>
										                        <div
										                            class="date"><?php echo get_post_time('j F ', false, bbp_get_topic_id(), true) . __('at', 'qode') . get_post_time(' H:i', false, bbp_get_topic_id(), true); ?></div>
										                    </div>
										                    <?php if (bbp_get_topic_author_id() == get_current_user_id()): ?>
										                        <a href="#" class="addi_actions_open"></a>
										                        <div class="addi_actions" style="display:none">
										                            <ul>
										                                <li><a class="edit_action" href="#">Редактировать</a>
										                                </li>
										                                <li><a class="remove_action"
										                                       href="#">Удалить</a></li>
										                            </ul>
										                        </div>
										                    <?php endif; ?>
										                </div>
										                <div class="single_topic_content">
										                    <?php $content = bbp_get_topic_content();
										                    if (mb_strlen($content) > 500) {
										                        echo '<div class="show">' . mb_substr($content, 0, 500) . '... <a href="#" class="show_all">' . __('More', 'qode') . '</a></div>';
										                        ?>
										                        <div class="hide"><?php echo $content; ?></div>
										                    <?php
										                    } else {
										                        echo $content;
										                    }
										                    ?>
										                </div>
										                <div class="single_topic_attaches">
										                    <?php $attaches = get_post_meta(bbp_get_topic_id(), 'attaches', true);
										                    foreach (explode(',', $attaches) as $attach) :
										                        if (empty($attach)) continue;
										                        $r = wp_get_attachment_image_src($attach, 'full');
										                        ?>
										                        <div class="single_topic_single_attachment">
										                            <div class="attachment-image"><a target="_blank"
										                                                             href="<?php echo $r[0]; ?>"><?php echo wp_get_attachment_image($attach, 'full'); ?></a>
										                            </div>
										                            <div class="attachment-controls"><a
										                                    class="delete-attachment"
										                                    data-id="<?php echo $attach; ?>" href="#">Удалить</a>
										                            </div>
										                        </div>
										                    <?php endforeach; ?>
										                </div>
										                <div style="display:none" class="single_topic_content_edit">
										                    <textarea
										                        class="edit_content"><?php echo get_post_field('post_content', bbp_get_topic_id()); ?></textarea>
										                    <input class="attaches-input" type="hidden" name="attaches"
										                           value="<?php echo get_post_meta(bbp_get_topic_id(), 'attaches', true); ?>"/>
										
										                    <div class="edit_actions">
										                        <a class="image-load" href="#"></a>
										                        <button
										                            class="cancel"><?php _e('Cancel', 'qode'); ?></button>
										                        <button
										                            class="save"><?php _e('Save', 'qode'); ?></button>
										                    </div>
										                </div>
										                <div class="single_topic_replies_container">
										                    <div class="single_topic_replies">
										                        <?php
										                        $replies = get_posts($default = array(
										                            'post_type' => bbp_get_reply_post_type(),         // Only replies
										                            'post_parent' => bbp_get_topic_id(),       // Of this topic
										                            'posts_per_page' => 5, // This many
										                            'orderby' => 'date',                     // Sorted by date
										                            'order' => 'DESC',                      // Oldest to newest
										                            'ignore_sticky_posts' => true                       // Stickies not supported
										                        ));
										                        $i = count($replies);
										                        if ($i == 5) {
										                            $count = new WP_Query($default = array(
										                                'numberposts' => -1,
										                                'post_type' => bbp_get_reply_post_type(),         // Only replies
										                                'post_parent' => bbp_get_topic_id(),       // Of this topic
										                                'posts_per_page' => 5, // This many
										                                'orderby' => 'date',                     // Sorted by date
										                                'order' => 'DESC',                      // Oldest to newest
										                                'ignore_sticky_posts' => true                       // Stickies not supported
										                            ));
										                            $count = $count->found_posts - 4;
										                            ?><a href="#" class="load_all_replies"><i
										                                class="comments_img"></i>Просмотреть
										                            еще <?php echo $count . ' ' . custom_plural_form($count, 'комментарий', 'комментария', 'комментариев'); ?>
										                            </a>
										                        <?php
										                        }
										                        $replies = array_reverse($replies);
										                        //array_shift($replies);
										                        foreach ($replies as $reply) {
                                                                    $postUser = new WP_User($reply->post_author);
                                                                    ?>
										                            <div class="single_topic_reply <?php $postUser = new WP_User($reply->post_author);echo ($postUser->has_cap('bbp_keymaster') || $postUser->has_cap('bbp_moderator')) ? "isAdmin" : "";?>"
										                                 id="reply-<?php echo $reply->ID; ?>"
										                                 data-id="<?php echo $reply->ID; ?>">
										                                <div class="photo"><a
										                                        href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => $reply->post_author, 'height' => 32, 'width' => 32)); ?></a>
										                                </div>
										                                <div class="content_wrapper">
										                                    <div class="reply_content"><a
										                                            class="author-link"
										                                            href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bbp_get_reply_author_display_name($reply->ID); ?></a>
                                                                                    <?php 
                                                                                        if ($postUser->has_cap('bbp_keymaster'))  echo "<small>(Администратор форума)</small>" ;
                                                                                        elseif ($postUser->has_cap('bbp_moderator'))  echo "<small>(Преподаватель)</small>" ;
                                                                                    ?>
                                                                                    <?php echo bbp_get_reply_content($reply->ID); ?>
										                                    </div>
										                                    <div class="single_reply_attaches">
										                                        <?php $attaches = get_comment_meta($reply->ID, 'attaches', true);
										                                        foreach (explode(',', $attaches) as $attach) :
										                                            if (empty($attach)) continue;
										                                            $r = wp_get_attachment_image_src($attach, 'full');
										                                            ?>
										                                            <div
										                                                class="single_reply_single_attachment">
										                                                <div class="attachment-image"><a
										                                                        target="_blank"
										                                                        href="<?php echo $r[0]; ?>"><?php echo wp_get_attachment_image($attach, 'full'); ?></a>
										                                                </div>
										                                                <div
										                                                    class="attachment-controls">
										                                                    <a class="delete-attachment"
										                                                       data-id="<?php echo $attach; ?>"
										                                                       href="#">Удалить</a>
										                                                </div>
										                                            </div>
										                                        <?php endforeach; ?>
										                                    </div>
										                                    <div style="display:none"
										                                         class="reply_content_edit"><textarea
										                                            class="reply_content_edit_textarea"><?php echo get_post_field('post_content', $reply->ID); ?></textarea><input
										                                            class="attaches-input" type="hidden"
										                                            name="attaches"
										                                            value="<?php echo get_comment_meta($reply->ID, 'attaches', true); ?>"/><a
										                                            class="image-load" href="#"></a>										
										                                        <div class="edit_actions"><a
										                                                class="cancel"
										                                                href="#">Отменить</a></div>
										                                    </div>
										                                    <div class="date">
										                                    	<?php echo get_post_time('j F ', false, $reply->ID, true) . __('at', 'qode') . get_post_time(' H:i', false, $reply->ID, true); ?></span><?php $like = get_post_meta($reply->ID, 'like_' . get_current_user_id(), true); ?>
										                                    </div>
										                                </div>
										                                <?php if ($reply->post_author == get_current_user_id()): ?>
										                                    <a class="addi_actions_open" href="#"></a>
										                                    <div class="addi_actions"
										                                         style="display:none">
										                                        <ul>
										                                            <li><a class="edit_action" href="#">Редактировать</a>
										                                            </li>
										                                            <li><a class="remove_action"
										                                                   href="#">Удалить</a></li>
										                                        </ul>
										                                    </div>
										                                <?php endif; ?>
										                            </div>
										                        <?php
										                        }
										                        $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
										                        ?>
										                    </div>
										                    <div class="single_topic_reply_form">
										                        <form
										                            action="<?php echo $url; ?>#topic-<?php echo bbp_get_topic_id(); ?>"                                                                    
																	data-bbp_forum_id = "<?php echo $forum_id;?>"
										                            data-bbp_topic_id="<?php echo bbp_get_topic_id(); ?>"
										                            method="post">
										                            <div class="photo"><a
										                                    href="<?php echo bp_core_get_user_domain(get_current_user_id()); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => get_current_user_id(), 'height' => 32, 'width' => 32)); ?></a>
										                            </div>
										                            <div class="reply-form">
										                                <textarea  placeholder="<?php _e('Введите текст сообщения...', 'qode'); ?>"
										                                    name="content" ></textarea>
										                                    <a class="image-load" href="#"></a>
										
										                                <div class="add_reply_form_files">
										                                </div>
										                            </div>
										
										                            <input type="hidden" name="bbp_forum_id"
										                                   value="<?php echo $forum_id; ?>">
										                            <input type="hidden" name="bbp_topic_id"
										                                   value="<?php echo bbp_get_topic_id(); ?>">
										                            <input type="hidden" name="action"
										                                   value="custom-bbp-reply-create">
										                            <input type="hidden" name="security"
										                                   value="<?php echo wp_create_nonce('custom-bbp-reply-create'); ?>">
										                            <input class="attaches-input" type="hidden"
										                                   name="attaches"/>
										                        </form>
										                    </div>
										                </div>
										            </div>
										        <?php                                                
										        endwhile;
										        wp_reset_postdata();
										        if ($counter == 11) {
										            ?><a class="load_more_topics" href="#">Просмотреть больше обсуждений</a>
										        <?php
										        }
										    } else {
										        _e('This forum does not have topics', 'qode');
										    }
											endwhile;
										endif;
                                        ?>
                                    </div>