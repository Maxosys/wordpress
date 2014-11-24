<?php

	
	// number of pins	
	 
			$pinsval = '';			
			$repinsvalcsv = '';
			$total_count_repins = array();
			
			
			
			foreach($datearr as $key => $val)
			{
				$datearr[$key];
				$condata = $obj->countRePinData($datearr[$key]);			
				$total_count_repins[] = $condata;
				count($condata);			
				$repinsvalcsv.= $condata.',';
				$pinsval .= '['.$condata.'],';
				
			}
				$fi_repinsval = '['.$pinsval.']';
				
					$sumOfREPins = array_sum($total_count_repins);
	//[[0],[6],]
	
	// number of Pinners	 
			$pinnersval = '';
			$repinnersval = '';
			$total_count_repinners = array();
			foreach($datearr as $key => $val)
			{			
				$condata = $obj->countRePinnerData($datearr[$key]);
				$total_count_repinners[] = $condata;
				$repinnersval.= $condata.',';
				$pinnersval .= '['.$condata.'],';				
			}
			 $fi_repinnersval = '['.$pinnersval.']';
			 
			 $sumOfREPinners = array_sum($total_count_repinners);
	//[[0],[6],]	
 
 
		 $repins_avrage = $sumOfREPins/$number_of_day;
		 $repins_avrage =  floor($repins_avrage);
	
		$repinners_avrage = $sumOfREPinners/$number_of_day;
		$repinners_avrage =  floor($repinners_avrage);
?>
<div class="pi_analytic">
<div class="left_antic">
<div class="pins">
<h2>
Repins
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/qus.png" alt="img" border="0" title="Pins are the daily average number of pins from your website." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<h3 style="font-size:33px;font-weight: bold;color: #367CBD;"><?php echo $repins_avrage; ?></h3>
</div>
</div>

<div class="pins pinners">
<h2>
Repinners
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/internal-plugins/analytics/images/o_qus.png" alt="img" border="0" title="Pinners are the daily average number of people who pinned from your website. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<h3 style="font-size:33px;font-weight: bold;color: #C06506;"><?php echo $repinners_avrage; ?></h3>
</div>
</div>


</div>
<div class="right_antic">
<div class="analytic_img">

<!---------------------------graph1------------------------------>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">


$(function () {
    $('#repins_repinners').highcharts({
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
                name: 'Repins',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: <?php echo $fi_repinsval; ?>
            }, {
                name: 'Repinners',
                data: <?php echo $fi_repinnersval; ?>
            }, ]
        });
    
});


		</script>
             
<script type="text/javascript">
var templateDir = "<?php bloginfo('template_directory') ?>";
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/exporting.js">  </script>


<div id="repins_repinners" style="width:745px; height: 400px; margin: 0 auto"> </div>


<!-------------------------------graph--------------------------->

</div>
</div>

</div>

	
    
    