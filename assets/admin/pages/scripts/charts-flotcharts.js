var ChartsFlotcharts = function() {

    return {
        initPieCharts: function (total, completed, accept, pending) {
            var data = [];
            series = 3;
            data = [{label: "Completeness", data: completed * 100 / total, color: "#578ebe"}, {
                label: "Accepted",
                data: accept * 100 / total,
                color: "#26c281"
            }, {label: "Pending", data: pending * 100 / total, color: "#e26a6a"}];

            if ($('#pie_static').size() !== 0) {
                $.plot($("#pie_static"), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: true,
                                radius: 3 / 4,
                                formatter: function (label, series) {
                                    return '<div style="font-size:8pt;text-align:center;padding:1px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                },
                                background: {
                                    color: series.background,
                                    opacity: 0.5
                                }
                            }
                        }
                    },
                    legend: {
                        show: false
                    },
                    combine: {
                        color: series.color
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
        },
        initLineCharts: function (datas) {
            if (!jQuery.plot) {
                return;
            }
            function chart2(datas) {
                if ($('#series_chart').size() != 1) {
                    return;
                }

                window.tickX = [];
                window.tickY = [];


                for(i = 0 ; i < datas.length; i++){
                    window.tickX.push([i, datas[i][0]]);
                    window.tickY.push([i, datas[i][1]]);
                }
                var plot = $.plot($("#series_chart"), [
                {
                    data: tickY,
                    label: "Orders",
                    lines: {
                        lineWidth: 1,
                    },
                    shadowSize: 0

                }
                ], {
                    series: {
                        lines: {
                            show: true,
                            lineWidth: 2,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.05
                                }, {
                                    opacity: 0.01
                                }]
                            }
                        },
                        points: {
                            show: true,
                            radius: 2,
                            lineWidth: 1
                        },
                        shadowSize: 2
                    },
                    grid: {
                        hoverable: true,
                        clickable: false,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    },
                    colors: ["#d12610", "#37b7f3", "#52e136"],
                    xaxis: {
                        ticks: window.tickX,
                        tickDecimals: 0,
                        tickColor: "#eee",
                    },
                    yaxis: {
                        ticks: 11,
                        tickDecimals: 0,
                        tickColor: "#eee",
                    }
                });


                function showTooltip(x, y, contents) {
                    $('<div id="tooltip">' + contents + '</div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y + 5,
                        left: x + 15,
                        border: '1px solid #333',
                        padding: '4px',
                        color: '#fff',
                        'border-radius': '3px',
                        'background-color': '#333',
                        opacity: 0.80
                    }).appendTo("body").fadeIn(200);
                }

                var previousPoint = null;
                $("#series_chart").bind("plothover", function (event, pos, item) {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;
                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(0),
                                y = item.datapoint[1].toFixed(0);
                            showTooltip(item.pageX, item.pageY, y + " orders " + " in " + window.tickX[parseInt(x)][1]);
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }
            if(typeof datas == "undefined"){
                return;
            }

            var data_array=[];
            for(i = 0; i < datas.length; i++){
                var data_item = $.map(datas[i], function(el) { return el });
                data_array.push(data_item)
            }

            chart2(data_array);
        },
    };

}();