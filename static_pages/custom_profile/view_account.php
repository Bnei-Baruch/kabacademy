
<div id="viewMyAccount">
	<div>
		<?php echo get_avatar ( get_current_user_id ()); ?>
	</div>
	<div>
	<?php
	echo <<<HTML
<div>
	<label>{$myAccountData->country['translate']}: </label>{$myAccountData->country['val']}
</div>
<div>
	<label>{$myAccountData->city['translate']}: </label>{$myAccountData->city['val']}
</div>
<div>
	<label>{$myAccountData->age['translate']}: </label>{$myAccountData->age['val']}
</div>
HTML;
	?>
	</div>

	<div><?php do_shortcode ( '[namaste-mycourses]' ); ?></div>

</div>