<?php

require("inc/Config.php");
require("inc/Module.php");

$reportName = $_GET["reportName"];

$title = "OCLint Report (" . $reportName . ")";
include("inc/header.php");

$module = new Module();
$module->deserialize($config["REPORTS_DIR"].$reportName.".json");
?>
		<div id="highcharts-container" style="min-width: 600px; height: 400px; margin: 0 auto"></div>
		<table class="overview">
			<thead>
				<tr>
					<th width="100">Name</th>
					<th width="80">Number of Files</th>
					<th width="70">Violations/File</th>
					<th width="100">Files with Violations</th>
					<th width="50">Priority 1</th>
					<th width="50">Priority 2</th>
					<th width="50">Priority 3</th>
					<th width="200">Date</th>
					<th width="200">Rules</th>
				</tr>
			</thead>
			<tr>
				<td><?php echo($module->name); ?></td>
				<td><?php echo($module->numberOfFiles); ?></td>
				<td><?php echo($module->ratio); ?></td>
				<td><?php echo($module->filesWithViolations); ?></td>
				<td><?php echo($module->priority1); ?></td>
				<td><?php echo($module->priority2); ?></td>
				<td><?php echo($module->priority3); ?></td>
				<td><?php echo($module->date->format($config["DATE_FORMAT_LONG"])); ?></td>
				<td><a href="http://docs.oclint.org/en/dev/rules/">OCLint Rule Documentation</a></td>
			</tr>
		</table>

		<table class="data">
		</table>

		<?php include("inc/footer.php"); ?>

		<script type="text/javascript">
			<?php include("inc/sorting.js"); ?>
	
			var prompt;
			function didSelectRow( celDiv, id ) {
	    		$( celDiv ).click( function() {
	    			var link = $(celDiv).parent().siblings().last().first().text();
	    			var filename = link.split("/").pop().split("-").shift();
	    			filename = filename.replace("#L", ":");

	    			if (navigator.platform == "MacIntel") {
	    				var promptOptions = {
							title: "Open your project in Xcode<br/>Shift-Command-O (⇧⌘O) <br/>Paste this text.",
							buttons: {
								confirm: {
									label: "Show this violation in Github"
								}
							},
							value:filename,
							callback: function(result) {                
								if (result !== null) {                                             
									window.location.href = link;
								}
							}
						};

						prompt = bootbox.prompt(promptOptions);
						$("input.bootbox-input.bootbox-input-text.form-control").focus(function(){
							this.select();
						});
	    			}else{
	    				window.location.href = link;
	    			}
	    		});
			}
			$(document).on("keypress", function(e) {
				if ( e.metaKey && ( e.which === 99 ) ) {
					setTimeout(function() {
						prompt.modal("hide");
					}, 500);
				}
			});

			$( document ).ready(function() {
				$('.overview').flexigrid({height:25	});
				grid = $('.data').flexigrid(
					{
						url : 'module.php?reportName=<?php echo $reportName; ?>.json',
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

<?php
$names = '"Priotity-1","Priotity-2","Priotity-3"';
$reportsDir = $config["REPORTS_DIR"];
$url = "'data/details/$reportName/'+name+'.json'";
$title = $reportName;
include("inc/graph.php");
?>
	</body>
</html>
