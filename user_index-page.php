<?php 
/*
Template Name: User index
*/ 
?>

	<?php get_header(); ?>
	
	<div class="full_width">
	<div class="full_width_inner">



		<?php

			global $user_ID;

		$is_manager = current_user_can('namaste_manage');
 			$_course = new NamasteLMSCourseModel();		 
			 // select all courses
			 $_course -> register_course_type();
			 $courses = $_course -> select();
		?>
		<h1><?php _e('My Courses', 'namaste')?></h1>

		<?php if(!sizeof($courses)) :?>
			<p><?php _e('No courses are available at this time.', 'namaste')?></p>
		<?php return false;
		endif;?>

		<div class="wrap myCourses">
			<?php if(!empty($message)):?>
				<p class="namaste-note"><?php echo $message?></p>
			<?php endif;?>	



			<?php foreach($courses as $course): $class = ('alternate' == @$class) ? '' : 'alternate';?>
		

				<div class="<?php echo $class?>">
					<div class="image">
						<?php echo get_the_post_thumbnail( $course->ID, 'thumbnail' );?>
					</div>
					<div>
						<a href="<?php echo get_permalink($course->post_id)?>" target="_blank"><?php echo $course->post_title?></a>
						<?php if(!empty($course->post_excerpt)): echo apply_filters('the_content', stripslashes($course->post_excerpt)); endif;?>
					</div>
					<?php 
						echo $_course ->enroll_buttons($course, $is_manager); 
						var_dump($course);


					?>

				</div>
			<?php endforeach;?>
		</div>
	</div>
	</div>
	<?php get_footer(); ?>			