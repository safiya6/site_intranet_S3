function graphiqueDoughnut(Id, json) {
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
           label: "quotite departement",
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
   });
}