<?php do_action( 'bp_before_member_header' ); ?>

<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">
		<?php bp_displayed_user_avatar( 'type=full' ); ?>
	</a>
</div>
<!-- #item-header-avatar -->


<div id="item-header-content">
<?php
$fieldSructure = ( object ) KabCustomRegistrationHelper::getUserFieldList ();
echo <<<HTML
		<div>
			<label>{$fieldSructure->country['translate']}: </label>{$fieldSructure->country['val']}
		</div>
		<div>
			<label>{$fieldSructure->city['translate']}: </label>{$fieldSructure->city['val']}
		</div>
		<div>
			<label>{$fieldSructure->age['translate']}: </label>{$fieldSructure->age['val']}
		</div>
HTML;

?>

</div>
<!-- #item-header-content -->

<?php do_action( 'bp_after_member_header' ); ?>
<?php do_action( 'template_notices' ); ?>
