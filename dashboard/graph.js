var data;
$(document).ready(function() {
  let projectID = localStorage.getItem("chosenProject");
  console.log(projectID);
  $.ajax({
    
    url:"../admin/grabProjectStats.php",
    type:"POST",
    data: {projectID : projectID},
    success: function(responseData){
      let temp = JSON.parse(responseData);
      console.log(temp);
      if (temp == false) {
        document.getElementById('chart').innerHTML = `<p><i>Add tasks to see charts</i></p>`;
      }
      localStorage.setItem(`0Count`,0)
      localStorage.setItem(`1Count`,0)
      localStorage.setItem(`2Count`,0)
      localStorage.setItem(`3Count`,0)
      temp.forEach((status) => {  
        if (localStorage.getItem(`${status["status"]}Count`) == 0) {
          localStorage.setItem(`${status["status"]}Count`,1)
        }
        else {
          localStorage.setItem(`${status["status"]}Count`,parseInt(localStorage.getItem(`${status["status"]}Count`)) + 1)
        }
    });
    data = [
      {status: 'To Do', count: localStorage.getItem("0Count")},
      {status: 'In Progress', count: localStorage.getItem("1Count")},
      {status: 'Review', count: localStorage.getItem("2Count")},
      {status: 'Done', count: localStorage.getItem("3Count")}
    ];
      //console.log(data);
        }
    }
  );
  console.log(data);

  setTimeout( () =>                   
  {
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
  }, 1000);
  });
 