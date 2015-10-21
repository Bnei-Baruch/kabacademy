<?php 
/*
       * Template Name: Webinar Page
       */

function enqueue_scripts() {
	wp_enqueue_script ( 'bootstrap', get_stylesheet_directory_uri () . '/lib/bootstrap/js/bootstrap.min.js');
	wp_enqueue_script ( 'webinar', get_stylesheet_directory_uri () . '/webinar/script.js' );

	wp_enqueue_style ( 'bootstrap', get_stylesheet_directory_uri () . '/lib/bootstrap/css/bootstrap.min.css' );
	wp_enqueue_style ( 'webinar', get_stylesheet_directory_uri () . '/webinar/style.css' );
	wp_enqueue_style ( 'Roboto', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700,700italic&amp;subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,vietnamese,latin-ext' );
}    
 
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
//get_header ('withoutMenu');

wp_head();
include_once (get_stylesheet_directory () . '/webinar/index.php');

//wp_footer();

?>