<?php
/**
 * Created by PhpStorm.
 * User: davgur
 * Date: 14.04.2015
 * Time: 19:54
 */
?>

<?php
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
							
							<?php if (NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $post->ID) == null){ ?>
								<span class="btnCourse">Ð’Ð¾Ð¹Ñ‚Ð¸</span>
							
							<?php } else {?>
							
								<span class="btnCourse">Ð—Ð°Ð¿Ð¸Ñ�Ð°Ñ‚ÑŒÑ�Ñ�</span>
							
							<?php }?>
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

            ?>


            <div class="academy_course <?php echo $aCourseData["live_sticker"] ?>" style="background: url('<?php echo $aCourseData["image"] ?>'); background-size: 265px 230px;  background-repeat: no-repeat;">
                <a href="<?php echo get_permalink($avail_one->ID); ?>">
                    <span class="academy_course_text">
                        <span class="academy_course_title"><?php echo  $aCourseData["title"] ?></span>
                        <span class="academy_course_subtitle">
                            <?php echo $aCourseData["subtitle"] ?>
                            <span class="btnCourse">Ð—Ð°Ð¿Ð¸Ñ�Ð°Ñ‚ÑŒÑ�Ñ�</span>
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
        <?php } ?>
    </div>
</div>