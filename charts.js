document.addEventListener('DOMContentLoaded', function() {
    // Initial data for the Line and Area Chart
    var optionsLine = {
        series: [
            {
                name: 'FARM A',
                type: 'area',
                data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33, 24]
            },
            {
                name: 'FARM B',
                type: 'line',
                data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43, 30]
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            }
        },
        stroke: {
            curve: 'smooth'
        },
        fill: {
            type: 'solid',
            opacity:  [0.35, 1] // Adjusted opacity for both series
        },
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        markers: {
            size: 0
        },
        yaxis: [
            {
                title: {
                    text: 'Expense',
                },
            },
            {
                opposite: true,
                title: {
                    text: 'Income',
                },
            },
        ],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " Dollars";
                    }
                    return y;
                }
            }
        }
    };

    var chartLine = new ApexCharts(document.querySelector("#chartline"), optionsLine);
    chartLine.render();

    // Radial Bar Chart
    var optionsPie = {
        series: [44, 55, 67, 83, 45],
        chart: {
            height: 350,
            type: 'radialBar'
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '22px',
                    },
                    value: {
                        fontSize: '16px',
                    },
                    total: {
                        show: true,
                        label: 'Total',
                        formatter: function (w) {
                            return 249;
                        }
                    }
                }
            }
        },
        labels: ['Apples', 'Oranges', 'Bananas', 'Berries', 'Grapes'],
    };

    var chartPie = new ApexCharts(document.querySelector("#chartpie"), optionsPie);
    chartPie.render();

    // Column Chart
    var optionsColumn = {
        series: [{
            name: 'Actual',
            data: [{
                x: '2011',
                y: 1292,
                goals: [{
                    name: 'Expected',
                    value: 1400,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2012',
                y: 4432,
                goals: [{
                    name: 'Expected',
                    value: 5400,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2013',
                y: 5423,
                goals: [{
                    name: 'Expected',
                    value: 5200,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2014',
                y: 6653,
                goals: [{
                    name: 'Expected',
                    value: 6500,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2015',
                y: 8133,
                goals: [{
                    name: 'Expected',
                    value: 6600,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2016',
                y: 7132,
                goals: [{
                    name: 'Expected',
                    value: 7500,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2017',
                y: 7332,
                goals: [{
                    name: 'Expected',
                    value: 8700,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            },
            {
                x: '2018',
                y: 6553,
                goals: [{
                    name: 'Expected',
                    value: 7300,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                }]
            }]
        }],
        chart: {
            height: 350,
            type: 'bar'
        },
        plotOptions: {
            bar: {
                columnWidth: '70%'
            }
        },
        colors: ['#00E396'],
        dataLabels: {
            enabled: false
        },
        legend: {
            show: true,
            showForSingleSeries: true,
            customLegendItems: ['Actual', 'Expected'],
            markers: {
                fillColors: ['#00E396', '#775DD0']
            }
        }
    };

    var chartColumn = new ApexCharts(document.querySelector("#chartcolumn"), optionsColumn);
    chartColumn.render();
});
