const totalizer = {
    id: 'totalizer',
    beforeUpdate: chart => {
        let totals = {}
        let utmost = 0

        chart.data.datasets.forEach((dataset, datasetIndex) => {
            if ((dataset.type == 'bar') && chart.isDatasetVisible(datasetIndex)) {
                utmost = datasetIndex
                dataset.data.forEach((value, index) => {
                    totals[index] = (totals[index] || 0) + value
                })
            }
        })

        chart.$totalizer = {
            totals: totals,
            utmost: utmost
        }
    }
}

var data = [{
    label: 'Net Income',
    data: [165, 160, 180, 170, 150, 155, 180],
    type: 'line',
    pointRadius: 10,
    pointBackgroundColor: '#55ACEE',
    pointBorderColor: '#55ACEE',
    borderColor: '#55ACEE',
    borderDash: [5, 5],
    backgroundColor: 'transparent',
    // this dataset is drawn on top
    order: 0
}, {
    label: 'CAGR',
    data: [120, 125, 130, 135, 140, 145, 150],
    type: 'line',
    pointRadius: 0,
    pointBackgroundColor: '#000',
    pointBorderColor: '#000',
    borderColor: '#000',
    backgroundColor: 'transparent',
    // this dataset is drawn on top
    order: 1
}, {
    label: 'Cabang 1',
    backgroundColor: '#F56190',
    data: [10, 20, 30, 40, 10, 40, 30],
    type: 'bar'
}, {
    label: 'Cabang 2',
    backgroundColor: '#FFA643',
    data: [15, 40, 60, 20, 30, 25, 75],
    type: 'bar'
}, {
    label: 'Cabang 3',
    backgroundColor: '#AAD58B',
    data: [25, 10, 20, 70, 40, 15, 20],
    type: 'bar'
}, {
    label: 'Total',
    data: [0, 0, 0, 0, 0, 0, 0],
    backgroundColor: 'rgba(24,91,62,0)',
    datalabels: {
        formatter: (value, ctx) => {
            const total = ctx.chart.$totalizer.totals[ctx.dataIndex];
            return total
        },
        align: 'end',
        anchor: 'end',
        display: function(ctx) {
            return ctx.datasetIndex === ctx.chart.$totalizer.utmost
        }
    },
    type: 'bar'
}];

var options = {
    responsive: true,
    tooltips: {
        enabled: false
    },
    legend: {
        position: 'bottom',
        display: true,

    },
    plugins: {
        datalabels: {
            display: function(context) {
                return context.chart.isDatasetVisible(context.datasetIndex);
            },
            font: {
                weight: 'bold',
                size: 14
            }
        }
    },
    title: {
        display: false,
        text: ''
    },
    scales: {
        xAxes: [{
            stacked: true
        }],
        yAxes: [{
            stacked: true,
            ticks: {
                beginAtZero: true
            }
        }]
    }
};

// var ctx = document.getElementById("myChart").getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//         datasets: data
//     },
//     options: options,
//     plugins: [totalizer]
// });


