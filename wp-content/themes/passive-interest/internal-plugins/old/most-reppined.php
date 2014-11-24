<?php
/*
 Template Name: most-repinned-pins
*/
?>

<?php get_header(); ?>

<?php 

$user_id = get_current_user_id();

$data = get_user_meta($user_id);
if(!empty($data['website_url'][0])):
$website_url = $data['website_url'][0];
endif;
?>

<div class="analytics">
	<div class="analytics_con">
		<h1>
			<?php echo $website_url;?>
		</h1>
		<div class="analytic_head">
			<div class="anltic_date">
				<a href="#"><input type="text" value="" id="datepicker"> </a>
			</div>
			<div class="anltic_nav">
				<ul>
					<li><a href="<?php echo bloginfo('siteurl');?>/analytics" >Site Metrics</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/most-recent">Most Recent</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/most-repinned" class="current">Most Repinned</a></li>
					<li><a href="#">Most Clicked</a></li>
					<?php  if(is_page('most-reppined')) { ?>
					<li><input type="button" class="export_btn" value="export" /></li>
					<?php 
						}
							

				?>
					</li>
				</ul>
			</div>


		</div>

		<div class="pi_analytic">

			<?php
	// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>

			<?php	
			/*$args = array(
			 'post_type' => 'post',
		'paged' => $paged
	);

	query_posts($args);*/

	

	// get_template_part('index', 'repinned');
	include_once('index-repinned.php');
	

	?>

		</div>
	</div>



	<?php get_footer(); ?>