<?php
/*
Template Name: Login Page
*/

if (is_user_logged_in ()) {
        wp_redirect( home_url() );
        return;    
}
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

if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
    $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
    $fixed_title_image = $qode_options_satellite['fixed_title_image'];
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


<div class="container">
    <div id="lr-container" class="container_inner clearfix">
        <!--<div class="lr-container">-->
            <div class="lr-left-container">
                <div>
                    <span class="T1"><?php // _e('Log In to U-World', 'qode'); ?></span>
                    <!--<span class="T2"> <?php // _e('Please fill in the information below:', 'qode'); ?></span>-->
                    <p class="help-info">&nbsp;<?php // _e('* asterisk indicates required fields', 'qode'); ?></p>
                    <?php echo do_shortcode('[loginForm]'); ?>
                </div>
                <div>
                    <br />
                    <p>
                        <a href="/registration">Нет логина? Зарегистрируйтесь >></a>
                    </p>
                </div>
                <!-- <div class="clearfix or-divider">
                    <div class="hor-line-divider"></div>
                    <div class="hor-line-divider-text"><?php _e('or', 'qode'); ?></div>
                    <div class="hor-line-divider"></div>
                </div>
                <div>
                    <span class="T2"><?php _e('New to U-World?', 'qode'); ?></span>
                    <?php //echo do_shortcode('[vkruge_registration_form]'); ?>
                </div> -->
            </div>
            <!-- <div class="lr-right-container">
                <span class="T2"><?php _e('Sign In with your social account', 'qode'); ?></span>
                <?php echo do_shortcode('[btn-hybridauth provider_id="Google" connect="true"]<span class="essb_icon"></span><span class="essb_network_name">'.__('Sign in with Google', 'qode').'</span>[/btn-hybridauth]'); ?>
                <?php echo do_shortcode('[btn-hybridauth provider_id="Facebook" connect="true"]<span class="essb_icon"></span><span class="essb_network_name">'.__('Sign in with Facebook', 'qode').'</span>[/btn-hybridauth]'); ?>
                <?php echo do_shortcode('[btn-hybridauth provider_id="Vkontakte" connect="true"]<span class="essb_icon"></span><span class="essb_network_name">'.__('Sign in with Vkontakte', 'qode').'</span>[/btn-hybridauth]'); ?>
            </div>-->
        <!--</div>-->
    </div>
</div>

<?php get_footer(); ?>
