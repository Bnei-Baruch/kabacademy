<?php
global $wp_query;
$id = $wp_query->get_queried_object_id ();
$sidebar = get_post_meta ( $id, "qode_show-sidebar", true );

if (get_query_var ( 'paged' )) {
	$paged = get_query_var ( 'paged' );
} elseif (get_query_var ( 'page' )) {
	$paged = get_query_var ( 'page' );
} else {
	$paged = 1;
}

if (get_post_meta ( $id, "qode_responsive-title-image", true ) != "") {
	$responsive_title_image = get_post_meta ( $id, "qode_responsive-title-image", true );
} else {
	$responsive_title_image = $qode_options_satellite ['responsive_title_image'];
}

if (get_post_meta ( $id, "qode_fixed-title-image", true ) != "") {
	$fixed_title_image = get_post_meta ( $id, "qode_fixed-title-image", true );
} else {
	$fixed_title_image = $qode_options_satellite ['fixed_title_image'];
}

if (get_post_meta ( $id, "qode_title-image", true ) != "") {
	$title_image = get_post_meta ( $id, "qode_title-image", true );
} else {
	$title_image = $qode_options_satellite ['title_image'];
}

if (get_post_meta ( $id, "qode_title-height", true ) != "") {
	$title_height = get_post_meta ( $id, "qode_title-height", true );
} else {
	$title_height = $qode_options_satellite ['title_height'];
}

if (get_post_meta ( $id, "qode_fixed-title-image", true ) != "") {
	$fixed_title_image = get_post_meta ( $id, "qode_fixed-title-image", true );
} else {
	$fixed_title_image = $qode_options_satellite ['fixed_title_image'];
}

$title_background_color = '';
if (get_post_meta ( $id, "qode_page-title-background-color", true ) != "") {
	$title_background_color = get_post_meta ( $id, "qode_page-title-background-color", true );
} else {
	$title_background_color = $qode_options_satellite ['title_background_color'];
}

$show_title_image = true;
if (get_post_meta ( $id, "qode_show-page-title-image", true )) {
	$show_title_image = false;
}
get_header ();
