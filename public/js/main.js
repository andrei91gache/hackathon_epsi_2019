var ctx1 = document.getElementById('production_actuelle').getContext('2d');


new Chart(ctx1, {
    type: 'line',
    // The data for our dataset
    data: {
        labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] ,
        datasets: [
            {
                label: "Production d'energie solaire",
                borderColor: "#ff9900",
                data: [15,0,8,155,22,35,78]
            },
            {
                label: "Consumation d'energie solaire",
                borderColor: "#ff0a10",
                data: [25,88,30,0,2,12,3]
            },
        ]
    },
    // Configuration options go here
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    suggestedMin: 0,
                    suggestedMax: 500
                }
            }]
        }
    }
});


