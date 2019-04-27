var ctx1 = document.getElementById('production_actuelle').getContext('2d');
var ctx2 = document.getElementById('consumation_actuelle').getContext('2d');

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

new Chart(ctx2, {
    type: 'line',
    // The data for our dataset
    data: {
        labels: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] ,
        datasets: [
            {
                label: "Consumation d'energie solaire",
                borderColor: "#ff9900",
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