<?php

$currentModules = modulesInDirectory($config["REPORTS_DIR"]);
foreach ($currentModules as $moduleName => $module) {
    $values = "";
    $buildCount = 0;
    foreach ($builds as $buildNumber => $buildsModules) {
        if (strlen($values) > 0) {
            $values .= ",";
        }
        $currentModule = $buildsModules[$moduleName];

        // print_r($currentModule);exit;
        $value = $currentModule->numberOfViolations;
        if (gettype($value) == "integer") {
            $values .= "".$value."";
        }
    }
    if (strlen($values) > 0 ) {
        if ($i++>0) {
            echo ",";
        }
    echo <<< EOF

                {
                    name: '$moduleName',
                    data: [$values]
                }
EOF;
    };
}

?>
