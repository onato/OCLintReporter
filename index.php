<?php
$title = "OCLint Reporter";
include("inc/header.php");
?>	

<table class="data">
</table>

		<?php include("inc/footer.php"); ?>

		<script type="text/javascript">
			var flexigrid;

			<?php include("inc/sorting.js"); ?>
	
			function didSelectRow( celDiv, id ) {
	    		$( celDiv ).click( function() {
	        		window.location.href = "details.php?filename="+id;
	    		});
			}

			$( document ).ready(function() {
				$('.data').flexigrid(
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

</body></html>