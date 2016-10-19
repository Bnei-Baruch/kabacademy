
<div class="column1">
	<div class="full_width">
		<div id="buddypress" class="group_users">
			<!--  <?php if (bp_group_has_members("group_id=$buddypress_id&exclude_admins_mods=0&per_page=6")) : ?>

                                                <ul id="member-list" class="item-list">
                                                    <?php while (bp_group_members()) : bp_group_the_member(); ?>
                                                        <li>

                                                          
                                                            <div class="photo"><a
                                                                    href="<?php echo $isForumModerator ? bp_get_group_member_url(): '#'; ?>"><?php bp_group_member_avatar(array('height' => 40, 'width' => 40)); ?></a>
                                                            </div>
                                                            <div class="name"><a
                                                                    href="<?php echo $isForumModerator ? '#': bp_get_group_member_url();  ?>"><?php bp_group_member_name(); ?></a>
                                                            </div>

                                                        </li>
                                                    <?php endwhile; ?>
                                                </ul>
				
                                            <?php else: ?>

                                                <div id="message" class="info">
                                                    <p><?php _e('This group has no members', 'qode'); ?></p>
                                                </div>

                                            <?php endif; ?> -->
											
											
											
												<?php if ( bp_group_has_members("group_id=$buddypress_id&exclude_admins_mods=1") ) : ?>
												
												 	<ul id="member-list" class="item-list" role="main">

														<?php
													while ( bp_group_members () ) :
														bp_group_the_member ();
														if (get_user_by ( 'id', bp_get_group_member_id () )->user_status == 2)
															continue;
														?>

															<li><a href="<?php bp_group_member_domain(); ?>">

																	<?php bp_group_member_avatar_thumb(); ?>

																</a>

					<h5><?php bp_group_member_link(); ?></h5> <span class="activity"><?php bp_group_member_joined_since(); ?></span>

																<?php do_action( 'bp_group_members_list_item' ); ?>
															</li>

														<?php endwhile; ?>

													</ul>
			<div id="pag-bottom" class="pagination">

				<div class="pag-count" id="member-count-bottom">

															<?php //bp_members_pagination_count(); ?>
															<?php $group = groups_get_group( array( 'group_id' => $buddypress_id) ); $groupLink = '/gruppyi/' . $group->slug . '/members/'; ?>

															<a class="pagination-links button small"
						href="<?php echo $groupLink; ?>" target="_blank"><?php echo __('View all members','qode')?></a>

				</div>

				<!-- <div class="pagination-links" id="member-pag-bottom">

															<?php //bp_members_pagination_links(); ?>

														</div> -->
			</div> 
												<?php else: ?>
												 
												  <div id="message" class="info">
				<p>This group has no members.</p>
			</div>
												 
												<?php endif;?>											
                                        </div>

	</div>
</div>
<div class="column2">