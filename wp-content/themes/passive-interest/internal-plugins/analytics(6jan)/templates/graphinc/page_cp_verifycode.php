<?php
/*
Template Name: _verifycode
*/
if (!is_user_logged_in()) { wp_redirect(home_url('/login/?redirect_to=' . home_url('/settings/'))); exit; }

get_header();




$key = 'url_verified';
  $single = true;
  $isverified = get_user_meta( $user_ID, $key, $single ); 
  if($isverified=="yes") {  ?>
  <script>window.location.href="<?php echo site_url(); ?>/analytics";</script>
  <?php   }    ?>


<!------------Pop_UP_scripts starts here------------>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"> </script>		
		
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/pop_up.css" type="text/css" media="screen" />
		
		<style>
		.edit_profile
		{
			float:left;
			width:580px;
			box-shadow:3px 0px 3px #d2d2d2;
		}
		.edit
		{
			width:560px;
			padding:10px;
			float:left;
			border-bottom:1px solid #d2d2d2;
		}
		.edit_profile h1
		{
			font-size:20px;
			font-family:Arial, Helvetica, sans-serif;
			font-weight:bold;
			margin:0px;
			padding:0px;
			float:left;
		}

		.cross_img
		{
			float:right;
		}

.cross_img img
{
	float:left;
	padding: 5px 0;
}

.busines_form
{
	float:left;
}

.busines_form label
{
	float:left;
	width:139px;
	font-size:13px;
	font-family:Arial, Helvetica, sans-serif;
	font-weight:bold;
	margin-top:7px;
   color:#5f5f5d;
}

.t_box
{
	float:left;
	width:399px;
	border:1px solid #d2d2d2;
	padding:7px;
	background:#f3f3f3;
	border-radius:5px 5px 5px 5px;
}
.head
{
	float:left;
	width:139px;
}
.head h2
{
	font-size:13px;
	font-family:Arial, Helvetica, sans-serif;
    margin: 7px 0 0;
	padding:0px;
	font-weight:bold;
   color:#5f5f5d;
}

.pin
{
	float:left;
	background:#116a3a;
	border-radius:3px;
}

.pin img
{
	float:left;
	  padding: 20px 24px;
	
}

.chg_btn
{
	float:left;
}

.chg_btn a
{
	float:left;
	font-size:13px;
	font-family:Arial, Helvetica, sans-serif;
	text-decoration:none;
	color:#fff;
	background:#116a3a;
	border:1px solid #d2d2d2;
	border-radius:3px;
	 margin: 24px 0 0 17px;
	 padding:5px;
	 border-radius:3px;
	
}
.chg_btn a:hover
{
	color:#111;
}

.link
{
	float:left;
}

.link a
{
	float:left;
	font-size:13px;
	font-family:Arial, Helvetica, sans-serif;
	color:#000;
	text-decoration:none;
	margin: 16px 20px 0 0;
}

.t_box1
{
	float:left;
	width:250px;
	border:1px solid #d2d2d2;
	padding:7px;
	background:#f3f3f3;
	border-radius:5px 5px 5px 5px;
}

.textbox
{
	background:#f1f1f1;
	border:1px solid #d2d2d2;
	border-radius:5px;
}

.verify_btn
{
	float:left;
}

.verify_btn a {
    background: none repeat scroll 0 0  #116a3a ;
    border: 1px solid #D2D2D2;
    border-radius: 3px;
    color: #fff;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    margin: 3px 10px 0;
    padding: 5px 15px;
    text-decoration: none;
}
.verify_btn  a:hover
{
	color:#111;
}

.visit_text
{
	float:left;
}
.visit_text h1
{
	margin:0px;
	padding:0px;
	font-size:11px;
	font-family:Arial, Helvetica, sans-serif;
	color:#444446;
}
.visit_text span
{
	color:#df4928;
	
}

.submit_btn
{
	float:right;
	margin-top:7px;
}

.cancel
{
	float:left;
	margin-right:5px;
	
}


.cancel a {
    background: none repeat scroll 0 0  #116a3a ;
    border-radius: 5px;
    color: #5F5F5D;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    padding: 8px 20px;
    text-decoration: none;
	border:1px solid #d2d2d2;
	color:#fff;
}
.cancel a:hover
{
	color:#000;
}
.save
{
	float:left;
}

.save a {
    background: none repeat scroll 0 0  #116a3a ;
    border-radius: 5px;
    color: #5F5F5D;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    padding: 8px 20px;
    text-decoration: none;
	border:1px solid #d2d2d2;
	color:#fff;
}

.save a:hover
{
	color:#000;
}
		</style>
	
		<script  type="text/javascript">
		
		
		/* download start popup */
		//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#popupContact").fadeIn("slow");
		popupStatus = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#popupContact").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact").height();
	var popupWidth = $("#popupContact").width();
	//centering
	$("#popupContact").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
	
}


//CONTROLLING EVENTS IN jQuery
function aaaa()
{
		//disablePopup();
		
		centerPopup();
		//load popup
		loadPopup();
}

$(document).ready(function(){
	
	
	

	//LOADING POPUP
	//Click the button event!
	$("#login").click(function(){
		//centering with css
		centerPopup();
		//load popup
		loadPopup();
	});
	

	
				
	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose").click(function(){
		disablePopup();
	});
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

});
		
		/* end download popup */
		/* start popup*/
		
		//SETTING UP OUR POPUP
//0 means disabled; 1 means enabled;
var popupStatus2 = 0;

//loading popup with jQuery magic!
function loadPopup1(){
	//loads popup only if it is disabled
	if(popupStatus2==0){
		$("#backgroundPopup_2").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup_2").fadeIn("slow");
		$("#popupContact_2").fadeIn("slow");
		popupStatus2 = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup1(){
	//disables popup only if it is enabled
	if(popupStatus2==1){
		$("#backgroundPopup_2").fadeOut("slow");
		$("#popupContact_2").fadeOut("slow");
		//$("#backgroundPopup").fadeOut("slow");
		//$("#popupContact").fadeOut("slow");
		popupStatus2 = 0;
	}
}

//centering popup
function centerPopup1(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContact_2").height();
	var popupWidth = $("#popupContact_2").width();
	//centering
	$("#popupContact_2").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	//only need force for IE6
	
	$("#backgroundPopup_2").css({
		"height": windowHeight
	});
	
}


//CONTROLLING EVENTS IN jQuery
$(document).ready(function(){
	
	//LOADING POPUP
	//Click the button event!
	$("#regis").click(function(){	
	
		//centering with css
		centerPopup1();
		//load popup
		loadPopup1();
	});
	

	
				
	//CLOSING POPUP
	//Click the x event!
	$("#popupContactClose_2").click(function(){
		disablePopup1();
	});
	//Click out event!
	$("#backgroundPopup_2").click(function(){
		disablePopup1();
	});
	//Press Escape event!
	$(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus2==1){
			disablePopup1();
		}
	});

});



function formsubmitwebverify(uid)
{
	var domainurlname =  $('#domainurlname').val();
	//alert(uid);
	//alert(domainurlname);
	
	if(domainurlname!='')
	{
		if(isValidURL(domainurlname))
		{
		
		$.post("<?php echo bloginfo('template_url');  ?>/ajax/VerifiedWebSiteAccordingUser.php/",{uid:uid,domainurlname:domainurlname}).done(function(respurl)
			{	// website verified according to user
				
				//alert(respurl);
				if(respurl==0)
				{			
					$("#responseerro").html("Already Verified By Other User");
				}
				
				else{
					$.post("<?php echo bloginfo('template_url');  ?>/ajax/verifywebsiteformsubmit.php/",{uid:uid,contype:domainurlname}).done(function(resp)
					{
						$("#responseerro").html(" ");
						var res = resp.split(",");
						res[0];
						$("#filenamenameidval").html(res[0]);
						$("#webnamenameidval").html(res[1]);	
				
				// set tag value in input box
						$("#metatagrespid").html(res[4]);

						$("#htmlfilename").val(res[0]);
						var url = "<?php echo bloginfo('template_url'); ?>/download.php?filename="+res[0];	
						
						$("#downloadlinksid").attr("href",url);
						$("#loginidnew").click();
					});
				}
				
			});

				
		}
		else
		{
			$("#responseerro").html("Enter Valid Website");
		}
	}
	else
	{
		$("#responseerro").html("Please Enter Website");
	}
}
function isValidURL(url){
    var RegExp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
	}

	
	function downloadfil()
	{
		var ff = $("#htmlfilename").val();
		
		//alert(ff);
		var url = "<?php echo bloginfo('template_url'); ?>/download.php?filename="+ff;					
		
		
		//window.location.href = url;				
	}
		</script>

	<!------------Pop_UP_scripts ends here------------>
    
    
      <script type="text/javascript">
	function checkisverified(uid)
	{
		var verficationfilename = $('span#filenamenameidval').text();
		var websiteurl = $('span#webnamenameidval').text();
		var metatag_type_id =  $("#metatag_type_id").val();
		
		$.post("<?php echo bloginfo('template_url');  ?>/ajax/isverifiedwebsite.php/",{uid:uid,verifilename:verficationfilename,websitelink:websiteurl,metatag_type_id:metatag_type_id},function(result){
			
			if(result=="Verified") {
				$('.msg').css('color','#063');
				$('.msg').html('website verfied successfully.');
				$('#popupContact_2').fadeOut('slow');
				$('#backgroundPopup_2').fadeOut('slow');
				$("#backgroundPopup").fadeOut("slow");
				$("#popupContact").fadeOut("slow");
				document.location.href='<?php echo bloginfo('siteurl');?>/analytics/';
			}
			else {
				$('.msg').css('color','#F00');
				$('.msg').html('Not Verified.');
			}
		});		
	}
	
	$(document).ready(function(e) {
        $('.do_lator').click(function() {
			$("#backgroundPopup").fadeOut("slow");
				$("#popupContact").fadeOut("slow");
			});
    });
	

// tag link 	
function hideshowlinktag()
{
	$("#taglinkid").hide();
	$("#showlink").hide();
	
	$("#hidelink").show();
	$("#uploadlinkid").show();
	
	$("#metatag_type_id").val("metatag_type");
}
// upload html
function hideshowlinkupload()
{
	$("#taglinkid").show();
	$("#showlink").show();	
	$("#hidelink").hide();
	$("#uploadlinkid").hide();
	$("#metatag_type_id").val("upload_type");
}
	
	</script>
    
    
<div class="container-fluid">

<div class="analytic_conn">
	<div class="analytic_box">
		<h1>Want to see Analytics?</h1>
		<p>Verify your website to view Piformula web analytics and learn<br /> what people are pinning from your domain. </p>
		<div class="anct_btn">
			<a id="regis" href="javascript:;"> Verify My Website </a>
			
			<?php						
			
				$current_user = wp_get_current_user();
			    $id = $current_user->ID;
			    $myrows = $wpdb->get_results("SELECT * FROM wp_users where ID='".$id."' " );
				
			?>
			<?php
				//print_r($_REQUEST);
			?>
		</div>
	</div>	
</div>

<!-- Pop up working-->
<div id="popupContact_2">
		<a id="popupContactClose_2"></a>
        
  
	
<form method="post" action="" id="websitesubmit" >	
		<div class="edit_profile">
<div class="edit">

<h1>Verify Website</h1>

<div class="cross_img">
<img src="<?php echo bloginfo('template_url');  ?>/img/cross.png" border="0" alt="img" />
</div>
</div>
<?php /*?>
<div class="edit">
<div class="head">
<h2>Username Name</h2>
</div>

<div class="link">
	<a href="#"><?php echo $myrows[0]->user_login; ?></a>
</div>

</div>

<div class="edit">
<div class="head">
<h2>About you</h2>
</div>
<textarea rows="5" cols="48" class="textbox">

</textarea>

</div>

<div class="edit">
<div class="head">
<h2>Location</h2>
</div>
<input type="text" name="user"  class="t_box" placeholder=""/>

</div>

<?php */?><div class="edit">
<div class="head">
<h2>Website</h2>
</div>
<input type="text" name="domainurlname" id="domainurlname"  placeholder="" class="t_box1"/>
<div class="verify_btn">
<a href="javascript:;" onclick="formsubmitwebverify('<?php echo $id; ?>');">Verify Website</a>
</div>

</div>
<span id="responseerro" style="color:red;"></span>
<?php /*?>
<div class="edit">
<div class="visit_text" id="responseerro" style="color:red;">
<h1> </h1>
</div>
<!--
<div class="visit_text">
<h1>Visit  <span>Account Setting</span> to change your Password,email<br />address,and Facebook and Twitter Setting.</h1>
</div>
-->

<div class="submit_btn">
<div class="cancel">
<a href="#">Cancel</a>
</div>
<div class="save">
<a href="#" id="saveprofileanalytics">Save Profile</a>
</div>
</div>


</div>

<?php */?></div>

</form>	
        
       
        
        
	</div>
	<div id="backgroundPopup_2"></div>

<!-- end Pop up work-->
<a id="loginidnew" href="#" onclick="aaaa();">  </a>
<!-- download pop up -->

<div id="popupContact">
		<a id="popupContactClose"></a>
			
			<form method="post" action="" id="websitesubmitdownload" >	
		<div class="edit_profile">
<div class="edit">
<h1>Verify Your Website</h1>
<span class="msg" style="margin-left:100px;"></span>
<div class="cross_img">
	<img src="<?php echo bloginfo('template_url');  ?>/img/cross.png" border="0" alt="img" />
</div>
</div>

	<div class="edit">
	
		<div class="head">
			<h2>Why verify?</h2>
		</div>
		<div class="link">
			Verified sites show up on profile and in search results
		</div>

	</div>
<input type="hidden" id="htmlfilename" />

<input type="hidden" id="metatag_type_id" value="upload_type" />

 <div class="edit">
	<div class="head">
		<h2>How to verify</h2>
	</div>	
	<span id="showlink">
		<?php
			include("downloadindex.php");	
		?>	 
		<br/>
		Upload this file (<span id="filenamenameidval"> </span>) to <span id="webnamenameidval"> </span>
	</span>
	<span id="hidelink" style="display:none">
		 <input type="text" size="25" id="metatagrespid" value='<meta name="p:domain_verify" content="2afae4b689555ea05b7e0d82167823e4" />'  />
		 <br/>
		 Add this meta tag to the <head> of your index.html file or equivalent
	</span>
  </div>
<div class="edit">
<div class="visit_text" id="responseerro" style="color:red;">
<h1> </h1>
</div>

<div class="visit_text" id="taglinkid">
	<h1>Can't upload a file? <a href="javascript:;" onclick="hideshowlinktag();" > Verify with a meta tag </a></h1>
</div>
<div class="visit_text" id="uploadlinkid" style="display:none;">
	<h1>Can't use a meta tag? <a href="javascript:;" onclick="hideshowlinkupload();" >  Verify by upload </a></h1>
</div>


<div class="submit_btn">



<div class="cancel">
<a href="#" class="do_lator">Do This Later</a>
</div>
<div class="save">
<?php
$current_user = wp_get_current_user();
$idd = $current_user->ID;
?>
<a href="javascript:;" onclick="checkisverified('<?php echo $idd; ?>');"> Complete Verification </a>
</div>
</div>
</div>

</div>
		</form>	
		
</div>
	
	
	<div id="backgroundPopup"></div>
<!-- end download pop up -->


</div>


 
<?php
//wp_enqueue_script('jquery-form', array('jquery'), false, true);
get_footer();
?>