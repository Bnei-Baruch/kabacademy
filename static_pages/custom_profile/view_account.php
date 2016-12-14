<?php
$current_user_id = get_current_user_id ();
?>
<h1 class="pageTitle"><?php echo $myAccountData->display_name['val'];?></h1>
<div id="viewMyAccount">
	<div class="col-sm-4 row">

		<div class="col-sm-6 avatar">
			<?php echo get_avatar ( $current_user_id, 135); ?>
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
	<div class="col-sm-8 row myCourses myAccountProgress">
	<?php
	$courses = get_all_user_courses ( $current_user_id );
	$enrolled_courses = array ();
	$completed_courses = array ();
	
	foreach ( $courses as $course ) {
		if ($course->status == 'enrolled') {
			array_push ( $enrolled_courses, $course );
		} else if ($course->status == 'completed') {
			array_push ( $completed_courses, $course );
		}
	}
	?>
	<h3>Aktivnye</h3>	
	<?php
	foreach ( $enrolled_courses as $course ) {
		$progress_bar = NamastePROCourses::progress_bar ( $course->post_id, $user_ID );
		
		echo <<<HTML
		<div class="row courseItem">
		 	<div class="col-sm-5 courseName">{$course->post_title}</div>
		 	<div class="col-sm-7">{$progress_bar}</div>
		</div>
HTML;
	}
	?>
	<h3>Proidennye</h3>
	<?php
	foreach ( $completed_courses as $course ) {
		$completion_time_str = date ( get_option ( 'date_format' ), strtotime ( $course->completion_time ) );
		echo <<<HTML
		<div class="row">
		 	<div class="col-sm-5 courseName">{$course->post_title}</div>
		 	<div class="col-sm-7">zavershen {$completion_time_str}</div>
		</div>
HTML;
	}
	?>
	</div>
</div>