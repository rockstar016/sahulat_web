var ChartsFlotcharts = function() {

    return {
        //main function to initiate the module

        init: function() {
            // initPieCharts();
        },
        initPieCharts: function(total, completed, accept, pending) {
            var data = [];
            series = 3;
            data = [{label:"Completeness", data:completed*100 / total, color:"#578ebe"},{label:"Accepted", data:accept*100 / total,color:"#26c281"},{label:"Pending", data:pending*100 / total,color:"#e26a6a"}];

            if ($('#pie_chart_3').size() !== 0) {
                $.plot($("#pie_chart_3"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 3 / 4,
                                formatter: function(label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:1px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                background: {
                                    color:series.background,
                                    opacity: 0.5
                                }
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    combine: {
                        color:series.color
                    }
                });
            }

            function pieHover(event, pos, obj) {
                if (!obj)
                    return;
                percent = parseFloat(obj.series.percent).toFixed(2);
                $("#hover").html('<span style="font-weight: bold; color: ' + obj.series.color + '">' + obj.series.label + ' (' + percent + '%)</span>');
            }

            function pieClick(event, pos, obj) {
                if (!obj)
                    return;
                percent = parseFloat(obj.series.percent).toFixed(2);
                alert('' + obj.series.label + ': ' + percent + '%');
            }

        }

    };

}();