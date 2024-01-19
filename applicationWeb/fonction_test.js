/* Fonction pour créer un graphique Doughnut */
function graphiqueDoughnut(Id, json, label, titre) {
    var jsonData = json;

    if (jsonData && jsonData.length > 0) {
        // Récupérez tous les éléments avec la classe 'graph-container-parent'
        var graphParents = document.getElementsByClassName('graph-container-parent');

        // Créez la div du graphique
        var graphContainer = document.createElement('div');
        graphContainer.className = 'graph-container';

        var titleElement = document.createElement('h1');
        titleElement.textContent = titre;
        graphContainer.appendChild(titleElement);

        // Créez le canvas
        var canvasElement = document.createElement('canvas');
        canvasElement.id = Id;
        canvasElement.className = "canva";

        // Ajoutez le canvas à la div
        graphContainer.appendChild(canvasElement);

        // Ajoutez la div au premier élément avec la classe 'graph-container-parent'
        graphParents[0].appendChild(graphContainer);

        var labels = jsonData.map(function (item) { return item.label; });
        var data = jsonData.map(function (item) { return item.data; });

        // Obtenez le contexte 2D du canvas
        var ctxCercle = document.getElementById(Id).getContext('2d');

        // Configuration des données pour le graphique Doughnut
        var doughnutData = {
            labels: labels,
            datasets: [{
                label: label,
                data: data,
                backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 205, 86, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)'],
                borderWidth: 1
            }]
        };

        // Création du graphique Doughnut
        var graphiqueCercle = new Chart(ctxCercle, {
            type: 'doughnut',
            data: doughnutData,
            options: {
                responsive: true,
            }
        });
    } else {
        console.error("Aucune donnée disponible pour créer le graphique Doughnut.");
    }
}

/* Fonction pour créer un graphique Camembert */
function graphiqueCamenbert(Id, json, titre) {
    var jsonData = json;

    if (jsonData && jsonData.length > 0) {
        // Utilisez la fonction createGraphContainer pour créer le conteneur du graphique
        var ctx = createGraphContainer(Id, titre);

        var labels = jsonData.map(function(item) { return item.label; });
        var percentages = jsonData.map(function(item) { return parseInt(item.data, 10); });

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: percentages,
                    backgroundColor: ['#FF6384', '#36A2EB', '#008000', '#FF00FF','#FFA500','#FF0000','#0000FF','#00FF00','#FFFF00'],
                }],
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Changer la couleur du texte ici
                        }
                    }
                } 
            }
        });
    } else {
        console.error("Aucune donnée disponible pour créer le graphique Camembert.");
    }
}

/* Fonction pour créer un graphique avec deux labels (Camembert) */
function graphiqueCamenbert2label(Id, json, titre, label1, label2) {
    var jsonData = json;

    if (jsonData) {
        // Utilisez la fonction createGraphContainer pour créer le conteneur du graphique
        var ctx = createGraphContainer(Id, titre);

        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [label1, label2],
                datasets: [{
                    data: [jsonData.label, jsonData.data],
                    backgroundColor: ['#FF6384', '#36A2EB'],
                }],
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                        },
                    },
                },
            },
        });
    } else {
        console.error("Aucune donnée disponible pour créer le graphique Camembert.");
    }
}

/* Fonction pour créer un graphique Bar */
function graphiqueBar(Id, json, label1, label2, titre) {
    var jsonData = json;

    if (jsonData && jsonData.length > 0) {
        // Utilisez la fonction createGraphContainer pour créer le conteneur du graphique
        var ctx = createGraphContainer(Id, titre);

        var labels = jsonData.map(function(item) {
            return item.label;
        });

        var totalServStatutaire = jsonData.map(function(item) {
            return item.datax;
        });

        var totalServComplementaire = jsonData.map(function(item) {
            return item.datay;
        });

        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: label1,
                    data: totalServStatutaire,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                }, {
                    label: label2,
                    data: totalServComplementaire,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                        ticks: {
                            color: 'white' // Changer la couleur du texte de l'axe X ici
                        }
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            color: 'white' // Changer la couleur du texte de l'axe X ici
                        }
                    },
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'white' // Changer la couleur du texte ici
                        }
                    }
                }
            },
        });
    } else {
        console.error("Aucune donnée disponible pour créer le graphique Bar.");
    }
}

/* Fonction pour créer un graphique de Barres Horizontales */
function graphiqueBarresHorizontales(Id, json, titre) {
    var jsonData = json;

    // Vérifiez si les données nécessaires sont présentes
    if (jsonData && jsonData.length > 0) {
        // Utilisez la fonction createGraphContainer pour créer le conteneur du graphique
        var ctx = createGraphContainer(Id, titre);

        // Extraire les disciplines et les départements uniques
        var disciplines = [...new Set(jsonData.map(item => item.datay))];
        var departements = [...new Set(jsonData.map(item => item.label))];

        // Préparer les ensembles de données
        var datasets = [];
        departements.forEach((dept, index) => {
           
