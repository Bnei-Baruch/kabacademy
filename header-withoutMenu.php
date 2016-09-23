<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_satellite;
global $wp_query;
$disable_qode_seo = "";
$seo_title = "";
if (isset($qode_options_satellite['disable_qode_seo'])) $disable_qode_seo = $qode_options_satellite['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options_satellite['responsiveness'])) $responsiveness = $qode_options_satellite['responsiveness'];
	if($responsiveness != "no"){
	?>
	<meta name=viewport content="width=device-width,initial-scale=1,user-scalable=no">
	<?php 
	}else{
	?>
	<meta name=viewport content="width=1200,user-scalable=no">
	<?php } ?>
	
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	<?php if ($disable_qode_seo != "yes") { ?>
	<?php if($seo_description) { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php } else if($qode_options_satellite['meta_description']){ ?>
	<meta name="description" content="<?php echo $qode_options_satellite['meta_description'] ?>">
	<?php } ?>
	<?php if($seo_keywords) { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php } else if($qode_options_satellite['meta_keywords']){ ?>
	<meta name="keywords" content="<?php echo $qode_options_satellite['meta_keywords'] ?>">
	<?php } ?>
	<?php } ?>
	<?php wp_head(); ?>

<body <?php body_class(); ?>>	
	<div class="content">