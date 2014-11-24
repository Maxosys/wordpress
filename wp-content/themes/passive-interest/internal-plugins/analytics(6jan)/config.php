<?php

// Default user role (EDIT THIS)
define("GS_DEFAULT_USER_ROLE","author");

define("GS_SM_SECRET_PWD", "random1seed");

// Facebook App ID )EDIT THIS)
define("GS_FB_APP_ID", "337946803014343");


// Twitter Consumer Key (EDIT THIS)
define("GS_T_KEY", "tngWqwBDLCacCVAgz4nB2Q");
// Twitter Consumer Secret (EDIT THIS)
define("GS_T_SECRET", "abAOwhAwASLtZZvxjmRygQ8krzg7el8bekMuCKERY");


// Twitter and Facebook Callback URL's (Do not edit)
define("GS_T_CALLBACK", get_stylesheet_directory_uri()."/internal-plugins/gssmlogin/twitteradduser.php");
define("GS_FB_CREATE_USER_URL", get_stylesheet_directory_uri()."/internal-plugins/gssmlogin/fbadduser.php");

// Facebook Channel URL (Do not edit)
define("GS_FB_CHANNEL_URL", get_stylesheet_directory_uri()."/internal-plugins/gssmlogin/fbchannel.html");

// Plugin path. Never hurts to have it around (Do not edit)
define("GS_FB_PLUGIN_PATH", dirname(__FILE__));


?>