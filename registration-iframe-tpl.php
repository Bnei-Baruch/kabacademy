<?php
/*
 * Template Name: Registration For iFrame
 */

global $wp_query;
if ($_POST ['action'] == "loginRregistrationFormShortcode") {
	$_POST ['userData'] ['courseId'] = $_REQUEST ['courseId'];
	do_action ( 'wp_ajax_nopriv_registerRregistrationFormShortcode' );
	// $tesa = new RregistrationFormShortcodeClass();
	// $return = RregistrationFormShortcodeClass::login();
}
if ($_POST ['action'] == "registerRregistrationFormShortcode") {
	$_POST ['userData'] ['courseId'] = $_REQUEST ['courseId'];
	RregistrationFormShortcodeClass::register();
	/* 
	add_action ( 'init', array (
			'RregistrationFormShortcodeClass',
			'register' 
	) ); */
}

//add_action ( 'wp_ajax_nopriv_registerRregistrationFormShortcode', 'UserProfile_GetDefaultFieldes', 30 );
//$testD = new TestDavgur();

wp_enqueue_script ( 'ajax-script', get_template_directory_uri () . '/js/my-ajax-script.js', array (
		'jquery' 
) );
wp_enqueue_script ( 'regFormJs', REGFORM_DIR_URL . '/js/script.js' );
wp_enqueue_style ( 'loginAndRegisterForm', REGFORM_DIR_URL . '/style.css' );

wp_print_styles ( 'loginAndRegisterForm' );
wp_print_scripts ( 'regFormJs' );

//admin_url('admin-ajax.php')
// add ajaxurl for javascript
$ajaxurlScript = '<script type="text/javascript">window.ajaxurl ="' . admin_url('admin-ajax.php') . '"</script>';
echo $ajaxurlScript;
/**
 * To able transmit parameter in url of iFrame
 */
if (is_null ( $_REQUEST ['getLoginForm'] ))
	echo do_shortcode ( '[registerForm]' );
else
	echo do_shortcode ( '[loginForm]' );
	// for add course id to request catch AJAX action (with priority -1 as in shortcode)
if (! is_null ( $_REQUEST ['courseId'] )) {
}

?>