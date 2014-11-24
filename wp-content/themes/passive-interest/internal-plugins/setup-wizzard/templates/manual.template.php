<style>
.wizzard-menu li {
	display: inline-block;
	margin: 0 4px;	
	margin: 0 0.6%;
	width: 12%;	
}
.wizzard-menu {
	width:100%;	
}
.wizzard-menu li a {
	padding: 4px;
	display: block;
}
.video,.paypal,.affiliate,.ourstores,.promotestore,.personal,.emaillist {
	display:none;	
}
.active {
	display: block;	
}
.message-successful {
	border:1px solid #ccc;
	background: #beebd0;
	color: #373737;
	vertical-align: middle;
	margin-bottom: 20px;	
}
.message-successful p {
	padding: 12px;	
	margin:0;
}
/*------MOBILE MENU STUFF-----*/
.wm-mobile{
	position:absolute;
	width:112% !important;
	background-color:transparent;
	padding:5px;
	text-transform:uppercase;
	text-align:center;
	height:50px;
	font-size:16px;
	font-weight:bold;
	margin-left:-3px !important;
	margin-top: -3px !important;
	border:0;
}
@media (max-width: 979px){
.wm-mobile-wrapper{
	display:block;
}
.wizzard-menu {
	display:none;
}	
}
</style>
<script>
jQuery(function($) {
	var hash = window.location.hash;
	
	if(hash) {
		var pages = hash;
		
		$('.active').removeClass("active");
		
		pages = pages.replace("#","");
		$("." + pages).addClass("active");
		
	}
	
	$('.wizzard-menu li a').click(function(e){
		var page = $(this).attr("href");
		
		window.location.hash = $(this).attr('href');
		
		$('.active').removeClass("active");
		
		page = page.replace("#","");
		$("." + page).addClass("active");
		
		e.preventDefault();
		
	});
	
	$('.wm-mobile').bind('click change' , function(e){
		var page = $(this).val();
		window.location.hash = $(this).val();	
		$('.active').removeClass("active");
		$("." + page).addClass("active");
		e.preventDefault();	
	});
	
	setTimeout(function() {
		  $(".message-successful").fadeOut(300);
	}, 6000);
});
</script>
<form action="" method="post">
<ul class="wizzard-menu">
    <li><a href="#video">Welcome Video</a></li>
    <li><a href="#paypal">My Paypal</a></li>
    <li><a href="#affiliate">Affiliate Link</a></li>
    <li><a href="#personal">Profile Link</a></li>
    <li><a href="#ourstores">Our Stores</a></li>
    <li><a href="#promotestore">How to Promote</a></li>
    <li><a href="#emaillist">Email List</a></li>
</ul>
<div class="wm-mobile-wrapper">
    <select class="wm-mobile">
        <option selected="selected" value="video">Welcome Video</option>
        <option value="paypal">My Paypal</option>
        <option value="affiliate">Affiliate Link</option>
        <option value="ourstores">Our Stores</option>
        <option value="promotestore">How to Promote</option>
        <option value="emaillist">Email List</option>
    </select>
</div>
<div class="manual-config" style="text-align:center;">
    <div id="option-1" class="video active">
        <h2>Watch our 5 minute Welcome Video!</h2>
        <p><?php
			 $video_url = get_option("pif_welcome_video");
			 $video_embeded = wp_oembed_get($video_url,array('width' => 1200));		

				if(!empty($video_url)){
				?>
				<script type="text/javascript">
					jQuery(document).ready(function($){
						
						$("iframe").each(resize);
						$(window).resize(function(){
							$("iframe").each(resize);
						});
					
						function resize(){															
							var ifWidth = $(this).width();
							var ifHeight = $(this).height();
							var ratio = 1.7;
						
							if($(this).length > 0){
								var newWidth = $(this).width();
								var newHeight = newWidth/ratio;	
							}
							$(this).height(newHeight);	
						}
					});
				</script>
				<?php
				}
				echo $video_embeded;
				?></p>
        <p><?php echo get_option("pif_welcome_video_extra"); ?></p>
    </div>
    
    <div id="option-2" class="paypal">
        <h2>Paypal Signup</h2>
        <p><?php echo get_option("pif_paypal_description"); ?></p>
        <p><input type="text" name="pif_paypal_id" value="<?php echo get_user_meta(get_current_user_id(),"PAYPALID", true); ?>" placeholder="Paypal ID (email)" /></p>
        <div class="post-comments">
            <input name="pif_user_update" type="hidden" value="1" />
            <input type="submit" id="submit" value="Save" />
        </div>
    </div>
    
    <div id="option-3" class="affiliate">
        <h2>Configure your affiliate link</h2>
        <p><?php echo get_option("pif_afiliate_link"); ?></p>
        <p><input type="text" name="pif_afiliate_id" value="<?php echo get_user_meta(get_current_user_id(),"MEMBERID", true); ?>" placeholder="Member ID or affiliate link" /></p>
        <p>Your affiliate link is: <?php printf(WIZARD_LINK_FOR_MEMBERID, get_user_meta(get_current_user_id(),"MEMBERID", true)); ?></p>
       
        <div class="post-comments">
            <input name="pif_user_update" type="hidden" value="1" />
            <input type="submit" id="submit" value="Save" />
        </div>
    </div>
    <?php
	
	$curr_user = get_current_user_id();
	$new_user = new WP_User($curr_user);
	
	if($submission->newaddress)
	{
		$new_user->user_nicename = $submission->newaddress;	
	}
	if($_POST["urlsubmit"])
	{
		$new_user->user_nicename = sanitize_text_field($_POST["urlsubmit"]);
	}
	?>
    <div id="option-4" class="personal">
        <h2>Configure your personal profile link.</h2>
        <div id="gsSupportTicketForm" style="width: 35%;margin: 0 auto;">
        <div style="border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    height: 20px;
    padding-top: 0px;
    padding-bottom: 20px;
    margin-bottom: 20px;"><span style="color: #096;">http://piformula.com/u/</span><input type="text" name="urlsubmit" style="border: 0;
    box-shadow: none;
    border-radius: 0px;padding-left: 0;
    margin-top: 8px;font-weight:bold;" value="<?php echo $new_user->user_nicename; ?>" placeholder="yournamehere" /></div>
        </div>
       
        <div class="post-comments">
            <input name="pif_user_update" type="hidden" value="1" />
            <input type="submit" id="submit" value="Save" />
        </div>
    </div>
    
    <div id="option-5" class="ourstores">
        <h2>Our Wellness Stores</h2>
        <p><?php echo get_option("pif_our_stores"); ?></p>
    </div>
    
    <div id="option-6" class="promotestore">
        <h2>How to promote your store</h2>
        <p><?php echo get_option("pif_howto_promote"); ?></p>
    </div>
    
    <div id="option-7" class="emaillist">
        <h2>Join our email list</h2>
        <p><?php echo get_option("pif_email_listing"); ?></p>
    </div>
    
</div>




</form>