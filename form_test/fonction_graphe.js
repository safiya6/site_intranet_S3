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
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8A2BE2'], // You can customize the colors
                }],
            },
        });
     
}

  
  
        
