<?php 
/*
Template Name: Main Full Width
*/ 
?>

<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$sidebar = get_post_meta($id, "qode_show-sidebar", true);  

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }  

if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_satellite['responsive_title_image'];
}

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_satellite['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_satellite['title_image'];
}

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_satellite['title_height'];
}

$title_background_color = '';
if(get_post_meta($id, "qode_page-title-background-color", true) != ""){
 $title_background_color = get_post_meta($id, "qode_page-title-background-color", true);
}else{
	$title_background_color = $qode_options_satellite['title_background_color'];
}

$show_title_image = true;
if(get_post_meta($id, "qode_show-page-title-image", true)) {
	$show_title_image = false;
}

?>
	<?php get_header(); ?>
		<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
			<div class="title <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes" && $show_title_image == true){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true){ echo 'has_background'; } if($responsive_title_image == 'yes' && $show_title_image == true){ echo 'with_image'; } ?>" style="<?php if($responsive_title_image == 'no' && $title_image != "" && $show_title_image == true){ echo 'background-image:url('.$title_image.');';  } if($responsive_title_image == 'no' && $title_height != ''){ echo 'height:'.$title_height.'px;'; } if($title_background_color != ''){ echo 'background-color:'.$title_background_color.';'; } ?>">
				<?php if($responsive_title_image == 'yes' && $title_image != "" && $show_title_image == true){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
				<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<div class="title_holder">
						<div class="container">
							<div class="container_inner clearfix">
								<h1<?php if(get_post_meta($id, "qode_page-title-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-title-color", true) ?>" <?php } ?>><?php the_title(); ?></h1>
								<?php if(get_post_meta($id, "qode_page-subtitle", true)) { ?><span class="subtitle"<?php if(get_post_meta($id, "qode_page-subtitle-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-subtitle-color", true) ?>" <?php } ?>> <?php echo get_post_meta($id, "qode_page-subtitle", true) ?></span><?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if($qode_options_satellite['show_back_button'] == "yes") { ?>
			<a id='back_to_top' href='#'>
				<span class="icon_holder small_icon nohover"><span class="icon_inner"><span class="icon white arrow_up_in_circle">&nbsp;</span></span></span>
				<span class="icon_holder small_icon hover"><span class="icon_inner"><span class="icon white arrow_up_in_circle_fill">&nbsp;</span></span></span>
			</a>
		<?php } ?>

		<?php if (!is_user_logged_in()){ 
		$revslider = get_post_meta($id, "qode_revolution-slider", true);
		if (!empty($revslider)){ ?>
			<div class="slider"><div class="slider_inner">
			<?php echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		} 
		} ?>
	<div class="full_width">
	<div class="full_width_inner">
	
	<?php if (($sidebar == "default") || ($sidebar == "")) : ?>
    <?php if (!is_user_logged_in()): ?>
        <?php if (have_posts()) :
            while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php else: /** if user is logged in **/

$my_courses = get_posts(array(
    'posts_per_page' => -1,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'namaste_course',
    'post_status' => 'publish'));

?>
<div class="container">
    <div class="container_inner clearfix">
        <?php

        $enrolled = $avail = array();

        global $wpdb;

        foreach ($my_courses as $my_course) {

            $query = $wpdb->get_results($wpdb->prepare("SELECT tU.*, tS.status as namaste_status
                    FROM {$wpdb->users} tU JOIN " . NAMASTE_STUDENT_COURSES . " tS
                    ON tS.user_id = tU.ID AND tS.course_id=%d
                    ORDER BY user_nicename", $my_course->ID));

            $students = array();

            foreach ($query as $query_one) {
                $students[] = $query_one->ID;
            }

            if (in_array(get_current_user_id(), $students)) {
                $enrolled[] = $my_course;
            } else {
                $avail[] = $my_course;
            }

        }

        if (!empty($enrolled)) { ?>
            <h2>
                <?php _e('My courses:', 'qode'); ?>
            </h2>
        <?php }
        foreach ($enrolled as $enrolled_one) {
            $aCourseData = getCourseDataForHomePage($enrolled_one);
			//print_r($aCourseData);
            ?>

            <div class="academy_course <?php echo $aCourseData["live_sticker"] ?>" style="background: url('<?php print_r($aCourseData["image"])?>'); background-size: 265px 230px;  background-repeat: no-repeat;">
                <a href="<?php echo get_permalink($enrolled_one->ID); ?>">
                    <span class="academy_course_text">
                        <span class="academy_course_title"><?php print_r($aCourseData["title"]) ?></span>
                        <span class="academy_course_subtitle">
                            <?php echo $aCourseData["subtitle"] ?>
							
							<span class="btnCourse">Войти</span>
							<?php //$perc = get_course_progress($enrolled_one->ID, get_current_user_id()); ?>
							<!--  
							<div class="btnCourse" style="position: relative; height: 32px; padding: 0px;">
                                        <span style="position: absolute;left:80px;color: #555555"><?php // echo "Progress ".$perc."%"; ?></span>
								<div style="height: 32px; width: <?php //echo $perc;?>%; background-color: #FFF4D9;">
								</div>
							</div>
							/-->
                        </span>
                    </span>
                </a>

               <!-- <div class="course_one_category">
                    <?php /*if (!empty($category)) : */?>
                        <span><?php /*echo $category; */?></span>
                    <?php /*endif; */?>
                </div>-->
                <div class="courseColorBG" style="background-color: #<?php echo  $aCourseData["category_color"] ?>"></div>
            </div>
        <?php }


        if (!empty($avail)) { ?>
            <h2>
                <?php _e('Available courses:', 'qode'); ?>
            </h2>
        <?php }

        foreach ($avail as $avail_one) {
            $aCourseData = getCourseDataForHomePage($avail_one);
			//print_r($aCourseData);
			
			if (!$aCourseData["registration_closed"]){
            ?>


            <div class="academy_course <?php echo $aCourseData["live_sticker"] ?>" style="background: url('<?php echo $aCourseData["image"] ?>'); background-size: 265px 230px;  background-repeat: no-repeat;">
                <a href="<?php echo get_permalink($avail_one->ID); ?>">
                    <span class="academy_course_text">
                        <span class="academy_course_title"><?php echo  $aCourseData["title"] ?></span>
                        <span class="academy_course_subtitle">
                            <?php echo $aCourseData["subtitle"] ?>
                            <span class="btnCourse"><?php  _e( 'Enroll', 'qode' ) ?></span>
                        </span>
                    </span>
                </a>

                <!-- <div class="course_one_category">
                    <?php /*if (!empty($category)) : */?>
                        <span><?php /*echo $category; */?></span>
                    <?php /*endif; */?>
                </div>-->
                <div class="courseColorBG" style="background-color: #<?php echo  $aCourseData["category_color"] ?>"></div>
            </div>
        <?php } } ?>
    </div>
</div>
    <?php endif; ?>
	
	
		
			<?php endif; ?>
	</div>
	</div>
	<?php get_footer(); ?>			