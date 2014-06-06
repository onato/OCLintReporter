<?php

require("inc/Config.php");
require("inc/Module.php");

$filename = $_GET["filename"];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="Flexigrid/css/flexigrid.css" />
	<style type="text/css">
	.data {width: 100%, }
	</style>

	<script type="text/javascript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="Flexigrid/js/flexigrid.js"></script>
	<script type="text/javascript">
		function didSelectRow( celDiv, id ) {
    		$( celDiv ).click( function() {
    			console.log(celDiv);
    			var link = $(celDiv).parent().siblings().last().first().text();
        		window.location.href = link;
    		});
		}

		$( document ).ready(function() {
			$('.data').flexigrid(
				{
					url : 'module.php?filename=<?php echo $filename; ?>',
	                dataType : 'json',
					height: 600,
					sortname : "priority",
                	sortorder : "asc",
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
			$('.data').parent().css('height',$('#flexigrid').attr ('clientHeight')); 
		});
	</script>

</head>

<body>
<table class="data">
</table>

</body></html>
