require('./bootstrap');

import Chart from 'chart.js/auto';

const ctx = document.getElementById('tooling-dashboard-chart');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: 'Rate of tooling',
            data: {
                "2017": 2,
                "2018": 4,
                "2019": 9,
                "2020": 5,
                "2021": 12
            },
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
