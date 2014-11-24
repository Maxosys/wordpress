<style>
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

@media (max-width: 979px){

}
</style>
<script>
jQuery(function($) {
	
	function wizardnextprevdisplay() {
	if(!$(".active").prev(".wizarditem").length) { $("#wizardprev").hide(); $(".usersubmit").show(); }
	else { $("#wizardprev").show(); $(".usersubmit").hide(); }

	if(!$(".active").next(".wizarditem").length) { $("#wizardnext").hide(); $(".usersubmit").show(); }
	else { $("#wizardnext").show(); $(".usersubmit").hide(); }
	}

	$("#wizardprev").click(function(){
		$(".active").prev(".wizarditem").addClass("active");
		$(".active").next(".active").removeClass("active");
		wizardnextprevdisplay();
	});

	$("#wizardnext").click(function(){
		$(".active").next(".wizarditem").addClass("active");
		$(".active").prev(".active").removeClass("active");
		wizardnextprevdisplay();
	});

	wizardnextprevdisplay();

	setTimeout(function() {
		  $(".message-successful").fadeOut(300);
	}, 6000);
});
</script>
<form action="" method="post">
<div class="manual-config" style="text-align:center;">
    <div id="option-1" class="video active wizarditem">
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
    
    <div id="option-2" class="paypal wizarditem">
        <h2>Paypal Signup</h2>
        <p><?php echo get_option("pif_paypal_description"); ?></p>
        <p><input type="text" name="pif_paypal_id" value="<?php echo get_user_meta(get_current_user_id(),"PAYPALID", true); ?>" placeholder="Paypal ID (email)" /></p>
    </div>
    
    <div id="option-3" class="affiliate wizarditem">
        <h2>Configure your affiliate link</h2>
        <p><?php echo get_option("pif_afiliate_link"); ?></p>
        <p><input type="text" name="pif_afiliate_id" value="<?php echo get_user_meta(get_current_user_id(),"MEMBERID", true); ?>" placeholder="Member ID or affiliate link" /></p>
        <p>Your affiliate link is: <?php printf(WIZARD_LINK_FOR_MEMBERID, get_user_meta(get_current_user_id(),"MEMBERID", true)); ?></p>
    </div>
    <?php
	global $submission;
	$curr_user = get_current_user_id();
	$new_user = new WP_User($curr_user);
	
	if($_POST["urlsubmit"]) {
		$new_user->user_nicename = sanitize_text_field($_POST["urlsubmit"]);	
	}
	?>
    <div id="option-4" class="personal wizarditem">
        <h2>Configure your personal profile link</h2>
        <div id="gsSupportTicketForm" style="width: 75%;
margin: 0 auto;">
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
    </div>
    
    <div id="option-5" class="ourstores wizarditem">
        <h2>Our Wellness Stores</h2>
        <p><?php echo get_option("pif_our_stores"); ?></p>
    </div>
    
    <div id="option-6" class="promotestore wizarditem">
        <h2>How to promote your store</h2>
        <p><?php echo get_option("pif_howto_promote"); ?></p>
    </div>
    
    <div id="option-7" class="emaillist wizarditem">
        <h2>Join our email list</h2>
        <p><?php echo get_option("pif_email_listing"); ?></p>        
    </div>
    
</div>

<div style="text-align:center">
<input type="button" id="wizardprev" value="Previous" />
<input type="button" id="wizardnext" value="Next" />
<input name="pif_user_update" type="hidden" value="1" />
<input type="submit" value="Finish" class="usersubmit" />
</div>

</form>