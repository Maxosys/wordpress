<?php
// This page is opened in a separate window , retrieves twitter data and sets up + logs user in
require_once("../../../../../wp-load.php");
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

session_start();

// If we have an authentication token, get the user info
if(isset($_GET['oauth_token']))
{
	$connection = new TwitterOAuth(GS_T_KEY, GS_T_SECRET, $_SESSION['request_token'], $_SESSION['request_token_secret']);
	$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
	if($access_token)
	{
		$connection = new TwitterOAuth(GS_T_KEY, GS_T_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
		$params =array();
		$params['include_entities']='false';
		$content = $connection->get('account/verify_credentials',$params);

		if($content && isset($content->screen_name) && isset($content->name))
		{
			// This could be handled some other way, but we need a way to store the request/auth tokens and mysql is overkill
			$_SESSION["name"] = $content->name;
			$_SESSION["image"] = $content->profile_image_url;
			$_SESSION["twitter_id"] = $content->screen_name;
		}
	}
}

/* Switch to the main blog to register on the main blog */
global $switched;
switch_to_blog(1);

// Do we have a name and id? Let's create a user and log in
if(isset($_SESSION['name']) && isset($_SESSION['twitter_id']))
{
	if(is_user_logged_in()) { } // One more check, just to be on the safe side
	else {
		$fp = fopen("fberrlog.txt", "a+");
		$name = $_SESSION["name"];
		$tid = $_SESSION["twitter_id"];
		$email = "";
		$pass = sha1(GS_SM_SECRET_PWD.$tid);
		
		// User creation data
		$userdata = array(
			"user_login" => "TW_".$tid,
			"user_pass" => $pass,
			"user_email" => $email,
			"user_nicename" => $tid,
			"display_name" => "TW_".$tid,
			"role" => GS_DEFAULT_USER_ROLE
		);
		
		// If the user doesn't exist, create it
		if(!username_exists("TW_".$tid)) $user = wp_insert_user($userdata);
		
		if (is_wp_error($user)) fwrite($fp, "Error creating user. : ".$user->get_error_message()."\n");
		
		// Login credentials
		$creds["user_login"] = "TW_".$tid;
		$creds["user_password"] = $pass;
		$creds["remember"] = true;
		// Log the user in
		$login = wp_signon($creds, false);
			
		if (is_wp_error($login)) fwrite($fp, "Error logging in. : ".$login->get_error_message()."\n");
	
		fclose($fp);
		
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
	
		echo "<script> opener.location.reload(); window.close(); </script>";
	} // is user logged in end else

}
else // Not logged in, let's do it
{
	$connection = new TwitterOAuth(GS_T_KEY, GS_T_SECRET);
	$request_token = $connection->getRequestToken(GS_T_CALLBACK); //get Request Token

	if($request_token)
	{
		$token = $request_token['oauth_token'];
		$_SESSION['request_token'] = $token ;
		$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
		
		switch ($connection->http_code) 
		{
			// We got a request token, let's get the auth token and log in
			case 200:
				$url = $connection->getAuthorizeURL($token);
				//redirect to Twitter .
				// die($url);
				// exit();
		    	header('Location: ' . $url);
			    break;
			default:
				// Log errors
		    	break;
		}

	}
}

/* restore back to the current blog */
restore_current_blog();

?>