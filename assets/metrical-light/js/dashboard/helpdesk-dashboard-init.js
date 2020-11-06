$(function() {
    
    window.Apex = {
        stroke: {
            width: 1
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
    var g = function(j) {
        var m = j.slice();
        var l = m.length,
            k, i;
        while (0 !== l) {
            i = Math.floor(Math.random() * l);
            l -= 1;
            k = m[l];
            m[l] = m[i];
            m[i] = k
        }
        return m
    };
    var c = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];
    var h = {
        chart: {
            type: "area",
            height: 60,
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
            data: g(c)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#f44242"],
    };
    var f = {
        chart: {
            type: "area",
            height: 60,
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
            data: g(c)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#EE8CE5"],
    };
    var d = {
        chart: {
            type: "area",
            height: 60,
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
            opacity: 0.3
        },
        series: [{
            data: g(c)
        }],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        yaxis: {
            min: 0
        },
        colors: ["#04CAD0"],
    };
    var b = {
        chart: {
            type: "area",
            height: 60,
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
            opacity: 0.3
        },
        series: [{
            data: g(c)
        }],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        yaxis: {
            min: 0
        },
        colors: ["#F49917"],
    };
    var h = new ApexCharts(document.querySelector("#countSpark1"), h);
    h.render();
    var f = new ApexCharts(document.querySelector("#countSpark2"), f);
    f.render();
    var d = new ApexCharts(document.querySelector("#countSpark3"), d);
    d.render();
    var b = new ApexCharts(document.querySelector("#countSpark4"), b);
    b.render();
    var a = {
        chart: {
            height: 350,
            type: "line",
            stacked: false,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
        },
        stroke: {
            width: [1, 2, 3, 5],
            curve: "smooth"
        },
        plotOptions: {
            bar: {
                columnWidth: "25%"
            }
        },
        colors: ["#65e0e0", "#e4eaff", "#66a4fb", "#f49917"],
        series: [{
            name: "New Tickets",
            type: "column",
            data: [23, 11, 22, 27, 13, 22, 37, 21, 44, 22, 30]
        }, {
            name: "Solved Tickets",
            type: "area",
            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        }, {
            name: "Opened Tickets",
            type: "bar",
            data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
        }, {
            name: "Unresolved Tickets",
            type: "line",
            data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
        }],
        fill: {
            opacity: [0.85, 0.25, 1],
            gradient: {
                inverseColors: false,
                shade: "light",
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ["01/01/2003", "02/01/2003", "03/01/2003", "04/01/2003", "05/01/2003", "06/01/2003", "07/01/2003", "08/01/2003", "09/01/2003", "10/01/2003", "11/01/2003"],
        markers: {
            size: 0
        },
        xaxis: {
            type: "datetime"
        },
        yaxis: {
            min: 0
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(i) {
                    if (typeof i !== "undefined") {
                        return i.toFixed(0) + ""
                    }
                    return i
                }
            }
        },
        legend: {
            labels: {
                useSeriesColors: true
            },
        }
    };
    var e = new ApexCharts(document.querySelector("#supportTicketchart"), a);
    e.render()
});