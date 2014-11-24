<?php
/*
Template Name: Frontpage Template
*/

if(is_user_logged_in()) {
	wp_redirect( home_url()."/home/" ); exit;	
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title( '', true, 'right' ); if (!is_home() && !is_front_page()) echo ' | '; bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); if ($site_description && (is_home() || is_front_page())) echo ' | ' . $site_description; ?></title>
	<?php 
	global $post;
	if (is_single() && $post->post_content == '') {
		$meta_boards = get_the_terms($post->ID, 'board');
		$meta_categories = get_the_category($post->ID);
	
		if ($meta_boards) {
			foreach ($meta_boards as $meta_board) {
				$meta_board_name = $meta_board->name;
			}
		} else {
			$meta_board_name = __('Untitled', ipin);
		}
		
		foreach ($meta_categories as $meta_category) {
			$meta_category_name = $meta_category->name;
		}
	?>
		<meta name="description" content="<?php _e('Pinned onto', 'ipin'); ?> <?php echo $meta_board_name; ?> <?php _e('Board in', 'ipin') ?> <?php echo $meta_category_name; ?> <?php _e('Category', 'ipin'); ?>" />
	<?php
	}
	?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/custom.css" rel="stylesheet">        
    <link href="<?php echo get_template_directory_uri(); ?>/custom/frontpage/stil.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,600' rel='stylesheet' type='text/css'>
	<?php if (of_get_option('color_scheme') == 'dark') { ?>
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/style-dark.css" rel="stylesheet">
	<?php } ?>

	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!--[if IE 7]>
	  <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome-ie7.css" rel="stylesheet">
	<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> style="background-color:#fff;">
<?php 
if(isset($_GET["message"]) && $_GET["message"] == "loggedout") {
	?>
    <script>
		jQuery(function($){
			alert("You have been successfully logged out");
		});
	</script>
    <?php
}
?>
<div class="first_wrapper_gs">
    
    <div class="first_logo_gs">
    	<img src="<?php echo site_url(); ?>/wp-content/uploads/sites/5/2013/09/logo.png" width="100%"/>
    </div>
    
    <div class="first_message_gs"><?php get_option("frontpage_big_message"); ?></div>
    
    <div class="first_signup_gs">
    
    
        <?php do_shortcode('[GSFBLOGIN class="first_fb_signup_gs" text="Login with Facebook"]'); ?>
    	<?php do_shortcode('[GSTWLOGIN class="first_tw_signup_gs" text="Login with Twitter"]'); ?>
        
        <a href="<?php echo site_url(); ?>/register/" class="first_mail_signup_gs">Sign up with email</a>
        
        <div class="clear"></div>
    
    </div><!-- end first signup gs -->    
    
    <div class="first_login_qs">Already have and account? <a href="<?php echo site_url(); ?>/login/">Log in now</a></div>
    
    <div class="translate_gs_front">
        <?php 
        if (!dynamic_sidebar('sidebar-left')) :
        endif ?>
        <style>
			body {
				overflow: hidden;
			}
		 </style>
    </div>    
    
    <div class="first_img_gs">
		<div class="first_img_gs_fixed"></div>
	</div>
</div><!-- end first wrapper gs -->

<div class="first_nav_gs">

		<?php 
		
			wp_nav_menu(array('theme_location' => 'frontpage_nav'));
		
		?>

	</div><!-- end first nav gs -->
</body>
</html>
