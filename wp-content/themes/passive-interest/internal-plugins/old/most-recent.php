<?php
/*
 Template Name: most recent
*/
?>

<?php get_header(); ?>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
jQuery(document).ready(function(){
jQuery("#most_recent_csv").click(function(){
var name = jQuery("#dname").val();
jQuery.ajax({
type: 'POST',   // Adding Post method
url: ajaxurl, // Including ajax file
data: {"action": "recent-pins-csv"}, // Sending data dname to post_word_count function.
success: function(data){ // Show returned data using the function.
alert(data);
}
});
});
});
</script>
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
				<a href="#"><?php echo date('Y-m-d');?></a>
			</div>
			<div class="anltic_nav">
				<ul>
					<li><a href="<?php echo bloginfo('siteurl');?>/analytics" >Site Metrics</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/most-recent" class="current">Most Recent</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/most-repinned">Most Repinned</a></li>
					<li><a href="#">Most Clicked</a></li>
					<?php  if(is_page('most-recent')) { ?>
	<li><input type="button" id="most_recent_csv" class="export_btn" value="export" /></li>
					<?php 	}
				?>
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

	//get_template_part('index', 'recent');
	include_once('index-recent.php');

	?>

		</div>
	</div>



	<?php get_footer(); ?>