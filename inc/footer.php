
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script type="text/javascript" src="Flexigrid/js/flexigrid.js"></script>
        <script src="js/vendor/highstocks/js/highstock.src.js"></script>
		<script src="js/vendor/highstocks/js/modules/exporting.js"></script>
        <script src="js/plugins.js"></script>
        

        <script type="text/javascript">
	        // Little hack to automatically call the data updater script. 
	        // This could cause problems when the amount of data increses.
	        $.getJSON("update.php", function(data) {});
		</script>
