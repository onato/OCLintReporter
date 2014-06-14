<?php
$i=0;
foreach (array_values($results)[0] as $key => $value) {
    $values = "";
    foreach ($results as $buildNumber => $build) {
        if (strlen($values) > 0) {
            $values .= ",";
        }
        $value = $build[$key];
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
                    name: '$key',
                    data: [$values]
                }
EOF;
    };
}
?>      
