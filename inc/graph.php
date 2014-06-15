        <script type="text/javascript">
$(function () {

    var seriesOptions = [],
            yAxisOptions = [],
            seriesCounter = 0,
            names = [<?php echo $names; ?>],
            colors = Highcharts.getOptions().colors;

    $.each(names, function(i, name) {

        $.getJSON(<?php echo $url; ?>, function(data) {
            seriesOptions[i] = {
                name: name,
                type: 'spline',
                data: data
            };

            // As we're loading the data asynchronously, we don't know what order it will arrive. So
            // we keep a counter and create the chart when all the data is loaded.
            seriesCounter++;
            if (seriesCounter == names.length) {
                createChart();
            }
        });


        // create the chart when all data is loaded
        function createChart() {
            // Create the chart
            $('#container').highcharts('StockChart', {
                chart: {
                    zoomType: 'x'
                },
                title: {
                    text: '<?php echo $title; ?>'
                },
                subtitle: {
                    text: 'Violations per Build'
                },
                legend: {
                    enabled: true
                },
                tooltip: {
                },
                yAxis: {
                    title: {
                        text: 'Number of Violations'
                    },
                    min:0
                },
                rangeSelector: {
                    inputEnabled: $('#container').width() > 480,
                    buttons: [{
                        type: 'day',
                        count: 1,
                        text: '1d'
                    }, {
                        type: 'week',
                        count: 1,
                        text: '1w'
                    }, {
                        type: 'month',
                        count: 1,
                        text: '1m'
                    }, {
                        type: 'month',
                        count: 6,
                        text: '6m'
                    }, {
                        type: 'year',
                        count: 1,
                        text: '1y'
                    }, {
                        type: 'all',
                        text: 'All'
                    }],
                    selected: 3
                },

                series: seriesOptions

            });
        }
    });
});

</script>
