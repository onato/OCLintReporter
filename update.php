<?php
include_once("inc/Config.php");
include_once("inc/Module.php");

$reportsDir = $config["REPORTS_DIR"];
$archiveDir = $config["ARCHIVE_DIR"];

$modules = modulesInDirectory($reportsDir);
$firstModule = array_values($modules)[0];

foreach ($modules as $key => $tmpModule) {
	$filename = $tmpModule->filename;
	$dh  = opendir($archiveDir);
	$buildNumbers = array();
	$summaryValues = array();
	$detailsValues = array();
	while (false !== ($buildNumber = readdir($dh))) {
	    if (strpos($buildNumber,".") === false) {
	    	$content = "";
			$module = new Module();
			$module->deserializeSummary($archiveDir.$buildNumber."/".$filename);
			$moduleForBuildTime = new Module();
			$moduleForBuildTime->deserializeSummary($archiveDir.$buildNumber."/".$firstModule->filename);

			$timestamp = $moduleForBuildTime->date->getTimestamp()*1000;
			$summaryValues[$timestamp] = $module->numberOfViolations;
			$detailValues[$timestamp] = array(
				"Priotity-1"=>$module->priority1,
				"Priotity-2"=>$module->priority2,
				"Priotity-3"=>$module->priority3);
	    }
	}

	$moduleForBuildTime->deserializeSummary($reportsDir.$firstModule->filename);
	$timestamp = $moduleForBuildTime->date->getTimestamp()*1000;
	$module->deserializeSummary($reportsDir.$filename);
	$summaryValues[$timestamp] = $module->numberOfViolations;
	$detailValues[$timestamp] = array(
		"Priotity-1"=>$module->priority1,
		"Priotity-2"=>$module->priority2,
		"Priotity-3"=>$module->priority3);


	// print_r($summaryValues);
	ksort($summaryValues);
	ksort($detailValues);
	// print_r($values);

	writeOverview($summaryValues, $filename);
	writeDetail($detailValues, $filename);
}

function writeOverview($values, $filename) {
	$path = "data/overview/".$filename;
	$arrayValues = array();
	foreach ($values as $key => $value) {
		$arrayValues[] = array($key, $value);
	}
	$json = json_encode($arrayValues, JSON_PRETTY_PRINT);
	file_put_contents($path, $json, LOCK_EX);
}

function writeDetail($values, $filename) {
    $info = pathinfo($filename);
	$name = basename($filename,'.'.$info['extension']);
	$path = "data/details/".$name."/";
	if (!file_exists($path)) {
	    if (!@mkdir($path, 0777, true)) {
		    $error = error_get_last();
		    print_r($error);
		}
	}

	foreach (array_values($values)[0] as $key => $value) {
		$arrayValues = array();
		foreach ($values as $timestamp => $data) {
			$arrayValues[] = array($timestamp, $data[$key]);
		}
		$json = json_encode($arrayValues, JSON_PRETTY_PRINT);
		file_put_contents($path.$key.".json", $json, LOCK_EX);
	}
}

?>