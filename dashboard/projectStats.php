<!DOCTYPE html>
<html lang="en">

<head>
    <!--Bootstrap-->
    <link type="text/css" rel="stylesheet" href="/dashboard/dashboard.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.1/chart.umd.js"
        integrity="sha512-vCUbejtS+HcWYtDHRF2T5B0BKwVG/CLeuew5uT2AiX4SJ2Wff52+kfgONvtdATqkqQMC9Ye5K+Td0OTaz+P7cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

            <div class="topContainer">
                <div class="userContainer">
                    Users
                    <div id="usersAssigned" class="usersAssigned">





                    </div>
                </div>
                <div class="middleContainer">
                    <button class="backButton" onclick="navclick('/dashboard/adminDashboard.php'); location.reload();">Return to
                        Dashboard</button>
                    <button class="projectButton" onclick="viewproject();">View Project</button>
                </div>
                <div class="deadlineContainer">
                    Deadline
                    <div id="statsdeadlineStats" >
                        <h6 id="statsdeadline"></h6>
                        <div class="progress" style="width:80%; margin-inline:auto; margin-block:0;">
                            <div id="statsdeadlineMeter" class="progress-bar bg-danger" style="width: 100%"></div>
                        </div>
                       
                        <h6 id="statscountdown"></h6>
                       
                    </div>
                </div>

            </div>
            <div id = "chart" class="chartContainer">
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
    grabUsersByProject(localStorage.getItem("chosenProject"));

    grabDeadline(localStorage.getItem("chosenProject"));

    function viewproject() {

        navclick("/productivity/projects.php");
    }
</script>


</html>