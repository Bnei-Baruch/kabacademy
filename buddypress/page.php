<?php
$args = [ 
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => 'custom_profile-page.php',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		'fields' => 'ids' 
];
$pages = get_posts ( $args );

if (! empty ( $pages )) {
	wp_redirect ( get_permalink ( $pages [0] ) );
	exit ();
}
?>