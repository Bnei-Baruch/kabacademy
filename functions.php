<?php

// enqueue the child theme stylesheet
function wp_schools_enqueue_scripts() {
	
	wp_deregister_script('jquery');
	wp_register_script('jquery', ("https://code.jquery.com/jquery-2.1.4.js"), false, '2.1.4');
	wp_enqueue_script('jquery');
	
	// wp_register_style("bootstrap-css", get_stylesheet_directory_uri() . './bootstrap/css/bootstrap.css');
	// wp_enqueue_style('bootstrap-css');
	wp_register_style ( 'childstyle', get_stylesheet_directory_uri () . '/style.css' );
	wp_enqueue_style ( 'childstyle' );
	wp_register_style ( 'bxslider', get_stylesheet_directory_uri () . '/jquery.bxslider.css' );
	wp_enqueue_style ( 'bxslider' );
	
	// wp_enqueue_script("bootstrap", get_stylesheet_directory_uri() . './bootstrap/js/bootstrap.min.js');
	wp_enqueue_script ( 'watuscript', get_stylesheet_directory_uri () . '/watu-script.js', array (
			'watu-script' 
	), false, true );
	wp_enqueue_script ( 'bbScript', get_stylesheet_directory_uri () . '/bb-script.js' );
	wp_enqueue_script ( 'bxslider', get_stylesheet_directory_uri () . '/js/jquery.bxslider.min.js' );
	wp_enqueue_style ( 'fonts-ptsansnarrow', 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' );
	// wp_enqueue_style( 'fonts-ptsans', 'http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=cyrillic,latin' );
	// wp_enqueue_script( 'fonts-ptsans', 'http://webfonts.creativecloud.com/open-sans:n7:all;pt-sans-narrow:n4,n7:all;pt-sans:n4,n7,i4:all.js' );
}

add_action ( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 1100 );
function custom_widgets_init() {
	register_sidebar ( array (
			'name' => 'footer partners area',
			'id' => 'footer_partners',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '' 
	) );
}

add_action ( 'widgets_init', 'custom_widgets_init' );

/* Disable WordPress Admin Bar for all users but admins. */
add_filter ( 'show_admin_bar', '__return_false' );

add_action ( 'wp_footer', 'except_logout_url', 100 );
function except_logout_url() {
	echo '<script>no_ajax_pages.push("' . htmlspecialchars_decode ( wp_logout_url ( home_url () ) ) . '");</script>';
}
function request_url() {
	$result = ''; // Пока результат пу�?т
	$default_port = 80; // Порт по-умолчанию
	                    
	// �? не в защищенном-ли мы �?оединении?
	if (isset ( $_SERVER ['HTTPS'] ) && ($_SERVER ['HTTPS'] == 'on')) {
		// В защищенном! Добавим протокол...
		$result .= 'https://';
		// ...и переназначим значение порта по-умолчанию
		$default_port = 443;
	} else {
		// Обычное �?оединение, обычный протокол
		$result .= 'http://';
	}
	// Им�? �?ервера, напр. site.com или www.site.com
	$result .= $_SERVER ['SERVER_NAME'];
	
	// �? порт у на�? по-умолчанию?
	if ($_SERVER ['SERVER_PORT'] != $default_port) {
		// Е�?ли нет, то добавим порт в URL
		$result .= ':' . $_SERVER ['SERVER_PORT'];
	}
	// По�?ледн�?�? ча�?ть запро�?а (путь и GET-параметры).
	$result .= $_SERVER ['REQUEST_URI'];
	// Уфф, вроде получило�?ь!
	return $result;
}
function qode_scripts_replace() {
	// wp_dequeue_script("default");
	wp_enqueue_script ( "default", get_stylesheet_directory_uri () . "/js/default.min.js", array (), false, true );
}

// add_action('wp_enqueue_scripts', 'qode_scripts_replace');
function get_course_progress($course_id, $student_id = null) {
	global $wpdb, $user_ID;
	if (empty ( $student_id ))
		$student_id = $user_ID;
	if (empty ( $student_id ))
		return __ ( 'N/A', 'namaste' );
		
		// select num lessons in the course
	$lesson_ids = $wpdb->get_results ( $wpdb->prepare ( "SELECT tP.ID as ID FROM {$wpdb->posts} tP
	JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course' AND tM.meta_value = %d
	WHERE post_type = 'namaste_lesson'  AND (post_status='publish' OR post_status='draft')", $course_id ) );
	$num_lessons = sizeof ( $lesson_ids );
	$lids = array (
			0 
	);
	foreach ( $lesson_ids as $lesson_id )
		$lids [] = $lesson_id->ID;
	$lid_sql = implode ( ",", $lids );
	
	// now select num completed lessons by this student
	$num_completed = $wpdb->get_var ( $wpdb->prepare ( "SELECT COUNT(id) FROM " . NAMASTE_STUDENT_LESSONS . "
			WHERE student_id=%d AND lesson_id IN ($lid_sql) AND status=1", $student_id ) );
	
	if (! $num_lessons)
		$perc = 0;
	else
		$perc = round ( 100 * $num_completed / $num_lessons );
	
	return $perc;
}
function academy_courses($atts) {
	$atts = shortcode_atts ( array (
			'page' => '0' 
	), $atts );
	
	$return = '';
	
	$numberposts = 20;
	
	$posts = get_posts ( array (
			'numberposts' => $numberposts,
			'offset' => $atts ['page'] * 1,
			'post_type' => 'namaste_course',
			'post_status' => 'publish' 
	) );
	foreach ( $posts as $key => $post ) {
		if ($key == ($numberposts - 1))
			break;
		$aCourseData = getCourseDataForHomePage ( $post );
		// $return = json_encode($aCourseData);
		// $return = 'asdasdasd';
		if (! $aCourseData ["registration_closed"]) {
			if (NamasteLMSStudentModel::is_enrolled ( get_current_user_id (), $post->ID ) == null) {
				$enrollBtnHTML = '<span class="btnCourse">Войти</span>';
									/* <div class="btnCourse" style="position: relative; height: 32px; padding: 0px;">
										<span style="position: absolute;left:80px;color: ##555555">
											Прогре�?�? ' . $perc . '%
										</span>
										<div style="height: 32px; width: ' . $perc . '%; background-color: #FFF4D9;"></div>
									</div>'; */
			} else {
				$enrollBtnHTML = '<span class="btnCourse">' . __ ( 'Enroll', 'qode' ) . '</span>';
				$perc = get_course_progress ( $my_course->ID, $enrolled_one->ID );
			}
			$return .= '
			<div class="academy_course ' . $aCourseData ["live_sticker"] . '" style="background: url(' . $aCourseData ["image"] . '); background-size: 265px 230px;  background-repeat: no-repeat;">
				<a href="' . get_permalink ( $post->ID ) . '">
					<span class="academy_course_text">
							<span class="academy_course_title">' . $aCourseData ["title"] . '</span>
							<span class="academy_course_subtitle">
								' . $aCourseData ["subtitle"] . $enrollBtnHTML . '								
							</span>
					</span>
				</a>
				<div class="courseColorBG" style= "background-color: #' . $aCourseData ["category_color"] . '"></div>
			</div>';
		}
	}
	
	wp_reset_postdata ();
	$load_more = '';
	
	if (count ( $posts ) == $numberposts) {
		//$load_more .= '<div id="load_more_posts_wrap"><a id="load_more_posts" data-page="' . ($atts ['page'] + 8) . '" href="#">' . __ ( 'MORE COURSES', 'qode' ) . '</a></div>';
	}
	
	return $return . $load_more;
}
function getCourseDataForHomePage($post) {
	$aResult = array ();
	
	$registration_closed = get_post_meta ( $post->ID, 'registration_closed', true );
	
	$aResult ['registration_closed'] = $registration_closed;
	
	$post_thumbnail_id = get_post_thumbnail_id ( $post->ID );
	$upload_dir = wp_upload_dir ();
	
	if ($post_thumbnail_id) {
		$imageArray = wp_get_attachment_image_src ( $post_thumbnail_id, 'thumbnail', false );
		$image = $imageArray [0];
	} else {
		$image = 'http://dummyimage.com/269x150/fff/000.png&text=No+image';
	}
	
	$aResult ['image'] = $image;
	
	if (in_category ( 'on-layn-obuchenie', $post->ID )) {
		$aResult ['live_sticker'] = 'courseLive';
	} else {
		$aResult ['live_sticker'] = '';
	}
	
	$title = get_post_meta ( $post->ID, 'list_title', true );
	$title = (! empty ( $title )) ? $title : $post->post_title;
	$aResult ['title'] = $title;
	$subtitle = get_post_meta ( $post->ID, 'list_subtitle', true );
	$aResult ['subtitle'] = $subtitle;
	
	/*
	 * if(mb_strlen($title) > 20){
	 * $title = mb_substr($title, 0, 20) . '...';
	 * }
	 * if(mb_strlen($subtitle) > 30){
	 * $subtitle = mb_substr($subtitle, 0, 30) . '...';
	 * }
	 */
	
	$footer = '';
	$category_color = get_post_meta ( $post->ID, 'course_color', true );
	$category_color = $category_color ? $category_color : "555";
	$aResult ['category_color'] = $category_color;
	
	$begins_at = get_post_meta ( $post->ID, 'begins_at', true );
	$aResult ['begins_at'] = $begins_at;
	
	$length = get_post_meta ( $post->ID, 'length', true );
	
	if (! empty ( $length )) {
		$length_str = __ ( 'Length ', 'qode' ) . $length . ' ' . __ ( 'days', 'qode' );
	}
	
	if (! empty ( $begins_at ) && strtotime ( $begins_at )) {
		$days = ceil ( (strtotime ( $begins_at ) - time ()) / (24 * 60 * 60) );
		if ($days > 0) {
			$footer .= __ ( 'Begins at: ', 'qode' ) . $days . ' ' . __ ( 'days', 'qode' );
		} elseif ($days == 0) {
			$footer .= __ ( 'Begins today', 'qode' );
		} else {
			$footer .= __ ( 'Started', 'qode' );
		}
		if (! empty ( $length )) {
			$footer .= ' (' . $length_str . ')';
		}
	} elseif (! empty ( $length )) {
		$footer = $length_str;
	}
	$aResult ['footer'] = $footer;
	
	$category = get_the_category ( $post->ID );
	$category = ! empty ( $category ) ? $category [0] : '';
	$category = ! empty ( $category ) ? '<div class="academy_course_cat">' . mb_strtoupper ( $category->cat_name ) . '</div>' : '';
	$aResult ['category'] = $category;
	
	return $aResult;
}

add_shortcode ( 'academy_courses', 'academy_courses' );
function tabsline($atts, $content = null) {
	$html = "";
	extract ( shortcode_atts ( array (), $atts ) );
	$html .= '<div class="tabs ' . (isset ( $atts ['type'] ) ? $atts ['type'] : '') . '">';
	$html .= '<ul class="tabs-nav">';
	$key = array_search ( (isset ( $atts ['type'] ) ? $atts ['type'] : ''), $atts );
	if ($key !== false) {
		unset ( $atts [$key] );
	}
	foreach ( $atts as $key => $tab ) {
		if (stripos ( $key, "tabid" ) !== false) {
			$html .= '<li><a href="#' . $key . '">' . $tab . '</a></li>';
		}
	}
	$html .= '</ul>';
	$html .= '<div class="tabs-container">';
	$html .= no_wpautop ( $content ) . '</div></div>';
	return $html;
}

remove_shortcode ( 'tabs' );
add_shortcode ( 'tabs', 'tabsline' );

add_action ( 'wp_footer', 'academy_courses_loader' );
function academy_courses_loader() {
	echo '<script>
        jQuery(document).on("click", "#load_more_posts", function(e){

            e.preventDefault();

               var data = {
                "action": "get_academy_courses",
                "page": jQuery(this).data("page"),
                "security": "' . wp_create_nonce ( "load-more-courses" ) . '"
            };

            jQuery(this).parent().remove();

            jQuery.post(ajaxurl, data, function(response) {
               if(response.result == "OK"){
                    jQuery("#academy_courses_list .container_inner").append(response.content);
               }
            }, "json");
        });
    </script>';
}
function get_academy_courses() {
	if (is_numeric ( $_POST ['page'] ) && check_ajax_referer ( 'load-more-courses', 'security' )) {
		$page = ( int ) $_POST ['page'];
		$return = do_shortcode ( '[academy_courses page="' . $page . '"]' );
		die ( json_encode ( array (
				'result' => 'OK',
				'content' => $return 
		) ) );
	}
}

add_action ( 'wp_ajax_nopriv_get_academy_courses', 'get_academy_courses' );

if (function_exists ( 'add_image_size' )) {
	add_image_size ( 'academy_courses_list', 269, 150, true );
	add_image_size ( 'academy_courses_list_small', 171, 100, true );
}
function namaste_mark() {
	global $wpdb, $post, $user_ID;
	
	if (! is_user_logged_in ())
		return "";
		
		// is the lesson in progress?
		/*
	 * $in_progress = $wpdb->get_var($wpdb->prepare("SELECT id FROM ".NAMASTE_STUDENT_LESSONS."
	 * WHERE lesson_id=%d AND student_id=%d AND status!=1", $post->ID, $user_ID));
	 * if(!$in_progress) return '';
	 */
		
	// ready for completion?
	if (NamasteLMSLessonModel::is_completed ( $post->ID, $user_ID )) {
		return __ ( 'Lesson completed!', 'namaste' );
	} elseif (NamasteLMSLessonModel::is_ready ( $post->ID, $user_ID, false, true )) {
		// display button or mark as completed
		if (! empty ( $_POST ['mark'] )) {
			NamasteLMSLessonModel::complete ( $post->ID, $user_ID );
			return __ ( 'Lesson completed!', 'namaste' );
		} else {
			return '<form method="post" action="">
				<p><input type="submit" class="namaste-mark" name="mark" value="' . __ ( 'Mark as completed', 'namaste' ) . '"></p>
				</form>';
		}
	} else {
		return '<form method="post" action="">
				<p><input type="submit" class="namaste-mark" name="mark" value="' . __ ( 'Mark as completed', 'namaste' ) . '" disabled="disabled"></p>
				</form>';
	}
} // end mark

add_action ( 'init', 'reregister_shortcode', 15 );
function reregister_shortcode() {
	remove_shortcode ( 'namaste-mark' );
	add_shortcode ( 'namaste-mark', 'namaste_mark' );
	
	remove_shortcode ( 'namaste-enroll' );
	add_shortcode ( 'namaste-enroll', 'namaste_enroll' );
	
	remove_shortcode ( 'namaste-next-lesson' );
	add_shortcode ( 'namaste-next-lesson', 'namaste_next_lesson' );
	
	remove_shortcode ( 'namaste-prev-lesson' );
	add_shortcode ( 'namaste-prev-lesson', 'namaste_prev_lesson' );
	
	remove_shortcode ( 'namastepro-next-lesson' );
	add_shortcode ( 'namastepro-next-lesson', 'namastepro_next_lesson' );
	
	remove_shortcode ( 'namastepro-prev-lesson' );
	add_shortcode ( 'namastepro-prev-lesson', 'namastepro_prev_lesson' );
}
function namaste_enroll() {
	global $wpdb, $user_ID, $user_email, $post;
	
	if (! is_user_logged_in ()) {
		// return __('You need to be logged in to enroll in this course', 'namaste');
		$content = '';
		
		$required_lessons_ids = get_post_meta ( $post->ID, 'namaste_required_lessons', true );
		if (! is_array ( $required_lessons_ids ))
			$required_lessons_ids = array ();
		
		if (! empty ( $required_lessons_ids )) {
			sort ( $required_lessons_ids );
			$content .= "<ul class='not-auth-todo-list'>\n";
			foreach ( $required_lessons_ids as $lesson ) {
				$content .= "<li>" . get_the_title ( $lesson );
				$content .= "</li>\n";
			}
			$content .= "</ul>";
		}
		
		return $content;
	}
	
	$enrolled = $wpdb->get_row ( $wpdb->prepare ( "SELECT * FROM " . NAMASTE_STUDENT_COURSES . " WHERE user_id = %d AND course_id = %d", $user_ID, $post->ID ) );
	
	if (empty ( $enrolled->id )) {
		$currency = get_option ( 'namaste_currency' );
		$is_manager = current_user_can ( 'namaste_manage' );
		$_course = new NamasteLMSCourseModel ();
		
		// stripe integration goes right on this page
		$accept_stripe = get_option ( 'namaste_accept_stripe' );
		$accept_paypal = get_option ( 'namaste_accept_paypal' );
		$accept_other_payment_methods = get_option ( 'namaste_accept_other_payment_methods' );
		
		if ($accept_stripe)
			$stripe = NamasteStripe::load ();
		if (! empty ( $_POST ['stripe_pay'] )) {
			NamasteStripe::pay ( $currency );
			namaste_redirect ( $_SERVER ['REQUEST_URI'] );
		}
		
		if (! empty ( $_POST ['enroll'] )) {
			echo " <script type='text/javascript'> location.reload(true); </script>";
			// TODO:Davgur - make error (ont go after this)
			$mesage = NamasteLMSCoursesController::enroll ( $is_manager );
			namaste_redirect ( $_SERVER ['REQUEST_URI'] );
		}
		
		$_course->currency = $currency;
		$_course->accept_other_payment_methods = $accept_other_payment_methods;
		$_course->accept_paypal = $accept_paypal;
		$_course->accept_stripe = $accept_stripe;
		$_course->stripe = $stripe;
		wp_enqueue_script ( 'thickbox', null, array (
				'jquery' 
		) );
		wp_enqueue_style ( 'thickbox.css', '/' . WPINC . '/js/thickbox/thickbox.css', null, '1.0' );
		$post->post_id = $post->ID;
		$post->fee = get_post_meta ( $post->ID, 'namaste_fee', true );
		$content = $_course->enroll_buttons ( $post, $is_manager );
		
		$content = str_replace ( '<form method="post">', '<form method="post" id="namaste-enroll-form">', $content );
		$content = str_replace ( '</form>', '</form><a id="enroll-not-auth" class="upperCase" href="#">' . __ ( 'Enroll', 'qode' ) . '<span>»</span></a><script>(function($){
    $("#share-social-buttons").addClass("not-logged");

    $("#enroll-not-auth").on("click", function(e){
        e.preventDefault();
        $("#namaste-enroll-form").submit();
    });
})(jQuery);</script>', $content );
		return $content;
	} else {
		switch ($enrolled->status) {
			case 'enrolled' :
				return __ ( 'You are enrolled in this course.', 'namaste' );
				break;
			case 'pending' :
				return __ ( 'Your enroll request is received. Waiting for manager approval.', 'namaste' );
				break;
			case 'completed' :
				return __ ( 'You have completed this course.', 'namaste' );
				break;
			case 'rejected' :
				return __ ( 'Your enrollment request is rejected.', 'namaste' );
				break;
		}
	}
}
function output_postid() {
	global $post;
	if (isset ( $post->ID ) && ! empty ( $post->ID ) && is_singular ( 'namaste_lesson' )) :
		?>
<script>
            var lesson_id = <?php echo $post->ID ?>;
        </script>








	<?php endif;
}

add_action ( 'wp_footer', 'output_postid' );
function watucas_scheck() {
	$uid = get_current_user_id ();
	
	if (isset ( $_REQUEST ['lesson_id'] ) && is_numeric ( $_REQUEST ['lesson_id'] ) && $uid && NamasteLMSLessonModel::is_ready ( $_REQUEST ['lesson_id'], $uid, true )) {
		echo '
        <script>
        jQuery(function ($) {
        jQuery(\'input[name="mark"]\').each(function(){
        jQuery(this).removeAttr("disabled");
        });
        });
        </script>';
	}
}

add_action ( 'watu_exam_submitted', 'watucas_scheck' );
function gsearch() {
	return "<div id='gsearch'>
    <script>
  (function() {
    var cx = '014300946940296201717:pou6u89fur0';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
    </div>";
}

add_shortcode ( 'gsearch', 'gsearch' );
function namaste_next_lesson_custom($atts) {
	extract ( shortcode_atts ( array (
			'class' => 'course-navigation-item',
			'text' => 'Lesson' 
	), $atts, 'nnlc' ) );
	// selects the next lesson in the course if any
	
	if (! is_user_logged_in ())
		return "";
	
	global $post, $user_ID;
	
	$_course = new NamasteLMSCourseModel ();
	
	$course_id = get_post_meta ( $post->ID, 'namaste_course', true );
	
	if (empty ( $course_id ) && $post->post_type == 'namaste_course') {
		$course_id = $post->ID;
	} elseif (empty ( $course_id )) {
		return "";
	}
	
	$required_lessons = $_course->required_lessons ( $course_id, $user_ID );
	
	$next_lesson = '';
	
	if (! empty ( $required_lessons )) {
		foreach ( $required_lessons as $lesson ) {
			$next_lesson = $lesson->ID;
			if (! $lesson->namaste_completed) {
				break;
			}
		}
	}
	
	if (empty ( $required_lessons ))
		return "<a class='" . $class . "' href='" . add_query_arg ( array (
				'tab' => 'nolessons' 
		), get_permalink ( $course_id ) ) . "'>" . $text . " " . __ ( "(Starts soon!)", 'qode' ) . "</a>";
	
	return "<a class='" . $class . "' href='" . get_permalink ( $next_lesson ) . "'>" . $text . "</a>";
}

add_shortcode ( 'nnlc', 'namaste_next_lesson_custom' );

// selects the next lesson in the course if any
function namaste_next_lesson($atts) {
	global $post, $wpdb;
	if (empty ( $post->ID ) or $post->post_type != 'namaste_lesson')
		return "";
	
	$text = empty ( $atts [0] ) ? __ ( 'next lesson', 'qode' ) : $atts [0];
	
	// select next lesson
	$course_id = get_post_meta ( $post->ID, 'namaste_course', true );
	$next_lesson = $wpdb->get_row ( $wpdb->prepare ( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = 'namaste_lesson' AND tM.meta_value = %d AND tP.ID > %d
			AND tP.post_status = 'publish' ORDER BY tP.ID", $course_id, $post->ID ) );
	
	if (empty ( $next_lesson->ID ))
		return "";
	
	return "<a class='namaste-next-lesson' href='" . get_permalink ( $next_lesson->ID ) . "'>$text</a>";
}

// selects the previous lesson in the course if any
function namaste_prev_lesson($atts) {
	global $post, $wpdb;
	if (empty ( $post->ID ) or $post->post_type != 'namaste_lesson')
		return "";
	
	$text = empty ( $atts [0] ) ? __ ( 'previous lesson', 'qode' ) : $atts [0];
	
	// select next lesson
	$course_id = get_post_meta ( $post->ID, 'namaste_course', true );
	$prev_lesson = $wpdb->get_row ( $wpdb->prepare ( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = 'namaste_lesson' AND tM.meta_value = %d AND tP.ID < %d
			AND tP.post_status = 'publish' ORDER BY tP.ID DESC", $course_id, $post->ID ) );
	
	if (empty ( $prev_lesson->ID ))
		return "";
	
	return "<a class='namaste-prev-lesson' href='" . get_permalink ( $prev_lesson->ID ) . "'>$text</a>";
}

// selects the next lesson in the course if any
function namastepro_next_lesson($atts) {
	global $post, $wpdb;
	if (empty ( $post->ID ) or $post->post_type != 'namaste_lesson')
		return "";
	
	$text = empty ( $atts [0] ) ? __ ( 'next lesson', 'qode' ) : $atts [0];
	
	// select next lesson
	$course_id = get_post_meta ( $post->ID, 'namaste_course', true );
	$next_lesson = $wpdb->get_row ( $wpdb->prepare ( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = 'namaste_lesson' AND tM.meta_value = %d AND tP.ID > %d
			AND tP.post_status = 'publish' ORDER BY tP.ID", $course_id, $post->ID ) );
	
	if (empty ( $next_lesson->ID ))
		return "";
	
	return "<a class='namaste-next-lesson' href='" . get_permalink ( $next_lesson->ID ) . "'>$text</a>";
}

// selects the previous lesson in the course if any
function namastepro_prev_lesson($atts) {
	global $post, $wpdb;
	if (empty ( $post->ID ) or $post->post_type != 'namaste_lesson')
		return "";
	
	$text = empty ( $atts [0] ) ? __ ( 'previous lesson', 'qode' ) : $atts [0];
	
	// select next lesson
	$course_id = get_post_meta ( $post->ID, 'namaste_course', true );
	$prev_lesson = $wpdb->get_row ( $wpdb->prepare ( "SELECT tP.* FROM {$wpdb->posts} tP
			JOIN {$wpdb->postmeta} tM ON tM.post_id = tP.ID AND tM.meta_key = 'namaste_course'
			WHERE tP.post_type = 'namaste_lesson' AND tM.meta_value = %d AND tP.ID < %d
			AND tP.post_status = 'publish' ORDER BY tP.ID DESC", $course_id, $post->ID ) );
	
	if (empty ( $prev_lesson->ID ))
		return "";
	
	return "<a class='namaste-prev-lesson' href='" . get_permalink ( $prev_lesson->ID ) . "'>$text</a>";
}

add_action ( 'init', 'namaste_archive_post_type_add' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function namaste_archive_post_type_add() {
	$labels = array (
			'name' => __ ( 'Archive Items', 'qode' ),
			'singular_name' => __ ( 'Archive Item', 'qode' ),
			'menu_name' => __ ( 'Archive Items', 'qode' ),
			'name_admin_bar' => __ ( 'Archive Item', 'qode' ),
			'add_new' => __ ( 'Add New', 'qode' ),
			'add_new_item' => __ ( 'Add New Archive Item', 'qode' ),
			'new_item' => __ ( 'New Archive Item', 'qode' ),
			'edit_item' => __ ( 'Edit Archive Item', 'qode' ),
			'view_item' => __ ( 'View Archive Item', 'qode' ),
			'all_items' => __ ( 'All Archive Items', 'qode' ),
			'search_items' => __ ( 'Search Archive Items', 'qode' ),
			'parent_item_colon' => __ ( 'Parent Archive Items:', 'qode' ),
			'not_found' => __ ( 'No Archive Items found.', 'qode' ),
			'not_found_in_trash' => __ ( 'No Archive Items found in Trash.', 'qode' ) 
	);
	
	$args = array (
			'labels' => $labels,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'query_var' => true,
			'rewrite' => array (
					'slug' => 'archive' 
			),
			'capability_type' => 'post',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array (
					'title',
					'editor',
					'author',
					'revisions',
					'custom-fields' 
			) 
	);
	
	register_post_type ( 'namaste_archive', $args );
}

add_shortcode ( 'h4', 'h4_wrap_shortcode' );
function h4_wrap_shortcode($attr, $content) {
	return '<h4>' . $content . '</h4>';
}

add_shortcode ( 'link', 'link_wrap_shortcode' );
function link_wrap_shortcode($atts, $content) {
	$args = shortcode_atts ( array (
			'title' => 'Link',
			'href' => '#' 
	), $atts );
	
	return '<a href="' . $args ['href'] . '">' . $args ['title'] . '</a>';
}
function get_next_lection_date($id) {
	if (empty ( $id ))
		return '';
	
	$cal_id = get_post_meta ( $id, 'calend_link', true );
	
	$matches = array ();
	preg_match ( '/(src|cid)=([-_\.%@\w]+)/iu', $cal_id, $matches );
	$cal_id = $matches [2];
	
	require_once 'google-api-php-client-master/autoload.php';
	
	$client = new Google_Client ();
	$client->setApplicationName ( "My_Application" );
	$client->setDeveloperKey ( "AIzaSyAf7A6tXAT5CC61yYkid6Q6ONmCutzl6dw" );
	
	$cal_id = str_replace ( '%40', '@', $cal_id );
	
	$calendar = new Google_Service_Calendar ( $client );
	$opts = array (
			'maxResults' => 1,
			'timeMin' => date ( DateTime::ATOM ),
			'singleEvents' => true,
			'orderBy' => 'startTime' 
	);
	
	try {
		$results = $calendar->events->listEvents ( $cal_id, $opts );
	} catch ( Exception $e ) {
		return '';
	}
	
	if (empty ( $results->items )) {
		return '';
	} else {
		$start = '';
		
		foreach ( $results as $result ) {
			$start = date ( 'd-m-Y \a\t H:i', strtotime ( $result->start->dateTime ) + 3 * 60 * 60 );
		}
		
		return __ ( 'Next lection starts ', 'qode' ) . " " . $start . __ ( ' MSK', 'qode' );
	}
}

add_shortcode ( 'slide', 'renderslide' );
function renderslide($atts, $content) {
	return '<li>' . $content . '</li>';
}

add_action ( 'wp_ajax_update_note_title', 'update_note_title' );
function update_note_title() {
	$user_id = get_current_user_id ();
	if (! $user_id) {
		die ( json_encode ( array (
				'result' => 'ERROR' 
		) ) );
	}
	$date = current_time ( 'timestamp', 0 );
	
	$notes = get_user_meta ( $user_id, 'notes_' . $_POST ['course_id'], true );
	
	if (! isset ( $notes [$_POST ['note_id']] )) {
		$notes [$_POST ['note_id']] = array (
				'title' => __ ( 'New Note', 'qode' ),
				'content' => __ ( 'Type text here...', 'qode' ),
				'date' => $date 
		);
	}
	
	$notes [$_POST ['note_id']] ['title'] = $_POST ['title'];
	$notes [$_POST ['note_id']] ['date'] = $date;
	
	update_user_meta ( $user_id, 'notes_' . $_POST ['course_id'], $notes );
	
	die ( json_encode ( array (
			'result' => 'OK',
			'date' => date ( 'd/m/y', $date ),
			'time' => date ( 'h:i A', $date ) 
	) ) );
}

add_action ( 'wp_ajax_update_note_content', 'update_note_content' );
function update_note_content() {
	$user_id = get_current_user_id ();
	if (! $user_id) {
		die ( json_encode ( array (
				'result' => 'ERROR' 
		) ) );
	}
	$date = current_time ( 'timestamp', 0 );
	
	$notes = get_user_meta ( $user_id, 'notes_' . $_POST ['course_id'], true );
	
	if (! isset ( $notes [$_POST ['note_id']] )) {
		$notes [$_POST ['note_id']] = array (
				'title' => __ ( 'New Note', 'qode' ),
				'content' => __ ( 'Type text here...', 'qode' ),
				'date' => $date 
		);
	}
	
	$notes [$_POST ['note_id']] ['content'] = $_POST ['content'];
	$notes [$_POST ['note_id']] ['date'] = $date;
	
	update_user_meta ( $user_id, 'notes_' . $_POST ['course_id'], $notes );
	
	die ( json_encode ( array (
			'result' => 'OK',
			'date' => date ( 'd/m/y', $date ),
			'time' => date ( 'h:i A', $date ) 
	) ) );
}

add_action ( 'wp_ajax_remove_note', 'remove_note' );
function remove_note() {
	$user_id = get_current_user_id ();
	if (! $user_id) {
		die ( json_encode ( array (
				'result' => 'ERROR' 
		) ) );
	}
	
	$notes = get_user_meta ( get_current_user_id (), 'notes_' . $_POST ['course_id'], true );
	
	unset ( $notes [$_POST ['note_id']] );
	
	update_user_meta ( get_current_user_id (), 'notes_' . $_POST ['course_id'], $notes );
	
	die ( json_encode ( array (
			'result' => 'OK' 
	) ) );
}
function qode_styles_Re() {
	wp_dequeue_script ( "plugins" );
	wp_enqueue_script ( "plugins-new", get_stylesheet_directory_uri () . "/js/plugins.js", array (), false, true );
	wp_enqueue_script ( "autosize-textarea", get_stylesheet_directory_uri () . "/js/jquery.autosize.min.js", array (), false, true );
	wp_enqueue_script ( "filereader", get_stylesheet_directory_uri () . "/js/filereader.js", array (), false, true );
	wp_enqueue_script ( "custom-js", get_stylesheet_directory_uri () . "/js/custom.js", array (
			"filereader" 
	), false, true );
	$translation_array = array (
			'ajaxurl' => admin_url ( 'admin-ajax.php' ) 
	);
	
	wp_localize_script ( 'custom-js', 'customjs', $translation_array );
	wp_localize_script ( 'custom-js', 'custom_ajax_vars', array (
			'ajax_url' => admin_url ( 'admin-ajax.php' ) 
	) );
}

add_action ( 'wp_enqueue_scripts', 'qode_styles_Re', 11 );

add_action ( 'wp_ajax_custom_bbp_topic_create', 'custom_bbp_topic_create' );
function custom_bbp_topic_create() {
	$topic_id = bbp_insert_topic ( array (
			'post_parent' => ( int ) $_POST ['bbp_forum_id'],
			'post_content' => $_POST ['content'],
			'post_title' => (mb_strlen ( $_POST ['content'] ) > 100) ? mb_substr ( $_POST ['content'], 0, 100 ) . '...' : $_POST ['content'] 
	), 
			// 'comment_status' => 'closed',
			// 'menu_order' => 0,
			array (
					'forum_id' => ( int ) $_POST ['bbp_forum_id'] 
			) );
	
	echo print_r ( $topic_id, true );
	$isAttahced = update_post_meta ( $topic_id, 'attaches', $_POST ['attaches'] );
	do_action ( 'nbbi_insert_any', $topic_id );
	if (! is_numeric ( $isAttahced ))
		echo $isAttahced;
}

add_action ( 'wp_ajax_custom_bbp_reply_create', 'custom_bbp_reply_create' );
function custom_bbp_reply_create() {
	$reply_id = bbp_insert_reply ( array (
			'post_parent' => $_POST ['bbp_topic_id'], // topic ID
			'post_content' => $_POST ['content'],
			'post_title' => (mb_strlen ( $_POST ['content'] ) > 100) ? mb_substr ( $_POST ['content'], 0, 100 ) . '...' : $_POST ['content'] 
	), array (
			'forum_id' => $_POST ['bbp_forum_id'],
			'topic_id' => $_POST ['bbp_topic_id'] 
	) );
	echo $reply_id;
	update_comment_meta ( $reply_id, 'attaches', $_POST ['attaches'] );
	
	do_action ( 'nbbi_insert_any', $reply_id );
}
function wp_disabled_lesson_redirect() {
	$id = get_the_ID ();
	
	if (get_post_type ( $id ) != 'namaste_lesson') {
		return false;
	}
	
	$course_id = get_post_meta ( $id, 'namaste_course', true );
	
	if (get_post_meta ( $course_id, 'disable_lection', true )) {
		wp_redirect ( get_permalink ( $course_id ) );
		die ();
	}
}

add_action ( 'wp', 'wp_disabled_lesson_redirect' );
function filter_content_tags($content) {
	
	// $content = nl2br(strip_tags(trim($content), '<br>'));
	$content = nl2br ( esc_html ( trim ( $content ) ), '<br>' );
	
	return $content;
}

add_filter ( 'bbp_get_reply_content', 'filter_content_tags', 0 );
add_filter ( 'bbp_get_topic_content', 'filter_content_tags', 0 );
function remove_topic_custom() {
	$post = get_post ( $_POST ['id'] );
	
	if ($post->post_author == get_current_user_id ()) {
		bbp_delete_topic ( $_POST ['id'] );
		wp_delete_post ( $_POST ['id'], true );
	}
	
	die ( json_encode ( array (
			'result' => 'OK' 
	) ) );
}
function remove_reply_custom() {
	$post = get_post ( $_POST ['id'] );
	
	if ($post->post_author == get_current_user_id ()) {
		bbp_delete_reply ( $_POST ['id'] );
		wp_delete_post ( $_POST ['id'], true );
	}
	
	die ( json_encode ( array (
			'result' => 'OK' 
	) ) );
}

add_action ( 'wp_ajax_remove-topic-custom', 'remove_topic_custom' );
add_action ( 'wp_ajax_remove-reply-custom', 'remove_reply_custom' );
function update_topic_custom() {
	$post = get_post ( $_POST ['id'] );
	
	if ($post->post_author == get_current_user_id ()) {
		wp_update_post ( array (
				'ID' => $_POST ['id'],
				'post_content' => $_POST ['content'] 
		) );
		
		update_post_meta ( $_POST ['id'], 'attaches', $_POST ['attaches'] );
	}
	
	die ( json_encode ( array (
			'result' => 'OK',
			'content' => bbp_get_topic_content ( $_POST ['id'] ) 
	) ) );
}
function update_reply_custom() {
	$post = get_post ( $_POST ['id'] );
	
	if ($post->post_author == get_current_user_id ()) {
		wp_update_post ( array (
				'ID' => $_POST ['id'],
				'post_content' => $_POST ['content'] 
		) );
		
		update_comment_meta ( $_POST ['id'], 'attaches', $_POST ['attaches'] );
	}
	
	die ( json_encode ( array (
			'result' => 'OK',
			'content' => bbp_get_reply_content ( $_POST ['id'] ) 
	) ) );
}

add_action ( 'wp_ajax_update-topic-custom', 'update_topic_custom' );
add_action ( 'wp_ajax_update-reply-custom', 'update_reply_custom' );
function like_custom() {
	$check = get_post_meta ( $_POST ['id'], 'like_' . get_current_user_id (), true );
	$count = get_post_meta ( $_POST ['id'], 'likes', true );
	
	if ($check) {
		$count = ( int ) $count - 1;
		delete_post_meta ( $_POST ['id'], 'like_' . get_current_user_id () );
	} else {
		$count = ( int ) $count + 1;
		update_post_meta ( $_POST ['id'], 'like_' . get_current_user_id (), '1' );
	}
	
	update_post_meta ( $_POST ['id'], 'likes', $count );
	
	die ( json_encode ( array (
			'result' => 'OK',
			'count' => $count 
	) ) );
}

add_action ( 'wp_ajax_like-custom', 'like_custom' );
function custom_plural_form($n, $form1, $form2, $form5) {
	$n = abs ( $n ) % 100;
	$n1 = $n % 10;
	if ($n > 10 && $n < 20)
		return $form5;
	if ($n1 > 1 && $n1 < 5)
		return $form2;
	if ($n1 == 1)
		return $form1;
	return $form5;
}
function load_all_replies() {
	$content = '';
	
	$replies = get_posts ( $default = array (
			'numberposts' => - 1,
			'post_type' => bbp_get_reply_post_type (), // Only replies
			'post_parent' => $_POST ['id'], // Of this topic
			'orderby' => 'date', // Sorted by date
			'order' => 'ASC', // Oldest to newest
			'ignore_sticky_posts' => true 
	) ); // Stickies not supported
	
	array_pop ( $replies );
	array_pop ( $replies );
	array_pop ( $replies );
	array_pop ( $replies );
	
	ob_start ();
	foreach ( $replies as $reply ) {
		?>
<div class="single_topic_reply  <?php $postUser = new WP_User($reply->post_author);echo ($postUser->has_cap('bbp_keymaster') || $postUser->has_cap('bbp_moderator')) ? "isAdmin" : "";?>" 
	data-id="<?php echo $reply->ID; ?>">
	<div class="photo">
		<a href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => $reply->post_author, 'height' => 32, 'width' => 32)); ?></a>
	</div>
	<div class="content_wrapper">
		<div class="reply_content">
			<a class="author-link"
				href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bbp_get_reply_author_display_name($reply->ID); ?></a>
                <?php 
                    if ($postUser->has_cap('bbp_keymaster'))  echo "<small>(Администратор форума)</small>" ;
                    elseif ($postUser->has_cap('bbp_moderator'))  echo "<small>(Преподаватель)</small>" ;
                ?>
				<?php echo bbp_get_reply_content($reply->ID); ?>
        </div>
		<div style="display: none" class="reply_content_edit">
			<textarea class="reply_content_edit_textarea"><?php echo get_post_field('post_content', $reply->ID); ?></textarea>
			<a href="#" class="smiles_open"></a>

			<div class="edit_actions">
				<a class="cancel" href="#">Отменить</a>
			</div>
		</div>
                <?php $likes = get_post_meta($reply->ID, 'likes', true); ?>
                <div class="actions">
			<span class="date"><?php echo get_post_time('j F ', false, $reply->ID, true) . __('at', 'qode') . get_post_time(' H:i', false, $reply->ID, true); ?></span><?php $like = get_post_meta($reply->ID, 'like_' . get_current_user_id(), true); ?>
                    <a class="like"
				<?php echo (!empty($like)) ? ' style="display:none"' : ''; ?>
				href="#"><?php _e('Like', 'qode'); ?></a><a class="like dislike"
				<?php echo (empty($like)) ? ' style="display:none"' : ''; ?>
				href="#"><?php _e('Dislike', 'qode'); ?></a>

			<div class="like-count"
				<?php if (empty($likes)) echo ' style="display:none"'; ?>>
				<i class="like-img"></i><span class="count"><?php echo (int)$likes; ?></span>
			</div>
		</div>
	</div>
            <?php if ($reply->post_author == get_current_user_id()): ?>
                <a class="addi_actions_open" href="#"></a>
	<div class="addi_actions" style="display: none">
		<ul>
			<li><a class="edit_action" href="#">Редактировать</a></li>
			<li><a class="remove_action" href="#">Удалить</a></li>
		</ul>
	</div>
            <?php endif; ?>
        </div>
<?php
	}
	$content = ob_get_contents ();
	ob_end_clean ();
	
	die ( json_encode ( array (
			'result' => 'OK',
			'content' => $content 
	) ) );
}

add_action ( 'wp_ajax_load-all-replies', 'load_all_replies' );
function load_more_topics() {
	$content = '';
	
	ob_start ();
	
	$forum_id = $_POST ['forum'];
	
	if ($topics = bbp_has_topics ( array (
			'post_parent' => $forum_id,
			'posts_per_page' => 11,
			'paged' => $_POST ['list'] 
	) )) {
		$counter = 0;
		while ( bbp_topics () ) :
			bbp_the_topic ();
			
			if (++ $counter == 12)
				break;
			
			?>
<div class="topics_list_single_topic  <?php $postUser = new WP_User(bbp_get_topic_author_id());echo ($postUser->has_cap('bbp_keymaster') || $postUser->has_cap('bbp_moderator')) ? "isAdmin" : "";?>"
	id="topic-<?php echo bbp_get_topic_id(); ?>"
	data-bbp_forum_id="<?php echo $forum_id;?>"
	data-id="<?php echo bbp_get_topic_id(); ?>">
	<div class="single_topic_header">
		<div class="photo">
			<a
				href="<?php echo bp_core_get_user_domain(bbp_get_topic_author_id()); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => bbp_get_topic_author_id(), 'height' => 40, 'width' => 40)); ?></a>
		</div>
		<div class="info">
			<div class="name">
				<a
					href="<?php echo bp_core_get_user_domain(bbp_get_topic_author_id()); ?>"><?php echo bbp_get_topic_author_display_name(bbp_get_topic_id()); ?></a>
                <?php 
                    if ($postUser->has_cap('bbp_keymaster'))  echo "<small>(Администратор форума)</small>" ;
                    elseif ($postUser->has_cap('bbp_moderator'))  echo "<small>(Преподаватель)</small>" ;
                ?>
			</div>
			<div class="date"><?php echo get_post_time('j F ', false, bbp_get_topic_id(), true) . __('at', 'qode') . get_post_time(' H:i', false, bbp_get_topic_id(), true); ?></div>
		</div>
                    <?php if (bbp_get_topic_author_id() == get_current_user_id()): ?>
                        <a href="#" class="addi_actions_open"></a>
		<div class="addi_actions" style="display: none">
			<ul>
				<li><a class="edit_action" href="#">Редактировать</a></li>
				<li><a class="remove_action" href="#">Удалить</a></li>
			</ul>
		</div>
                    <?php endif; ?>
                </div>
	<div class="single_topic_content">
                    <?php
			
			$content = bbp_get_topic_content ();
			if (mb_strlen ( $content ) > 500) {
				echo '<div class="show">' . mb_substr ( $content, 0, 500 ) . '... <a href="#" class="show_all">' . __ ( 'More', 'qode' ) . '</a></div>';
				?>
                        <div class="hide"><?php echo $content; ?></div>
                    <?php
			} else {
				echo $content;
			}
			
			?>
                </div>
	<div style="display: none" class="single_topic_content_edit">
		<textarea class="edit_content"><?php echo get_post_field('post_content', bbp_get_topic_id()); ?></textarea>

		<div class="edit_actions">
			<button class="cancel"><?php _e('Cancel', 'qode'); ?></button>
			<button class="save"><?php _e('Save', 'qode'); ?></button>
		</div>
	</div>
	<div class="single_topic_actions">
                    <?php $likes = get_post_meta(bbp_get_topic_id(), 'likes', true); ?>
                    <?php $like = get_post_meta(bbp_get_topic_id(), 'like_' . get_current_user_id(), true); ?><a
			class="like"
			<?php echo (!empty($like)) ? ' style="display:none"' : ''; ?>
			href="#"><?php _e('Like', 'qode'); ?></a><a class="like dislike"
			<?php echo (empty($like)) ? ' style="display:none"' : ''; ?> href="#"><?php _e('Dislike', 'qode'); ?></a>

		<div class="like-count"
			<?php if (empty($likes)) echo ' style="display:none"'; ?>>
			<i class="like-img"></i><span class="count"><?php echo (int)$likes; ?></span>
		</div>
	</div>
	<div class="single_topic_replies_container">
		<div class="single_topic_replies">
                        <?php
			$replies = get_posts ( $default = array (
					'post_type' => bbp_get_reply_post_type (), // Only replies
					'post_parent' => bbp_get_topic_id (), // Of this topic
					'posts_per_page' => 5, // This many
					'orderby' => 'date', // Sorted by date
					'order' => 'DESC', // Oldest to newest
					'ignore_sticky_posts' => true 
			) ); // Stickies not supported
			
			$i = count ( $replies );
			if ($i == 5) {
				$count = new WP_Query ( $default = array (
						'numberposts' => - 1,
						'post_type' => bbp_get_reply_post_type (), // Only replies
						'post_parent' => bbp_get_topic_id (), // Of this topic
						'posts_per_page' => 5, // This many
						'orderby' => 'date', // Sorted by date
						'order' => 'DESC', // Oldest to newest
						'ignore_sticky_posts' => true 
				) ); // Stickies not supported
				
				$count = $count->found_posts - 4;
				?><a href="#" class="load_all_replies"><i class="comments_img"></i>Про�?мотреть
                            еще <?php echo $count . ' ' . custom_plural_form($count, 'комментарий', 'комментари�?', 'комментариев'); ?>
                            </a>
                        <?php
			}
			$replies = array_reverse ( $replies );
			array_shift ( $replies );
			foreach ( $replies as $reply ) {
				
				?>
				<div class="single_topic_reply <?php $postUser = new WP_User($reply->post_author);echo ($postUser->has_cap('bbp_keymaster') || $postUser->has_cap('bbp_moderator')) ? "isAdmin" : "";?>"
				data-id="<?php echo $reply->ID; ?>">
				<div class="photo">
					<a
						href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => $reply->post_author, 'height' => 32, 'width' => 32)); ?></a>
				</div>
				<div class="content_wrapper">
					<div class="reply_content">
						<a class="author-link"
							href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bbp_get_reply_author_display_name($reply->ID); ?></a>
                            
                        <?php 
                            if ($postUser->has_cap('bbp_keymaster'))  echo "<small>(Администратор форума)</small>"; 
                            elseif ($postUser->has_cap('bbp_moderator'))  echo "<small>(Преподаватель)</small>" ;
                        ?>
							<?php echo bbp_get_reply_content($reply->ID); ?>
                    </div>
					<div style="display: none" class="reply_content_edit">
						<textarea class="reply_content_edit_textarea"><?php echo get_post_field('post_content', $reply->ID); ?></textarea>
						<a href="#" class="smiles_open"></a>

						<div class="edit_actions">
							<a class="cancel" href="#">Отменить</a>
						</div>
					</div>
                                    <?php $likes = get_post_meta($reply->ID, 'likes', true); ?>
                                    <div class="actions">
						<span class="date"><?php echo get_post_time('j F ', false, $reply->ID, true) . __('at', 'qode') . get_post_time(' H:i', false, $reply->ID, true); ?></span><?php $like = get_post_meta($reply->ID, 'like_' . get_current_user_id(), true); ?>
                                        <a class="like"
							<?php echo (!empty($like)) ? ' style="display:none"' : ''; ?>
							href="#"><?php _e('Like', 'qode'); ?></a><a class="like dislike"
							<?php echo (empty($like)) ? ' style="display:none"' : ''; ?>
							href="#"><?php _e('Dislike', 'qode'); ?></a>

						<div class="like-count"
							<?php if (empty($likes)) echo ' style="display:none"'; ?>>
							<i class="like-img"></i><span class="count"><?php echo (int)$likes; ?></span>
						</div>
					</div>
				</div>
                                <?php if ($reply->post_author == get_current_user_id()): ?>
                                    <a class="addi_actions_open"
					href="#"></a>
				<div class="addi_actions" style="display: none">
					<ul>
						<li><a class="edit_action" href="#">Редактировать</a></li>
						<li><a class="remove_action" href="#">Удалить</a></li>
					</ul>
				</div>
                                <?php endif; ?>
                            </div>
                        <?php
			}
			$url = (isset ( $_SERVER ['HTTPS'] ) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			?>
                    </div>
		<div class="single_topic_reply_form">
			<form
				action="<?php echo $url; ?>#topic-<?php echo bbp_get_topic_id(); ?>"
				data-bbp_forum_id="<?php echo $forum_id;?>"
				data-bbp_topic_id="<?php echo bbp_get_topic_id(); ?>" method="post">
				<div class="photo">
					<a
						href="<?php echo bp_core_get_user_domain(get_current_user_id()); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => get_current_user_id(), 'height' => 32, 'width' => 32)); ?></a>
				</div>
				<div class="reply-form">
					<textarea
						placeholder="<?php _e('Введите текст сообщения...', 'qode'); ?>"
						name="content"></textarea>
					<a href="#" class="smiles_open"></a>
				</div>

				<input type="hidden" name="bbp_forum_id"
					value="<?php echo $forum_id; ?>"> <input type="hidden"
					name="bbp_topic_id" value="<?php echo bbp_get_topic_id(); ?>"> <input
					type="hidden" name="action" value="custom-bbp-reply-create"> <input
					type="hidden" name="security"
					value="<?php echo wp_create_nonce('custom-bbp-reply-create'); ?>">
			</form>
		</div>
	</div>
</div>
<?php
		endwhile
		;
		if ($counter == 11) {
			?><a class="load_more_topics" href="#"><?php _e('Load more discussions', 'qode'); ?></a>
<?php
		}
	}
	
	$content = ob_get_contents ();
	ob_end_clean ();
	
	die ( json_encode ( array (
			'result' => 'OK',
			'content' => $content 
	) ) );
}

add_action ( 'wp_ajax_load-more-topics', 'load_more_topics' );
function choose_the_course() {
	return __ ( 'Choose the course:', 'qode' );
}

add_shortcode ( 'choose-the-course', 'choose_the_course' );

load_child_theme_textdomain ( 'qode', get_stylesheet_directory () . '/languages' );
function mythemename_wrap_embeds($html, $url, $attr, $post_id) {
	return '<div class="videotuube">' . $html . '</div>';
}

add_filter ( 'embed_oembed_html', 'mythemename_wrap_embeds', 10, 4 );

add_action ( 'wp_ajax_update_image_only_del', 'update_image_only_del' );
function update_image_only_del() {
	$post_id = $_POST ['post_id'];
	$author = get_post ( $post_id );
	$author = $author->post_author;
	if ($author == get_current_user_id ()) {
		wp_delete_attachment ( $post_id, true );
		wp_delete_post ( $post_id, true );
	}
}

add_action ( 'wp_ajax_upload-forum-file', 'upload_forum_file' );
function delete_attachment_cb() {
	$id = $_POST ['id'];
	$ptid = $_POST ['ptid'];
	$type = $_POST ['type'];
	
	if ($type == 'post') {
		$meta = get_post_meta ( $ptid, 'attaches', true );
		
		$new_meta = preg_replace ( "/$id/ui", '', $meta );
		$new_meta = preg_replace ( "/,,/ui", ',', $new_meta );
		$new_meta = preg_replace ( "/^,/ui", '', $new_meta );
		$new_meta = preg_replace ( "/,$/ui", '', $new_meta );
		
		update_post_meta ( $ptid, 'attaches', $new_meta );
	} else {
		$meta = get_comment_meta ( $ptid, 'attaches', true );
		
		$new_meta = preg_replace ( "/$id/ui", '', $meta );
		$new_meta = preg_replace ( "/,,/ui", ',', $new_meta );
		$new_meta = preg_replace ( "/^,/ui", '', $new_meta );
		$new_meta = preg_replace ( "/,$/ui", '', $new_meta );
		
		update_comment_meta ( $ptid, 'attaches', $new_meta );
	}
}

add_action ( 'wp_ajax_delete-attachment', 'delete_attachment_cb' );
function upload_forum_file() {
	$id = isset ( $_POST ['id'] ) ? ( int ) $_POST ['id'] : 0;
	$type = $_POST ['type'];
	$file = $_POST ['file'];
	$name = $_POST ['name'];
	
	$tmp_img = explode ( ";", $file );
	$img_header = explode ( '/', $tmp_img [0] );
	$ext = $img_header [1];
	
	if (! in_array ( $ext, array (
			'png',
			'jpg',
			'jpeg',
			'gif' 
	) )) {
		die ( json_encode ( array (
				'result' => 'ERROR' 
		) ) );
	}
	
	$imgtitle = $name;
	$imgtitle .= '.' . $ext;
	
	$uploads = wp_upload_dir ( $time = null );
	$filename = wp_unique_filename ( $uploads ['path'], $imgtitle );
	
	$image_url = $uploads ['url'] . '/' . $filename;
	
	file_put_contents ( $uploads ['path'] . '/' . $filename, file_get_contents ( 'data://' . $file ) );
	
	$wp_filetype = wp_check_filetype ( $image_url );
	$attachment = array (
			'guid' => $image_url,
			'post_mime_type' => $wp_filetype ['type'],
			'post_title' => preg_replace ( '/\.[^.]+$/', '', basename ( $image_url ) ),
			'post_content' => '',
			'post_status' => 'inherit' 
	);
	
	$attachment_id = wp_insert_attachment ( $attachment, $uploads ['path'] . '/' . $filename, ($type == 'post') ? $id : 0 );
	
	require_once (ABSPATH . 'wp-admin/includes/image.php');
	
	$attachment_data = wp_generate_attachment_metadata ( $attachment_id, $uploads ['path'] . '/' . $filename );
	
	wp_update_attachment_metadata ( $attachment_id, $attachment_data );
	
	$content = '';
	
	if ($type == 'post') {
		if ($id != 0) {
			$meta = get_post_meta ( $id, 'attaches', true );
			
			update_post_meta ( $id, 'attaches', (empty ( $meta )) ? $attachment_id : $meta . ',' . $attachment_id );
		}
		
		$r = wp_get_attachment_image_src ( $attachment_id, 'full' );
		
		$content = '<div class="single_topic_single_attachment">
                <div class="attachment-image"><a target="_blank" href="' . $r [0] . '">' . wp_get_attachment_image ( $attachment_id, array (
				'32',
				'32' 
		) ) . '</a></div><div class="attachment-controls"><a class="delete-attachment" data-id="' . $attachment_id . '" href="#">Удалить</a></div>
            </div>';
	} else {
		if ($id != 0) {
			$meta = get_comment_meta ( $id, 'attaches', true );
			
			update_comment_meta ( $id, 'attaches', (empty ( $meta )) ? $attachment_id : $meta . ',' . $attachment_id );
		}
		
		$r = wp_get_attachment_image_src ( $attachment_id, 'full' );
		
		$content = '<div class="single_reply_single_attachment">
                <div class="attachment-image"><a target="_blank" href="' . $r [0] . '">' . wp_get_attachment_image ( $attachment_id, array (
				'32',
				'32' 
		) ) . '</a></div><div class="attachment-controls"><a class="delete-attachment" data-id="' . $attachment_id . '" href="#">Удалить</a></div>
            </div>';
	}
	
	die ( json_encode ( array (
			'result' => 'OK',
			'id' => $attachment_id,
			'content' => $content 
	) ) );
}
function addMailChimpSegment($student_id, $course_id, $status) {
	$addSegment_url = "https://us8.api.mailchimp.com/2.0/lists/segment-add";
	$optAddSegment = new stdClass ();
	$optAddSegment->type = "saved";
	$optAddSegment->name = "example name";
	$optAddSegment->segment_opts = new stdClass ();
	$optAddSegment->segment_opts->match = "any";
	$optAddSegment->segment_opts->conditions = array (
			'field' => 'Courses',
			'op' => 'contain',
			'value' => 'a' 
	);
	
	$paramAddSegment = array (
			'apikey' => 'b2c547489ec1fe7855e24ac585a1cbcd-us8',
			'id' => '95d772f07d',
			"opts" => $optAddSegment 
	);
	
	$curlAddSegment = curl_init ( $addSegment_url );
	curl_setopt ( $curlAddSegment, CURLOPT_HTTPHEADER, array (
			'Content-Type: application/json' 
	) );
	curl_setopt ( $curlAddSegment, CURLOPT_POST, true );
	curl_setopt ( $curlAddSegment, CURLOPT_POSTFIELDS, json_encode ( $paramAddSegment ) );
	curl_setopt ( $curlAddSegment, CURLOPT_RETURNTRANSFER, 1 );
	curl_exec ( $curlAddSegment );
}

add_action ( 'namaste_enrolled_course', 'addMailChimpSegment' );
function rightToLogFileDavgur($logText) {
	$msg = $logText;
	$path = dirname(__FILE__) . '/log/DavgurLog.txt';
	$f = fopen ( $path, "a+" );
	fwrite ( $f, $msg );
	fclose ( $f );
}
function isUserCanEnrollToCourse() {
	global $wpdb, $post, $user_ID;
	$course_access = get_post_meta ( $post->ID, 'namaste_access', true );
	
	$filter_sql = '';
	$filter_sql = apply_filters ( 'namaste-course-select-sql', $filter_sql, $user_ID );
	
	// select all courses join to student courses so we can have status.
	$my_courses = $wpdb->get_results ( $wpdb->prepare ( "SELECT tSC.*, 
        tC.post_title as post_title, tC.ID as post_id, tC.post_excerpt as post_excerpt
         FROM {$wpdb->posts} tC LEFT JOIN " . NAMASTE_STUDENT_COURSES . " tSC ON tC.ID = tSC.course_id
         AND tSC.user_id = %d WHERE tC.post_status = 'publish'
         AND tC.post_type='namaste_course' $filter_sql ORDER BY tC.post_title", $user_ID ) );
	
	$course_access_counter = count ( $course_access );
	if (! is_array ( $course_access ) || $course_access_counter == 0)
		return true;
	foreach ( $course_access as $CAccessID ) {
		foreach ( $my_courses as $oMyCourse ) {
			if ($CAccessID == $oMyCourse->course_id && $oMyCourse->status == 'completed')
				$course_access_counter --;
		}
	}
	return $course_access_counter == 0;
}

// LOGOUT LINK IN MENU
function academy_menu_logout_link($nav, $args) {
	$logoutlink = '<li class="loginBtn"><a href="' . wp_logout_url ( home_url () ) . '"><span>' . __ ( 'Logout', 'qode' ) . '</span></a></li>';
	if ($args->menu == 'Header right menu (Signed)') {
		return $nav . $logoutlink;
	} else {
		return $nav;
	}
}

add_filter ( 'wp_nav_menu_items', 'academy_menu_logout_link', 10, 2 );

// Filter wp_nav_menu() to add profile link
add_filter( 'wp_nav_menu_items', 'my_nav_menu_profile_link' );
function my_nav_menu_profile_link($menu) {
	if (!is_user_logged_in())
		return $menu;
	else
		$profilelink = '<li class="loginBtn"><a href="' . bp_loggedin_user_domain( '/' ) . '"><span>' . wp_get_current_user()->display_name . '</span></a></li>';
	$menu = $menu . $profilelink;
	return $menu;
}


add_filter ( 'wpmu_welcome_user_notification', '__return_false' ); // Disable welcome email

add_filter ( 'network_site_url', function ($url, $path, $scheme) {
	
	if ($path === 'wp-login.php?action=lostpassword' || 'wp-login.php?action=resetpass') {
		$url = site_url ( $path, $scheme );
	}
	
	return $url;
}, 999, 3 );

add_filter ( 'lostpassword_url', function ($lostpassword_url, $redirect) {
	return home_url ( '/lostpassword/?redirect_to=' . $redirect );
}, 999, 2 );

add_filter ( 'lostpassword_redirect', function ($lostpassword_redirect) {
	return home_url ();
}, 999, 1 );

add_filter ( 'login_redirect', create_function ( '$url,$query,$user', 'return home_url();' ), 999, 3 );

/*
 * AJAX Function for adding the points for the new extra events.
 * Author: al@shtrak.eu
 */
add_action ( "wp_ajax_update_points_system", "update_points_system" );
function update_points_system() {
	global $wpdb;
	
	$points_type = $_POST ['pointsType'];
	$user_id = $_POST ['userId'];
	$course_id = $_POST ['courseId'];
	$action_points = 0;
	$text = '';
	$points_type_array = array('webinar','webinarTT', 'webinarSF', 'webinarPH','webinarMS' ,'webinarVS','forum','workshop','archive');
	
	// Check if user is enrolled
	$enrolled = $wpdb->get_var ( $wpdb->prepare ( "SELECT id FROM {$wpdb->prefix}namaste_student_courses WHERE user_id = %d AND course_id = %d AND (status = 'enrolled' OR status = 'completed')", $user_id, $course_id ) );
	if (! $enrolled) {
		_e ( "You must enroll in the course first before you can see the lessons", 'namaste' );
		die ();
	}
	
	// check if correct points type
	if (!in_array($points_type, $points_type_array)) {
		echo 'not correct point type';
		die ();
	}
	
	// check if ids are numbers, not a hack
	if (! is_numeric ( $user_id ) || ! is_numeric ( $course_id )) {
		echo 'Not numbers';
		die ();
	}
	
	// get course title
	$title = get_the_title ( $course_id );
	
	// current date
	$today = date_i18n ( 'j F Y', time () );
	$date = date ( 'Y-m-d' );
	$datetime = date ( "Y-m-d h:i:s" );
	
	// get the points for the action
	if ($points_type == 'webinar' || $points_type == 'webinarTT' || $points_type == 'webinarSF' || $points_type == 'webinarPH' || $points_type == 'webinarMS' || $points_type == 'webinarVS') {
		
		$action_points = get_post_meta ( $course_id, 'namaste_points_webinar', true );
		if ($action_points === '') {
			$action_points = get_option ( 'namaste_points_webinar' );
		}
		
		$text = sprintf ( __ ( 'Received %d points for taking part in the webinar for course "%s" on %s', 'qode' ), $action_points, $title, $today );
	} elseif ($points_type == 'workshop') {
		
		$action_points = get_post_meta ( $course_id, 'namaste_points_workshop', true );
		if ($action_points === '') {
			$action_points = get_option ( 'namaste_points_workshop' );
		}
		
		$text = sprintf ( __ ( 'Received %d points for taking part in the workshop for course "%s"  on %s', 'qode' ), $action_points, $title, $today );
	} elseif ($points_type == 'forum') {
		
		$action_points = get_post_meta ( $course_id, 'namaste_points_forum', true );
		if ($action_points === '') {
			$action_points = get_option ( 'namaste_points_forum' );
		}
		
		$text = sprintf ( __ ( 'Received %d points for taking part in the forum for course "%s" on %s', 'qode' ), $action_points, $title, $today );
	} elseif ($points_type == 'archive') {
		
		$action_points = get_post_meta ( $course_id, 'namaste_points_archive', true );
		if ($action_points === '') {
			$action_points = get_option ( 'namaste_points_archive' );
		}
		
		$text = sprintf ( __ ( 'Received %d points for wandering around the archive for course "%s" on %s', 'qode' ), $action_points, $title, $today );
	}
	
	// check if hasn't got already the points
	if ($points_type == 'archive' || $points_type == 'forum') {
		// compare only by user id, points type and course id
		$duplicates = $wpdb->get_results ( "SELECT value FROM {$wpdb->prefix}namaste_history WHERE user_id = $user_id  AND for_item_type = '" . $points_type . "' AND for_item_id = $course_id" );
	} else {
		// compare only by user id, points type, course id
		$duplicates = $wpdb->get_results ( "SELECT value FROM {$wpdb->prefix}namaste_history WHERE user_id = $user_id  AND for_item_type = '" . $points_type . "' AND for_item_id = $course_id AND date ='" . $date . "'" );
	}
	
	// if there is a field with the same description - die()
	if (is_array ( $duplicates ) && is_object ( $duplicates [0] ) && $duplicates [0]->value == $text) {
		echo true;
		die ();
	}
	
	// update database
	$sql = "INSERT INTO {$wpdb->prefix}namaste_history (user_id,num_value,action, for_item_type,value,date,datetime,for_item_id) VALUES (%d,%d,%s,%s,%s,%s,%s,%d)";
	$sql = $wpdb->prepare ( $sql, $user_id, $action_points, 'awarded_points', $points_type, $text, $date, $datetime, $course_id );
	$result = $wpdb->query ( $sql );
	
	// if problems with the db
	if ($result === false) {
		var_dump ( $result );
		die ();
	}
	
	do_action ( 'namaste_earned_points', $user_id, $action_points );
	// update total the points
	$current_total_points = get_user_meta ( $user_id, 'namaste_points', true );
	if ($current_total_points == "") {
		add_user_meta ( $user_id, 'namaste_points', $action_points );
	} else {
		$total_points = $current_total_points + $action_points;
		update_user_meta ( $user_id, 'namaste_points', $total_points );
	}
	
	// just die
	echo true;
	die ();
}

/* Add some more fields in the namaste options page for additional points */
add_action ( 'namster_after_default_points_fields', 'namaste_additional_points_fields_option_page' );
function namaste_additional_points_fields_option_page() {
	?>
<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="points_register" size="4"
		value="<?php echo get_option('namaste_points_register')?>"> <?php _e('points for registring in the site.', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="points_start_course" size="4"
		value="<?php echo get_option('namaste_points_start_course')?>"> <?php _e('points for course enrolment', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="points_webinar" size="4"
		value="<?php echo get_option('namaste_points_webinar')?>"> <?php _e('points for watching the webinar', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="points_workshop" size="4"
		value="<?php echo get_option('namaste_points_workshop')?>"> <?php _e('points for participation in the workshop', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="points_course_forum" size="4"
		value="<?php echo get_option('namaste_points_forum')?>"> <?php _e('points for participation in the forum course', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="points_archive" size="4"
		value="<?php echo get_option('namaste_points_archive')?>"> <?php _e('points for use the archive ', 'namaste')?></p>
<?php
}

/* Updating the additional options fields */
add_action ( 'namaste_default_points_update', 'namaste_update_default_points' );
function namaste_update_default_points() {
	update_option ( 'namaste_points_register', $_POST ['points_register'] );
	update_option ( 'namaste_points_start_course', $_POST ['points_start_course'] );
	update_option ( 'namaste_points_webinar', $_POST ['points_webinar'] );
	update_option ( 'namaste_points_workshop', $_POST ['points_workshop'] );
	update_option ( 'namaste_points_forum', $_POST ['points_course_forum'] );
	update_option ( 'namaste_points_archive', $_POST ['points_archive'] );
}

/* Adding additional point fields for the single page */
add_action ( 'namaste_after_single_course_points_fields', 'namaste_additional_points_single_course' );
function namaste_additional_points_single_course($post) {
	// get award points for enrollment
	$award_points_enroll = get_post_meta ( $post->ID, 'namaste_points_start_course', true );
	if ($award_points_enroll === '')
		$award_points_enroll = get_option ( 'namaste_points_start_course' );
		
		// get award points for particpation in the webinar
	$award_points_webinar = get_post_meta ( $post->ID, 'namaste_points_webinar', true );
	if ($award_points_webinar === '')
		$award_points_webinar = get_option ( 'namaste_points_webinar' );
		
		// get award points for particpation in the workshop
	$award_points_workshop = get_post_meta ( $post->ID, 'namaste_points_workshop', true );
	if ($award_points_workshop === '')
		$award_points_workshop = get_option ( 'namaste_points_workshop' );
		
		// get award points for particpation in the workshop
	$award_points_forum = get_post_meta ( $post->ID, 'namaste_points_forum', true );
	if ($award_points_forum === '')
		$award_points_forum = get_option ( 'namaste_points_forum' );
		
		// get award points for particpation in the workshop
	$award_points_archive = get_post_meta ( $post->ID, 'namaste_points_archive', true );
	if ($award_points_archive === '')
		$award_points_archive = get_option ( 'namaste_points_archive' );
	?>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="namaste_points_start_course" size="4"
		value="<?php echo $award_points_enroll?>"> <?php _e('points for enrolling in the course ', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="namaste_points_webinar" size="4"
		value="<?php echo $award_points_webinar?>"> <?php _e('points for watching the webinar', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="namaste_points_workshop" size="4"
		value="<?php echo $award_points_workshop?>"> <?php _e('points for participation in the workshop', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="namaste_points_forum" size="4"
		value="<?php echo $award_points_forum ?>"> <?php _e('points for participation in the forum course', 'namaste')?></p>

<p><?php _e('Reward', 'namaste')?> <input type="text"
		name="namaste_points_archive" size="4"
		value="<?php echo $award_points_archive?>"> <?php _e('points for use the archive ', 'namaste')?></p>

<?php
}

/* Update the additional points on single course page */
add_action ( 'namaste_single_course_points_update', 'namaste_update_single_course_points' );
function namaste_update_single_course_points($post_id) {
	if (isset ( $_POST ['namaste_points_start_course'] ))
		update_post_meta ( $post_id, "namaste_points_start_course", $_POST ['namaste_points_start_course'] );
	if (isset ( $_POST ['namaste_points_webinar'] ))
		update_post_meta ( $post_id, "namaste_points_webinar", $_POST ['namaste_points_webinar'] );
	if (isset ( $_POST ['namaste_points_workshop'] ))
		update_post_meta ( $post_id, "namaste_points_workshop", $_POST ['namaste_points_workshop'] );
	if (isset ( $_POST ['namaste_points_forum'] ))
		update_post_meta ( $post_id, "namaste_points_forum", $_POST ['namaste_points_forum'] );
	if (isset ( $_POST ['namaste_points_archive'] ))
		update_post_meta ( $post_id, "namaste_points_archive", $_POST ['namaste_points_archive'] );
}

/* Hook to the enrollement process to add more points on sign */
function namaste_enrolled_course_add_points($student_id, $course_id, $status) {
	global $wpdb;
	
	$points_type = 'enrollment';
	$user_id = $student_id;
	$action_points = 0;
	$text = '';
	$title = get_the_title ( $course_id );
	
	// current date
	$today = date_i18n ( 'j F Y', time () );
	$date = date ( 'Y-m-d' );
	$datetime = date ( "Y-m-d h:i:s" );
	
	$action_points = get_post_meta ( $course_id, 'namaste_points_start_course', true );
	if ($action_points === '') {
		$action_points = get_option ( 'namaste_points_start_course' );
	}
	
	$text = sprintf ( __ ( 'Received %d points for enrollin in course "%s" on %s', 'qode' ), $action_points, $title, $today );
	
	// update database
	$sql = "INSERT INTO {$wpdb->prefix}namaste_history (user_id,num_value,action, for_item_type,value,date,datetime,for_item_id) VALUES (%d,%d,%s,%s,%s,%s,%s,%d)";
	$sql = $wpdb->prepare ( $sql, $user_id, $action_points, 'awarded_points', $points_type, $text, $date, $datetime, $course_id );
	$result = $wpdb->query ( $sql );
	
	// if problems with the db
	if ($result === false) {
		return false;
	}
	
	do_action ( 'namaste_earned_points', $user_id, $action_points );
	// update total the points
	$current_total_points = get_user_meta ( $user_id, 'namaste_points', true );
	if ($current_total_points == "") {
		add_user_meta ( $user_id, 'namaste_points', $action_points );
	} else {
		$total_points = $current_total_points + $action_points;
		update_user_meta ( $user_id, 'namaste_points', $total_points );
	}
}

add_action ( 'namaste_enrolled_course', 'namaste_enrolled_course_add_points', 10, 3 );

/* Hooking after user registration to add the initial points */
add_action ( 'user_register', 'add_points_on_registration', 10, 1 );
function add_points_on_registration($user_id) {
	global $wpdb;
	$action_points = get_option ( 'namaste_points_register' );
	$today = date_i18n ( 'j F Y', time () );
	$date = date ( 'Y-m-d' );
	$datetime = date ( "Y-m-d h:i:s" );
	$points_type = "registration";
	$text = sprintf ( __ ( 'Received %d points for registering in the system on %s', 'qode' ), $action_points, $today );
	
	$sql = "INSERT INTO {$wpdb->prefix}namaste_history (user_id,num_value,action, for_item_type,value,date,datetime,for_item_id) VALUES (%d,%d,%s,%s,%s,%s,%s,%d)";
	$sql = $wpdb->prepare ( $sql, $user_id, $action_points, 'awarded_points', $points_type, $text, $date, $datetime, $course_id );
	$result = $wpdb->query ( $sql );
	do_action ( 'namaste_earned_points', $user_id, $action_points );
	if ($result) {
		update_user_meta ( $user_id, 'namaste_points', $action_points );
	}
}
function registrationForm_iframe() {
	global $post, $wpdb;
	if ($_POST ['action'] == "loginRregistrationFormShortcode") {
		$_POST ['userData'] ['courseId'] = $_REQUEST ['courseId'];
		do_action ( 'wp_ajax_nopriv_registerRregistrationFormShortcode' );
		// $tesa = new RregistrationFormShortcodeClass();
		// $return = RregistrationFormShortcodeClass::login();
	}
	if ($_POST ['action'] == "registerRregistrationFormShortcode") {
		$_POST ['userData'] ['courseId'] = $_REQUEST ['courseId'];
		RregistrationFormShortcodeClass::register ();
	}
}
/* 
class BB_Su_Shortcodes extends Su_Shortcodes{
	function  __construct(){
		add_action( 'init', array( __CLASS__, 'register' ) );
	}
	
	public static function register(){
		// Prepare compatibility mode prefix
		$prefix = su_cmpt();
		$func = array( 'BB_Su_Shortcodes', 'bb_youtube_advanced' );
		add_shortcode( $prefix . 'bb_youtube_advanced',  $func);
	}
	
	public static function bb_youtube_advanced( $atts = null, $content = null ) {
		// Prepare data
		$return = array();
		$params = array();
		$atts = shortcode_atts( array(
				'url'            => false,
				'width'          => 600,
				'height'         => 400,
				'responsive'     => 'yes',
				'autohide'       => 'alt',
				'autoplay'       => 'no',
				'controls'       => 'yes',
				'fs'             => 'yes',
				'loop'           => 'no',
				'modestbranding' => 'no',
				'playlist'       => '',
				'rel'            => 'yes',
				'showinfo'       => 'yes',
				'theme'          => 'dark',
				'https'          => 'no',
				'wmode'          => '',
				'class'          => '',
		), $atts, 'youtube_advanced' );
		if ( !$atts['url'] ) return Su_Tools::error( __FUNCTION__, __( 'please specify correct url', 'su' ) );
		$atts['url'] = su_scattr( $atts['url'] );
		$id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $atts['url'], $match ) ) ? $match[1] : false;
		// Check that url is specified
		if ( !$id ) return Su_Tools::error( __FUNCTION__, __( 'please specify correct url', 'su' ) );
		// Prepare params
		foreach ( array( 'autohide', 'autoplay', 'controls', 'fs', 'loop', 'modestbranding', 'playlist', 'rel', 'showinfo', 'theme', 'wmode' ) as $param ) $params[$param] = str_replace( array( 'no', 'yes', 'alt' ), array( '0', '1', '2' ), $atts[$param] );
		// Correct loop
		if ( $params['loop'] === '1' && $params['playlist'] === '' ) $params['playlist'] = $id;
		// Prepare protocol
		$protocol = ( $atts['https'] === 'yes' ) ? 'https' : 'http';
		// Prepare player parameters
		$params = http_build_query( $params );
		// Create player
		$return[] = '<div class="su-youtube su-responsive-media-' . $atts['responsive'] . su_ecssc( $atts ) . '">';
		$return[] = '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="' . $protocol . '://www.youtube.com/embed/' . $id . '?' . $params . '&version=3&enablejsapi=1" frameborder="0" allowfullscreen="true"></iframe>';
		$return[] = '</div>';
		su_query_asset( 'css', 'su-media-shortcodes' );
		// Return result
		return implode( '', $return );
	}
} 
new BB_Su_Shortcodes; 


class TestDavgur{
	function  __construct(){
		add_action ( 'wp_ajax_nopriv_registerRregistrationFormShortcode', array(__CLASS__, 'test') );
	}
	public static  function test($a){
		$b = $a;
	}
}*/