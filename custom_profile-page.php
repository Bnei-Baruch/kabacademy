<?php
/*
Template Name: Custom profile
*/

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



<div id="item-header-avatar">
	<a href="<?php bp_displayed_user_link(); ?>">
		<?php bp_displayed_user_avatar( 'type=full' ); ?>
	</a>
</div>
<!-- #item-header-avatar -->


<div id="item-header-content">
<?php
$fieldSructure = ( object ) KabCustomRegistrationHelper::getUserFieldList ();
echo <<<HTML
		<div>
			<label>{$fieldSructure->country['translate']}: </label>{$fieldSructure->country['val']}
		</div>
		<div>
			<label>{$fieldSructure->city['translate']}: </label>{$fieldSructure->city['val']}
		</div>
		<div>
			<label>{$fieldSructure->age['translate']}: </label>{$fieldSructure->age['val']}
		</div>
HTML;

?>

</div>
<!-- #item-header-content -->




<?php
	bp_get_template_part( 'members/single/profile/edit' );
?>


</div>

<?php get_footer(); ?>
