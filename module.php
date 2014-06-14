<?php
header('Content-Type: application/json');

require("inc/Config.php");
require("inc/Module.php");

$reportName = $_GET["reportName"];
$sortBy = "priority";
if (isset($_POST["sortname"])) {
	$sortBy = $_POST["sortname"];
}
$ascending = true;
if (isset($_POST["sortorder"]) && $_POST["sortorder"]=="desc") {
	$ascending = false;
}


$module = new Module();
$module->deserialize($config["REPORTS_DIR"].$reportName);
$count = count($module->violations);

echo <<< EOF
{"page":1,"total":$count,"rows":[
EOF;

// print_r($module);
$GITHUB_ROOT = $config["GITHUB_ROOT"];
$isFirst = true;

$violations = sortViolations($module->violations);


foreach ($violations as $violation) {

	if (!$isFirst) {
		echo ",";
	}
	$isFirst = false;

	$gitHubLink = "$GITHUB_ROOT$violation->path#L$violation->startLine";
	$basename = basename($violation->path);
		echo <<< EOF

    {
    	"id": "$basename",
    	"cell": {
	    	"name": "$basename",
	    	"path": "$violation->path",
	    	"link": "$violation->link",
	    	"position":"$violation->startLine($violation->startColumn) - $violation->endLine($violation->endColumn)",
	    	"rule":"{$violation->rule}",
	    	"priority":{$violation->priority},
	    	"message":"{$violation->message}"
    	}
    }
EOF;
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



function sortViolations($violations) {
	usort($violations, "cmp");
	return $violations;
}


?>
]}