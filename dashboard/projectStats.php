<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap-->
    <link type="text/css" rel="stylesheet" href="/dashboard/dashboard.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>

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
                  <div class="usersAssigned">
                    
                    
                        <div class="user">admin</div>
                        <div class="user">j.anderson2-21</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        <div class="user">lorem</div>
                        
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
grabProjectStats();
</script>
<script>
const elems = document.querySelectorAll("#after0, #after1, #after2, #after3");
elems.forEach((elem) => {
    elem.addEventListener("mouseover", (e) => {
        const info =document.getElementById("taskinfo");
        info.innerHTML = elem.innerHTML;
        $.ajax({
            type: "POST",
            url: "admin/grabTasksByStatus.php",
            data: {
                projectID: localStorage.getItem("chosenProject"),
                status: elem.innerHTML
            },
            success: function (response) {
                if (response != "false") {
                    const data = JSON.parse(response);
                    data.forEach((task) => {
                        info.innerHTML += "<div class='miniTaskInfo'>" + task.taskName + "</div>";
                    });
                } else {
                   info.innerHTML = elem.innerHTML + " has no tasks";
                }
            }
        });
       
    });
});

</script>

</html>