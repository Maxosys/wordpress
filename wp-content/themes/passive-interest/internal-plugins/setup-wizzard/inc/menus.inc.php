<?php
// Menu items
add_action("admin_menu", "add_menu_items");
function add_menu_items() {
	add_menu_page("Wizard Setup", "Wizard Setup", "activate_plugins", "wizardsetup", array("AdminConfigPanel", "Run") );
}


?>