<?php
/**
 * Plugin Name: Test Plugin
 * Plugin URI: http://localhost/wordpress/
 * Description: A brief description of the Plugin.
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Ankit Sharma
 * Author URI: http://localhost/wordpress/
 * License: A "Slug" license name e.g. GPL2
 */

?>
<?php
	/* valid username */
	
	function init()
	{
		//add_action( 'wp_ajax_nopriv_validate_username','validate_usernametest');
		//add_action( 'wp_ajax_validate_username','validate_usernametest');
		
		add_shortcode( 'ajax_register_test','register_shortcodenew');		
		add_shortcode( 'ajax_login_test','login_shortcodenew');
		
		add_action( 'wp_ajax_nopriv_login_submit','login_submit');
		add_action( 'wp_ajax_login_submit','login_submit');
		
		add_action( 'wp_ajax_nopriv_register_submit','register_submit');
		add_action( 'wp_ajax_register_submit','register_submit');		
	}
	
	add_action( 'init','init');
	add_action( 'wp_head','header1');

	function register_shortcodenew()
	{
	   include (plugin_dir_path( dirname( __FILE__ ) ) . 'test-plugin/views/register.php');
    }
	function login_shortcodenew()
	{
       include (plugin_dir_path( dirname( __FILE__ ) ) . 'test-plugin/views/testlogin.php');
    }	
	
		 /**
		  * Any additional code to be ran during wp_head
		  *
		  * Prints the ajaxurl in the html header.
		  * Prints the meta tags template.
		  */

  function header1()
	 {
        print '<script type="text/javascript"> var ajaxurl = "'. admin_url("admin-ajax.php") .'";</script>';
        //load_template( plugin_dir_path( dirname( __FILE__ ) ) . "views/meta-tags.php" );
     }
	
	/* end valid username */	

	add_action( 'wp_enqueue_scripts','enqueue_scripts');

	function enqueue_scripts( $scripts=null )
	{
		wp_enqueue_script( 'register', plugin_dir_url( dirname( __FILE__ ) ) . 'test-plugin/assets/register.js', array('jquery')  );
	}
		//add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );	
		
		
		
	function login_submit()
	{
		
        /**
         * Build our array of credentials to be passed into wp_signon.
         * Default is to look for $_POST variables
         */
        $creds = array(
            'user_login'    => empty( $_POST['log'] ) ? $user_login : $_POST['log'],
            'user_password' => empty( $_POST['pwd'] ) ? $password : $_POST['pwd'],
            'remember'      => isset( $_POST['remember'] ) ? null : true
            );
        $user = wp_signon( $creds, false );

		
		// echo $errdata = is_wp_error( $user );
		 //print_r($errdata);
		
        /**
         * If signon is successful we print the user name if not we print "0" for
         * false
         */
        print is_wp_error( $user ) ? "0" : "1"; //$user->data->user_login;

				// if ( $is_ajax ) die(); else return false;		   
		exit;
	}
	
	function register_submit($login=null, $password=null, $email=null, $confirm_password=null, $is_ajax=true )
	{
		$user = array
		(
			'login'    => empty( $_POST['login'] ) ? $login : $_POST['login'],
			'email'    => empty( $_POST['email'] ) ? $email : $_POST['email'],
			'password' => empty( $_POST['password'] ) ? $password : $_POST['password'],
			'confirm_password' => empty( $_POST['confirm_password'] ) ? $confirm_password : $_POST['confirm_password'],
		);
		
	 
	$st =  true; 				
	$email_exists  =  email_exists($user['email']);
	$errmsg = array();
		
		if($email_exists=='')
		{
						
		}
		else
		{
			$errmsg[1] = 'Email Already Exists';
			$st =  false;
		}
		
		$username_exists = username_exists($user['login']);
		if($username_exists=='')
		{
			
		}
		else
		{
			$errmsg[2] = 'Username Already Exists';
			$st =  false;
		}
		if($st==true)
		{
			$user_id = wp_create_user( $user['login'], $user['password'], $user['email'] );
			 if ( ! is_wp_error( $user_id ) )
			 {
				 update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
				 wp_update_user( array( 'ID' => $user_id, 'role' => 'subscriber' ) );
				 $wp_signon = wp_signon( array( 'user_login' => $user['login'], 'user_password' => $user['password'], 'remember' => true ), false );
				$errmsg[3] = 'Successfully Register';
				$errmsg[4] = $user_id;
			 }
		}
		else
		{
			$random_password = __('User already exists.  Password inherited.');
		}
		 
		 echo  json_encode($errmsg);			
		exit;		 
    }
?>