<?php
/**
 * Plugin Name: Login & Register
 * Plugin URI: http://nanowebtech.com/plugins
 * Description: Creates a simple login and register modal with an optional shortcode.
 * Version: 1.0.1
 * Author: Ankit Sharma
 * Author URI: http://nanowebtech.com
 * License: Nano V1
 */


/**
 * Include our abstract which is a Class of shared Methods for our Classes.
 */	
	require_once 'controllers/abstractnew.php';

/**
 * If the admin is being displayed load the admin class and run it.
 */

/**
 * If users are allowed to register we require the registration class
 */
require_once 'controllers/registernew.php';

