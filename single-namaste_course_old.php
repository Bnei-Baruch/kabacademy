<?php

if(get_post_meta(get_the_ID(), "qode_show-sidebar", true) != ""){
    $sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
}else{
    $sidebar = $qode_options_satellite['blog_single_sidebar'];
}

$blog_hide_comments = "";
if (isset($qode_options_satellite['blog_hide_comments']))
    $blog_hide_comments = $qode_options_satellite['blog_hide_comments'];

if(get_post_meta(get_the_ID(), "qode_responsive-title-image", true) != ""){
    $responsive_title_image = get_post_meta(get_the_ID(), "qode_responsive-title-image", true);
}else{
    $responsive_title_image = $qode_options_satellite['responsive_title_image'];
}

if(get_post_meta(get_the_ID(), "qode_fixed-title-image", true) != ""){
    $fixed_title_image = get_post_meta(get_the_ID(), "qode_fixed-title-image", true);
}else{
    $fixed_title_image = $qode_options_satellite['fixed_title_image'];
}

if(get_post_meta(get_the_ID(), "qode_title-image", true) != ""){
    $title_image = get_post_meta(get_the_ID(), "qode_title-image", true);
}else{
    $title_image = $qode_options_satellite['title_image'];
}

if(get_post_meta(get_the_ID(), "qode_title-height", true) != ""){
    $title_height = get_post_meta(get_the_ID(), "qode_title-height", true);
}else{
    $title_height = $qode_options_satellite['title_height'];
}

$title_background_color = '';
if(get_post_meta(get_the_ID(), "qode_page-title-background-color", true) != ""){
    $title_background_color = get_post_meta(get_the_ID(), "qode_page-title-background-color", true);
}else{
    $title_background_color = $qode_options_satellite['title_background_color'];
}

$show_title_image = true;
if(get_post_meta(get_the_ID(), "qode_show-page-title-image", true)) {
    $show_title_image = false;
}

if(isset($qode_options_satellite['twitter_via']) && !empty($qode_options_satellite['twitter_via'])) {
    $twitter_via = " via " . $qode_options_satellite['twitter_via'];
} else {
    $twitter_via = 	"";
}

?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<?php if($qode_options_satellite['show_back_button'] == "yes") { ?>
    <a id='back_to_top' href='#'>
        <span class="icon_holder small_icon nohover"><span class="icon_inner"><span class="icon white arrow_up_in_circle">&nbsp;</span></span></span>
        <span class="icon_holder small_icon hover"><span class="icon_inner"><span class="icon white arrow_up_in_circle_fill">&nbsp;</span></span></span>
    </a>
<?php } ?>

<?php
$revslider = get_post_meta($id, "qode_revolution-slider", true);
if (!empty($revslider)){ ?>
    <div class="slider"><div class="slider_inner">
            <?php echo do_shortcode($revslider); ?>
        </div></div>
<?php
}
        $subtitle = get_post_meta($post->ID, 'list_subtitle', true);
?>
        <?php


        $category = get_the_category( $post->ID );
        $category = !empty($category) ? $category[0] : '';
        $category_class = !empty($category) ? ' '.$category->category_nicename : '';
        $category = !empty($category) ? '<div class="course_single_course_cat">'.mb_strtoupper($category->cat_name).'</div>' : '';

        $tab = '';
        ?>
<div class="container">
    <div class="container_inner pt0">

        <?php get_template_part( 'course-header' ); ?>

        <div class="blog_holder v2 blog_single single-namaste_course<?php echo $category_class; ?>">

            <article class="standard">
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php
            if(is_user_logged_in() && $tab == 'nolessons'):
                ?>
                    <div class="">
                        <?php $course_id = $post->ID; ?>
                        <h2 class="u3h2"><a href="<?php echo get_permalink($course_id); ?>" title="<?php echo get_the_title($course_id); ?>"><?php echo get_the_title($course_id); ?></a></h2>
                    </div>

                    <div class="nolessons-container">

                        <div class="nolessons-row">
                            <div class="nolessons-cell nolessons-text-cell">
                                <div class="text-align-left">
                                    <span class="nolessons-highlighted"><?php _e('This course does not have selfstudy lessons for the moment.', 'qode'); ?></span>
                                </div>
                            </div>
                            <div class="nolessons-cell nolessons-image-cell">
                                <img src="/wp-content/uploads/2014/12/clock-new-24-blog.png" />
                            </div>
                        </div>

                    </div>
                <?php elseif(is_user_logged_in() && $tab == 'lection'): ?>
                    <table class="clearfix lection-heading">
                        <tr>
                            <?php $course_id = $post->ID; ?>
                            <td>
                                <h2 class="u3h2"><a href="<?php echo get_permalink($course_id); ?>" title="<?php echo get_the_title($course_id); ?>"><?php echo get_the_title($course_id); ?></a></h2>
                                <h2 class="u3h2">&nbsp;>&nbsp;</h2>
                                <h2 class="u3h2"><a id="lveventTitl" href="<?php echo get_permalink(); ?>" title=""></a></h2>
                            </td>

                            <?php
                            $width = '18%';
                if( current_user_can('editor') || current_user_can('administrator') ) {
                    $width = '30%';
                }
                            ?>
                            <td style="width:<?php echo $width; ?>">
                                <div class="gototraining">
                                    <img width="45" height="43" src="http://ru.edu.kbb1.com/wp-content/uploads/sites/2/2015/02/icongooglehangout2.png" />
                                    <a target="_blank" href="https://rt.kbb1.com/#/find-table/mak-autumn/ru"><?php _e('Go to training', 'qode'); ?> <span>Â»</span></a>
                                    <?php if( current_user_can('editor') || current_user_can('administrator') ) : ?>
                                    <a target="_blank" href="https://rt.kbb1.com/backend/spaces/mak-autumn/tables/ru/moderated"><?php _e('Manage training', 'qode'); ?> <span>Â»</span></a>
									<a target="_blank" href="https://chat1.kbb1.com/admin.html?label=rt.kbb1.com.mak-autumn"><?php _e('Manage chat', 'qode'); ?> <span>Â»</span></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="two_columns_60_40 lection-tab clearfix">
					    <div class="column1">
					    <!-- <iframe src="https://rt.kbb1.com/http-viewer-iframe.html#mak-autumn" class="videoIframe"  scrolling="no" frameborder="0"> </iframe> -->
						
                            <div class="lection-video-container">
                                <table cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td style="vertical-align: top; padding: 0px;">
                                            <div id="lveventplayer">
                                                <div id="kabacademycom-frme-cnt" style="color: #ffffff; text-align: center; width: 667px; height: 380px; background-color: #000000;">
                                                    <h1></h1>
                                                    <h1></h1>
                                                    <h4><span style="font-size: 1em; line-height: 24px;"><?php _e('Ð—Ð´ÐµÑ�ÑŒ Ð±ÑƒÐ´ÐµÑ‚ Ð¿Ð»ÐµÐµÑ€ Ñ� Ñ‚Ñ€Ð°Ð½Ñ�Ð»Ñ�Ñ†Ð¸ÐµÐ¹', 'qode'); ?></span></h4>
                                                    <strong><?php _e('Ð•Ñ�Ð»Ð¸ Ð¿Ð»ÐµÐµÑ€ Ð½Ðµ Ð¿Ð¾Ñ�Ð²Ð¸Ð»Ñ�Ñ� Ð² Ð½Ð°Ð·Ð½Ð°Ñ‡ÐµÐ½Ð½Ð¾Ðµ Ð²Ñ€ÐµÐ¼Ñ�, Ð¾Ð±Ð½Ð¾Ð²Ð¸Ñ‚Ðµ Ñ�Ñ‚Ñ€Ð°Ð½Ð¸Ñ†Ñƒ!', 'qode'); ?></strong> </br> </br><strong><?php _e('Ð•Ñ�Ð»Ð¸ Ñ‡ÐµÑ€ÐµÐ· 5 Ð¼Ð¸Ð½ Ð¿Ð¾Ñ�Ð»Ðµ Ð½Ð°Ð·Ð½Ð°Ñ‡ÐµÐ½Ð½Ð¾Ð³Ð¾ Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¸ Ñ‚Ñ€Ð°Ð½Ñ�Ð»Ñ�Ñ†Ð¸Ñ� Ð½Ðµ Ð½Ð°Ñ‡Ð°Ð»Ð°Ñ�ÑŒ, Ð¾Ð±Ð½Ð¾Ð²Ð¸Ñ‚Ðµ Ñ�Ñ‚Ñ€Ð°Ð½Ð¸Ñ†Ñƒ!', 'qode'); ?></strong>

                                                </div>
                                            </div></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <script type="text/javascript">// <![CDATA[
                                        function showPending(data) {var lvevnt=data.feed.entry;
                                            if(lvevnt) {
                                                document.getElementById('lveventTitl').innerHTML=lvevnt[lvevnt.length-1].title.$t;
                                                document.getElementById('lveventTitl').title=lvevnt[lvevnt.length-1].title.$t;
                                                document.getElementById('lveventplayer').innerHTML='<iframe id="krugitv-frme" src="http://www.youtube.com/embed/'+lvevnt[lvevnt.length-1].content.src.split('/').splice(-1,1)+'&#038;autoplay=1&#038;rel=0" frameborder="0" width="677" height="390"></iframe>';}
                                            else {
                                                document.getElementById('lveventTitl').innerHTML="<?php _e('no live events', 'qode'); ?>";
                                                document.getElementById('lveventTitl').title="<?php _e('no live events', 'qode'); ?>";
                                            }
                                        }
                                        function showActive(data) {var lvevnt=data.feed.entry;

                                            if(lvevnt) {
                                                document.getElementById('lveventTitl').innerHTML=lvevnt[lvevnt.length-1].title.$t;
                                                document.getElementById('lveventTitl').title=lvevnt[lvevnt.length-1].title.$t;
                                                document.getElementById('lveventplayer').innerHTML='<iframe id="krugitv-frme" src="http://www.youtube.com/embed/'+lvevnt[lvevnt.length-1].content.src.split('/').splice(-1,1)+'&#038;autoplay=1&#038;rel=0" frameborder="0" width="677" height="390"></iframe>';}
                                            else {var s=document.createElement("script");
                                                s.type="text/javascript";s.src='https://gdata.youtube.com/feeds/api/users/UC47ukJjUCMtIok1wMYo2Zhw/live/events?v=2&status=pending&fields=entry(title,content)&alt=json-in-script&callback=showPending';
                                                document.getElementsByTagName("head")[0].appendChild(s);}
                                        }
                                        // ]]></script>
                                    <script type="text/javascript" src="https://gdata.youtube.com/feeds/api/users/UC47ukJjUCMtIok1wMYo2Zhw/live/events?v=2&amp;status=active&amp;fields=entry(title,content)&amp;alt=json-in-script&amp;callback=showActive"></script>
                            </div>
                            <?php
                                $next_lection_date = get_next_lection_date($course_id);
                                if(!empty($next_lection_date)) {
                                    echo '<div class="next-lection-date">'.$next_lection_date.'</div>';
                                }
                            ?>
                        </div>
                        <div class="column2">
                            <div class="tabs sidebar-tabs-dmn">
                                <ul class="tabs-nav">
                                    <li class="active"><a href="#tabiid1"><?php _e('Discussion', 'qode'); ?></a></li>
                                    <li id="activate_bx" class=""><a href="#tabiid2"><?php _e('Materials', 'qode'); ?></a></li>
                                    <li class=""><a href="#tabiid3"><?php _e('Notes', 'qode'); ?></a></li>
                                </ul>
                                <div class="tabs-container">
                                    <div id="tabiid1" class="tab-content" style="display: block;">
                                        <iframe src="https://chat1.kbb1.com/?label=rt.kbb1.com.mak-autumn&lang=ru&from_name=name_text"></iframe>
                                    </div>
                                    <div id="tabiid2" class="tab-content" style="display: none;">
                                        <div class="bx-controls-direction"><a id="bx-prev" href=""></a><a id="bx-next" href=""></a></div>
                                        <ul id="tabiid2slide">
                                            <?php echo do_shortcode(get_post_meta($course_id, 'materials', true)); ?>
                                        </ul>
                                        <script>
                                            (function($){
                                                $(document).on('click', '#activate_bx', second_passed);
                                                function second_passed() {
                                                    if($('#tabiid2slide').hasClass('activatedbx')) {
                                                        return false;
                                                    }
                                                    setTimeout(function(){
                                                        var slider = $('#tabiid2slide').bxSlider({
                                                            infiniteLoop: true,
                                                            hideControlOnEnd: false,
                                                            nextSelector: '#bx-next',
                                                            prevSelector: '#bx-prev',
                                                            nextText: '',
                                                            prevText: ''
                                                        });
                                                        $('#tabiid2slide').addClass("activatedbx");

                                                        $('#bx-next').click(function(){
                                                            slider.goToNextSlide();
                                                            return false;
                                                        });

                                                        $('#bx-prev').click(function(){
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
                                            $course_id = $post->ID;
                                            $notes = get_user_meta(get_current_user_id(), 'notes_'.$course_id, true); //[accordion_item caption="Accordion 1" title_color=""]This is some content[/accordion_item][accordion_item caption="Accordion 1" title_color=""]This is some content[/accordion_item]
                                            $content_notes = '';

                                            //$notes[] = array('title' => 'test', 'content' => 'Type here...', 'date' => time());

                                            foreach($notes as $key => $note) {
                                                $content_notes .= do_shortcode('[accordion_item caption="'.$note['title'].'" title_color=""]<div class="note_title_wrap"><input class="note_title" value="'.$note['title'].'" /></div><div class="note_content" contenteditable="true">'.$note['content'].'</div><div class="note_actions"><a href="#" class="remove_note pull-left"></a><div class="note_status pull-right">'.__('SAVED', 'qode').'</div><div class="note_date pull-right"><span class="date">'.date('d/m/y', $note['date']).'</span><span class="time">'.date('h:i A', $note['date']).'</span></div></div><input style="display: none" class="note_id" value="'.$key.'" />[/accordion_item]');
                                            }
                                        ?>
                                        <?php echo do_shortcode('[accordion accordion_type="accordion"]'.$content_notes.'[/accordion]'); ?>
                                        <a id="addnewnote" href="#"><?php _e('Add New Note', 'qode'); ?></a>
                                        <div id="templates" style="display:none">
                                            <?php echo do_shortcode('[accordion_item caption="'.__('New Note', 'qode').'" title_color=""]<div class="note_title_wrap"><input class="note_title" value="'.__('New Note', 'qode').'" /></div><div class="note_content" contenteditable="true" data-ph="'.__('Type text here...', 'qode').'"></div><div class="note_actions"><a href="#" class="remove_note pull-left"></a><div class="note_status pull-right">'.__('SAVING...', 'qode').'</div><div class="note_date pull-right"><span class="date"></span><span class="time"></span></div></div><input style="display: none" class="note_id" value="" />[/accordion_item]'); ?>
                                        </div>
                                        <script>
                                            jQuery(document).ready(function(){
                                                jQuery.ui.accordion.prototype._originalKeyDown = jQuery.ui.accordion.prototype._keydown;
                                                jQuery.ui.accordion.prototype._keydown = function( event ) {
                                                    var keyCode = jQuery.ui.keyCode;

                                                    if (event.keyCode == keyCode.SPACE) {
                                                        return;
                                                    }
                                                    // call the original method
                                                    this._originalKeyDown(event);
                                                };

                                                var index = 0;
                                                index = jQuery("#tabiid3 h3.ui-accordion-header").length - 1;

                                                jQuery( "#tabiid3 .accordion" ).on( "accordioncreate", function( event, ui ) {
                                                    jQuery( "#tabiid3 .accordion" ).accordion( "option", "active", index );
                                                    jQuery("#tabiid3 h3.ui-accordion-header span").remove();
                                                } );

                                                /*jQuery(document).on('dblclick', "#tabiid3 h3.ui-accordion-header", function(e){
                                                    e.preventDefault();

                                                    jQuery(this).addClass('editing').html('<input style="width:100%" value="'+jQuery(this).text()+'" />');

                                                    return false;
                                                });*/
                                                jQuery(document).on('click', '#tabiid3 .note-title-edit-icon', function(e){
                                                    e.preventDefault();
                                                    e.stopPropagation();

                                                    console.log('x');
                                                    return false;
                                                });

                                                jQuery(document).on('click', function(e){
                                                    if(jQuery("#tabiid3 h3.ui-accordion-header.editing").length == 0 || jQuery(e.target).closest('.editing').length > 0){
                                                        return;
                                                    }
                                                    var title = jQuery("#tabiid3 h3.ui-accordion-header.editing input").val();
                                                    var note_id = jQuery("#tabiid3 h3.ui-accordion-header.editing").next().find('.note_id').val();

                                                    update_note_title(note_id, title, jQuery("#tabiid3 h3.ui-accordion-header.editing").next());

                                                    jQuery("#tabiid3 h3.ui-accordion-header.editing")
                                                        .html(title)
                                                        .removeClass('editing');
                                                });

                                                jQuery(document).on('click', function(e){
                                                    if(jQuery("#tabiid3 .accordion_content .note_content.editing").length == 0 || jQuery(e.target).closest('.editing').length > 0){
                                                        return;
                                                    }
                                                    var content = jQuery("#tabiid3 .accordion_content .note_content.editing").html();
                                                    var note_id = jQuery("#tabiid3 .accordion_content .note_content.editing").closest('.accordion_content').find('.note_id').val();

                                                    update_note_content(note_id, content, jQuery("#tabiid3 .accordion_content .note_content.editing").closest('.accordion_content'));

                                                    jQuery("#tabiid3 .accordion_content .note_content.editing")
                                                        .removeClass('editing');
                                                });

                                                var title_update_timer_id = 0;

                                                jQuery(document).on('keyup', '#tabiid3 .note_title_wrap .note_title', function(e){
                                                    var title = jQuery(this).val();
                                                    var note_id = jQuery(this).closest('.accordion_content_inner').find('.note_id').val();
                                                    var elem = jQuery(this).closest('.accordion_content_inner');

                                                    elem.parent().prev().html(title);

                                                    clearTimeout(title_update_timer_id);
                                                    title_update_timer_id = setTimeout(function(){ update_note_title(note_id, title, elem) }, 500);
                                                });

                                                var content_update_timer_id = 0;


                                                jQuery(document).on('keyup', '#tabiid3 .accordion_content .note_content', function(e){
                                                    jQuery(this).addClass('editing');
                                                    var content = jQuery(this).html();
                                                    var note_id = jQuery(this).closest('.accordion_content').find('.note_id').val();
                                                    var elem = jQuery(this).closest('.accordion_content');
                                                    clearTimeout(content_update_timer_id);
                                                    content_update_timer_id = setTimeout(function(){ update_note_content(note_id, content, elem) }, 500);
                                                });

                                                function update_note_title(note_id, title, elem){
                                                    elem.find('.note_status').text('<?php _e('SAVING...', 'qode') ?>');

                                                    jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", {
                                                        'action' : 'update_note_title',
                                                        'note_id' : note_id,
                                                        'title' : title,
                                                        'course_id' : <?php echo $course_id; ?>
                                                    }, function(response) {
                                                        elem.find('.note_status').text('<?php _e('SAVED', 'qode') ?>');
                                                        elem.find('.date').text(response.date);
                                                        elem.find('.time').text(response.time);
                                                    }, 'json');
                                                }

                                                function update_note_content(note_id, content, elem){
                                                    elem.find('.note_status').text('<?php _e('SAVING...', 'qode'); ?>');

                                                    jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", {
                                                        'action' : 'update_note_content',
                                                        'note_id' : note_id,
                                                        'content' : content,
                                                        'course_id' : <?php echo $course_id; ?>
                                                    }, function(response) {
                                                        elem.find('.note_status').text('<?php _e('SAVED', 'qode') ?>');
                                                        elem.find('.date').text(response.date);
                                                        elem.find('.time').text(response.time);
                                                    }, 'json');
                                                }

                                                jQuery(document).on('click', '#tabiid3 .remove_note', function(e){
                                                    e.preventDefault();

                                                    var note_id = jQuery(this).closest('.accordion_content').find('.note_id').val();
                                                    var $this = jQuery(this);

                                                    $this.closest('.accordion_content').prev().remove();
                                                    $this.closest('.accordion_content').remove();

                                                    jQuery.post("<?php echo admin_url( 'admin-ajax.php' ); ?>", {
                                                        'action' : 'remove_note',
                                                        'note_id' : note_id,
                                                        'course_id' : <?php echo $course_id; ?>
                                                    }, function(response) {
                                                    }, 'json');
                                                });

                                                jQuery(document).on('click', '#addnewnote', function(e){
                                                    e.preventDefault();

                                                    jQuery('#templates h3.ui-accordion-header span').remove();

                                                    var new_note = jQuery('#templates > *').clone();
                                                    var id = 0;

                                                    if(jQuery('#tabiid3 .accordion .note_id').length > 0){
                                                        id = parseInt(jQuery('#tabiid3 .accordion .note_id').last().val());
                                                        id = id + 1;
                                                    }
                                                    new_note.find('.note_id').val(id);

                                                    jQuery('#tabiid3 .accordion').append(new_note).accordion( "refresh" ).accordion( "option", "active", jQuery("#tabiid3 h3.ui-accordion-header").length - 1 );

                                                    update_note_title(id, "<?php _e('New Note', 'qode'); ?>", new_note);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php elseif(is_user_logged_in() && $tab == 'shedule' && !get_post_meta($post->ID, 'disable_shedule', true)): ?>
                    <?php
                        $course_id = $post->ID;
                        $calend_link = get_post_meta($course_id, 'calend_link', true);
                        if( ! empty($calend_link)):
                            ?>
                            <iframe class="course-shedule" src="<?php echo $calend_link; ?>" style="border: 0" frameborder="0" scrolling="no"></iframe>
                        <?php else: ?>
                            <?php_e ('ÐšÐ°Ð»ÐµÐ½Ð´Ð°Ñ€ÑŒ Ð´Ð»Ñ� Ð´Ð°Ð½Ð½Ð¾Ð³Ð¾ ÐºÑƒÑ€Ñ�Ð° Ð¾Ñ‚Ñ�ÑƒÑ‚Ñ�Ð²ÑƒÐµÑ‚', 'qode'); ?>
                        <?php endif;  ?>
                <?php elseif(is_user_logged_in() && $tab == 'forum' && !get_post_meta($post->ID, 'disable_forum', true)): ?>
                    <?php
                        $course_id = $post->ID;
                        $forum_id = '';
                        $buddypress_id = get_post_meta($course_id, 'buddypress_id', true);

                        if(!empty($buddypress_id)) {
                            $forum_id = bbp_get_group_forum_ids($buddypress_id);
                        }

                        if(!empty($forum_id)) {
                            $forum_id = $forum_id[0];
                        }

                        if(NamasteLMSStudentModel::is_enrolled(get_current_user_id(), $course_id) && !empty($forum_id)){
                            //echo do_shortcode('[bbp-single-forum id="'.$forum_id.'"]');
                            ?>
                            <div class="two_columns_33_66 forum-tab clearfix">
                                <div class="column1">
                                    <div class="group_users">
                                        <?php  if ( bp_group_has_members( "group_id=$buddypress_id&exclude_admins_mods=0&per_page=6" ) ) : ?>

                                            <ul id="member-list" class="item-list">
                                                <?php while ( bp_group_members() ) : bp_group_the_member(); ?>
                                                    <li>

                                                        <!-- Example template tags you can use -->
                                                        <div class="photo"><a href="<?php echo bp_get_group_member_url(); ?>"><?php bp_group_member_avatar(array('height' => 40, 'width' => 40)); ?></a></div>
                                                        <div class="name"><a href="<?php echo bp_get_group_member_url(); ?>"><?php bp_group_member_name(); ?></a></div>

                                                    </li>
                                                <?php endwhile; ?>
                                            </ul>

                                        <?php else: ?>

                                            <div id="message" class="info">
                                                <p><?php _e('This group has no members', 'qode'); ?></p>
                                            </div>

                                        <?php endif;  ?>
                                    </div>
                                </div>
                                <div class="column2">
                                    <div class="add_topic_form_container">
                                        <form action="" method="post">
                                            <div class="add_topic_form_header">
                                                <div class="publication"><i class="icon"></i><?php _e('Publication', 'qode'); ?></div>
                                            </div>
                                            <div class="add_topic_form">
                                                <textarea placeholder="<?php _e('Ð’Ð²ÐµÐ´Ð¸Ñ‚Ðµ Ñ‚ÐµÐºÑ�Ñ‚ Ñ�Ð¾Ð¾Ð±Ñ‰ÐµÐ½Ð¸Ñ�...', 'qode'); ?>" name="content"></textarea>
                                            </div>
                                            <div class="add_topic_form_files">
                                            </div>                                            <div class="add_topic_form_actions">
                                                <a class="image-load" href="#"></a><button type="submit"><?php _e('Publish', 'qode'); ?></button>
                                            </div>
                                            <input type="hidden" name="bbp_forum_id" value="<?php echo $forum_id; ?>">
                                            <input type="hidden" name="action" value="custom-bbp-topic-create">
                                            <input type="hidden" name="security" value="<?php echo wp_create_nonce( 'custom-bbp-topic-create' ); ?>">
                                            <input class="attaches-input" type="hidden" name="attaches" />
                                        </form>
                                    </div>

                                    <div class="topics_list_divider"><?php _e('Ð�ÐµÐ´Ð°Ð²Ð½Ð¸Ðµ Ð¾Ð±Ñ�ÑƒÐ¶Ð´ÐµÐ½Ð¸Ñ�', 'qode'); ?></div>

                                    <div class="topics_list" data-list="2" data-forum="<?php echo $forum_id; ?>">
                                        <?php
                                            if($topics = bbp_has_topics( array(
                                                'post_parent'    => $forum_id,
                                                'posts_per_page' => 11
                                                //'paged'          => bbp_get_paged(),
                                            ) )){
                                                $counter = 0;
                                                while ( bbp_topics() ) : bbp_the_topic();

                                                    if(++$counter == 12) break;

                                                     ?>
                                                    <div class="topics_list_single_topic" id="topic-<?php echo bbp_get_topic_id(); ?>" data-id="<?php echo bbp_get_topic_id(); ?>">
                                                        <div class="single_topic_header">
                                                            <div class="photo"><a href="<?php echo bp_core_get_user_domain(bbp_get_topic_author_id()); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => bbp_get_topic_author_id(), 'height' => 40, 'width' => 40)); ?></a></div>
                                                            <div class="info">
                                                                <div class="name"><a href="<?php echo bp_core_get_user_domain(bbp_get_topic_author_id()); ?>"><?php echo bbp_get_topic_author_display_name( bbp_get_topic_id() ); ?></a></div>
                                                                <div class="date"><?php echo get_post_time('j F ', false, bbp_get_topic_id(), true).__('at', 'qode').get_post_time(' H:i', false, bbp_get_topic_id(), true); ?></div>
                                                            </div>
                                                            <?php if(bbp_get_topic_author_id() == get_current_user_id()): ?>
                                                                <a href="#" class="addi_actions_open"></a>
                                                                <div class="addi_actions" style="display:none">
                                                                    <ul>
                                                                        <li><a class="edit_action" href="#">Ð ÐµÐ´Ð°ÐºÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ</a></li>
                                                                        <li><a class="remove_action" href="#">Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ</a></li>
                                                                    </ul>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="single_topic_content">
                                                            <?php $content = bbp_get_topic_content();
                                                            if(mb_strlen($content) > 500) {
                                                                echo '<div class="show">'.mb_substr($content, 0, 500).'... <a href="#" class="show_all">'.__('More', 'qode').'</a></div>';
                                                                ?>
                                                                <div class="hide"><?php echo $content; ?></div>
                                                                <?php
                                                            }else{
                                                                echo $content;
                                                            }

                                                            ?>
                                                        </div>
                                                        <div class="single_topic_attaches">
                                                            <?php $attaches = get_post_meta(bbp_get_topic_id(), 'attaches', true);
                                                            foreach(explode(',', $attaches) as $attach) :
                                                                if(empty($attach)) continue;
                                                                $r = wp_get_attachment_image_src($attach, 'full');
                                                                ?>
                                                                <div class="single_topic_single_attachment">
                                                                    <div class="attachment-image"><a target="_blank" href="<?php echo $r[0]; ?>"><?php echo wp_get_attachment_image( $attach, 'full' ); ?></a></div><div class="attachment-controls"><a class="delete-attachment" data-id="<?php echo $attach; ?>" href="#">Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ</a></div>
                                                                </div>
                                                                <?php endforeach; ?>
                                                        </div>
                                                        <div style="display:none" class="single_topic_content_edit">
                                                            <textarea class="edit_content"><?php echo get_post_field( 'post_content', bbp_get_topic_id() ); ?></textarea>
                                                            <input class="attaches-input" type="hidden" name="attaches" value="<?php echo get_post_meta(bbp_get_topic_id(), 'attaches', true); ?>" />
                                                            <div class="edit_actions">
                                                                <a class="image-load" href="#"></a>
                                                                <button class="cancel"><?php _e('Cancel', 'qode'); ?></button>
                                                                <button class="save"><?php _e('Save', 'qode'); ?></button>
                                                            </div>
                                                        </div>
                                                        <div class="single_topic_actions">
                                                            <?php $likes = get_post_meta(bbp_get_topic_id(), 'likes', true); ?>
                                                            <?php $like = get_post_meta(bbp_get_topic_id(), 'like_'.get_current_user_id(), true); ?><a class="like"<?php echo (!empty($like)) ? ' style="display:none"' : ''; ?> href="#"><?php _e('Like', 'qode'); ?></a><a class="like dislike"<?php echo (empty($like)) ? ' style="display:none"' : ''; ?> href="#"><?php _e('Dislike', 'qode'); ?></a><div class="like-count"<?php if(empty($likes)) echo ' style="display:none"'; ?>><i class="like-img"></i><span class="count"><?php echo (int)$likes; ?></span></div>
                                                        </div>
                                                        <div class="single_topic_replies_container">
                                                            <div class="single_topic_replies">
                                                            <?php
                                                                $replies = get_posts($default = array(
                                                                    'post_type'           => bbp_get_reply_post_type(),         // Only replies
                                                                    'post_parent'         => bbp_get_topic_id(),       // Of this topic
                                                                    'posts_per_page'      => 5, // This many
                                                                    'orderby'             => 'date',                     // Sorted by date
                                                                    'order'               => 'DESC',                      // Oldest to newest
                                                                    'ignore_sticky_posts' => true                       // Stickies not supported
                                                                ));
                                                                $i = count($replies);
                                                                if($i == 5) {
                                                                    $count = new WP_Query($default = array(
                                                                        'numberposts' => -1,
                                                                        'post_type'           => bbp_get_reply_post_type(),         // Only replies
                                                                        'post_parent'         => bbp_get_topic_id(),       // Of this topic
                                                                        'posts_per_page'      => 5, // This many
                                                                        'orderby'             => 'date',                     // Sorted by date
                                                                        'order'               => 'DESC',                      // Oldest to newest
                                                                        'ignore_sticky_posts' => true                       // Stickies not supported
                                                                    ));
                                                                    $count = $count->found_posts - 4;
                                                                    ?><a href="#" class="load_all_replies"><i class="comments_img"></i>ÐŸÑ€Ð¾Ñ�Ð¼Ð¾Ñ‚Ñ€ÐµÑ‚ÑŒ ÐµÑ‰Ðµ <?php echo $count.' '.custom_plural_form($count, 'ÐºÐ¾Ð¼Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ð¸Ð¹', 'ÐºÐ¾Ð¼Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ð¸Ñ�', 'ÐºÐ¾Ð¼Ð¼ÐµÐ½Ñ‚Ð°Ñ€Ð¸ÐµÐ²'); ?></a>
                                                                    <?php
                                                                }
                                                                $replies = array_reverse($replies);
                                                                array_shift($replies);
                                                                foreach($replies as $reply){

                                                            ?>
                                                                <div class="single_topic_reply" id="reply-<?php echo $reply->ID; ?>" data-id="<?php echo $reply->ID; ?>">
                                                                    <div class="photo"><a href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => $reply->post_author, 'height' => 32, 'width' => 32)); ?></a></div>
                                                                    <div class="content_wrapper">
                                                                        <div class="reply_content"><a class="author-link" href="<?php echo bp_core_get_user_domain($reply->post_author); ?>"><?php echo bbp_get_reply_author_display_name( $reply->ID ); ?></a><?php echo bbp_get_reply_content( $reply->ID ); ?></div>
                                                                        <div class="single_reply_attaches">
                                                                            <?php $attaches = get_comment_meta($reply->ID, 'attaches', true);
                                                                            foreach(explode(',', $attaches) as $attach) :
                                                                                if(empty($attach)) continue;
                                                                                $r = wp_get_attachment_image_src($attach, 'full');
                                                                                ?>
                                                                                <div class="single_reply_single_attachment">
                                                                                    <div class="attachment-image"><a target="_blank" href="<?php echo $r[0]; ?>"><?php echo wp_get_attachment_image( $attach, 'full' ); ?></a></div><div class="attachment-controls"><a class="delete-attachment" data-id="<?php echo $attach; ?>" href="#">Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ</a></div>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                        <div style="display:none" class="reply_content_edit"><textarea class="reply_content_edit_textarea"><?php echo get_post_field( 'post_content', $reply->ID ); ?></textarea><input class="attaches-input" type="hidden" name="attaches" value="<?php echo get_comment_meta($reply->ID, 'attaches', true); ?>" /><a class="image-load" href="#"></a><a href="#" class="smiles_open"></a><div class="edit_actions"><a class="cancel" href="#">ÐžÑ‚Ð¼ÐµÐ½Ð¸Ñ‚ÑŒ</a></div></div>
                                                                        <?php $likes = get_post_meta($reply->ID, 'likes', true); ?>
                                                                        <div class="actions"><span class="date"><?php echo get_post_time('j F ', false, $reply->ID, true).__('at', 'qode').get_post_time(' H:i', false, $reply->ID, true); ?></span><?php $like = get_post_meta($reply->ID, 'like_'.get_current_user_id(), true); ?><a class="like"<?php echo (!empty($like)) ? ' style="display:none"' : ''; ?> href="#"><?php _e('Like', 'qode'); ?></a><a class="like dislike"<?php echo (empty($like)) ?  ' style="display:none"' : ''; ?> href="#"><?php _e('Dislike', 'qode'); ?></a><div class="like-count"<?php if(empty($likes)) echo ' style="display:none"'; ?>><i class="like-img"></i><span class="count"><?php echo (int)$likes; ?></span></div></div>
                                                                    </div>
                                                                    <?php if($reply->post_author == get_current_user_id()): ?>
                                                                        <a class="addi_actions_open" href="#"></a>
                                                                        <div class="addi_actions" style="display:none">
                                                                            <ul>
                                                                                <li><a class="edit_action" href="#">Ð ÐµÐ´Ð°ÐºÑ‚Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ</a></li>
                                                                                <li><a class="remove_action" href="#">Ð£Ð´Ð°Ð»Ð¸Ñ‚ÑŒ</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php

                                                                }
                                                                $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                                                            ?>
                                                            </div>
                                                            <div class="single_topic_reply_form">
                                                                <form action="<?php echo $url; ?>#topic-<?php echo bbp_get_topic_id(); ?>" method="post">
                                                                    <div class="photo"><a href="<?php echo bp_core_get_user_domain(get_current_user_id()); ?>"><?php echo bp_core_fetch_avatar(array('item_id' => get_current_user_id(), 'height' => 32, 'width' => 32)); ?></a></div><div class="reply-form"><textarea placeholder="<?php _e('Ð’Ð²ÐµÐ´Ð¸Ñ‚Ðµ Ñ‚ÐµÐºÑ�Ñ‚ Ñ�Ð¾Ð¾Ð±Ñ‰ÐµÐ½Ð¸Ñ�...', 'qode'); ?>" name="content"></textarea><a class="image-load" href="#"></a><a href="#" class="smiles_open"></a><div class="add_reply_form_files">
                                                                        </div></div>

                                                                    <input type="hidden" name="bbp_forum_id" value="<?php echo $forum_id; ?>">
                                                                    <input type="hidden" name="bbp_topic_id" value="<?php echo bbp_get_topic_id(); ?>">
                                                                    <input type="hidden" name="action" value="custom-bbp-reply-create">
                                                                    <input type="hidden" name="security" value="<?php echo wp_create_nonce( 'custom-bbp-reply-create' ); ?>">
                                                                    <input class="attaches-input" type="hidden" name="attaches" />
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                endwhile;
                                                    if($counter == 11) {
                                                        ?><a class="load_more_topics" href="#">ÐŸÑ€Ð¾Ñ�Ð¼Ð¾Ñ‚Ñ€ÐµÑ‚ÑŒ Ð±Ð¾Ð»ÑŒÑˆÐµ Ð¾Ð±Ñ�ÑƒÐ¶Ð´ÐµÐ½Ð¸Ð¹</a>
                                                    <?php
                                                    }
                                            }else{
                                                _e('This forum does not have topics', 'qode');
                                            }
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <input id="image-uploader" class="image-uploader hidden" type="file" name="image-uploader" multiple />
                            <?php echo get_smiles_list(); ?>
                            <?php
                        }elseif(empty($forum_id)) {
                            _e('Ð£ Ð´Ð°Ð½Ð½Ð¾Ð³Ð¾ ÐºÑƒÑ€Ñ�Ð° Ð½ÐµÑ‚ Ñ„Ð¾Ñ€ÑƒÐ¼Ð°', 'qode');
                        }else{
                            _e('Ð¢Ð¾Ð»ÑŒÐºÐ¾ Ñ�Ñ‚ÑƒÐ´ÐµÐ½Ñ‚Ñ‹ ÐºÑƒÑ€Ñ�Ð° Ð¸Ð¼ÐµÑŽÑ‚ Ð´Ð¾Ñ�Ñ‚ÑƒÐ¿ Ðº Ñ„Ð¾Ñ€ÑƒÐ¼Ñƒ ÐºÑƒÑ€Ñ�Ð°', 'qode');
                        }
                    ?>
                <?php elseif(is_user_logged_in() && $tab == 'archive' && !get_post_meta($post->ID, 'disable_archive', true)): ?>
                <?php
                $course_id = $post->ID;

                $archive_items = get_posts(array(
                    'numberposts'     => -1,
                    'orderby'         => 'meta_value_num date',
                    'order'           => 'DESC',
                    'meta_key'        => 'order_number',
                    'meta_query' => array(
                        array(
                            'key' => 'archive_course',
                            'value' => $course_id
                        )
                    ),
                    'post_type'       => 'namaste_archive',
                    'post_status'     => 'publish'
                ) );
                if(count($archive_items) > 0) :
                ?>
                    <div class="two_columns_25_75 clearfix archive">
                        <div class="column1">
                            <div class="column_inner">
                                <ul class="namaste-archive-list">
                                    <?php foreach($archive_items as $key => $archive_item) : ?>
                                    <li data-tab-id="<?php echo $archive_item->ID; ?>" class="<?php if($key == 0) echo 'active '; ?>namaste-archive-list-item"><?php echo $archive_item->post_title; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="column2">
                            <div class="column_inner namaste-archive-wrap">
                                <?php foreach($archive_items as $key => $archive_item) : ?>
                                    <div<?php if($key != 0) echo ' style="display:none"'; ?> class="namaste-archive-tab-content namaste-archive-tab-<?php echo $archive_item->ID; ?>">
                                        <h2 class="namaste-archive-title"><?php echo $archive_item->post_title; ?></h2>
                                        <p class="namaste-archive-post-content">
                                            <?php echo do_shortcode($archive_item->post_content); ?>
                                        </p>
                                        <?php
                                        $additional = get_post_meta($archive_item->ID, 'additional_content', true);
                                        if(!empty($additional)) :
                                        $additional = preg_split('/[\n\r]+/', $additional);
                                        ?>

                                        <?php echo do_shortcode("[separator type='normal' color='#DFDFDF' thickness='' up='15' down='15']"); ?>
                                        <h4><?php _e('Additional Resources', 'qode'); ?></h4>
                                        <div>
                                            <?php foreach($additional as $link):
                                                $link_elem = explode(' : ', $link);
                                                if(count($link_elem) > 1) :
                                                ?>
                                            <a class="additional-link" href="<?php echo $link_elem[0]; ?>"><?php echo $link_elem[1]; ?></a>
                                            <?php
                                            endif;
                                            endforeach; ?>
                                        </div>
                                        <?php
                                            endif;
                                            $lectures = get_post_meta($archive_item->ID, 'lectures', true);
                                            if(!empty($lectures)):

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
                        (function($){
                            $(document).on('click', '.namaste-archive-list-item', function(e){
                                e.preventDefault();

                                var id = $(this).data('tab-id');

                                $('.namaste-archive-tab-content').hide();
                                $('.namaste-archive-tab-'+id).show();

                                $('.namaste-archive-list-item').removeClass('active');
                                $(this).addClass('active');

                                fix_height();

                            });

                            function fix_height() {
                                if($('.archive .column2').height() < $('.archive .column1').height()) {
                                    $('.archive .column2').height($('.archive .column1').height());
                                }else{
                                    $('.archive .column2').css('height', 'auto');
                                }
                            }

                            fix_height();
                        })(jQuery);
                    </script>
                    <?php else: ?>
                    <?php _e('Ð�Ñ€Ñ…Ð¸Ð² Ð´Ð°Ð½Ð½Ð¾Ð³Ð¾ ÐºÑƒÑ€Ñ�Ð° Ð¿ÑƒÑ�Ñ‚', 'qode'); ?>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="two_columns_25_75 clearfix about">
                        <div class="column1">
                            <div class="column_inner">
                                <div class="course_single_thumb_section">
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
                                </div>
                                <div class="course_single_info_section">

                                    <div class="course_single_course_title"><?php echo $title; ?></div>
                                    <div class="course_single_subtitle"><?php echo $subtitle; ?></div>
                                    <?php echo $category; ?>
                                </div>
                                <?php
                                $begins_at = get_post_meta($post->ID, 'begins_at', true);
                                $length = get_post_meta($post->ID, 'length', true);
                                if(!empty($begins_at) || !empty($length)):
                                ?>
                                <div class="course_single_info_section">
                                    <div class="course_single_section_title"><?php _e('Course details:', 'qode'); ?></div>
                                    <?php if(!empty($begins_at)): ?>
                                    <p><?php _e('Course Starts:', 'qode'); ?> <?php echo $begins_at; ?></p>
                                    <?php endif; ?>
                                    <?php if(!empty($length)): ?>
                                    <p><?php _e('Length:', 'qode'); ?> <?php echo $length; ?> <?php _e('days', 'qode'); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="column2">
                            <div class="column_inner">
                                <div id="share-social-buttons" class="<?php if(!is_user_logged_in()) echo 'not-logged'; ?>">
                                    <span class="T2"><?php _e('Invite friends', 'qode'); ?></span>
                                    <?php echo do_shortcode('[easy-share buttons="twitter,facebook,google"]'); ?>
                                </div>
                                <div class="T1"><?php _e('About a course', 'qode'); ?></div>
                                <?php the_content(); ?>
                                <?php if(!is_user_logged_in()) : ?>
                                <a id="enroll-not-auth" href="<?php echo home_url('/registration/'); ?>"><?php _e('ENROLL', 'qode'); ?> <span>Â»</span></a>
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