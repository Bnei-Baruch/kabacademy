<?php
/*
 * Template Name: Custom profile
 */
/*
 * global $wp_query;
 * $id = $wp_query->get_queried_object_id();
 * $sidebar = get_post_meta($id, "qode_show-sidebar", true);
 *
 * if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
 * elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
 * else { $paged = 1; }
 *
 * if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 * $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
 * }else{
 * $responsive_title_image = $qode_options_satellite['responsive_title_image'];
 * }
 *
 * if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 * $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
 * }else{
 * $fixed_title_image = $qode_options_satellite['fixed_title_image'];
 * }
 *
 * if(get_post_meta($id, "qode_title-image", true) != ""){
 * $title_image = get_post_meta($id, "qode_title-image", true);
 * }else{
 * $title_image = $qode_options_satellite['title_image'];
 * }
 *
 * if(get_post_meta($id, "qode_title-height", true) != ""){
 * $title_height = get_post_meta($id, "qode_title-height", true);
 * }else{
 * $title_height = $qode_options_satellite['title_height'];
 * }
 *
 * if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 * $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
 * }else{
 * $fixed_title_image = $qode_options_satellite['fixed_title_image'];
 * }
 *
 * $title_background_color = '';
 * if(get_post_meta($id, "qode_page-title-background-color", true) != ""){
 * $title_background_color = get_post_meta($id, "qode_page-title-background-color", true);
 * }else{
 * $title_background_color = $qode_options_satellite['title_background_color'];
 * }
 *
 * $show_title_image = true;
 * if(get_post_meta($id, "qode_show-page-title-image", true)) {
 * $show_title_image = false;
 * }
 */
?>

<?php
get_header ();
wp_enqueue_script ( "jquery-ui-tabs", "jquery" );

$myAccountData = ( object ) KabCustomRegistrationHelper::getUpdateProfile ();
?>
<script type="text/javascript">
jQuery("document").ready(function() {
  jQuery( "#tabs" ).tabs();
  jQuery( "#saveMyAccount" ).on('click', setUpdateProfile);
  
});
function setUpdateProfile() {
  var data = {
    action: 'setUpdateProfileRregistrationFormShortcode',
    userData: jQuery('#editMyAccount').find('form').serialize()
  };

  jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: data,
    dataType: 'json'
  })
  .done(function(data) { })
}

</script>

<?php if(!get_post_meta($id, "qode_show-page-title", true) && false) { ?>
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

<div class="container">
	<div id="tabs">
		<ul>
			<li><a href="#viewMyAccount">Prosmotret profil</a></li>
			<li><a href="#editMyAccount">Redaktirovat profil</a></li>
		</ul>
		<div id="viewMyAccount">
			<div>
			<?php
			echo get_avatar ( get_current_user_id () );
			echo <<<HTML
		<div>
			<label>{$myAccountData->country['translate']}: </label>{$myAccountData->country['val']}
		</div>
		<div>
			<label>{$myAccountData->city['translate']}: </label>{$myAccountData->city['val']}
		</div>
		<div>
			<label>{$myAccountData->age['translate']}: </label>{$myAccountData->age['val']}
		</div>
HTML;
			?>
			</div>
			<div><?php do_shortcode ( '[namaste-mycourses]' ); ?></div>

		</div>
		<div id="editMyAccount">
		<?php
		echo <<<HTML
				<form>
					<fieldset>
						<div class="formItem">
							<label for="first_name">{$myAccountData->first_name['translate']}</label>
							<input type="text" name="first_name" value="{$myAccountData->first_name['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="last_name">{$myAccountData->last_name['translate']}</label>
							<input type="text" name="last_name" value="{$myAccountData->last_name['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="display_name">{$myAccountData->display_name['translate']}</label>
							<input type="text" name="display_name" value="{$myAccountData->display_name['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="country">{$myAccountData->country['translate']}</label> 
							<input type="text" name="country" value="{$myAccountData->country['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="city">{$myAccountData->city['translate']}</label> 
							<input type="text" name="city" value="{$myAccountData->city['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="age">{$myAccountData->age['translate']}</label>
							<input type="number" min="16" max="100" name="age" value="{$myAccountData->age['val']}"
								class="text ui-widget ui-widget-content ui-corner-all" />
						</div>
						<div class="formItem">
							<label for="gender">{$myAccountData->gender['translate']['gender']}</label> 
							<select id="gender" name="gender">
								<option value="{$myAccountData->gender['translate']['male']}" selected="{$myAccountData->gender['male']}">
									{$myAccountData->gender['translate']['male']}
								</option>
								<option value="{$myAccountData->gender['translate']['female']}"  selected="{$myAccountData->gender['female']}">
									{$myAccountData->gender['translate']['female']}
								</option>
							</select>
						</div>
					</fieldset>
					div
				</form>
HTML;
		?>
			<div id="saveMyAccount">submit</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>