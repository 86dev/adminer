<?php

$PLUGINS_LIST = [
	(object)[
		'file' => './plugins/tables-filter.php',
		'class' => 'AdminerTablesFilter',
	],
	(object)[
		'file' => './plugins/bootstrap-like.php',
		'class' => 'AdminerBootstrapLike',
	],
	(object)[
		'file' => './plugins/edit-foreign.php',
		'class' => 'AdminerEditForeign',
	],
	(object)[
		'file' => './plugins/foreign-system.php',
		'class' => 'AdminerForeignSystem',
	],
	(object)[
		'file' => './plugins/login-sqlite.php',
		'class' => 'AdminerLoginSqlite',
	],
	(object)[
		'file' => './plugins/floatThead.php',
		'class' => 'AdminerFloatThead',
	],
	(object)[
		'file' => './plugins/edit-calendar.php',
		'class' => 'AdminerEditCalendar',
	],
	(object)[
		'file' => './plugins/dump-json.php',
		'class' => 'AdminerDumpJson',
	],
	(object)[
		'file' => './plugins/dump-yaml.php',
		'class' => 'AdminerDumpYaml',
	],
	(object)[
		'file' => './plugins/dump-alter.php',
		'class' => 'AdminerDumpAlter',
	],
	(object)[
		'file' => './plugins/json-column.php',
		'class' => 'AdminerJsonColumn',
	],
];

function adminer_object() {
	include_once "./plugins/plugin.php";

	global $PLUGINS_LIST;
	foreach ($PLUGINS_LIST as $plugin) {
		require_once $plugin->file;
		$plugins[] = new $plugin->class();
	}

	return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
error_reporting(0);
include "./adminer-4.8.1.php";
?>