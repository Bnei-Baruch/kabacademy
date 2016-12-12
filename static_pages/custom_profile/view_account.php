
<div id="viewMyAccount">
	<div class="col-sm-4 row">

		<div class="col-sm-6">
			<?php echo get_avatar ( get_current_user_id (), 250); ?>
		</div>
	<?php
	echo <<<HTML
	<div class="col-sm-6">
		<div>
			<label>{$myAccountData->country['translate']}: </label>{$myAccountData->country['val']}
		</div>
		<div>
			<label>{$myAccountData->city['translate']}: </label>{$myAccountData->city['val']}
		</div>
		<div>
			<label>{$myAccountData->age['translate']}: </label>{$myAccountData->age['val']}
		</div>
	</div>
HTML;
	?>
	</div>
	<div><?php echo  do_shortcode ( '[namaste-mycourses]' ); ?></div>

</div>