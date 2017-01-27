
<div class="col-sm-8 col-xs-offset-2 row myCourses myAccountProgress" id="viewMyAccount">
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
	<h3 class="courseTitle"><span>Активные курсы</span></h3>	
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
	<h3 class="courseTitle"><span>Пройденные курсы</span></h3>
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