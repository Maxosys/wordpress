<?php

// count pin function

function countPinData($dateval)
{

global $wpdb;
$most_recent_pins=array();
$postids=array();
$user_id = get_current_user_id();
$userdomain =  get_user_meta($user_id, 'website_url', true);



$ddurl = explode('://',$userdomain);
$ext_url = explode('.',$ddurl[1]);

$make_url = '';

if($ext_url[0]=='www')
{
	for($i=1;$i<count($ext_url);$i++)
	{
		$make_url .=$ext_url[$i].'.';
	}
}
else
{
	for($i=0;$i<count($ext_url);$i++)
	{
		$make_url .=$ext_url[$i].'.';
	}	
}
$userdomain = rtrim($make_url,'.');

$qq = "SELECT * FROM `wp_postmeta` WHERE `meta_key` = '_Photo Source Domain' and `meta_key` != '_Original Post ID' AND `meta_value` like '%".$userdomain."%'"; 
$postsdetails = $wpdb->get_results($qq);

foreach($postsdetails as $key => $value):
		$postids[] = $value->post_id;
endforeach;	

	for($i=0;$i<count($postids);$i++)
	{
		$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$postids[$i]."' and post_date like '%".$dateval."%' "; 
		$most_recent_pins[] = $wpdb->get_results($qqq);
	}

	$recent_pins=array();
	$bb = count($most_recent_pins);

	for($z=0;$z<$bb;$z++)
	{
		$recent_pins[]=$most_recent_pins[$z][0];
	}	
	
	$pindatanew =  array_filter($recent_pins);
	$countpin = array_values($pindatanew);
	
	$countdata = count($countpin);
	
	// return number of pins	
	return $countdata;		
}
	// End count pin function
	
	// Start count pinner function
	
	
	function countPinnerData($dateval)
	{	
		global $wpdb;
		$most_recent_pins=array();
		$postids=array();
		$user_id = get_current_user_id();
		$userdomain =  get_user_meta($user_id, 'website_url', true);
		$qq = "SELECT * FROM `wp_postmeta` WHERE `meta_key` = '_Photo Source Domain' and `meta_key` != '_Original Post ID' AND `meta_value` = '".$userdomain."'"; 
		$postsdetails = $wpdb->get_results($qq);

		foreach($postsdetails as $key => $value):
				$postids[] = $value->post_id;
		endforeach;	
		
		// fetch date wise record
		
			for($i=0;$i<count($postids);$i++)
			{
				$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$postids[$i]."' and post_date like '%".$dateval."%' "; 
				$most_recent_pins[] = $wpdb->get_results($qqq);
			}
				$recent_pins=array();
				$bb = count($most_recent_pins);				
			

			for($z=0;$z<$bb;$z++)
			{
				$recent_pins[]=$most_recent_pins[$z][0]->post_author;
			}
			
			$pindatanew =  array_filter($recent_pins);
			$countpin   =  array_values($pindatanew);
			$countdata = array_unique($countpin);				
			$countdata = count($countdata);			
			// return number of pinners	
			return $countdata;		
	}
	
// end count pinner function
	   
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
	
}
else
{
	for($i=1 ;$i<=$days ;$i++)
	{
		$date1 = str_replace('-', '/', $date);
		$tomorrow = date('Y-m-d',strtotime($date1 . "+$i days"));
		$datearr[] = $tomorrow;
	}
	//print_r($datearr);
	
	 $lastarrkey = $i-2;	
	//exit;
}

	$y1 = date('Y',strtotime($datearr[$lastarrkey]));
	$m1 = date('m',strtotime($datearr[$lastarrkey]))-1;
	$d1 = date('d',strtotime($datearr[$lastarrkey]));

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
}
	
	
	// set starting date 
	
	
	// end starting date
	
	// number of pins
	//print_r($datearr);	
	 
			$pinsval = '';
			foreach($datearr as $key => $val)
			{
				$datearr[$key];		
				$condata = countPinData($datearr[$key]);
			
				count($condata);	
				//echo '<br/>';				
				
				$pinsval .= '['.$condata.'],';
			}

			$fi_pinsval = '['.$pinsval.']';		
			
	//[[0],[6],]
	
	// number of Pinners	 
			$pinnersval = '';
			foreach($datearr as $key => $val)
			{			
				$condata = countPinnerData($datearr[$key]);
				$pinnersval .= '['.$condata.'],';
			}
			 $fi_pinnersval = '['.$pinnersval.']';
	//[[0],[6],]	
 
?>
<div class="pi_analytic">
<div class="left_antic">
<div class="pins">
<h2>
Pins
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/qus.png" alt="img" border="0" title="Pins are the daily average number of pins from your website." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/b_zero.png" alt="img" border="0" /></a>
</div>
</div>

<div class="pins pinners">
<h2>
Pinners
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_qus.png" alt="img" border="0" title="Pinners are the daily average number of people who pinned from your website. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_zero.png" alt="img" border="0" /></a>
</div>
</div>


</div>
<div class="right_antic">
<div class="analytic_img">

<!---------------------------graph1------------------------------>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">


$(function () {
    $('#pins_pinners').highcharts({
	    chart: {
                type: 'spline'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: {
                 day: '%m/%e'
		   
            }
        },
	 plotOptions: {
         series: {
            pointStart: Date.UTC(<?php echo $y1; ?>, <?php echo $m1; ?>, <?php echo $d1; ?>),
            pointInterval: 24 * 3600 * 1000 // one day
        }
    },
	  yAxis: {
                title: {
                    text: ''
                },
                min: 0,
		  
            },
	      tooltip: {
                formatter: function() {
                        return  '<b>'+ Highcharts.dateFormat('%A', this.x) +'</b><br/>'+
									Highcharts.dateFormat('%b %e,%Y', this.x) +':'+ 
									'<b>'+this.y +'</b>';
                }},

      series: [{
                name: 'Pins',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: <?php echo $fi_pinsval; ?>
            }, {
                name: 'Pinners',
                data: <?php echo $fi_pinnersval; ?>
            }, ]
        });
    
});


		</script>
             
<script type="text/javascript">
var templateDir = "<?php bloginfo('template_directory') ?>";
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/exporting.js">  </script>


<div id="pins_pinners" style="width:745px; height: 400px; margin: 0 auto"> </div>


<!-------------------------------graph--------------------------->

</div>
</div>

</div>

	
    
    