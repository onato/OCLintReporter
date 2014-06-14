<?php
$title = "OCLint Reporter";
include("inc/header.php");
?>	

<table class="data">
</table>
<div id="container" style="min-width: 600px; height: 400px; margin: 0 auto"></div>

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
						sortname : sortArray[0],
	                	sortorder : sortArray[1],
	                	onChangeSort: onChangeSort,
						colModel : [ 
							{
		                        display : 'Name',
		                        name : 'name',
		                        id : 'name',
		                        width : 150,
		                        sortable : true,
		                        align : 'left',
		                        process: didSelectRow
		                    }, {
		                        display : 'Number of Files',
		                        name : 'numberOfFiles',
		                        width : 100,
		                        sortable : true,
		                        align : 'right',
		                        process: didSelectRow
		                    }, {
		                        display : 'Violations/File',
		                        name : 'ratio',
		                        width : 70,
		                        sortable : true,
		                        align : 'right',
		                        process: didSelectRow
		                    }, {
		                        display : 'Files with Violations',
		                        name : 'filesWithViolations',
		                        width : 100,
		                        sortable : true,
		                        align : 'right',
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority 1',
		                        name : 'priority1',
		                        width : 50,
		                        sortable : true,
		                        align : 'left',
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority 2',
		                        name : 'priority2',
		                        width : 50,
		                        sortable : true,
		                        align : 'right',
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority 3',
		                        name : 'priority3',
		                        width : 50,
		                        sortable : true,
		                        align : 'right',
		                        process: didSelectRow
		                	}, {
		                        display : 'Date',
		                        name : 'date',
		                        width : 150,
		                        sortable : true,
		                        process: didSelectRow
		                	} 
		                ],
					});
			});
		</script>
		<script src="js/vendor/highcharts/js/highcharts.js"></script>
		<script src="js/vendor/highcharts/js/modules/exporting.js"></script>
		<?php 
		include("overviewGraph.php"); ?>

</body></html>
