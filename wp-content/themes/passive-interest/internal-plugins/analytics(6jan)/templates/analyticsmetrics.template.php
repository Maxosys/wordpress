
<?php 
$user_id = get_current_user_id();
$data = get_user_meta($user_id);


if(!empty($data['website_url'][0])):
$website_url = $data['website_url'][0];
endif;
?>
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
<a href="#">Calender</a>
</div>
<div class="anltic_nav">
<ul>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=analyticsmetrics" class="current" >Site Metrics</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostrecent" >Most Recent</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostreppined">Most Repinned</a></li>
					<li><a href="#">Most Clicked</a></li>

<li>
<input type="button" class="export_btn" value="export" />
</li>
</ul>
</div>


</div>

<?php
// pins and pinners
	//get_template_part('index', 'analytics1');
	
	include_once('index-analytics1.php');
?>
<?php
//exit;
// repins and repinners
	//get_template_part('index', 'analytics2');
	
?>

<div class="pi_analytic">
<div class="left_antic">

<div class="pins">
<h2>
Repins
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/qus.png" alt="img" border="0" title="Repins are the daily average number of times pins from your website were repinned on Pinterest. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/b_zero.png" alt="img" border="0" /></a>
</div>
</div>

<div class="pins pinners">
<h2>
Repinners
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_qus.png" alt="img" border="0" title="Repinners are the daily average number of people who repinned your pins. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_zero.png" alt="img" border="0" /></a>
</div>
</div>


</div>
<div class="right_antic">
<div class="analytic_img">
<!---------------------------graph2------------------------------>

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
                 day: '%y/%e %a'
		   
            }
        },
	 plotOptions: {
         series: {
            pointStart: Date.UTC(2013, 11, 2),
            pointInterval: 48 * 3600 * 1000 // one day
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
                data: [
                    [ 0],
                    [1],
                    [4],
                    [3],
                    [2],
                    [6],
                    [6],
                    [2],
                    [1],
                    [0],
                    [0],
                    
                ]
            }, {
                name: 'Repinners',
                data: [
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                    [0],
                   
                ]
            }, ]
        });
    
});


		</script>
             


<div id="repins_repinners" style="width:745px; height: 400px; margin: 0 auto"></div>


<?php /*?><img src="<?php bloginfo('template_url');?>/images/analytic.png" alt="img" border="0" /><?php */?>
</div>
</div>


</div>

<div class="pi_analytic">
<div class="left_antic">

<div class="pins">
<h2>
Impression
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/qus.png" alt="img" border="0" title="Impressions are the daily average number of times your pins appeared on Pinterest in the main feed, in search results, or on on boards." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/b_zero.png" alt="img" border="0" /></a>
</div>
</div>

<div class="pins pinners">
<h2>
Reach
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_qus.png" alt="img" border="0" title="Reach are the daily average number of people who saw your pins on Pinterest." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_zero.png" alt="img" border="0" /></a>
</div>
</div>
</div>
<div class="right_antic">
<div class="analytic_img">
<!-----------------Graph3---------------->
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
                 day: '%y/%e %a'
		   
            }
        },
	 plotOptions: {
         series: {
            pointStart: Date.UTC(2013, 11, 2),
            pointInterval: 48 * 3600 * 1000 // one day
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
                name: 'impression',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [
                    [3],
                    [1],
                    [1],
                    [3],
                    [3],
                    [2],
                    [3],
                    [3],
                    [3],
                    [2],
                    [1],
                    
                ]
            }, {
                name: 'reach',
                data: [
                    [9],
                    [5],
                    [3],
                    [1],
                    [2],
                    [1],
                    [6],
                    [3],
                    [3],
                    [1],
                    [6],
                   
                ]
            }, ]
        });
    
});


		</script>
             


<div id="impression_reach" style="width:745px; height: 400px; margin: 0 auto"></div>
<!--------------------Graph3------------->
<?php /*?><img src="<?php bloginfo('template_url');?>/images/analytic.png" alt="img" border="0" /><?php */?>
</div>
</div>
</div>

<div class="pi_analytic">
<div class="left_antic">

<div class="pins">
<h2>
Clicks
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/qus.png" alt="img" border="0" title="Clicks are the daily average number of clicks to your website that came from Pinterest. " /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/b_zero.png" alt="img" border="0" /></a>
</div>
</div>

<div class="pins pinners">
<h2>
Visitors
</h2>
<div class="pin_qus">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_qus.png" alt="img" border="0" title="Visitors are the daily average number of people who visited your website from Pinterest." /></a>
</div>
<div class="clear"></div>
<div class="pin_zero">
<a href="#"><img src="<?php bloginfo('template_url');?>/images/o_zero.png" alt="img" border="0" /></a>
</div>
</div>


</div>
<div class="right_antic">
<div class="analytic_img">
<!-----------------Graph3---------------->
<script type="text/javascript">


$(function () {
    $('#click_visitors').highcharts({
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
                 day: '%y/%e %a'
		   
            }
        },
	 plotOptions: {
         series: {
            pointStart: Date.UTC(2013,11,14),
            pointInterval: 48 * 3600 * 1000 // one day
        }
    },
	  yAxis: {
                title: {
                    text: ''
                },
                min: 0
		 
            },
	      tooltip: {
                formatter: function() {
                        return  '<b>'+ Highcharts.dateFormat('%A', this.x) +'</b><br/>'+
									Highcharts.dateFormat('%b %e,%Y', this.x) +':'+ 
									'<b>'+this.y +'</b>';
                }},

      series: [{
                name: 'CLICK',
                // Define the data points. All series have a dummy year
                // of 1970/71 in order to be compared on the same x axis. Note
                // that in JavaScript, months start at 0 for January, 1 for February etc.
                data: [                   
                    [7],
                    [3],
                    [3],
                    [5],
                    [2],
                    [1],
                    [4],
                    [4],
					[3],
					[2],                    
                ]
            }, {
                name: 'VISITORS',
                data: [
                    [2],
                    [0],
                    [0.32],
                    [1],
                    [2],
                    [1.3],
                    [1.6],
                    [1.36],
                    [0.32],
                    [0.12],                   
                ]
            }, ]
			
        });
    
});


		</script>
             


<div id="click_visitors" style="width:745px; height: 400px; margin: 0 auto"></div>
<!--------------------Graph3------------->
<?php /*?><img src="<?php bloginfo('template_url');?>/images/analytic.png" alt="img" border="0" /><?php */?>
</div>
</div>


</div>


</div>
</div>



<script src="<?php echo get_template_directory_uri(); ?>/js/exporting.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/highcharts.js"></script>
