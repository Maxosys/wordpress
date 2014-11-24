<?php
global $submission, $code;

class UserConfigGeneric {
	function parse_user_config() {
		$data = $_POST;
		if(!isset($_POST['pif_user_update'])) return false;
		
		foreach($data as $entry => $value) {
			
			if($entry == "pif_paypal_id") {
				update_user_meta(get_current_user_id(), "PAYPALID", $value);
			}
				
			if($entry == "pif_afiliate_id" && $this->check_config_memberid($value)) {
				update_user_meta(get_current_user_id(), "MEMBERID", $this->check_config_memberid($value));
			}
			
			if($entry == "urlsubmit") {
				$submission = new userWebAddress();
		
				$urlsubmit = sanitize_text_field($_POST["urlsubmit"]);
				
				$message = $submission->set_address($urlsubmit);	
				
				$code = $submission->code;
			}
				
		}
		
		
		echo $message;
		
		return true;
	}
	
	// Check member id, convert to member id if URL
	function check_config_memberid($input = "") {
		if($input == "") return false; // no input? no save
		$return = $input; // default to member id
		$results = array();
		preg_match("/http:\/\/www\.passiveincome4life.org\/d\.cgi\/(.*)\/home\.html/i", $input, $results);
		//die(var_dump($results));
		if(count($results)>0) { $return = $results[1]; } // 0 is the whole string, 1 is first match
		return $return;
	}
} // end class

?>