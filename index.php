<?php
$title = "OCLint Reporter";
include("inc/header.php");
include("inc/Module.php");
?>	

<table class="data">
</table>
<div id="highcharts-container" style="min-width: 320px; height: 400px; margin: 0 auto"></div>

		<?php include("inc/footer.php"); ?>

		<script type="text/javascript">
			<?php include("inc/sorting.js"); ?>
	
			function didSelectRow( celDiv, id ) {
	    		$( celDiv ).click( function() {
	        		window.location.href = "details.php?reportName="+id;
	    		});
			}

			$( document ).ready(function() {
				grid = $('.data').flexigrid(
					{
						url : 'overview.php',
		                dataType : 'json',
						height: "auto",
						width: "auto",
						sortname : sortArray[0],
	                	sortorder : sortArray[1],
	                	onChangeSort: onChangeSort,
						colModel : [ 
							{
		                        display : 'Name',
		                        name : 'name',
		                        id : 'name',
		                        width : 100,
		                        sortable : true,
		                        align : 'left',
		                        process: didSelectRow
		                    }, {
		                        display : '#Files',
		                        name : 'numberOfFiles',
		                        width : 40,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                    }, {
		                        display : 'With Violations',
		                        name : 'filesWithViolations',
		                        width : 50,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                    }, {
		                        display : 'Violations/File',
		                        name : 'ratio',
		                        width : 70,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority 1',
		                        name : 'priority1',
		                        width : 40,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority 2',
		                        name : 'priority2',
		                        width : 40,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority 3',
		                        name : 'priority3',
		                        width : 40,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                	}, {
		                        display : 'Date',
		                        name : 'date',
		                        width : 100,
		                        sortable : true,
		                        process: didSelectRow
		                	} 
		                ],
					});
			});
		</script>
<?php
$names = "";
$reportsDir = $config["REPORTS_DIR"];
$modules = modulesInDirectory($reportsDir);
foreach ($modules as $key => $module) {
    if (strlen($names) > 0) {
        $names .= ",";
    }

    $names .= "'".$module->name."'";
}
$url = "'data/overview/'+name+'.json'";
$title = pathinfo($reportName)["filename"];
include("inc/graph.php");
?>


<?php 
  if ($config["AUTO_UPDATAE_DATA"]) {
?>
        <script type="text/javascript">
	        // Little hack to automatically call the data updater script. 
	        // This could cause problems when the amount of data increses.
	        // It would be better to call this from you continuous integration server.
	        $.getJSON("update.php", function(data) {});
		</script>
<?php
  }
?>
</body></html>
