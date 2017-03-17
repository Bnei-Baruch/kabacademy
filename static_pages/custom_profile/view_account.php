
<div class="col-sm-8 col-xs-offset-2 row myCourses myAccountProgress"
	id="viewMyAccount">
	<?php
	$courses = get_all_user_courses ( $current_user_id );
	$enrolled_courses = array ();
	$completed_courses = array ();
	$online_courses = array ();
	
	foreach ( $courses as $course ) {
		if(strpos($course->post_title, '</br>') !== false){
			$course->post_title = str_replace('</br>', '', $course->post_title);
		}

		if (has_category ( 'Он-лайн обучение', $course->post_id )) {
			array_push ( $online_courses, $course );
		} else if ($course->status == 'enrolled') {
			array_push ( $enrolled_courses, $course );
		} else if ($course->status == 'completed') {
			array_push ( $completed_courses, $course );
		}
	}
	if (count ( $online_courses ) > 0) :
		?>
	<h3 class="courseTitle">
		<span>On-line курсы</span>
	</h3>	
	<?php		
	foreach ( $online_courses as $course ) {			
		$courseLink = get_page_link($course->post_id);
		echo <<<HTML
		<div class="row courseItem">
		 	<div class="col-sm-5 courseName">
		 		<a href="{$courseLink}">{$course->post_title}</a>
		 	</div>
		</div>
HTML;
		}	
	endif;
	if (count ( $enrolled_courses ) > 0) :
	?>
	<h3 class="courseTitle">
		<span>Активные курсы</span>
	</h3>	
	<?php
	foreach ( $enrolled_courses as $course ) {
		$progress_bar = NamastePROCourses::progress_bar ( $course->post_id, $user_ID );
		$courseLink = get_page_link($course->post_id);
		echo <<<HTML
		<div class="row courseItem">
		 	<div class="col-sm-5 courseName">
		 		<a href="{$courseLink}">{$course->post_title}</a>
	 		</div>
		 	<div class="col-sm-7">{$progress_bar}</div>
		</div>
HTML;
	}
	endif;
	if (count ( $completed_courses ) > 0) :
	?>
	<h3 class="courseTitle">
		<span>Пройденные курсы</span>
	</h3>
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
	endif;
	?>
</div>