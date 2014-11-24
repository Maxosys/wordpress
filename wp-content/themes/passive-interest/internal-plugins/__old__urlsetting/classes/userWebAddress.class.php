<?php
/* Set my page URL 
* TODO : 
* Create a function to randomize the page's name based on what the user inputs
* Create a failsafe checker for every day usage, 1 time a day should be enough -- if errors are reported we can run it and fix it.
*/
class userWebAddress {
	
	public $newaddress;
	
	// Set the address given by the user
	function set_address($address) {
		global $wpdb;
		
		if($this->check_address($address)) {
			$msg["code"] = 12;
			$msg["error"]["text"] = '<div id="gsSupportTicketSubmitted" class="alert">That url is already taken, please choose another one.</div>';
		} else {
			
			$user_ID = get_current_user_id();
			
			$sql = mysql_query("update ".$wpdb->base_prefix."users set user_nicename = '".$address."' where ID = '".$user_ID."'");
			
			if($sql) {
				$msg["code"] = 10;
				$msg["success"]["text"] = '<div id="gsSupportTicketSubmitted" class="alert alert-success">Updated URL successfully. Enjoy your new address!</div>';	
				$this->newaddress = $address;
			} else {
				$msg["code"] = 13;
				$msg["error"]["text"] = '<div id="gsSupportTicketSubmitted" class="alert">There has been a problem saving your request. Please try again.</div>';
			}
			
		}
		
		return $this->get_code($msg);
	}
	// Check the address given
	function check_address($address) {
		global $wpdb;
		
		$sql = mysql_query("select * from ".$wpdb->base_prefix."users where user_nicename = '".$address."'");
		if(mysql_num_rows($sql)) {
			return true;	
		}
		else {
			return false;
		}
	}
	
	// Display message for the code given
	function get_code($code) {
		
		$msg = "";
		
		switch($code["code"]) {
			
			case 10 :
				$msg = $code["success"]["text"];
				break;
			
			case 12 :
				$msg = $code["error"]["text"];
				break;
			
			case 13 :
				$msg = "[ERROR ".$code["code"]."] : ".$code["error"]["text"];
				break;
				
		}
		
		return $msg;
	}
}
?>