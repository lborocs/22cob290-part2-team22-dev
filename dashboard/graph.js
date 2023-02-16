



  
  

$(document).ready(function() {
  let projectID = localStorage.getItem("chosenProject");
  console.log(projectID);
  $.ajax({
    
    url:"../admin/grabProjectStats.php",
    type:"POST",
    data: {projectID : projectID},
    success: function(responseData){
      let temp = JSON.parse(responseData);
      localStorage.setItem("0Count", temp[0]['status']);
      localStorage.setItem("1Count", temp[1]['status']);
      localStorage.setItem("2Count", temp[2]['status']);
      localStorage.setItem("3Count", temp[3]['status']);
      
      //console.log(data);
        }
    }
  );
  var data = [
    {status: 'To Do', count: localStorage.getItem("0Count")},
    {status: 'In Progress', count: localStorage.getItem("1Count")},
    {status: 'Review', count: localStorage.getItem("2Count")},
    {status: 'Done', count: localStorage.getItem("3Count")}
  ]
  console.log(data);
  new Chart(
    document.getElementById('myDoughnut'),
    {
      type: 'doughnut',
      data: {
        labels: data.map(row => row.status),
        datasets: [
          {
            label: 'Tasks by Status',
            backgroundColor: [
              '#dc3545',
              '#ffc107',
              '#17a2b8',
              '#28a745'
            ],
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
  new Chart(
    document.getElementById('myRadar'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.status),
        datasets: [
          {
            label: 'Tasks by Status',
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 205, 86)',
              'rgb(54, 162, 235)',
              'rgb(75, 192, 192)',
            ],
            borderWidth: 1,
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
  });
 