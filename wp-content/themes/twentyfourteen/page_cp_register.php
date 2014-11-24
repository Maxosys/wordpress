<?php
/*
Template Name: _register
*/
get_header();

?>




		<div id="main-content" class="main-content">
		<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
			<h1> Register </h1>
			
			<?php						
					echo do_shortcode('[userRegister]');

				?>

			
		</div><!-- #content -->
		</div><!-- #primary -->
		</div>
	
<?php get_footer(); ?>