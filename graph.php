<?php

$reportsDir = $config["REPORTS_DIR"];
$dh  = opendir($reportsDir);
$modules = array();
$builds = array();
while (false !== ($filename = readdir($dh))) {
    if (strpos($filename,".") === false) {
        $builds[] = $filename;
    }
}

sort($builds);

$results = array();
foreach ($builds as $buildNumber) {
    $module = new Module();
    $module->deserialize($buildNumber."/".$reportName);
    $result = array();
    $result["priority1"] = $module->priority1;
    $result["priority2"] = $module->priority2;
    $result["priority3"] = $module->priority3;
    $results[$buildNumber] = $result;
}

$builds = "";
foreach ($results as $buildNumber => $build) {
    if (strlen($builds) > 0) {
        $builds .= ",";
    }
    $builds .= "'".$buildNumber."'";
}

?>

        <script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Violations per Build'
            },
            subtitle: {
                text: '<?php echo pathinfo($reportName)["filename"]; ?>'
            },
            legend: {
                align: 'left',
                verticalAlign: 'top',
                y: 20,
                floating: true,
                borderWidth: 0
            },
            tooltip: {
                shared: true,
                crosshairs: true
            },
            xAxis: {
                categories: [<?php echo $builds; ?>]
            },
            yAxis: {
                title: {
                    text: 'Number of Violations'
                },
                min:0
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [
<?php
$i=0;
foreach (array_values($results)[0] as $key => $value) {
    if ($i++>0) {
        echo ",";
    }

    $values = "";
    foreach ($results as $buildNumber => $build) {
        if (strlen($values) > 0) {
            $values .= ",";
        }
        $values .= "".$build[$key]."";
    }
    echo <<< EOF

                {
                    name: '$key',
                    data: [$values]
                }
EOF;
}
?>      
            ]
        });
    });
    

        </script>

