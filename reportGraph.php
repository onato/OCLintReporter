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
    $module->deserialize($reportsDir.$buildNumber."/".$reportName);
    $result = array();
    $result["Priority 1"] = $module->priority1;
    $result["Priority 2"] = $module->priority2;
    $result["Priority 3"] = $module->priority3;
    $result["Date"] = $module->date;
    $results[$buildNumber] = $result;
}

$builds = "";
foreach ($results as $buildNumber => $build) {
    if (strlen($builds) > 0) {
        $builds .= ",";
    }
    $builds .= "'".$build["Date"]->format($config["DATE_FORMAT_SHORT"])."'";
}

?>

        <script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: '<?php echo pathinfo($reportName)["filename"]; ?>'
            },
            subtitle: {
                text: 'Violations per Build'
            },
            legend: {
            },
            tooltip: {
                shared: true,
                crosshairs: true
            },
            xAxis: {
                title: {
                    text: 'Builds over Time'
                },
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
include("inc/graphData.php");
?>      
            ]
        });
    });
    

        </script>

