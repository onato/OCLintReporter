<?php
date_default_timezone_set('Europe/Vienna');

$config["REPORTS_DIR"] = dirname(__FILE__)."/../reports/";
$config["ARCHIVE_DIR"] = $config["REPORTS_DIR"] . "archive/";
$config["ROOT"] = "/Users/Shared/Jenkins/Home/workspace/Toursprung/Module/TSRouteStats/";
$config["GITHUB_ROOT"] = "https://github.com/toursprung/MTKmobile/blob/Develop/";

$config["DATE_FORMAT_LONG"] = "G:i F j Y";
$config["DATE_FORMAT_SHORT"] = "F j G:i";

// Call the script to update.php the archived graph data each time the start page is opened.
$config["AUTO_UPDATAE_DATA"] = true; 
?>
