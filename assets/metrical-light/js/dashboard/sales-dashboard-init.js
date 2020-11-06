$(function() {
    
    var a = document.getElementById("annualReport");
    new Chart(a, {
        type: "line",
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
            datasets: [{
                label: "Sales Report",
                data: [5, 15, 5, 20, 15, 25],
                backgroundColor: "rgba(0, 204, 204, .2)",
                borderWidth: 1,
                fill: true
            }, {
                label: "Annual Revenue",
                data: [10, 10, 15, 5, 20, 15],
                backgroundColor: "rgba(248, 127, 186, .2)",
                borderWidth: 1,
                fill: true
            }, {
                label: "Total Profit",
                data: [15, 5, 15, 10, 25, 20],
                backgroundColor: "rgba(152, 194, 252, .2)",
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            legend: {
                display: true,
                labels: {
                    display: true,
                    fontFamily: "IBM Plex Sans, sans-serif",
                    fontColor: "#8392a5",
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 11,
                        fontFamily: "IBM Plex Sans, sans-serif",
                        fontColor: "#8392a5",
                        max: 25
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true,
                        fontSize: 11,
                        fontFamily: "IBM Plex Sans, sans-serif",
                        fontColor: "#8392a5",
                    }
                }]
            }
        }
    });
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
    var l = function(p) {
        var s = p.slice();
        var r = s.length,
            q, o;
        while (0 !== r) {
            o = Math.floor(Math.random() * r);
            r -= 1;
            q = s[r];
            s[r] = s[o];
            s[o] = q
        }
        return s
    };
    var n = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];
    var h = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#04CAD0"],
    };
    var d = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#f44242"],
    };
    var c = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        xaxis: {
            crosshairs: {
                width: 1
            },
        },
        yaxis: {
            min: 0
        },
        colors: ["#EE8CE5"],
    };
    var h = new ApexCharts(document.querySelector("#salesSpark1"), h);
    h.render();
    var d = new ApexCharts(document.querySelector("#salesSpark2"), d);
    d.render();
    var c = new ApexCharts(document.querySelector("#salesSpark3"), c);
    c.render();
    var g = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#EE8CE5"],
    };
    var e = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#f44242"],
    };
    var b = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
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
    var g = new ApexCharts(document.querySelector("#orderSpark1"), g);
    g.render();
    var e = new ApexCharts(document.querySelector("#orderSpark2"), e);
    e.render();
    var b = new ApexCharts(document.querySelector("#orderSpark3"), b);
    b.render();
    var j = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#f44242"],
    };
    var i = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
        }],
        yaxis: {
            min: 0
        },
        colors: ["#EE8CE5"],
    };
    var f = {
        chart: {
            type: "area",
            height: 60,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
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
            data: l(n)
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
    var j = new ApexCharts(document.querySelector("#revenueSpark1"), j);
    j.render();
    var i = new ApexCharts(document.querySelector("#revenueSpark2"), i);
    i.render();
    var f = new ApexCharts(document.querySelector("#revenueSpark3"), f);
    f.render();
    var m = {
        chart: {
            height: 330,
            type: "bar",
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#8392a5",
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "50%"
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ["transparent"]
        },
        series: [{
            name: "Net Profit",
            data: [44, 55, 57, 56, 61, 58]
        }, {
            name: "Revenue",
            data: [76, 85, 101, 98, 87, 105]
        }, {
            name: "Free Cash Flow",
            data: [35, 41, 36, 26, 45, 48]
        }],
        colors: ["#66a4fb", "#e4eaff", "#65e0e0"],
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
        },
        yaxis: {
            title: {
                text: "$ (thousands)"
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function(o) {
                    return "$ " + o + " thousands"
                }
            }
        }
    };
    var k = new ApexCharts(document.querySelector("#salesRevenueBarChart"), m);
    k.render()
});