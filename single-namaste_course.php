<?php

if (get_post_meta(get_the_ID(), "qode_show-sidebar", true) != "") {
    $sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
} else {
    $sidebar = $qode_options_satellite['blog_single_sidebar'];
}

$blog_hide_comments = "";
if (isset($qode_options_satellite['blog_hide_comments']))
    $blog_hide_comments = $qode_options_satellite['blog_hide_comments'];

if (get_post_meta(get_the_ID(), "qode_responsive-title-image", true) != "") {
    $responsive_title_image = get_post_meta(get_the_ID(), "qode_responsive-title-image", true);
} else {
    $responsive_title_image = $qode_options_satellite['responsive_title_image'];
}

if (get_post_meta(get_the_ID(), "qode_fixed-title-image", true) != "") {
    $fixed_title_image = get_post_meta(get_the_ID(), "qode_fixed-title-image", true);
} else {
    $fixed_title_image = $qode_options_satellite['fixed_title_image'];
}

if (get_post_meta(get_the_ID(), "qode_title-image", true) != "") {
    $title_image = get_post_meta(get_the_ID(), "qode_title-image", true);
} else {
    $title_image = $qode_options_satellite['title_image'];
}

if (get_post_meta(get_the_ID(), "qode_title-height", true) != "") {
    $title_height = get_post_meta(get_the_ID(), "qode_title-height", true);
} else {
    $title_height = $qode_options_satellite['title_height'];
}

$title_background_color = '';
if (get_post_meta(get_the_ID(), "qode_page-title-background-color", true) != "") {
    $title_background_color = get_post_meta(get_the_ID(), "qode_page-title-background-color", true);
} else {
    $title_background_color = $qode_options_satellite['title_background_color'];
}

$show_title_image = true;
if (get_post_meta(get_the_ID(), "qode_show-page-title-image", true)) {
    $show_title_image = false;
}

if (isset($qode_options_satellite['twitter_via']) && !empty($qode_options_satellite['twitter_via'])) {
    $twitter_via = " via " . $qode_options_satellite['twitter_via'];
} else {
    $twitter_via = "";
}

 $course_id = $post->ID;
 $channelId = get_post_meta($course_id, 'channelId', true);
 $course_space = get_post_meta($course_id,'course_space', true);
 $live_course_video_id = get_post_meta($course_id,'live_course_video_id', true);
 $hypercomments_id = get_post_meta($course_id,'hypercomments_id', true);
 $hypercomments_forum_id = get_post_meta($course_id,'hypercomments_forum_id', true);
 $forum_instruction_post_id = get_post_meta($course_id,'forum_instruction_post_id', true);
 $current_user = wp_get_current_user();
?>
<?php get_header(); ?>
<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri ();?>/js/hypercomments.js'></script>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();
        if ($qode_options_satellite['show_back_button'] == "yes") : ?>
            <a id='back_to_top' href='#'>
                <span class="icon_holder small_icon nohover"><span class="icon_inner"><span
                            class="icon white arrow_up_in_circle">&nbsp;</span></span></span>
                <span class="icon_holder small_icon hover"><span class="icon_inner"><span
                            class="icon white arrow_up_in_circle_fill">&nbsp;</span></span></span>
            </a>
        <?php
            endif;
        $title = get_post_meta($post->ID, 'list_title', true);
        $title = (!empty($title)) ? $title : $post->post_title;

        $category_topBg_ID = get_post_meta($post->ID, "course_header_bg", true);
        $begins_at = get_post_meta($post->ID, 'begins_at', true);
        $length = get_post_meta($post->ID, 'length', true);
        $subtitle = get_post_meta($post->ID, 'list_subtitle', true);

        $category = get_the_category($post->ID);
        $category = !empty($category) ? $category[0] : '';
        $category_class = !empty($category) ? ' ' . $category->category_nicename : '';
        $category = !empty($category) ? '<div class="course_single_course_cat">' . mb_strtoupper($category->cat_name) . '</div>' : '';

        $tab = '';
       
		
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			
			$title_image_array = wp_get_attachment_image_src($post_thumbnail_id, 'full', true);
			
			 $header_bg = $title_image_array[0];		
		
        ?>
		<!--

			Page Header if user is logged in & Enrolled in the course

		-->
		
		<?php if (is_user_logged_in() &&  (!NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $post->ID) == null)){?>
			<?php 

			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$title_image_array = wp_get_attachment_image_src($post_thumbnail_id, 'full', true);
			$title_image = $title_image_array[0];

			?>
			<div class="title with_image loggedin_title has_fixed_background" style="background-image: url(<?php echo $title_image; ?>); background-size: cover; max-height: 200px; display: block;  position: relative;  width: 100%; height: 200px">
				<?php 	//echo '<img src="' . $title_image . '" alt="title" />'; ?>

				<?php if (!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
					<div class="title_holder">
						<div class="container">
							<div class="container_inner clearfix">
								<h1<?php if (get_post_meta($id, "qode_page-title-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-title-color", true) ?>" <?php } ?>><?php the_title(); ?></h1>
								<?php if (get_post_meta($id, "qode_page-subtitle", true)) { ?><span
									class="subtitle"<?php if (get_post_meta($id, "qode_page-subtitle-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-subtitle-color", true) ?>" <?php } ?>> <?php echo get_post_meta($id, "qode_page-subtitle", true) ?></span><?php } ?>

									<?php if(!in_category('on-layn-obuchenie')): ?>
									<h3 style="color: white"><?php echo do_shortcode('[namaste-enroll]'); ?></h3>
									<?php endif; ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php } ?>

		<!--

			Page Header if user is NOT Enrolled

		-->
        <div class="container">
            <!-- course header -->
            <?php if (NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $post->ID) == null): ?>
                <div class="courseHeaderBg title has_fixed_background" style="background-image: url(<?php echo $header_bg; ?>); background-size: cover">
                    <h1 class="courseTitle"><?php echo($title); ?></h1>
                    <br/>
                    <!-- course texts - if have -->
                    <?php if (!empty($begins_at) || !empty($length)): ?>
                        <span class="courseSubTitle">
                <strong> <?php _e('Course Starts:', 'qode'); ?> </strong>
                            <?php echo ' ' . $begins_at; ?>
                            |
                <strong> <?php _e('Length:', 'qode'); ?> </strong>
                            <?php echo ' ' . $length . ' ';
                            _e('days', 'qode'); ?>
            </span>
                    <?php endif; ?>
					<div class="namasteEnrollShortcode">
                        <?php
                       
                        if (is_user_logged_in() &&  isUserCanEnrollToCourse()){
                            echo '<div class="button medium ">'.do_shortcode('[namaste-enroll]').'</div>';
                        } elseif (is_user_logged_in()){
                            echo '<h3>'.__('You cannot enroll this course - other courses have to be completed first.', 'namaste').'</h3>';
                        } else { ?>
                        <div class="button medium">
                           <a href="/registration?redirectUrl=<?php the_permalink();?>">
                                <?php _e('Enroll', 'qode'); ?>
                            </a>
                        </div>
                        <?php }?>
                    </div>
					
                    <div class="easyShare">
                        <?php echo do_shortcode('[easy-share buttons="ok,facebook,google" counters=0 style="icon" template="round-retina"]'); ?>
                    </div>
                </div>
				
			
            <?php endif; ?>
            <div class="container_inner pt0">

                <?php get_template_part('course-header'); ?>

                <div class="blog_holder v2 blog_single single-namaste_course<?php echo $category_class; ?>">

                    <article class="standard">
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <?php
                            if (is_user_logged_in() && $tab == 'nolessons'):
                                ?>
                                <div class="">
                                    <?php $course_id = $post->ID; ?>
                                    <h2 class="u3h2"><a href="<?php echo get_permalink($course_id); ?>"
                                                        title="<?php echo get_the_title($course_id); ?>"><?php echo get_the_title($course_id); ?></a>
                                    </h2>
                                </div>

                                <div class="nolessons-container">

                                    <div class="nolessons-row">
                                        <div class="nolessons-cell nolessons-text-cell">
                                            <div class="text-align-left">
                                                <span
                                                    class="nolessons-highlighted"><?php _e('This course does not have selfstudy lessons for the moment.', 'qode'); ?></span>
                                            </div>
                                        </div>
                                        <div class="nolessons-cell nolessons-image-cell">
                                            <img src="/wp-content/uploads/2014/12/clock-new-24-blog.png"/>
                                        </div>
                                    </div>

                                </div>
                            <?php elseif (is_user_logged_in() && $tab == 'lection'): ?>
                                <div class="two_columns_60_40 lection-tab clearfix">
                                    <div class="column1">

                                        <div class="lection-video-container">
                                            <div id="lveventplayer">
                                                <div style="text-align: center; width: 100%; height: 370px; background-color: #181818;font-size: 2em; line-height: 380px; color: #fff;">
                                                    Здесь будет плеер с трансляцией
                                                    <script type='text/javascript' src='<?php echo get_stylesheet_directory_uri ();?>/js/youtube-broadcast.js?ver=1.1'></script>
                                                    <script type="text/javascript" src = "https://www.youtube.com/iframe_api"></script>
                                                    <?php if(!empty ( $live_course_video_id)): ?>                                                        
                                                        <script> window.youtubeCourseVideoLiveId = '<?php echo $live_course_video_id; ?>'; </script>
                                                    <?php else :?>
                                                       	<script> window.youtubeBroadcastChannelId = '<?php echo $channelId; ?>'; </script>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                            <div class="gototraining">
                                                <img height="40"
                                                     src="<?php echo get_stylesheet_directory_uri(); ?>/images/icongooglehangoutGrey.png"/>
                                                <script>
													jQuery(document).ready(function(){
                                                        var checkedDisableSeminar = <?php echo get_post_meta($post->ID, 'disable_seminar', true);?>;
                                                        youTubePlayer.addLiveListner(exe_webinar_points);
                                                      
                                                        if (!!checkedDisableSeminar) {
                                                            jQuery('#joinLive')
                                                            .click(function(event){
                                                                event.preventDefault();
                                                                return;
                                                            });                                                            
                                                        } else {                                                            
                                                            youTubePlayer.addLiveListner(  function (){
                                                                jQuery('#joinLive')
                                                                .attr('title', "").attr('alt', "").removeClass("disable")
                                                                .click(function(event){
                                                                    var pointsType = 'workshop';
                                                                    var user_id = '<?php echo get_current_user_id(); ?>';
                                                                    var cousrse_id ='<?php echo $post->ID; ?>';
                                                                    var href = jQuery(this).attr('href');
                                                                    youTubePlayer.player.mute();
                                                                    add_points_webinar(pointsType,user_id,cousrse_id, href);
                                                                });
                                                            });
                                                        }
													});
                                                </script>
												
							                     <?php 
                                                    //time conversions
                                                    $points_type = 'webinar-general';
                                                    $dt = new DateTime();
                                                    $tz = new DateTimeZone('Europe/Moscow'); // or whatever zone you're after

                                                    $dt->setTimezone($tz);
                                                    //geth the hour in Moskve time
                                                    $current_hour = $dt->format('H');

                                                    //check the time zone
                                                    if($current_hour==5 || $current_hour==6){
                                                            $points_type = 'webinarTT';
                                                    }
                                                    if($current_hour==8 || $current_hour==9){
                                                            $points_type = 'webinarSF';
                                                    }
                                                    if($current_hour==16 || $current_hour==17){
                                                            $points_type = 'webinarPH';
                                                    }
                                                    if($current_hour==19 || $current_hour==20){
                                                            $points_type = 'webinarMS';
                                                    }
                                                        
                                                    //check if day is Voskresenya
                                                    $dw = date( "w", time()); // 0 = sunday

                                                    if ($dw ==  0) {
                                                        $points_type = 'webinarVS';
                                                    }
                                                 ?>

                                                <script>
												    function exe_webinar_points(){
                                                        var pointsType = '<?php echo $points_type ?>';
                                                        var user_id = '<?php echo get_current_user_id(); ?>';
                                                        var cousrse_id ='<?php echo $post->ID; ?>';
                                                        add_points_webinar(pointsType,user_id, cousrse_id);
                                                    }

                                                    function add_points_webinar(pointsType, userId, courseId) {
                                                        
                                                        if(pointsType =="" || userId == "" || courseId ==""){
                                                            console.log('empty data');
                                                            return false;
                                                        }

                                                        //userId is number
                                                        if ( !jQuery.isNumeric(userId) || !jQuery.isNumeric(courseId) ){
                                                            console.log('NaN');
                                                            return false;
                                                        }

                                                        //is correct point's type
                                                        if( pointsType != 'webinar-general' && pointsType != 'webinarTT' && pointsType != 'webinarSF' && pointsType != 'webinarPH' && pointsType != 'webinarMS' && pointsType != 'webinarVS') {
                                                            console.log('unknown points type');
                                                            return false;
                                                        }


                                                        var the_data = {
                                                            action: 'update_points_system',
                                                            userId: userId,
                                                            courseId: courseId,
                                                            pointsType: pointsType
                                                        }

                                                        jQuery.ajax({
                                                           url: ajaxurl,
                                                           data: the_data,
                                                           type: "post",
                                                           success: function (response){
                                                                console.log(response);
                                                           },
                                                           error: function() {
                                                               console.log('Ajax not submited');
                                                           }
                                                    });

                                                        return false;
                                                    }
                                                </script>

                                                <a id="joinLive" 
                                                    target="_blank"
                                                    title="Кнопка Семинар будет доступна только после начала семинара."
                                                    alt="Кнопка Семинар будет доступна только после начала семинара."
                                                    href="<?php echo get_post_meta($course_id,'link_seminar', true);?>"
                                                    class="btnM disable">

                                                    <?php _e('Go to training', 'qode'); ?>
                                                </a>
                                                <?php if (current_user_can('editor') || current_user_can('administrator')) : ?>
                                                <a target="_blank" class="btnM"
                                                   href="<?php
                                                        if(!empty($hypercomments_id)){
                                                            $seminar_button_href =  'http://admin.hypercomments.com/comments/approve/' . $hypercomments_id; 
                                                        } else {
                                                            $seminar_button_href = 'https://chat1.kbb1.com/admin.html?label=rt.kbb1.com.'.$course_space;
                                                        }
                                                        echo $seminar_button_href;
                                                    ?>" >
                                                   <?php _e('Manage chat', 'qode'); ?>
                                                </a>
                                            	<?php endif; ?>
                                            </div>
                                        
                                    </div>
                                    <div class="column2">
                                        <div class="tabs sidebar-tabs-dmn">
                                            <ul class="tabs-nav">
                                                <li class="active"><a
                                                        href="#tabiid1"><?php _e('Discussion', 'qode'); ?></a></li>
                                                <li id="activate_bx" class=""><a
                                                        href="#tabiid2"><?php _e('Materials', 'qode'); ?></a></li>
                                                <li class=""><a href="#tabiid3"><?php _e('Notes', 'qode'); ?></a></li>
                                            </ul>
                                            <div class="tabs-container">
                                                <div id="tabiid1" class="tab-content" style="display: block;">
                                                <?php 
                                                //@todo - duplicate code with hypercomments forum
                                                    if(!empty($hypercomments_id)){
                                                        $user_hypercomments = array(
                                                          'nick' => $current_user->display_name,
                                                          'avatar' => bp_core_fetch_avatar ( array( 'item_id' => $current_user->ID, 'type' => 'mini', 'html' => FALSE) ),
                                                          'id' => $current_user->ID
                                                        );
                                                        $time_hypercomments = time();
                                                        $secret_hypercomments = "2CI6jAMW4QctDv9g31q94ljx0";
                                                        $user_base64 = base64_encode( json_encode($user_hypercomments) );
                                                        $sign_hypercomments = md5($secret_hypercomments . $user_base64 . $time_hypercomments);
                                                        $auth_hypercomments = $user_base64 . "_" . $time_hypercomments . "_" . $sign_hypercomments;

                                                        //moderators
                                                        if($current_user->has_cap('bbp_keymaster') || $current_user->has_cap('bbp_moderator')){
                                                            $body_hypercomments =  json_encode(array(
                                                                'widget_id'=> $hypercomments_id,
                                                                'auth' => $auth_hypercomments,
                                                            ), JSON_HEX_QUOT);
                                                            $postParams = http_build_query(array (
                                                                'body'=> $body_hypercomments,
                                                                'signature'=> sha1($body_hypercomments.$secret_hypercomments)
                                                            ));

                                                            $curl_hypercomments = curl_init();
                                                            curl_setopt_array($curl_hypercomments, array(
                                                                CURLOPT_URL => 'http://c1api.hypercomments.com/1.0/users/add_moderator',
                                                                CURLOPT_RETURNTRANSFER => true,
                                                                CURLOPT_POST => true,
                                                                CURLOPT_POSTFIELDS => $postParams
                                                            ));
                                                            $response = curl_exec($curl_hypercomments);
                                                            rightToLogFileDavgur($response);
                                                            curl_close($curl_hypercomments);
                                                        }
                                                ?>                                                            
                                                        	<div id="hypercomments_widget"></div>
                                                        	<script type="text/javascript">
                                                        	_hcwp = window._hcwp || [];
                                                        	_hcwp.push({widget:"Stream", widget_id: <?php echo $hypercomments_id;?>, auth: "<?php echo $auth_hypercomments;?>", eager_load: true});
                                                        	  if (!window.hypercommentsAPI) {
                                                                  setTimeout(function(){
                                                                	  hypercommentsAPI.initById(<?php echo $hypercomments_id;?>);
                                                                  }, 10);                                                        
                                                              } else{
                                                            	  hypercommentsAPI.initById(<?php echo $hypercomments_id;?>);
                                                              }
                                                        	</script>
                                                <?php
                                                    } else {
                                                        $cityName = bp_get_profile_field_data( array( 'field'   => 'Город', 'user_id' => $current_user->ID));
                                                        $defaultChatParam = '&label=rt.kbb1.com.'.$course_space.'&name_text='.$current_user->display_name.'&from_text='.$cityName;
                                                  
                                                        echo('<iframe src="https://chat1.kbb1.com/?lang=ru'.$defaultChatParam.'"></iframe>');
                                                    } 
                                                ?>
                                                </div>
                                                <div id="tabiid2" class="tab-content" style="display: none;">
                                                    <div class="bx-controls-direction"><a id="bx-prev" href=""></a><a
                                                            id="bx-next" href=""></a></div>
                                                    <ul id="tabiid2slide">
                                                        <?php echo do_shortcode(get_post_meta($course_id, 'materials', true)); ?>
                                                    </ul>
                                                    <script>
                                                        (function ($) {
                                                            $(document).on('click', '#activate_bx', second_passed);
                                                            function second_passed() {
                                                                if ($('#tabiid2slide').hasClass('activatedbx')) {
                                                                    return false;
                                                                }
                                                                setTimeout(function () {
                                                                    var slider = $('#tabiid2slide').bxSlider({
                                                                        infiniteLoop: true,
                                                                        hideControlOnEnd: false,
                                                                        nextSelector: '#bx-next',
                                                                        prevSelector: '#bx-prev',
                                                                        nextText: '',
                                                                        prevText: ''
                                                                    });
                                                                    $('#tabiid2slide').addClass("activatedbx");

                                                                    $('#bx-next').click(function () {
                                                                        slider.goToNextSlide();
                                                                        return false;
                                                                    });

                                                                    $('#bx-prev').click(function () {
                                                                        slider.goToPrevSlide();
                                                                        return false;
                                                                    });
                                                                }, 500);
                                                            }
                                                        })(jQuery);
                                                    </script>
                                                </div>
                                                <div id="tabiid3" class="tab-content nopadding" style="display: none;">
                                                    <?php
                                                    $notes = get_user_meta(get_current_user_id(), 'notes_' . $course_id, true); //[accordion_item caption="Accordion 1" title_color=""]This is some content[/accordion_item][accordion_item caption="Accordion 1" title_color=""]This is some content[/accordion_item]
                                                    $content_notes = '';


                                                    foreach ($notes as $key => $note) {
                                                        $content_notes .= do_shortcode('[accordion_item caption="' . $note['title'] . '" title_color=""]<div class="note_title_wrap"><input class="note_title" value="' . $note['title'] . '" /></div><div class="note_content" contenteditable="true">' . $note['content'] . '</div><div class="note_actions"><a href="#" class="remove_note pull-left"></a><div class="note_status pull-right">' . __('SAVED', 'qode') . '</div><div class="note_date pull-right"><span class="date">' . date('d/m/y', $note['date']) . '</span><span class="time">' . date('h:i A', $note['date']) . '</span></div></div><input style="display: none" class="note_id" value="' . $key . '" />[/accordion_item]');
                                                    }
                                                    ?>
                                                    <?php echo do_shortcode('[accordion accordion_type="accordion"]' . $content_notes . '[/accordion]'); ?>
                                                    <a id="addnewnote" href="#"><?php _e('Add New Note', 'qode'); ?></a>

                                                    <div id="templates" style="display:none">
                                                        <?php echo do_shortcode('[accordion_item caption="' . __('New Note', 'qode') . '" title_color=""]<div class="note_title_wrap"><input class="note_title" value="' . __('New Note', 'qode') . '" /></div><div class="note_content" contenteditable="true" data-ph="' . __('Type text here...', 'qode') . '"></div><div class="note_actions"><a href="#" class="remove_note pull-left"></a><div class="note_status pull-right">' . __('SAVING...', 'qode') . '</div><div class="note_date pull-right"><span class="date"></span><span class="time"></span></div></div><input style="display: none" class="note_id" value="" />[/accordion_item]'); ?>
                                                    </div>
                                                    <script>
                                                        jQuery(document).ready(function () {
                                                            jQuery.ui.accordion.prototype._originalKeyDown = jQuery.ui.accordion.prototype._keydown;
                                                            jQuery.ui.accordion.prototype._keydown = function (event) {
                                                                var keyCode = jQuery.ui.keyCode;

                                                                if (event.keyCode == keyCode.SPACE) {
                                                                    return;
                                                                }
                                                                // call the original method
                                                                this._originalKeyDown(event);
                                                            };

                                                            var index = 0;
                                                            index = jQuery("#tabiid3 h3.ui-accordion-header").length - 1;

                                                            jQuery("#tabiid3 .accordion").on("accordioncreate", function (event, ui) {
                                                                jQuery("#tabiid3 .accordion").accordion("option", "active", index);
                                                                jQuery("#tabiid3 h3.ui-accordion-header span").remove();
                                                            });

                                                            jQuery(document).on('click', '#tabiid3 .note-title-edit-icon', function (e) {
                                                                e.preventDefault();
                                                                e.stopPropagation();

                                                                console.log('x');
                                                                return false;
                                                            });

                                                            jQuery(document).on('click', function (e) {
                                                                if (jQuery("#tabiid3 h3.ui-accordion-header.editing").length == 0 || jQuery(e.target).closest('.editing').length > 0) {
                                                                    return;
                                                                }
                                                                var title = jQuery("#tabiid3 h3.ui-accordion-header.editing input").val();
                                                                var note_id = jQuery("#tabiid3 h3.ui-accordion-header.editing").next().find('.note_id').val();

                                                                update_note_title(note_id, title, jQuery("#tabiid3 h3.ui-accordion-header.editing").next());

                                                                jQuery("#tabiid3 h3.ui-accordion-header.editing")
                                                                    .html(title)
                                                                    .removeClass('editing');
                                                            });

                                                            jQuery(document).on('click', function (e) {
                                                                if (jQuery("#tabiid3 .accordion_content .note_content.editing").length == 0 || jQuery(e.target).closest('.editing').length > 0) {
                                                                    return;
                                                                }
                                                                var content = jQuery("#tabiid3 .accordion_content .note_content.editing").html();
                                                                var note_id = jQuery("#tabiid3 .accordion_content .note_content.editing").closest('.accordion_content').find('.note_id').val();

                                                                update_note_content(note_id, content, jQuery("#tabiid3 .accordion_content .note_content.editing").closest('.accordion_content'));

                                                                jQuery("#tabiid3 .accordion_content .note_content.editing")
                                                                    .removeClass('editing');
                                                            });

                                                            var title_update_timer_id = 0;

                                                            jQuery(document).on('keyup', '#tabiid3 .note_title_wrap .note_title', function (e) {
                                                                var title = jQuery(this).val();
                                                                var note_id = jQuery(this).closest('.accordion_content_inner').find('.note_id').val();
                                                                var elem = jQuery(this).closest('.accordion_content_inner');

                                                                elem.parent().prev().html(title);

                                                                clearTimeout(title_update_timer_id);
                                                                title_update_timer_id = setTimeout(function () {
                                                                    update_note_title(note_id, title, elem)
                                                                }, 500);
                                                            });

                                                            var content_update_timer_id = 0;


                                                            jQuery(document).on('keyup', '#tabiid3 .accordion_content .note_content', function (e) {
                                                                jQuery(this).addClass('editing');
                                                                var content = jQuery(this).html();
                                                                var note_id = jQuery(this).closest('.accordion_content').find('.note_id').val();
                                                                var elem = jQuery(this).closest('.accordion_content');
                                                                clearTimeout(content_update_timer_id);
                                                                content_update_timer_id = setTimeout(function () {
                                                                    update_note_content(note_id, content, elem)
                                                                }, 500);
                                                            });

                                                            function update_note_title(note_id, title, elem) {
                                                                elem.find('.note_status').text('<?php _e('SAVING...', 'qode') ?>');

                                                                jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", {
                                                                    'action': 'update_note_title',
                                                                    'note_id': note_id,
                                                                    'title': title,
                                                                    'course_id': <?php echo $course_id; ?>
                                                                }, function (response) {
                                                                    elem.find('.note_status').text('<?php _e('SAVED', 'qode') ?>');
                                                                    elem.find('.date').text(response.date);
                                                                    elem.find('.time').text(response.time);
                                                                }, 'json');
                                                            }

                                                            function update_note_content(note_id, content, elem) {
                                                                elem.find('.note_status').text('<?php _e('SAVING...', 'qode'); ?>');

                                                                jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", {
                                                                    'action': 'update_note_content',
                                                                    'note_id': note_id,
                                                                    'content': content,
                                                                    'course_id': <?php echo $course_id; ?>
                                                                }, function (response) {
                                                                    elem.find('.note_status').text('<?php _e('SAVED', 'qode') ?>');
                                                                    elem.find('.date').text(response.date);
                                                                    elem.find('.time').text(response.time);
                                                                }, 'json');
                                                            }

                                                            jQuery(document).on('click', '#tabiid3 .remove_note', function (e) {
                                                                e.preventDefault();

                                                                var note_id = jQuery(this).closest('.accordion_content').find('.note_id').val();
                                                                var $this = jQuery(this);

                                                                $this.closest('.accordion_content').prev().remove();
                                                                $this.closest('.accordion_content').remove();

                                                                jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", {
                                                                    'action': 'remove_note',
                                                                    'note_id': note_id,
                                                                    'course_id': <?php echo $course_id; ?>
                                                                }, function (response) {
                                                                }, 'json');
                                                            });

                                                            jQuery(document).on('click', '#addnewnote', function (e) {
                                                                e.preventDefault();

                                                                jQuery('#templates h3.ui-accordion-header span').remove();

                                                                var new_note = jQuery('#templates > *').clone();
                                                                var id = 0;

                                                                if (jQuery('#tabiid3 .accordion .note_id').length > 0) {
                                                                    id = parseInt(jQuery('#tabiid3 .accordion .note_id').last().val());
                                                                    id = id + 1;
                                                                }
                                                                new_note.find('.note_id').val(id);

                                                                jQuery('#tabiid3 .accordion').append(new_note).accordion("refresh").accordion("option", "active", jQuery("#tabiid3 h3.ui-accordion-header").length - 1);

                                                                update_note_title(id, "<?php _e('New Note', 'qode'); ?>", new_note);
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif (is_user_logged_in() && $tab == 'shedule' && !get_post_meta($post->ID, 'disable_shedule', true)): ?>
                            <?php
                            $course_id = $post->ID;
                            $calend_link = get_post_meta($course_id, 'calend_link', true);
                            if (!empty($calend_link)):
                            ?>
                                <iframe class="course-shedule" src="<?php echo $calend_link; ?>" style="border: 0"
                                        frameborder="0" scrolling="no"></iframe>
                            <?php else: ?>
                                <? php_e('Календарь для данного курса отсутсвует', 'qode'); ?>
                            <?php endif; ?>
                            <?php elseif (is_user_logged_in() && $tab == 'forum' && !get_post_meta($post->ID, 'disable_forum', true)): ?>
                            <?php
                            $course_id = $post->ID;
                            $forum_id = '';
                            $buddypress_id = get_post_meta($course_id, 'buddypress_id', true);

                            if (!empty($buddypress_id)) {
                                $forum_id = bbp_get_group_forum_ids($buddypress_id);
                            }

                            if (!empty($forum_id)) {
                                $forum_id = $forum_id[0];
                            }

                            if (NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $course_id)){
                            //echo do_shortcode('[bbp-single-forum id="'.$forum_id.'"]');
                            ?>
                                <div class="two_columns_33_66 forum-tab clearfix">
											<?php
                                            if(!empty($forum_instruction_post_id)){
												echo ("<div class='full_width' style='text-align: right; margin-bottom: 15px; text-decoration: underline;'><a target='_blank' href='".get_permalink($forum_instruction_post_id)."'>" .get_post($forum_instruction_post_id)->post_title. "</a>");
											} else{
												include_once 'single-namaste_course_old_user_list.php';
											}
											
											if(empty($hypercomments_forum_id)){
                                                include_once 'single-namaste_course_old_forum.php';
                                            } else {
                                                $user_hypercomments = array(
                                                  'nick' => $current_user->display_name,
                                                  'avatar' => bp_core_fetch_avatar ( array( 'item_id' => $current_user->ID, 'type' => 'mini', 'html' => FALSE) ),
                                                  'id' => $current_user->ID
                                                );
                                                $time_hypercomments = time();
                                                $secret_hypercomments = "2CI6jAMW4QctDv9g31q94ljx0";
                                                $user_base64 = base64_encode( json_encode($user_hypercomments) );
                                                $sign_hypercomments = md5($secret_hypercomments . $user_base64 . $time_hypercomments);
                                                $auth_hypercomments = $user_base64 . "_" . $time_hypercomments . "_" . $sign_hypercomments;

                                                //moderators
                                                if($current_user->has_cap('bbp_keymaster') || $current_user->has_cap('bbp_moderator') || current_user_can('editor')){
                                                    $body_hypercomments =  json_encode(array(
                                                        'widget_id'=> $hypercomments_forum_id,
                                                        'auth' => $auth_hypercomments,
                                                    ), JSON_HEX_QUOT);
                                                    $postParams = http_build_query(array (
                                                        'body'=> $body_hypercomments,
                                                        'signature'=> sha1($body_hypercomments.$secret_hypercomments)
                                                    ));

                                                    $curl_hypercomments = curl_init();
                                                    curl_setopt_array($curl_hypercomments, array(
                                                        CURLOPT_URL => 'http://c1api.hypercomments.com/1.0/users/add_moderator',
                                                        CURLOPT_RETURNTRANSFER => true,
                                                        CURLOPT_POST => true,
                                                        CURLOPT_POSTFIELDS => $postParams
                                                    ));
                                                    $response = curl_exec($curl_hypercomments);
                                                    rightToLogFileDavgur($response);
                                                    curl_close($curl_hypercomments);
                                                }
                                            }
                                        ?>

                                        <div id="hypercomments_widget"></div>
                                        <script type="text/javascript">
                                            _hcwp = window._hcwp || [];
                                            _hcwp.push({widget:"Stream", widget_id: <?php echo $hypercomments_forum_id;?>, auth: "<?php echo $auth_hypercomments;?>", eager_load:true});
                                            if (!window.hypercommentsAPI) {
                                                setTimeout(function(){
                                                    hypercommentsAPI.initById(<?php echo $hypercomments_forum_id;?>);
                                                }, 10);                                                        
                                            } else{
                                                hypercommentsAPI.initById(<?php echo $hypercomments_forum_id;?>);
                                            }
                                        </script>



                                    </div>
                                </div>
                            <input id="image-uploader" class="image-uploader hidden" type="file" name="image-uploader"
                                   multiple/>
                            <?php
                            } elseif (empty($forum_id)) {
                                _e('У данного курса нет форума', 'qode');
                            } else {
                                _e('Только студенты курса имеют доступ к форуму курса', 'qode');
                            }
                            ?>
                            <?php elseif (is_user_logged_in() && $tab == 'archive' && !get_post_meta($post->ID, 'disable_archive', true)): ?>
                            <?php
                            $course_id = $post->ID;

                            $archive_items = get_posts(array(
                                'numberposts' => -1,
                                'orderby' => 'meta_value_num date',
                                'order' => 'DESC',
                                'meta_key' => 'order_number',
                                'meta_query' => array(
                                    array(
                                        'key' => 'archive_course',
                                        'value' => $course_id
                                    )
                                ),
                                'post_type' => 'namaste_archive',
                                'post_status' => 'publish'
                            ));
                            if (count($archive_items) > 0) :
                            ?>
                                <div class="two_columns_33_66 clearfix archive">
                                    <div class="column1">
                                        <div class="column_inner">
                                            <ul class="namaste-archive-list">
                                                <?php foreach ($archive_items as $key => $archive_item) : ?>
                                                    <li data-tab-id="<?php echo $archive_item->ID; ?>"
                                                        class="<?php if ($key == 0) echo 'active '; ?>namaste-archive-list-item"><?php echo $archive_item->post_title; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="column2">
                                        <div class="column_inner namaste-archive-wrap">
                                            <?php foreach ($archive_items as $key => $archive_item) : ?>
                                                <div<?php if ($key != 0) echo ' style="display:none"'; ?>
                                                    class="namaste-archive-tab-content namaste-archive-tab-<?php echo $archive_item->ID; ?>">
                                                    <h3 class="namaste-archive-title"><?php echo $archive_item->post_title; ?></h3>

                                                    <p class="namaste-archive-post-content">
                                                        <?php echo do_shortcode($archive_item->post_content); ?>
                                                    </p>
                                                    <?php
                                                    $additional = get_post_meta($archive_item->ID, 'additional_content', true);
                                                    if (!empty($additional)) : ?>
                                                        <?php echo do_shortcode("[separator type='normal' color='#DFDFDF' thickness='' up='15' down='15']"); ?>
                                                        <h4><?php _e('Additional Resources', 'qode'); ?></h4>
                                                        <div>
                                                            <?php echo $additional; ?>
                                                        </div>
                                                    <?php
                                                    endif;
                                                    $lectures = get_post_meta($archive_item->ID, 'lectures', true);
                                                    if (!empty($lectures)):

                                                        echo do_shortcode("[separator type='normal' color='#DFDFDF' thickness='' up='15' down='15']");
                                                        ?>
                                                        <h4><?php _e('Lectures', 'qode'); ?></h4>
                                                        <div class="lectures-content">
                                                            <?php echo do_shortcode($lectures); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    (function ($) {
                                        $(document).on('click', '.namaste-archive-list-item', function (e) {
                                            e.preventDefault();

                                            var id = $(this).data('tab-id');

                                            $('.namaste-archive-tab-content').hide();
                                            $('.namaste-archive-tab-' + id).show();

                                            $('.namaste-archive-list-item').removeClass('active');
                                            $(this).addClass('active');

                                            fix_height();

                                        });

                                        function fix_height() {
                                            if ($('.archive .column2').height() < $('.archive .column1').height()) {
                                                $('.archive .column2').height($('.archive .column1').height());
                                            } else {
                                                $('.archive .column2').css('height', 'auto');
                                            }
                                        }

                                        fix_height();
                                    })(jQuery);
                                </script>
                            <?php else: ?>
                                <?php _e('Архив данного курса пуст', 'qode'); ?>
                            <?php endif; ?>
                <?php else: ?>
				
					
                    <div class="two_columns_50_50 clearfix about">
                        <div class="column1">
                            <div class="column_inner">
							
								<?php if(!is_user_logged_in()) : ?>
							
									<div class="T1"><?php _e('About a course', 'qode'); ?></div>
									<?php if ($subtitle) echo  '<div class="course_single_subtitle  course_single_details">'. $subtitle .'</div>'; ?>
										
									<?php the_content(); ?>
								   
								<?php else: // USER IS LOGGED IN ?> 
									
									<div class="course_single_info_section">

										<div class="course_single_course_title"><?php echo $title; ?></div>
										
										<div class="course_single_details"><?php echo $category; ?></div>
										<?php
										$begins_at = get_post_meta($post->ID, 'begins_at', true);
										$length = get_post_meta($post->ID, 'length', true);
										if(!empty($begins_at) || !empty($length)):
										?>
										<?php if(!empty($begins_at)): ?>
										<div class="course_single_begins  course_single_details"><?php _e('Course Starts:', 'qode'); ?> <?php echo $begins_at; ?></div>
										<?php endif; ?>
										<?php if(!empty($length)): ?>
										<div class="course_single_length  course_single_details"><?php _e('Length:', 'qode'); ?> <?php echo $length; ?> <?php _e('days', 'qode'); ?></div>
										<?php endif; ?>
										<?php endif; ?> 
										
									
										
										<?php if (!NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $post->ID) == null):  // IF USER ENROLLED IN COURSE ?>
											<!-- <div class="course_single_enrolled_status  course_single_details"><?php echo do_shortcode('[namaste-enroll]'); ?></div> -->
											<?php $var = do_shortcode('[namaste-todo]'); if ($var && $var !="<ul></ul>") { echo '<div class="course_single_course_title">'. __("Program",'qode') .'</div><div class="course_single_programm_list  course_single_details">' .$var. '</div>'; }?>
										<?php else : ?>
											
											<?php $var = do_shortcode('[namaste-course-lessons 0 0 post_date ASC]'); if ($var && $var !="<ul></ul>") echo '<div class="course_single_course_title">'. __("Program",'qode') .'</div><div class="course_single_programm_list  course_single_details">' .$var. '</div>'; ?>
										<?php endif; ?>	
                                        <?php 
										  echo do_shortcode("[button size='medium' text='Помочь академии' link='http://neworg.kbb1.com/ru/node/260' target='_blank' background_color='rgba(224, 146, 47, 0.7)' ]");
                                        ?>
									</div>

									
									<?php if(!is_user_logged_in()) : ?>
									<a id="enroll-not-auth" class="upperCase" href="<?php echo home_url('/registration/'); ?>"><?php _e('Enroll', 'qode'); ?> <span>»</span></a>
									
									<?php endif; ?>
								<?php endif; ?> 
                            </div>
                        </div>
                        <div class="column2">
                            <div class="column_inner">
                                							
								<?php if(!is_user_logged_in()) : ?>
                                <!-- <div class="course_single_thumb_section">
                                    <?php
                                        $post_thumbnail_id = get_post_thumbnail_id( $post->ID );

                                        $image = wp_get_attachment_metadata( $post_thumbnail_id );

                                        $upload_dir = wp_upload_dir();

                                        $image = $upload_dir['baseurl'].'/'.$image['file'];

                                        if(!$post_thumbnail_id) {
                                            $image = 'http://dummyimage.com/640x360/fff/000.png&text=No+image';
                                        }
                                    ?>
                                    <img src="<?php echo $image; ?>" />
                                </div> -->
                                <div class="course_single_info_section">
									
                                   <?php $var = do_shortcode('[namaste-course-lessons 0 0 post_date ASC]'); if ($var && $var !="<ul></ul>") echo '<div class="course_single_course_title">'. __("Program",'qode') .'</div><div class="course_single_programm_list  course_single_details">' .$var. '</div>'; ?>
									<?php //echo $category; ?>
									
                                </div>
								<?php else: ?>
									<div class="T1"><?php _e('About a course', 'qode'); ?></div>
									<?php the_content(); ?>
								<?php endif; ?>	
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                        </div>
                    </article>


                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>


<?php get_footer(); ?>