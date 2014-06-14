<?php
include_once("inc/Config.php");
include_once("inc/Module.php");

$reportsDir = $config["REPORTS_DIR"];
$dh  = opendir($reportsDir);
$modules = array();
$buildNumbers = array();
while (false !== ($filename = readdir($dh))) {
    if (strpos($filename,".") === false) {
        $buildNumbers[] = $filename;
    }
}

sort($buildNumbers);

$builds = array();
foreach ($buildNumbers as $buildNumber) {
    $builds[$buildNumber] = modulesInDirectory($config["REPORTS_DIR"].$buildNumber."/");
}

$categories = "";
foreach ($builds as $buildNumber => $build) {
    if (strlen($categories) > 0) {
        $categories .= ",";
    }

    $date = array_values($build)[0]->date;
    $categories .= "'".$date->format($config["DATE_FORMAT_SHORT"])."'";
}

// print_r($buildNumbers);
// exit;



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
                categories: [<?php echo $categories; ?>]
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
include("inc/overviewData.php");
?>      
            ]
        });
    });
    

        </script>

