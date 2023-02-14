<script src="dashboard/dashboard.js"></script>
<main id="content" role="main">
    <div class="row">
        <div class="bg-light rounded-3" style="border-radius: 15px; padding: 3rem;">
            <h1 class="display-6" style="text-align: center;">Admin Dashboard</h1>

            <hr class="my-4">

            <h6>Current Projects:</h6>

            <div class="row" id="AdminProjectOverview" style="overflow-x:hidden;">
                <script>GrabProjects();</script>
            </div>

            <hr class="my-4">
            <h6>Admin Tools:</h6>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#CreateProjectModal" aria-controls="CreateProjectModal">Create Project</button>
            <hr class="my-4">
        </div>
    </div> 
</main>

<div class="modal" id="CreateProjectModal" tabindex="-1" role="dialog" aria-labelledby="CreateProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateProjectModalLabel">Input Project Details Below:</h5>
            </div>

            <div class="modal-body mx-auto">
                <form id="CreateProjectForm">
                    <label for="ProjectNameField">Project Name:</label><br>
                    <input type="text" class="form-control" id="ProjectNameField" name="ProjectNameField" required><br>

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
<script>   
    localStorage.setItem("currentPage", "dashboard/adminDashboard.php");
    changeSelected("dashboard");
    GrabEmails();
</script>