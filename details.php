<?php

require("inc/Config.php");
require("inc/Module.php");

$filename = $_GET["filename"];

$title = "OCLint Report (" . $filename . ")";
include("inc/header.php");

$module = new Module();
$module->deserialize($filename);
?>
		<table class="overview">
			<thead>
				<th width="100">Name</th>
				<th width="50">Number of Fileß</th>
				<th width="100">Violations/File</th>
				<th width="50">Files with Violations</th>
				<th width="50">Priority 1</th>
				<th width="50">Priority 2</th>
				<th width="50">Priority 3</th>
				<th width="200">Date</th>
				<th width="200">Rules</th>
			</thead>
			<tr>
				<td><?php echo($module->name); ?></td>
				<td><?php echo($module->numberOfFiles); ?></td>
				<td><?php echo($module->ratio); ?></td>
				<td><?php echo($module->filesWithViolations); ?></td>
				<td><?php echo($module->priority1); ?></td>
				<td><?php echo($module->priority2); ?></td>
				<td><?php echo($module->priority3); ?></td>
				<td><?php echo($module->date); ?></td>
				<td><a href="http://docs.oclint.org/en/dev/rules/">OCLint Rule Documentation</a></td>
			</tr>
		</table>

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
				$('.overview').flexigrid({height:25	});
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
