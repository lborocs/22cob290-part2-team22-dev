<?php
session_start();

if ($_SESSION['isAdmin'] == 0) {
    header("Location: /dashboard/dashboard.php");
    
}

?>

<script src="dashboard/adminDashboard.js"></script>

<link type="text/css" rel="stylesheet" href="/dashboard/dashboard.css" />
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<script>
     $(document).ready(function(){
       
            localStorage.setItem("currentPage", "dashboard/adminDashboard.php");
        
            
        
    });
</script>


<div class="header">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 5px; padding: 5px;">
                <h1 class="display-4" style="text-align: center;">Admin Dashboard</h1>
            </section>
        </div>
    <div class="float-container">
       
        <div class="float-child" id="projectContainer">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
                <h2 class="display-6" style="text-align: center;">Current Projects</h2>

                <hr class="my-4">


                <div class="row" id="AdminProjectOverview" style="overflow-x: hidden;">
                    <script>GrabProjects();</script>
                    
                </div>
                
            </section>
        </div>
        <div class="float-child" id="toDo">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
                <h5 class="display-6" style="text-align: center;">To Do List:</h5>

                <hr class="my-4">

                <div id="editor"></div>

            </section>
        </div>
    </div>




<div class="modal" id="CreateProjectModal" tabindex="-1" role="dialog" aria-labelledby="CreateProjectModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateProjectModalLabel">Input Project Details Below:</h5>
            </div>

            <div class="modal-body mx-auto">
                <form id="CreateProjectForm">
                    <label for="ProjectNameField">Project Name:</label><br>
                    <input type="text" class="form-control" id="ProjectNameField" name="ProjectNameField"
                        required><br>

                        <label for="TeamLeaderField">Assign a Team Leader:</label><br>
                        <select class="form-control" id="TeamLeaderField" name="TeamLeaderField" required>
                        </select><br>

                        <label for="DeadlineField">Set the Deadline:</label><br>
                        <input type="date" class="form-control" id="DeadlineField" name="DeadlineField" required><br>

                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    changeSelected("dashboard");
    GrabEmails();
    GrabProjects();
</script>