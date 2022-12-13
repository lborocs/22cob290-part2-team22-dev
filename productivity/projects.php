<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../dashboard/navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0">

    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="productivity/projects.js"></script>
    <script>
        $(document).ready(function(){
        
            localStorage.setItem("currentPage", "/productivity/projects.php");
        
        });
        function editTask(id) {
            $('#EditTaskModal').modal('show');
            $("#EditTaskModal").submit(function(event){
                let taskStatus = $("#EdittaskStatus option:selected").val();
                console.log(taskStatus);
                $.ajax({
                    url:"../productivity/editTaskStatus.php",
                    type:"POST",
                    data: {id: id, taskStatus: taskStatus},
                    success: function(){
                        $('#EditTaskModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        navclick("../productivity/projects.php");
                    },
                    error: function(e){
                        window.alert("Error Occurred! Please refer to console.");
                        console.log(e.message);
                    }
                });
                event.preventDefault();
            });
        }
    </script>
    <style>

        .tasks > .row {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
        .tasks > .row > .card {
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-1 border-right full-height mx-auto" id="options" style="border-radius: 0;">
                <h5 id="selectedProject">No Project Selected.</h5>
                <hr class="my-4">
                <button class="btn btn-primary" style="margin-bottom:2%;" id="changeProjectButton" type="button" data-bs-toggle="modal" data-bs-target="#changeProjectModal" aria-controls="changeProjectModal">Change Selected Project</button>
                <button class="btn btn-success" style="margin-bottom:2%;" id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addTaskModal" aria-controls="addTaskModal">Add Task</button>
                <button class="btn btn-primary" style="margin-bottom:2%;" id='filterTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#filterTaskModal" aria-controls="filterTaskModal">Filter Tasks</button>
            </div>

            <div class="col-sm full-height mx-auto" style="border-radius: 0;">
                <div id="displayTasks" style="display:none">
                    <h5>To Do</h5>
                    <div class="tasks">
                        <div id="toDo" class="row" style="margin:2%;"></div>
                    </div>
                    
                    <h5>Selected for Development</h5>
                    <div class="tasks">
                        <div id="dev" class="row" style="margin:2%;"></div>
                    </div>

                    <h5>In Progress</h5>
                    <div class="tasks">
                        <div id="progress" class="row" style="margin:2%;"></div>
                    </div>

                    <h5>Done</h5>
                    <div class="tasks">
                        <div id="done" class="row" style="margin:2%;"></div>
                    </div>
                </div>
                <div id="noTasks" class="lead" style="margin-top: 27%;">
                    No Tasks to Show.
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="changeProjectModal" tabindex="-1" role="dialog" aria-labelledby="changeProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeProjectModalLabel">Select Which Project to View:</h5>
                </div>

                <div class="modal-body mx-auto">
                    <form id="changeProjectForm">
                        <label for="ProjectNameField">Project Name:</label><br>
                        <select class="form-control" id="ProjectNameField" name="ProjectNameField"></select><br>

                        <button type="submit" class="btn btn-success">Choose this Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add a Task</h5>
                </div>

                <div class="modal-body">
                    <form id="addTaskForm">
                        <div class="form-group">
                            <label for="taskName">Input Task Name:</label>
                            <input type="text" class="form-control" id="taskName" name="taskName" required>
                        </div>

                        <label for="taskStatus">Current Task Status:</label>
                        <select multiple class="form-control" name="taskStatus" id="taskStatus" required>
                            <option value="0">To Do</option>
                            <option value="1">Selected for Development</option>
                            <option value="2">In Progress</option>
                            <option value="3">Done</option>
                        </select>
                        <br>

                        <div class="form-group">
                            <label for="descriptionTextArea">Description:</label>
                            <textarea class="form-control" id="descriptionTextArea" name="descriptionTextArea" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="manHoursInput">Expected Man Hours to Completion:</label>
                            <input type="number" class="form-control" name="manHoursInput" id="manHoursInput" min="0" required>
                        </div>

                        <div class="form-group">
                            <label for="assignee">Assignee:</label>
                            <select class="form-control" id="assignee" name="assignee" required></select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="EditTaskModal" tabindex="-1" role="dialog" aria-labelledby="EditTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EditTaskModalLabel">Edit a Task</h5>
                </div>

                <div class="modal-body">
                    <form id="EditTaskForm">
                        <label for="taskStatus">Change Task Status:</label>
                        <select multiple class="form-control" name="EdittaskStatus" id="EdittaskStatus" required>
                            <option value="0">To Do</option>
                            <option value="1">Selected for Development</option>
                            <option value="2">In Progress</option>
                            <option value="3">Done</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="filterTaskModal" tabindex="-1" role="dialog" aria-labelledby="filterTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterTaskModalLabel">Add a Task</h5>
                </div>

                <div class="modal-body">
                    <form id="filterTaskForm">
                        <div class="form-group">
                            <label for="memberName">Team member to filter by:</label>
                            <select multiple class="form-control" name="memberName" id="memberName" required>
                                <option value = "None">None</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        changeSelected("project");
        var myOffcanvas = document.getElementById('offcanvasNavbar')
        myOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
            navShut()
        })
        GrabProjects();
        GrabAssignees();
        sessionStorage.removeItem("chosenProject");
    </script>
</body>

</html>