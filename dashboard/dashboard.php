<?php
session_start();

if ($_SESSION['isAdmin'] == 1) {
    header("Location: /dashboard/adminDashboard.php");
    
}

?>
<link type="text/css" rel="stylesheet" href="/dashboard/dashboard.css" />
<script src="dashboard/dashboard.js"></script>

<div class="header">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 5px; padding: 5px;">
                <h1 class="display-4" style="text-align: center;">Dashboard</h1>
            </section>
        </div>
    <div class="float-container">
        
        <div class="float-child" id="userProjectContainer">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
                <h2 class="display-6" style="text-align: center;">Current Assigned Projects:</h2>

                <hr class="my-4">

                <div class="row" id="userProjectOverview" style="overflow-x:hidden;">
                    <script>GrabProjects("<?php echo $_SESSION['email'];?>");</script>
                </div>
            </section>         
        </div>
        <div class="float-child" id="userToDo">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
                <h5 class="display-6" style="text-align: center;">To Do List:</h5>

                <hr class="my-4">

                <div id="userEditor"></div>
                <button style="margin-top: 1em;" class="btn btn-primary" id = "save" value = <?php echo $_SESSION['email'] ?>>Save</button>
            </section>
        </div>
    </div> 


<script type="text/javascript">
    $(document).ready(function() {
        localStorage.setItem("currentPage", "dashboard/dashboard.php");
    });
</script>