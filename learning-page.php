<?php 
/*
       * Template Name: temp Page
       */

wp_enqueue_script ( 'lp_2015', 'http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js' );
wp_enqueue_script ( 'lp_2015-1', 'http://stg.odnoklassniki.ru/share/odkl_share.js' );
wp_enqueue_script ( 'lp_2015_custom', get_stylesheet_directory_uri () . '/scripts/index.js' );

wp_enqueue_style ( 'childstyle', get_stylesheet_directory_uri () . '/live/style_green.css' );
wp_enqueue_style ( 'childstyle', get_stylesheet_directory_uri () . '/live/jquery.ui.tabs.css' );

get_header ('withoutMenu');
include_once (get_stylesheet_directory () . '/live/index.php');
wp_footer();

?>