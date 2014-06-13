			var grid;

			function onChangeSort(sortname, sortorder){
				window.location.hash = sortname + "-" + sortorder;
				grid.flexReload();
			}

			var hash = window.location.hash;
			var sortArray = hash.substring(1).split("-");
			if (!sortArray[0].length) {
				sortArray = ["ratio","desc"];
			}
