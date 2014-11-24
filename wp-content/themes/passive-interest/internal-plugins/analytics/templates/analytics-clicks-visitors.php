<?php

		
	// number of clicks	
		
		//print_r($datearr);
		
		
$number_of_day = count($datearr);
	
			$total_count_pins = array();
			
			$clicksval = '';
			$clicksvalcsv = '';
						
			foreach($datearr as $key => $val)
			{
				
				$condata = $obj->countClicksData($datearr[$key]);
				
				
				$total_count_pins[] = $condata;
				
				count($condata);	
					
				$clicksvalcsv.=$condata.',';
				$clicksval .= '['.$condata.'],';
			}
			
 		  $fi_clicksval = '['.$clicksval.']';		



	
	$sumOfPins = array_sum($total_count_pins);
		
	
	// number of clicks	 
			$clickersval = '';
			$clickersvalcsv = '';
			$total_count_pinners = array();
			// days count
			
			
			// end days count
			
			
	foreach($datearr as $key => $val)
	{
		$condata =  $obj->countclickerData($datearr[$key]);
		
		
		$total_count_pinners[] = $condata;
		$clickersvalcsv .= $condata.',';
		$clickersval .= '['.$condata.'],';
	}
		
	
		echo $fi_clickersval = '['.$clickersval.']';
		$sumOfPinners = array_sum($total_count_pinners);
		
	//[[0],[6],]		
	
	 $pins_avrage = $sumOfPins/$number_of_day;
		 $pins_avrage =  floor($pins_avrage);
	
	 $pinners_avrage = $sumOfPinners/$number_of_day;
		$pinners_avrage =  floor($pinners_avrage);
	

?>


<div class="pi_analytic">
<div class="left_antic">
<div class="pins">
<h2>
Clicks
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/qus.png" alt="img" border="0" title="Pins are the daily average number of pins from your website." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<h3 style="font-size:33px;font-weight: bold;color: #367CBD;"><?php echo $pins_avrage; ?></h3>
</div>
</div>

<div class="pins pinners">
<h2>
Visitors
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/o_qus.png" alt="img" border="0" title="Pinners are the daily average number of people who pinned from your website. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<h3 style="font-size:33px;font-weight: bold;color: #C06506;"><?php echo $pinners_avrage; ?></h3>
</div>
</div>


</div>
<div class="right_antic">
<div class="analytic_img">

<!---------------------------graph1------------------------------>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">


$(function () {
    $('#clickers').highcharts({
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
                name: 'Clicks',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: <?php echo $fi_clicksval; ?>
            }, {
                name: 'Visitors',
                data: <?php echo $fi_clickersval; ?>
            }, ]
        });
    
});


		</script>
             
<script type="text/javascript">
var templateDir = "<?php bloginfo('template_directory') ?>";
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/exporting.js">  </script>


<div id="clickers" style="width:745px; height: 400px; margin: 0 auto"> </div>


<!-------------------------------graph--------------------------->

</div>
</div>

</div>

	
    
    