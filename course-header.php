<?php

if(is_user_logged_in()):


    global $post, $tab;

    if($post->post_type == 'namaste_lesson') {
        $tab = 'lesson';
    } else {
        if(isset($_GET['tab'])) {
            $tab = $_GET['tab'];
        } else {
            $tab = '';
        }
    }

    $course_id = get_post_meta($post->ID, 'namaste_course', true);

    if(empty($course_id)) {
        $course_id = $post->ID;
    }

    if((get_post_meta($course_id, 'disable_shedule', true) && $tab == 'shedule')
        || (get_post_meta($course_id, 'disable_forum', true) && $tab == 'forum')
        || (get_post_meta($course_id, 'disable_archive', true) && $tab == 'archive')){
        $tab = '';
    }

    $title = get_post_meta($course_id, 'list_title', true);
    $title = (!empty($title)) ? $title : $post->post_title;


    $forum_id = '';
    $buddypress_id = get_post_meta($course_id, 'buddypress_id', true);

    if(!empty($buddypress_id)) {
        $forum_id = bbp_get_group_forum_ids($buddypress_id);
    }

    $forum_url = add_query_arg(array('tab' => 'forum'), get_permalink($course_id));
    $archive_url = add_query_arg(array('tab' => 'archive'), get_permalink($course_id));
    //NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $course_id)
    ?>
    <div class="course-header">
        
        <!-- <div class="namaste-course-title"><?php _e('Course name:', 'qode'); ?> <strong><?php echo $title; ?></strong></div> -->
       

        <div class="course-navigation">

            <a class="course-navigation-item<?php echo empty($tab) ? ' active' : ''; ?>" href="<?php echo get_permalink($course_id); ?>"><?php _e('About the course', 'qode'); ?></a>
            <?php if(!get_post_meta($course_id, 'disable_lection', true)): ?>
            <?php echo do_shortcode('[nnlc text="'.__('SelfStudy', 'qode').'" class="course-navigation-item'.(in_array($tab, array('lesson', 'nolessons')) ? ' active' : '').'"]'); ?>
            <?php endif; ?>
            <?php $lect_active = get_post_meta($course_id, 'lections_active', true);
            if(!empty($lect_active)): ?>
                <a class="course-navigation-item<?php echo $tab == 'lection' ? ' active' : ''; ?>" href="<?php echo add_query_arg(array('tab' => 'lection'), get_permalink($course_id)); ?>"><?php _e('Lection (LIVE)', 'qode'); ?>&nbsp;<span class="color-red">◉</span></a>
            <?php endif; ?>
            <?php if(!get_post_meta($course_id, 'disable_shedule', true)): ?>
                <a class="course-navigation-item<?php echo $tab == 'shedule' ? ' active' : ''; ?>" href="<?php echo add_query_arg(array('tab' => 'shedule'), get_permalink($course_id)); ?>"><?php _e('Shedule', 'qode'); ?></a>
            <?php endif; ?>
            <?php if(!get_post_meta($course_id, 'disable_forum', true)): ?>
                <a onClick="add_points('forum','<?php echo get_current_user_id(); ?>','<?php echo $course_id; ?>','<?php echo $forum_url ?>')" id="course-nav-forum" class="course-navigation-item<?php echo $tab == 'forum' ? ' active' : ''; ?>" href="<?php echo $forum_url ?>"><?php _e('Forum', 'qode'); ?></a>
            <?php endif; ?>
            <?php if(!get_post_meta($course_id, 'disable_archive', true)): ?>
                <a onClick="add_points('archive','<?php echo get_current_user_id(); ?>','<?php echo $course_id; ?>','<?php echo $forum_url ?>')" id="course-nav-archive" class="course-navigation-item<?php echo $tab == 'archive' ? ' active' : ''; ?>" href="<?php echo $archive_url; ?>"><?php _e('Archive', 'qode'); ?></a>
            <?php endif; ?>
        </div>
    </div>
<?php

    endif;

?>