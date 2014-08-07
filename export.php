<?php

require("inc/Config.php");

copy("http://localhost:8080/OCLintReporter/index.php", "export/index.html");

makeDir("export/overview");
$columns = array("name", "numberOfFiles", "filesWithViolations", "ratio", "priority1", "priority2", "priority3", "date");
foreach ($columns as $column) {
	foreach (array("asc", "desc") as $order) {
		$destination = "export/overview/" . $column . "-" . $order . ".json";
		echo $destination."<br>";
		copy("http://localhost:8080/OCLintReporter/overview.php?sortname=".$column."&sortorder=".$order, $destination);
	}
}

recurse_copy("data", "export/data");
recurse_copy("css", "export/css");
recurse_copy("js", "export/js");
recurse_copy("reports", "export/reports");

$dh  = opendir(".");
$modules = array();
while (false !== ($filename = readdir($dh))) {
    // $files[] = $filename;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($ext != "php" && $ext != "") {
	    if (strpos($filename, ".git") !== 0 && strpos($filename, ".DS_Store") !== 0) {
			copy("http://localhost:8080/OCLintReporter/".$filename, "export/".$filename);
	    }
    }
}




function makeDir($path) {
	if (!file_exists($path)) {
	    if (!@mkdir($path, 0777, true)) {
		    $error = error_get_last();
		    print_r($error);
		}
	}
}

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 
?>