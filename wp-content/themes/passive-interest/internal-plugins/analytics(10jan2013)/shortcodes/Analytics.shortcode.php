<?php 


add_shortcode('pifanalytics','run_pif_verification');

function run_pif_verification() { 
	
	ob_start();
	
	if(is_user_logged_in()):
	
	if(isset($_GET['analyticview']))
	{
		if($_GET['analyticview']=='verification')   // verification template
		{
			require_once(CONFIG_ANALYTICS_PATH."/templates/verification.template.php");
		}
		else if($_GET['analyticview']=='analyticsmetrics') // analyticsmetic template
		{
			require_once(CONFIG_ANALYTICS_PATH."/templates/analyticsmetrics.template.php");
		}
		else if($_GET['analyticview']=='mostrecent')  // most recent template
		{
			require_once(CONFIG_ANALYTICS_PATH."/templates/mostrecent.template.php");
		}
		else if($_GET['analyticview']=='mostrepinned') // most repinned template
		{
			require_once(CONFIG_ANALYTICS_PATH."/templates/mostrepinned.template.php");
		}
				

	}
	else {
		
		$location  = site_url().'/analytics?analyticview=verification';
		?>
		<script>window.location='<?php echo $location;?>'</script>
		<?php 
	}
	
	
		 
		
		endif;
		
		return ob_get_clean();
		
}

// end  verification

?>