<?php
// This page takes the fb info from the js sdk (ajax) and sets up + logs user in
require_once("../../../../../wp-load.php");
require_once('config.php');
if(!isset($_POST["id"])) die("No juice");

/* Switch to the main blog to register on the main blog */
global $switched;
switch_to_blog(1);

if(is_user_logged_in()) {}
else {
	//$fp = fopen("fberrlog.txt", "a+");
	$name = $_POST["name"];
	$fbid = $_POST["id"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$pass = sha1(GS_SM_SECRET_PWD.$fbid);
	
	$userdata = array(
		"user_login" => "FB_".$fbid,
		"user_pass" => $pass,
		"user_email" => $email,
		"user_nicename" => "FB_".$fbid,
		"display_name" => "FB_".$fbid,
		"role" => GS_DEFAULT_USER_ROLE
	);
	
	if(!email_exists($email)) $user = wp_insert_user($userdata);
	
	// if (is_wp_error($user)) fwrite($fp, "Error creating user. : ".$user->get_error_message()."\n");
	
	$creds["user_login"] = "FB_".$fbid;
	$creds["user_password"] = $pass;
	$creds["remember"] = true;
	$login = wp_signon($creds, false);

	// if (is_wp_error($login)) fwrite($fp, "Error logging in. : ".$login->get_error_message()."\n");

if(is_multisite())
{
	function add_new_user_to_all_blogs($user_id)
	{
	  global $wpdb;
	
	  $blog_list = $wpdb->get_results("SELECT blog_id FROM " . $wpdb->blogs);
	  foreach ($blog_list as $blog)
	  {
		add_user_to_blog($blog->blog_id, $user_id, GS_DEFAULT_USER_ROLE);
	  }
	}
	
	add_new_user_to_all_blogs(get_current_user_id());
}

	//fclose($fp);
} // is user logged in end else

restore_current_blog();

?>