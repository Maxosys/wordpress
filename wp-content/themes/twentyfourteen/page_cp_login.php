<?php
/*
Template Name: _login
*/

define("DONOTCACHEPAGE", true);

if ($_GET['action'] == 'logout') {
	if (wp_verify_nonce($_GET['nonce'], 'logout')) {
		wp_logout();
		wp_safe_redirect(home_url('/login/?action=loggedout'));
		exit();
	}
}
	//if (is_user_logged_in()) { wp_redirect(home_url()); exit; }

get_header();
?>



		<div id="main-content" class="main-content">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

		<?php
			if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();

					/*
					 * Include the post format-specific template for the content. If you want to
					 * use this in a child theme, then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

				endwhile;
				// Previous/next post navigation.
				twentyfourteen_paging_nav();

			else :
				// If no content, include the "No posts found" template.
				get_template_part( 'content', 'none' );

			endif;
		?>

		</div>
	</div><!-- #primary -->
	
	</div>
	
<?php get_footer(); ?>