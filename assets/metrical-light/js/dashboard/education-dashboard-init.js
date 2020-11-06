$(function() {
    
    var a = {
        chart: {
            height: 280,
            type: "line",
            stacked: false,
            fontFamily: "IBM Plex Sans, sans-serif",
            foreColor: "#6780B1",
            toolbar: {
                show: false,
            }
        },
        stroke: {
            width: [1, 2, 3],
            curve: "smooth"
        },
        plotOptions: {
            bar: {
                columnWidth: "25%",
                endingShape: "rounded"
            }
        },
        colors: ["rgba(0, 204, 204, .2)", "rgba(248, 127, 186, .2)", "rgba(152, 194, 252, .2)"],
        series: [{
            name: "Total Income",
            type: "area",
            data: [5, 15, 5, 20, 10, 20, 15, 5, 20, 15, 25]
        }, {
            name: "Total Expense",
            type: "area",
            data: [10, 10, 15, 5, 15, 10, 10, 15, 5, 20, 15]
        }, {
            name: "Total Target",
            type: "area",
            data: [15, 5, 15, 10, 20, 15, 5, 15, 10, 25, 20]
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
            size: 3
        },
        xaxis: {
            type: "datetime"
        },
        yaxis: {
            min: 0
        },
        tooltip: {
            y: {
                formatter: function(c) {
                    return " $" + c
                }
            }
        },
        legend: {
            labels: {
                useSeriesColors: false
            },
        }
    };
    var b = new ApexCharts(document.querySelector("#projectsBudgetChaart"), a);
    b.render();
    var a = {
        chart: {
            height: 350,
            type: "radar",
        },
        series: [{
            name: "Science",
            data: [80, 50, 30, 40, 100, 20],
        }, {
            name: "Arts",
            data: [20, 30, 40, 80, 20, 80],
        }, {
            name: "Commerce",
            data: [44, 76, 78, 13, 43, 10],
        }],
        labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    };
    var b = new ApexCharts(document.querySelector("#topicsRadarChart"), a);
    b.render()
});