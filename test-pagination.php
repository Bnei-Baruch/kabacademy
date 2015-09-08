<?php
/*
Template Name: Test Pagination
*/
?>
<?php get_header(); ?>

		<div class="container">
    		 <div class="column1">
                                        <div id="buddypress" class="group_users">
											
												<?php if ( bp_group_has_members("group_id=7&exclude_admins_mods=1&per_page=10") ) : ?>
												
												 	<ul id="member-list" class="item-list" role="main">

														<?php while ( bp_group_members() ) : bp_group_the_member(); ?>

															<li>
																<a href="<?php bp_group_member_domain(); ?>">

																	<?php bp_group_member_avatar_thumb(); ?>

																</a>

																<h5><?php bp_group_member_link(); ?></h5>
																<span class="activity"><?php bp_group_member_joined_since(); ?></span>

																<?php do_action( 'bp_group_members_list_item' ); ?>

																<?php if ( bp_is_active( 'friends' ) ) : ?>

																	<div class="action">

																		<?php bp_add_friend_button( bp_get_group_member_id(), bp_get_group_member_is_friend() ); ?>

																		<?php do_action( 'bp_group_members_list_item_action' ); ?>

																	</div>

																<?php endif; ?>
															</li>

														<?php endwhile; ?>

													</ul>
													<div id="pag-bottom" class="pagination">

														<div class="pag-count" id="member-count-bottom">

															<?php bp_members_pagination_count(); ?>

														</div>

														<div class="pagination-links" id="member-pag-bottom">

															<?php bp_members_pagination_links(); ?>

														</div> 
														

													</div> 
												<?php else: ?>
												 
												  <div id="message" class="info">
													<p>This group has no members.</p>
												  </div>
												 
												<?php endif;?>											
                                        </div>
                                    </div>
</div>

<?php get_footer(); ?>