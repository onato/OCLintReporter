<?php

require("inc/Config.php");
require("inc/Module.php");

$filename = $_GET["filename"];

$title = "OCLint Report (" . $filename . ")";
include("inc/header.php");
?>

		<strong><a href="http://docs.oclint.org/en/dev/rules/">OCLint Rule Documentation</a></strong>

		<table class="data">
		</table>

		<?php include("inc/footer.php"); ?>

		<script type="text/javascript">
			var flexigrid;

			<?php include("inc/sorting.js"); ?>
	
			function didSelectRow( celDiv, id ) {
	    		$( celDiv ).click( function() {
	    			console.log(celDiv);
	    			var link = $(celDiv).parent().siblings().last().first().text();
	        		window.location.href = link;
	    		});
			}

			$( document ).ready(function() {
				flexigrid = $('.data').flexigrid(
					{
						url : 'module.php?filename=<?php echo $filename; ?>',
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
		                        display : 'Rule',
		                        name : 'rule',
		                        width : 220,
		                        sortable : true,
		                        process: didSelectRow
		                    }, {
		                        display : 'Priority',
		                        name : 'priority',
		                        width : 35,
		                        sortable : true,
		                        align : 'center',
		                        process: didSelectRow
		                    }, {
		                        display : 'Message',
		                        name : 'message',
		                        width : 400,
		                        sortable : true,
		                        process: didSelectRow
		                    }, {
		                        display : 'Position',
		                        name : 'position',
		                        width : 100,
		                        align : 'left',
		                        process: didSelectRow
		                    }, {
		                        display : 'Link',
		                        name : 'link',
		                        width : 100,
		                        align : 'left',
		                        hide: true
		                    }
		                ]
					});
			});
		</script>
	</body>
</html>
