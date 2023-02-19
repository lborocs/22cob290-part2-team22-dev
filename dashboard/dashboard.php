<?php
session_start();

if ($_SESSION['isAdmin'] == 1) {
    header("Location: /dashboard/adminDashboard.php");
    
}

?>
<link type="text/css" rel="stylesheet" href="/dashboard/dashboard.css" />
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="dashboard/dashboard.js"></script>
<script>
    $(document).ready(function(){
        localStorage.setItem("currentPage", "dashboard/dashboard.php");
    });
</script>
<main class="bd-content" id="userContent" role="main">
    <div class="float-container">
        <div class="header">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 5px; padding: 5px;">
                <h1 class="display-4" style="text-align: center;">Dashboard</h1>
            </section>
        </div>
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
            </section>
        </div>
    </div> 
</main>

<script type="text/javascript">
    changeSelected("dashboard");
</script>