<?php
/*
 * Template Name: Custom profile
 */

$current_user_id = get_current_user_id ();
if($current_user_id == 0){
	wp_redirect(home_url());	
	return;
}

$PATH_TO_FILES = get_stylesheet_directory () . '/static_pages/custom_profile/';
$URL_TO_FILES = get_stylesheet_directory_uri () . '/static_pages/custom_profile/';

/* include dependency */
include_once ($PATH_TO_FILES . 'header.php');
wp_enqueue_script ( "jquery-ui-tabs", "jquery" );
wp_enqueue_script ( "customProfileJs", $URL_TO_FILES . "script.js" );
wp_enqueue_style ( "customProfileCss", $URL_TO_FILES . "style.css" );
wp_enqueue_style ( "bootstrapCss", "//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" );
wp_enqueue_style ( 'fonts-Roboto', 'https://fonts.googleapis.com/css?family=Roboto' );

$myAccountData = ( object ) KabCustomRegistrationHelper::getUpdateProfile ();
?>

<div class="full_width">
	<div class="container">
	<?php
	$displayName = $myAccountData->display_name ['val'];
	if ($myAccountData->first_name ['val'] != null && $myAccountData->last_name ['val'] != null) {
		$displayName = $myAccountData->first_name ['val'] . ' ' . $myAccountData->last_name ['val'];
	}
	?>
		<h1 class="pageTitle"><?php echo $displayName;?></h1>
		<div class="col-sm-2 col-xs-offset-2 avatar">
				<?php echo get_avatar ( $current_user_id, 135); ?>
			</div>


		<div id="tabs">
			<div class="col-xs-6 row">
<?php
echo <<<HTML
			<div class="col-sm-5">
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
				<ul class="course-navigation">
					<li><a href="#viewMyAccount" class="course-navigation-item">Мой
							профиль</a></li>
					<li><a href="#editMyAccount" class="course-navigation-item">
							Редактировать профиль </a></li>
				</ul>
			</div>
			<div class="row" style="clear: both;">
<?php
include_once ($PATH_TO_FILES . 'view_account.php');
include_once ($PATH_TO_FILES . 'edit_account.php');
?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>