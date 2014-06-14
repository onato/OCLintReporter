<?php
header('Content-Type: application/json');

require("inc/Config.php");
require("inc/Module.php");



$dh  = opendir($config["REPORTS_DIR"]);
$modules = array();
while (false !== ($filename = readdir($dh))) {
    // $files[] = $filename;
    $ext = pathinfo($config["REPORTS_DIR"].$filename, PATHINFO_EXTENSION);
    if ($ext == "json") {
	    $module = new Module();
	    $module->deserializeSummary($filename);
		$modules[$filename] = $module;
    }
}

$sortBy = "ratio";
if (isset($_POST["sortname"])) {
	$sortBy = $_POST["sortname"];
}
$ascending = false;
if (isset($_POST["sortorder"]) && $_POST["sortorder"]=="asc") {
	$ascending = true;
}

function cmp($a, $b)
{
	global $sortBy, $ascending;
    if ($a == $b) {
        return 0;
    }

    $one = 1;
    if (!$ascending) {
    	$one *= -1;
    }
    return ($a->$sortBy < $b->$sortBy) ? -$one : $one;
}

usort($modules, "cmp");


$count = count($modules);
echo <<< EOF
{"page":1,"total":$count,"rows":[
EOF;

$isFirst = true;
foreach ($modules as $filename => $module) {
	 // print_r($sumary);
	$ratio = $module->ratio;
	if (!$isFirst) {
		echo ",";
	}
	$isFirst = false;
	echo <<< EOF

    {
    	"id": "$module->name",
    	"cell": {
	    	"name": "$module->name",
	    	"numberOfFiles": "$module->numberOfFiles",
	    	"ratio":$ratio,
	    	"filesWithViolations":{$module->filesWithViolations},
	    	"priority1":{$module->priority1},
	    	"priority2":{$module->priority2},
	    	"priority3":{$module->priority3},
	    	"date":"{$module->date}"
    	}
    }
EOF;

}

	    // echo $filename."<br/>";

?>
]}