<?php
error_reporting(E_ALL);

function adminer_object() {
	// required to run any plugin
	include_once "./plugins/plugin.php";

	// autoloader
	foreach (glob("./plugins/*.php") as $filename) {
		include_once "./$filename";
	}

	$plugins = array(
		// specify enabled plugins here
		new AdminerTablesFilter,
		new AdminerBootstrapLike,
		new AdminerEditForeign,
		new AdminerForeignSystem,
		new AdminerFrames,
		new AdminerLoginSqlite,
		new AdminerFloatThead,
		new AdminerEditCalendar,
		new AdminerDumpJson,
		new AdminerDumpAlter,
		new AdminerJsonColumn,
	);

	/* It is possible to combine customization and plugins:
	class AdminerCustomization extends AdminerPlugin {
	}
	return new AdminerCustomization($plugins);
	*/

	return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer-4.8.1.php";
?>