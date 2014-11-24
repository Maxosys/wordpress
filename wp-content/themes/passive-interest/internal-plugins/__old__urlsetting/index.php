<?php
require_once(dirname(__FILE__)."/classes/userWebAddress.class.php");

add_shortcode("updateurl","gs_update_user_url");
function gs_update_user_url() {
	
	if(!is_user_logged_in()) {
		
		wp_redirect(site_url()."/login/");
		exit();	
	}
	
	if($_POST["action"] == 403) {
		
		$submission = new userWebAddress();
		
		$urlsubmit = sanitize_text_field($_POST["urlsubmit"]);
		
		$message = $submission->set_address($urlsubmit);
	}
	
	$curr_user = get_current_user_id();
	$new_user = new WP_User($curr_user);
	
	ob_start();
	
	if($submission->newaddress) {
		$new_user->user_nicename = $submission->newaddress;	
	}
	
	echo $message;
	?>
    <div id="gsSupportTicketForm">
        <form action="" method="post">
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
           <input type="hidden" name="action" value="403" />
           <div><input type="submit" class="btn btn-large btn-primary" value="Update" style="width:100%;" /></div>
        </form>
    </div>
    <?php
	
	return ob_get_clean();
}
?>