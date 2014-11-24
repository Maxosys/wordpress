<?php
	
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
	
}	
	$datearr = array_reverse($datearr);
			array_shift($datearr);
	// set starting date 
/*	   
$datearr =  array();

$datearr[] = $date = date('Y-m-d');
for($i=1 ;$i<=15 ;$i++)
{
	$date1 = str_replace('-', '/', $date);
	$tomorrow = date('Y-m-d',strtotime($date1 . "-$i days"));
	$datearr[] = $tomorrow;
}
	$lastarrkey = $i-2;
	
	// set starting date 
	
	$y1 = date('Y',strtotime($datearr[$lastarrkey]));
	$m1 = date('m',strtotime($datearr[$lastarrkey]))-1;
	$d1 = date('d',strtotime($datearr[$lastarrkey]));
	*/
	// end starting date
	
	// number of pins	
			
			$pinsval = '';
			foreach($datearr as $key => $val)
			{
				$datearr[$key];		
				$condata = $obj->countPinData($datearr[$key]);
			
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
				$condata =  $obj->countPinnerData($datearr[$key]);
				$pinnersval .= '['.$condata.'],';
			}
			 $fi_pinnersval = '['.$pinnersval.']';
	//[[0],[6],]	
 
?>
<div class="pi_analytic">
<div class="left_antic">
<div class="pins">
<h2>
Impression
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/qus.png" alt="img" border="0" title="Pins are the daily average number of pins from your website." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/b_zero.png" alt="img" border="0" /></a>
</div>
</div>

<div class="pins pinners">
<h2>
Reach
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/o_qus.png" alt="img" border="0" title="Pinners are the daily average number of people who pinned from your website. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/o_zero.png" alt="img" border="0" /></a>
</div>
</div>


</div>
<div class="right_antic">
<div class="analytic_img">

<!---------------------------graph1------------------------------>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">


$(function () {
    $('#impression_reach').highcharts({
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
                name: 'Impression',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: <?php echo $fi_pinsval; ?>
            }, {
                name: 'Reach',
                data: <?php echo $fi_pinnersval; ?>
            }, ]
        });
    
});


		</script>
             
<script type="text/javascript">
var templateDir = "<?php bloginfo('template_directory') ?>";
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/exporting.js">  </script>


<div id="impression_reach" style="width:745px; height: 400px; margin: 0 auto"> </div>


<!-------------------------------graph--------------------------->

</div>
</div>

</div>

	
    
    