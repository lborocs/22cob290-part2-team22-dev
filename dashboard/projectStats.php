<!DOCTYPE html>
<html lang="en">

<head>
    <!--Bootstrap-->
    <link type="text/css" rel="stylesheet" href="/dashboard/dashboard.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.umd.js" integrity="sha512-vCUbejtS+HcWYtDHRF2T5B0BKwVG/CLeuew5uT2AiX4SJ2Wff52+kfgONvtdATqkqQMC9Ye5K+Td0OTaz+P7cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>document.title = localStorage.getItem("chosenProjectName")</script>
    <script>
        $(document).ready(function () {
            $(".title").append(localStorage.getItem("chosenProjectName"));
        });

    </script>
        <script src="dashboard/dashboard.js"></script>
        

</head>

<body>
    <div class="mainContainer">
        <div class="title"></div>
        <div class="boxContainer">
            <div class="userContainer">
                Users
                  <div id="usersAssigned"class="usersAssigned">
                    
                    
                        
                        
                        
                    </div>
                  </div>
            
            <div class="deadlineContainer">
                Deadline
                <div class="overallDeadline"></div>
                <div class="nextDeadline"></div>
            </div>
           
                <div class="chartContainer">
                    <canvas id="myDoughnut"></canvas>
                    <canvas id="myRadar"></canvas>
                </div>
                <script type="module" src="dashboard/graph.js"></script>
                </div>
           
        </div>
    </div>

</body>
<script>
grabUsersByProject(localStorage.getItem("chosenProject"));
grabProjectStats();
</script>


</html>