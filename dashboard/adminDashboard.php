<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="dashboard/dashboard.js"></script>
</head>
<body style="width:100% !important;">
    <main class="bd-content p-5" id="content" role="main">

        <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
            <h1 class="display-4" style="text-align: center;">Admin Dashboard</h1>

            <hr class="my-4">

            <h5>Current Projects:</h5>

            <div class="row" id="AdminProjectOverview">
            </div>

        </section>
        
        <div class="row">
            <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
                <h5>Create a New Project:</h5>

                <hr class="my-4">

                <div class="mx-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CreateProjectModal" aria-controls="CreateProjectModal">Create Project</button>
                </div>

            </section>
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
                        <input type="text" class="form-control" id="ProjectNameField" name="ProjectNameField"><br>

                        <label for="TeamLeaderField">Assign a Team Leader:</label><br>
                        <select class="form-control" id="TeamLeaderField" name="TeamLeaderField">
                        </select><br>

                        <label for="DeadlineField">Set the Deadline:</label><br>
                        <input type="date" class="form-control" id="DeadlineField" name="DeadlineField"><br>

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
</body>

</html>
