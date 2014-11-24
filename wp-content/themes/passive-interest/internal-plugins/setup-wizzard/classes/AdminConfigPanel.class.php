<?php
// This is the master config for the whole wizzard process

class AdminConfigPanel {
	

	function Run() {
	
		$tab = $_GET["tab"];
		// do the processing
		if(isset($_POST['pif_admin_update'])) {
			foreach($_POST as $entry => $value) {
				if(substr($entry, 0, 4) == "pif_") {
					// HTML5 html entities , ignore quotes (for other flags check php documentation)
					if($entry == "pif_email_listing") $value = (stripslashes($value));
					update_option($entry, stripslashes($value));
				}
			}
			
			echo "<div class='updated'><p>".WIZARD_ADMIN_SETTINGS_UPDATED."</p></div>";
		}
		
	
		ob_start();	
	
		require_once(CONFIG_WIZARD_PATH."/templates/adminconfig.template.php");
		
		ob_flush();
		
		return true;
	
	} // end print_admin_config_panel

} // end class

?>