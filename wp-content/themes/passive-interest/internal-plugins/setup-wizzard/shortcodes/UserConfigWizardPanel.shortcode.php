<?php

class UserConfigWizardPanel extends UserConfigGeneric {

	// return the config wizard
	function Run() {
		
		$generic = new UserConfigGeneric();
		$generic->parse_user_config();
		
		ob_start();
	
		require_once(CONFIG_WIZARD_PATH."/templates/wizard.template.php");

		return ob_get_clean();
	} // end print_config_wizard

} // end class

add_shortcode(SHORTCODE_WIZARD_CONFIG_PANEL, array("UserConfigWizardPanel","Run"));

?>