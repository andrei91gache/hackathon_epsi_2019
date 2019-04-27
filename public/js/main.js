var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["5:00", "5:30", "6:00", "6:30", "7:00", "7:30", "8:00", 
        "8:30", "9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", 
        "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", 
        "18:30", "19:00", "19:30", "20:00", "20:30", "21:00" "21:30", "22:00", "22:30", "23:00"],
        datasets: [{
        fill: false,
        lineTension: 0.1,
        backgroundColor: "rgba(75, 192, 192, 0.1)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderCapStyle: 'butt',
        borderDash: [],
        borderDashOffset: 0.0,
        borderJoinStyle: 'mite',
        pointBorderColor: "rgba(75, 192, 192, 1)",
        pointBackgroundColor: "#fff",
        pointBorderWidth: 1,
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "rgba(75, 192, 192, 1)",
        pointHoverBorderColor: "rgba(220, 220, 200, 1)",
        pointHoverBorderWidth: 2,
        pointRadius: 1,
        pointHitRadius: 10,
        data: [0, 0, 0, 0, 0, 3, 4, 5, 7, 9, 
        12, 19, 26, 34, 56, 67, 78, 79, 78, 75, 
        73, 78, 89, 56, 45, 34, 30, 28, 25, 21, 
        16, 12, 9, 4, 3, 0, 0]
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});