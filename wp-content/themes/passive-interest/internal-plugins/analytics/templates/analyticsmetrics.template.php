<?php 
$user_id = get_current_user_id();
$data = get_user_meta($user_id);

if(!empty($data['website_url'][0])):
$website_url = $data['website_url'][0];
endif;
?>

<script src="<?php echo bloginfo('template_directory');?>/js/calendar/jscal2.js"></script>
    <script src="<?php echo bloginfo('template_directory');?>/js/calendar/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/calendar/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/calendar/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/calendar/steel/steel.css" />

    <style>
	.f_date1class{
	 background: none repeat scroll 0 0 #F8F8F8;
    border: 1px solid #D2D2D2;
    border-radius: 3px;
    color: #5F5F5F;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    margin: 0 5px;
    padding: 8px 0;
    text-align: center;
    text-decoration: none;
    width: 226px; 
}
	</style>
	
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="row">
					
					<!--  new html -->
					
					<div class="analytics">
<div class="analytics_con">
<h1>
			<?php echo $website_url;?>
		</h1>
<div class="analytic_head">
<div class="anltic_date">
<?php
	if(isset($_GET['date']))
	{
		$datenew = $_GET['date'];
		
		$datenew = explode(',',$datenew);
		$dd1 = $datenew[0];
		$dd2 = $datenew[1];
		
		 $dd1_y = substr($dd1,0,4);
		 $dd1_m = substr($dd1,4,2);
		 $dd1_d = substr($dd1,6,2);
		 
		 $f_date1= $dd1_y.'-'.$dd1_m.'-'.$dd1_d;
		 
		 $f_date1_str = strtotime($f_date1);
		 $f_date1_f =  date('M d, Y',$f_date1_str);		 
		 $dd2_y = substr($dd2,0,4);
		 $dd2_m = substr($dd2,4,2);
		 $dd2_d = substr($dd2,6,2);		 
		 $f_date2 = $dd2_y.'-'.$dd2_m.'-'.$dd2_d;		 
		 $f_date2_str = strtotime($f_date2);
		 $f_date2_f =  date('M d, Y',$f_date2_str);		 
		 $date_value = $f_date1_f.' - '.$f_date2_f;
	}
	else
	{
		$date_value = '';
		$f_date1 = '';
		$f_date2 = '';
	}
	
		
	$date1 =	$f_date1; //"2013-12-30";
	$date2 =   $f_date2; //"2014-01-04";
	   
$datearr =  array();

if(!empty($date1) && !empty($date2))
{
	//$date1 = date('Y-m-d');


$datearr[] = $date = $date1; //date('Y-m-d');


$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

//printf("%d years, %d months, %d days\n", $years, $months, $days);



	if(strtotime($date1)>strtotime($date2))
	{

		for($i=0 ;$i<=$days ;$i++)
		{
			$date1 = str_replace('-', '/', $date);
			$tomorrow = date('Y-m-d',strtotime($date1 . "-$i days"));
			$datearr[] = $tomorrow;
		}
		$lastarrkey = $i-2;
		
		$y1 = date('Y',strtotime($datearr[$lastarrkey]));
		$m1 = date('m',strtotime($datearr[$lastarrkey]))-1;
		$d1 = date('d',strtotime($datearr[$lastarrkey]));
		
	}
	else
	{		
		for($i=1 ;$i<=$days ;$i++)
		{
			$date1 = str_replace('-', '/', $date);
			$tomorrow = date('Y-m-d',strtotime($date1 . "+$i days"));
			$datearr[] = $tomorrow;
		}
		//echo $lastarrkey = $i;	
		
		$y1 = date('Y',strtotime($datearr[0]));
		$m1 = date('m',strtotime($datearr[0]))-1;
		$d1 = date('d',strtotime($datearr[0]));
		 
		
	}
	
	
}
else
{
	$datearr[] = $date = date('Y-m-d');	
	for($i=1 ;$i<=15 ;$i++)
	{
		$date1 = str_replace('-', '/', $date);
		$tomorrow = date('Y-m-d',strtotime($date1 . "-$i days"));
		$datearr[] = $tomorrow;
	}
	$lastarrkey = $i-2;
	
	
	$y1 = date('Y',strtotime($datearr[$lastarrkey]));
	$m1 = date('m',strtotime($datearr[$lastarrkey]))-1;
	$d1 = date('d',strtotime($datearr[$lastarrkey]));
	$datearr = array_reverse($datearr);
	$ff = array_shift($datearr);
	
	
	$f_date2_str = strtotime($datearr[0]);
	$f_date2_f =  date('M d, Y',$f_date2_str);	
		 
	$f_date2_str2 = strtotime(end($datearr));
	$f_date2_f2 =  date('M d, Y',$f_date2_str2);	
	
	$date_value = $f_date2_f.' - '.$f_date2_f2;
}




	
	?>

<input size="30" id="f_date1" class="f_date1class" value="<?php echo $date_value;  ?>"  />	<br />
				<div id="info" style="text-align: center; margin-top: 1em;"></div>
				<script type="text/javascript">//<![CDATA[
						
							var SELECTED_RANGE = null;
						  function getSelectionHandler() {
								  var startDate = null;
								  var ignoreEvent = false;
								  return function(cal) {
										  var selectionObject = cal.selection;

			
										  if (ignoreEvent)
												  return;

										  var selectedDate = selectionObject.get();
										  if (startDate == null) {
												  startDate = selectedDate;
												  SELECTED_RANGE = null;
												  document.getElementById("info").innerHTML = "";
												  cal.args.min = Calendar.intToDate(selectedDate);
												  cal.refresh();
										  } else {
												  ignoreEvent = true;
												  selectionObject.selectRange(startDate, selectedDate);
												  ignoreEvent = false;
												  SELECTED_RANGE = selectionObject.sel[0];



												  startDate = null;
												  document.getElementById("info").innerHTML = ""; 									
											
												  document.location.href="?analyticview=analyticsmetrics&date="+SELECTED_RANGE;
											
												  // (*)
												  cal.args.min = null;
												  cal.refresh();
										    }
								  };
						  };

						
						  Calendar.setup({
							inputField : "f_date1",
							trigger    : "f_date1",
							onSelect   : function() { this.hide() },
							showTime   : 12,
							fdow          : 0,
							dateFormat : "%Y - %m - %d",
							selectionType : Calendar.SEL_SINGLE,
							onSelect      : getSelectionHandler()
						  });
						  
						  
						  
				//]]></script>
</div>
<div class="anltic_nav">
<ul>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=analyticsmetrics" class="current" >Site Metrics</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostrecent" >Most Recent</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostrepinned">Most Repinned</a></li>
	<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostclicked">Most Clicked</a></li>

 <li>
<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="export_graph_matrics" class="export_graph_matrics" >
    <input type="hidden" name="action" value="exportgraphcsv" />
    <a href="javascript:;" onclick="document.getElementById('export_graph_matrics').submit();" id="mostrecentpins" class="graph">Export</a>
    </form>
    </li>



</ul>
</div>


</div>

<?php
	
	$obj =  new Graphs();
	include_once('analytics-pin-pinners.php'); // PIN-PINNER GRAPH INCLUSION
	include_once('analytics-repin-repinners.php'); // REPIN REPINNERS GRAPH INCLUSION
	//include_once('analytics-impressions-reach.php'); // IMPRESSION REACH GRAPH INCLUSION
	include_once('analytics-clicks-visitors.php'); // CLICKS VISITORS GRAPH INCLUSION
?>




	<?php



						if(!empty($_REQUEST['action']) && $_REQUEST['action'] =="exportgraphcsv") {
// RUN THE CSV FUNCTIONALITY ON CONDITION BASIS WHEN CSV REQUEST COMES








$csvpath =  $_SERVER['DOCUMENT_ROOT'].'piformula/wp-content/themes/passive-interest/internal-plugins/analytics/csvfiles/';
//$csvpath =  $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/passive-interest/internal-plugins/analytics/csvfiles/';

$file = @fopen($csvpath."webanalyticsgraphs_record-".date('Y-m-d').".csv","w"); // OPEN CSV FILE FOR WRITE DATA

$fname="webanalyticsgraphs_record-".date('Y-m-d').".csv";

/***************************** LOOP THROUGH PUT EACH PIN IN CSV DOCUMENT ***************************************/

$pins  =explode(',',$pinsvalcsv);
$pinners  =explode(',',$pinnersvalcsv);
$repins  =explode(',',$repinsvalcsv);
$repinners  =explode(',',$repinnersval);

$clicks  =explode(',',$clicksvalcsv);
$visitors  =explode(',',$clickersvalcsv);

foreach($datearr as $k => $pin) {

	/**************************  INITIALLY SET CSV FILE COULMN HEADING  *******************************/

		if($k==0) {
			$csvrecentpinsdata = array(
						'date' => 'Date',
						'pins' => 'Pins',
						'pinners' => 'Pinners',
						'repins' => 'Repins',
						'repiners' => 'Repins',
						'impressions' => 'Impressions',
						'reach' => 'Reach',
						'clicks' => 'Clicks',
						'visitors' => 'Visitors'
			);
				fputcsv($file,$csvrecentpinsdata);
		}

		/**************************  INITIALLY SET CSV FILE COULMN HEADING  *******************************/





		/**************************  CREATE MOST RECENT PINS CSV ***************************/

		$csvrecentpinsdata = array(
						'date' => $datearr[$k],
						'pins' => $pins[$k],
						'pinners' => $pinners[$k],
						'repins' => $repins[$k],
						'repiners' => $repinners[$k],
						'impressions' => ' ',
						'reach' => ' ',
						'clicks' => $clicks[$k],
						'visitors' => $visitors[$k],
		);

/*******************************   CREATE MOST RECENT PINS CSV ***************************/


	/************************** WRITE CSV FILE ********************************************/

fputcsv($file,$csvrecentpinsdata);



	}

	/***************************** CSV FILE DOWNLOAD ******************************************/
	?>
						<script type="text/javascript">
 jQuery(document).ready(function() {
	  
 window.location.href =jQuery('.csvdownloadrecent').attr('href');
//or dynamically:
window.location.href = jQuery(".csvdownloadrecent").attr('href');
	
});
 </script>
						<a style="display: none;"
							href="<?php echo bloginfo('template_url'); ?>/internal-plugins/analytics/csvdownload.php?filename=<?php echo $fname;?>"
							id="csvdownloadrecent" class="csvdownloadrecent">Download csv
							File</a>



						<?php


						/***************************** CSV FILE DOWNLOAD  ******************************************/

						fclose($file);


						/***************************** CLOSE CSV FILE ******************************************/



}
?>














</div>
</div>



<script src="<?php echo get_template_directory_uri(); ?>/js/exporting.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/highcharts.js"></script>
