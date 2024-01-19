function graphiqueDoughnut(Id, json , titre) {
    //<script>graphiqueDoughnut("graphiqueCercle", <?php echo $_SESSION["quotite"] ; ?>) ;</script>

    //<div id="graph-container" style="width: 300px; height: 300px;">
    //<//canvas width=100px height=100px id="graphiqueCercle"></canvas>    
   //</div>
       var ctxCercle = document.getElementById(Id).getContext('2d');
       var jsonData = json;
       var labels = jsonData.map(function(item) { return item.label; });
       var data = jsonData.map(function(item) { return item.data; });
   
       var doughnutData = {
       labels: labels,
       datasets: [{
           label: titre,
           data: data,
           backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 205, 86, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)'],
           borderWidth: 1
       }]
       };

 
   var graphiqueCercle = new Chart(ctxCercle, {
     type: 'doughnut',
     data: doughnutData,
     options: {
       responsive: true, 
   }
   });} 

   function graphiqueCamenbert(Id,json){
    var jsonData = json;

        var labels = jsonData.map(function(item) { return item.label; });
        var percentages = jsonData.map(function(item) { return parseInt(item.data, 10); });

        var ctx = document.getElementById(Id).getContext('2d');

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: percentages,
                    backgroundColor: ['#FF6384', '#36A2EB', '#008000', '#FF00FF','#FFA500','#FF0000','#0000FF','#00FF00','#FFFF00'], // You can customize the colors
                }],
            },
        });
     
}
function graphiqueBar(Id, json,label1,label2) {
    var jsonData = json;

    var labels = jsonData.map(function(item) {
        return item.label;
    });

    var totalServStatutaire = jsonData.map(function(item) {
        return item.data1;
    });

    var totalServComplementaire = jsonData.map(function(item) {
        return item.data2;
    });

    var ctx = document.getElementById(Id).getContext('2d');

    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: label1,
                data: totalServStatutaire,
                backgroundColor: 'rgba(75, 192, 192, 0.8)', // Vous pouvez personnaliser la couleur
            }, {
                label: label2,
                data: totalServComplementaire,
                backgroundColor: 'rgba(255, 99, 132, 0.8)', // Vous pouvez personnaliser la couleur
            }],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    stacked: true,
                },
            },
        },
    });
}




    
// Fonction pour générer des couleurs aléatoires
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}



function graphiqueBarresHorizontales(Id, json) {
    var jsonData = json;

    // Extraire les disciplines et les départements uniques
    var disciplines = [...new Set(jsonData.map(item => item.label))];
    var departements = [...new Set(jsonData.map(item => item.data2))];

    // Préparer les ensembles de données
    var datasets = [];
    departements.forEach((dept, index) => {
        datasets.push({
            label: dept,
            data: disciplines.map(disc => {
                var item = jsonData.find(item => item.label === disc && item.data2 === dept);
                return item ? item.data1 : 0;
            }),
            backgroundColor: getRandomColor(index) // Utilisez une fonction pour obtenir une couleur différente pour chaque département
        });
    });

    // Configuration du graphique
    var ctx = document.getElementById(Id).getContext('2d');
    var barChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: disciplines,
            datasets: datasets
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: {
                    stacked: true, // Empiler les barres sur l'axe X
                    beginAtZero: true
                },
                y: {
                    stacked: true  // Empiler les barres sur l'axe Y
                }
            }
        }
    });}


