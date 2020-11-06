$(function() {
    
    var a = {
        chart: {
            height: 250,
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
                columnWidth: "50%",
            }
        },
        colors: ["#66a4fb", "#65e0e0", "#e4eaff"],
        series: [{
            name: "Total Budget",
            type: "column",
            data: [2523, 2111, 1922, 1827, 2013, 1932, 2037, 3021, 2944, 2522, 2230]
        }, {
            name: "Total Expense",
            type: "area",
            data: [1920, 1855, 1241, 1467, 1722, 1643, 1921, 2341, 2156, 2027, 1943]
        }, {
            name: "Total Target",
            type: "bar",
            data: [4000, 3000, 4000, 3000, 3000, 2500, 3000, 4000, 4500, 4000, 4500]
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
    b.render()
});