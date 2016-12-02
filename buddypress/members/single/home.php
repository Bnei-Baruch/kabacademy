<div id="buddypress">
	<?php do_action( 'bp_before_member_home_content' ); ?>

	<div id="item-header" role="complementary">
		<?php bp_get_template_part( 'members/single/member-header' ) ?>
	</div><!-- #item-header -->
	
	<div id="item-body">
		<?php
			do_action( 'bp_before_member_body' );
			bp_get_template_part( 'members/single/profile'  );
			do_action( 'bp_after_member_body' ); ?>

	</div><!-- #item-body -->
	<?php do_action( 'bp_after_member_home_content' ); ?>

</div><!-- #buddypress -->
