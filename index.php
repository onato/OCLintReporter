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
	<script type="text/javascript" src="Flexigrid/js/flexigrid.pack.js"></script>
	<script type="text/javascript">
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
					height: 600,
					sortname : "ratio",
                	sortorder : "desc",
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
	                        width : 100,
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
	                } ],
				});
			$('.data').parent().css('height',$('#flexigrid').attr ('clientHeight')); 
		});
	</script>

</head>

<body>
<table class="data">
</table>

</body></html>
