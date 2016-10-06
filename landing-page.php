<?php 
/*
       * Template Name: Landing Page
       */

wp_enqueue_script ( 'lp_2015', 'http://cloud.github.com/downloads/malsup/cycle/jquery.cycle.all.latest.js' );
wp_enqueue_script ( 'lp_2015-1', 'http://stg.odnoklassniki.ru/share/odkl_share.js' );
wp_enqueue_script ( 'lp_2015_custom', get_stylesheet_directory_uri () . '/scripts/index.js' );
wp_enqueue_style ( 'uiTab', get_stylesheet_directory_uri () . '/landingPage/lib/jquery.ui.tabs.css' );

get_header ('withoutMenu');

$landingPageType = "lp_2015";//get_post_meta(get_the_ID(), "landingPageType");


include_once (get_stylesheet_directory () . '/landingPage/'.$landingPageType.'/index.php');

wp_footer();

?>