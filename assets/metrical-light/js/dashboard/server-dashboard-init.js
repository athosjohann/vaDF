$(function() {
    
    window.Apex = {
        stroke: {
            width: 1
        },
        plotOptions: {
            bar: {
                columnWidth: "25%",
                endingShape: "rounded"
            }
        },
        markers: {
            size: 0
        },
        tooltip: {
            fixed: {
                enabled: true,
            }
        }
    };
    var j = function(r) {
        var u = r.slice();
        var t = u.length,
            s, q;
        while (0 !== t) {
            q = Math.floor(Math.random() * t);
            t -= 1;
            s = u[t];
            u[t] = u[q];
            u[q] = s
        }
        return u
    };
    var p = [47, 25, 54, 30, 56, 24, 50, 20, 47, 25, 54, 30, 56, 24, 50, 20, 47, 25, 54, 30, 56, 24, 50, 20, 47, 25, 54, 30, 56, 24, 50, 20];
    var c = {
        chart: {
            type: "bar",
            height: 100,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            sparkline: {
                enabled: true
            },
        },
        markers: {
            size: 5,
            colors: undefined,
            strokeColors: "#E2ECFE",
            strokeWidth: 2,
            strokeOpacity: 0.9,
            fillOpacity: 1,
            discrete: [],
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
            onClick: undefined,
            onDblClick: undefined,
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        },
        stroke: {
            curve: "straight"
        },
        fill: {
            opacity: 0.3,
        },
        series: [{
            data: j(p)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#f44242"],
    };
    var b = {
        chart: {
            type: "bar",
            height: 100,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            sparkline: {
                enabled: true
            },
        },
        markers: {
            size: 5,
            colors: undefined,
            strokeColors: "#6780B1",
            strokeWidth: 2,
            strokeOpacity: 0.9,
            fillOpacity: 1,
            discrete: [],
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
            onClick: undefined,
            onDblClick: undefined,
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        },
        stroke: {
            curve: "straight"
        },
        fill: {
            opacity: 0.3,
        },
        series: [{
            data: j(p)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#23BF08"],
    };
    var a = {
        chart: {
            type: "bar",
            height: 100,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            sparkline: {
                enabled: true
            },
        },
        markers: {
            size: 5,
            colors: undefined,
            strokeColors: "#fff",
            strokeWidth: 1,
            strokeOpacity: 0.9,
            fillOpacity: 1,
            discrete: [],
            shape: "circle",
            radius: 2,
            offsetX: 0,
            offsetY: 0,
            onClick: undefined,
            onDblClick: undefined,
            hover: {
                size: undefined,
                sizeOffset: 3
            }
        },
        stroke: {
            curve: "straight"
        },
        fill: {
            opacity: 0.3,
        },
        series: [{
            data: j(p)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#F7AF17"],
    };
    var c = new ApexCharts(document.querySelector("#countSpark1"), c);
    c.render();
    var b = new ApexCharts(document.querySelector("#countSpark2"), b);
    b.render();
    var a = new ApexCharts(document.querySelector("#countSpark3"), a);
    a.render();
    $(function() {
        var t = q(new Date("15 Jul 2017").getTime(), 100, {
            min: 10,
            max: 20
        });
        var v = {
            chart: {
                id: "chart2",
                type: "area",
                height: 300,
                fontFamily: "IBM Plex Sans, sans-serif",
                foreColor: "#6780B1",
                toolbar: {
                    autoSelected: "pan",
                    show: false
                }
            },
            colors: ["#f44242"],
            stroke: {
                width: 1
            },
            grid: {
                borderColor: "#C8DCFC",
                clipMarkers: false,
                yaxis: {
                    lines: {
                        show: false
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                gradient: {
                    enabled: true,
                    opacityFrom: 0.5,
                    opacityTo: 0
                }
            },
            markers: {
                size: 5,
                colors: ["#f44242"],
                strokeColor: "#fff",
                strokeWidth: 1
            },
            series: [{
                data: t
            }],
            tooltip: {
                theme: "dark"
            },
            xaxis: {
                type: "datetime"
            },
            yaxis: {
                min: 0,
                tickAmount: 5
            }
        };
        var s = new ApexCharts(document.querySelector("#chart-area"), v);
        s.render();
        var u = {
            chart: {
                id: "chart1",
                height: 220,
                type: "bar",
                fontFamily: "IBM Plex Sans, sans-serif",
                foreColor: "#6780B1",
                brush: {
                    target: "chart2",
                    enabled: true
                },
                selection: {
                    enabled: true,
                    fill: {
                        color: "#84BCFF",
                        opacity: 0.5
                    },
                    xaxis: {
                        min: new Date("27 Jul 2017 10:00:00").getTime(),
                        max: new Date("14 Aug 2017 10:00:00").getTime()
                    }
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: "25%",
                    endingShape: "rounded"
                }
            },
            dataLabels: {
                enabled: false
            },
            colors: ["#f44242"],
            series: [{
                data: t
            }],
            stroke: {
                width: 1
            },
            grid: {
                borderColor: "#C8DCFC"
            },
            markers: {
                size: 0
            },
            xaxis: {
                type: "datetime",
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                tickAmount: 5
            }
        };
        var r = new ApexCharts(document.querySelector("#chart-bar"), u);
        r.render();

        function q(C, D, B) {
            var A = 0;
            var z = [];
            while (A < D) {
                var w = C;
                var E = Math.floor(Math.random() * (B.max - B.min + 1)) + B.min;
                z.push([w, E]);
                C += 86400000;
                A++
            }
            return z
        }
    });
    window.Apex = {
        chart: {
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            toolbar: {
                show: false
            },
        },
        colors: ["#FCCF31", "#17ead9", "#f02fc2"],
        stroke: {
            width: 1
        },
        dataLabels: {
            enabled: true
        },
        grid: {
            borderColor: "#40475D",
        },
        xaxis: {
            axisTicks: {
                color: "#333"
            },
            axisBorder: {
                color: "#333"
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                gradientToColors: ["#F55555", "#6078ea", "#6094ea"]
            },
        },
        tooltip: {
            theme: "dark",
            x: {
                formatter: function(q) {
                    return moment(new Date(q)).format("HH:mm:ss")
                }
            }
        },
        yaxis: {
            decimalsInFloat: 2,
            opposite: true,
            labels: {
                offsetX: -10
            }
        }
    };
    var e = 3;
    var d = 11;

    function l() {
        var q = d;
        return (Math.sin(q / e) * (q / e) + q / e + 1) * (e * 2)
    }

    function f(q) {
        return Math.floor(Math.random() * (q.max - q.min + 1)) + q.min
    }

    function k(u, v, t) {
        var s = 0;
        var r = [];
        while (s < v) {
            var q = u;
            var w = ((Math.sin(s / e) * (s / e) + s / e + 1) * (e * 2));
            r.push([q, w]);
            u += 300000;
            s++
        }
        return r
    }

    function n(r, q) {
        var s = r + 300000;
        return {
            x: s,
            y: Math.floor(Math.random() * (q.max - q.min + 1)) + q.min
        }
    }
    var o = {
        chart: {
            type: "radialBar",
            height: 250,
            offsetY: 0,
            offsetX: 0
        },
        plotOptions: {
            radialBar: {
                size: undefined,
                inverseOrder: false,
                hollow: {
                    margin: 1,
                    size: "48%",
                    background: "transparent",
                },
                track: {
                    show: true,
                    background: "#C8DCFC",
                    strokeWidth: "10%",
                    opacity: 1,
                    margin: 3,
                },
            },
        },
        series: [55, 60],
        labels: ["CPU", "RAM"],
        legend: {
            show: true,
            position: "left",
            offsetX: 0,
            offsetY: 0,
            formatter: function(r, q) {
                return r + " - " + q.w.globals.series[q.seriesIndex] + "%"
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shade: "dark",
                type: "horizontal",
                shadeIntensity: 0.1,
                inverseColors: true,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100]
            }
        },
        stroke: {
            lineCap: "round"
        }
    };
    var h = new ApexCharts(document.querySelector("#circlechart"), o);
    h.render();
    window.setInterval(function() {
        d++;
        h.updateSeries([f({
            min: 10,
            max: 100
        }), f({
            min: 10,
            max: 100
        })])
    }, 3000);
    google.charts.load("current", {
        packages: ["geochart"],
        mapsApiKey: "AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY"
    });
    google.charts.setOnLoadCallback(m);

    function m() {
        var s = google.visualization.arrayToDataTable([
            ["Country", "Popularity"],
            ["Germany", 200],
            ["United States", 300],
            ["Brazil", 400],
            ["Canada", 500],
            ["France", 600],
            ["RU", 700]
        ]);
        var q = {
            colors: ["#5D78FF", "#C9D5FA"],
        };
        var r = new google.visualization.GeoChart(document.getElementById("regionGeoCharts"));
        r.draw(s, q)
    }
    window.Apex = {
        stroke: {
            width: 1
        },
        plotOptions: {
            bar: {
                columnWidth: "25%",
                endingShape: "rounded"
            }
        },
        markers: {
            size: 0
        },
        tooltip: {
            fixed: {
                enabled: true,
            }
        }
    };
    var j = function(r) {
        var u = r.slice();
        var t = u.length,
            s, q;
        while (0 !== t) {
            q = Math.floor(Math.random() * t);
            t -= 1;
            s = u[t];
            u[t] = u[q];
            u[q] = s
        }
        return u
    };
    var p = [147, 125, 154, 130, 156, 124, 150, 120, 147, 125, 154, 154, 130, 156, 124, 150, 120];
    var i = {
        chart: {
            type: "area",
            height: 150,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            curve: "straight"
        },
        fill: {
            opacity: 0.3,
        },
        series: [{
            data: j(p)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#f44242"],
    };
    var g = {
        chart: {
            type: "area",
            height: 150,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            sparkline: {
                enabled: true
            },
        },
        stroke: {
            curve: "straight"
        },
        fill: {
            opacity: 0.3,
        },
        series: [{
            data: j(p)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#23BF08"],
    };
    var i = new ApexCharts(document.querySelector("#areaSpark1"), i);
    i.render();
    var g = new ApexCharts(document.querySelector("#areaSpark2"), g);
    g.render()
});