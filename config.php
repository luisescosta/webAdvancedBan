<?php
// HORA E DATA LOCAL
// setlocale(LC_ALL, "pt_BR", "pt_BT.utf-8", "portuguese");
// date_default_timezone_set("Brazil/East");

// AUTOLAOD
spl_autoload_register(function ($className){
	$filename = "class".DIRECTORY_SEPARATOR.$className.".class.php";
	if (file_exists($filename)) {
		require_once($filename);
	}
});