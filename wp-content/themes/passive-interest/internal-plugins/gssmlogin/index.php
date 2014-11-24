<?php
/*
 * Plugin Name: GS Social Media Login
 * Description: Social Media Login Buttons
 * Version: 1.0
 */


// Plugin config. MUST EDIT
require_once("config.php");


// Include FB SDK and other scripts
add_action("wp_head", "gs_include_fb_sdk");
function gs_include_fb_sdk()
{
	echo "<div id=\"fb-root\"></div>\n"; // Should be added immediately after <body> tag, but there's no such filter so the header will have to do. Doesnt work in IE 6,7
	if(!is_user_logged_in()) require_once(GS_FB_PLUGIN_PATH."/login.js.php"); // Not enqueuing this because I need a way to pass the app id to the fb sdk
}



// Display Facebook button
add_shortcode("GSFBLOGIN", "gs_display_fb_login_button");
function gs_display_fb_login_button($atts = array())
{
	if (is_user_logged_in()) return false; // Logged in? kthxbai
	//echo '<fb:login-button show-faces="false" width="200" max-rows="1"></fb:login-button>'; // Default fb button
	$class = (isset($atts["class"])) ? "gsfblogin ".$atts["class"] : "gsfblogin";
	$text = (isset($atts["text"])) ? $atts["text"] : "Log in";
	echo '<a href="#" class="'.$class.'"><em></em>
            <span>'.$text.'</span></a>';
}

// Display Twitter button
add_shortcode("GSTWLOGIN", "gs_display_twitter_login_button");
function gs_display_twitter_login_button($atts = array())
{
	if (is_user_logged_in()) return false; // Logged in? kthxbai
	//echo '<fb:login-button show-faces="false" width="200" max-rows="1"></fb:login-button>'; // Default fb button
	$class = (isset($atts["class"])) ? "gstwlogin ".$atts["class"] : "gstwlogin";
	$text = (isset($atts["text"])) ? $atts["text"] : "Log in";
	echo '<a href="#" class="'.$class.'"><em></em>
            <span>'.$text.'</span></a>';
}



// Enqueue scripts
add_action("wp_enqueue_scripts", "gs_fb_enqueue_scripts");
function gs_fb_enqueue_scripts()
{
	wp_enqueue_script('gssmcustom', get_stylesheet_directory_uri()."/internal-plugins/gssmlogin/custom.js", array('jquery'), '1.0', false);
}

?>