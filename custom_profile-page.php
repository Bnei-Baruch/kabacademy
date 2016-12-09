<?php
/*
 * Template Name: Custom profile
 */
$PATH_TO_FILES = '/static_pages/custom_profile/';
$URL_TO_FILES = get_stylesheet_directory_uri () . $PATH_TO_FILES;

/* include dependency */
include_once ($PATH_TO_FILES . 'header.php');
wp_enqueue_script ( "jquery-ui-tabs", "jquery" );
wp_enqueue_script ( "customProfileJs", $URL_TO_FILES . "script.js" );
wp_enqueue_style ( "customProfileCss", $URL_TO_FILES . "style.css" );
wp_enqueue_style ( "bootstrapCss", "//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" );

$myAccountData = ( object ) KabCustomRegistrationHelper::getUpdateProfile ();
?>

<div class="full_width">
	<div class="container">
		<div id="tabs">
			<div class="col-xs-6 col-xs-offset-3 row">
				<ul class="course-navigation">
					<li><a href="#viewMyAccount" class="course-navigation-item">Prosmotret
							profil</a></li>
					<li><a href="#editMyAccount" class="course-navigation-item">Redaktirovat
							profil</a></li>
				</ul>
			</div>
			<div  class="col-xs-12">
			<?php
			include_once ($PATH_TO_FILES . 'view_account.php');
			include_once ($PATH_TO_FILES . 'edit_account.php');
			?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>