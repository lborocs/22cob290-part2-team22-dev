<?php session_start(); ?>

<script src="<?php if ($_SESSION['isAdmin'] == true){ echo 'productivity/projects.js';} else {echo 'productivity/userProjects.js';} ?>"></script>

<script>
    $(document).ready(function(){
    
        localStorage.setItem("currentPage", "/productivity/projects.php");
        sessionStorage.setItem("email", "<?php echo $_SESSION['email']?>");
        if (localStorage.getItem("chosenProject") != null){
            sessionStorage.setItem("chosenProject", localStorage.getItem("chosenProject"));
            
        }
       
    
    });
</script>

<link rel="stylesheet" href="productivity/projects.css">

<div id="main" class="row">
    <div class="col-sm-1 full-height" id="options">
        <h6 id="selectedProject">No Project Selected.</h6>
        <h6 id="teamLeader"></h6>

        <hr class="my-3">

        <div id="progressBar">
            <div class="progress">
                <div id="toDoMeter" class="progress-bar bg-danger" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="popover" data-bs-placement="top" data-bs-title="'To Do' Stats: " data-bs-content="" data-bs-trigger="hover"></div>
                <div id="selectedMeter" class="progress-bar bg-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="popover" data-bs-placement="top" data-bs-title="'Selected for Development' Stats: " data-bs-content="" data-bs-trigger="hover"></div>
                <div id="inProgressMeter" class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="popover" data-bs-placement="top" data-bs-title="'In Progress' Stats:" data-bs-content="" data-bs-trigger="hover"></div>
                <div id="doneMeter" class="progress-bar bg-success" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" data-bs-toggle="popover" data-bs-placement="top" data-bs-title="'Done' Stats:" data-bs-content="" data-bs-trigger="hover"></div>
            </div>
            <hr class="my-3">
        </div>

        <div id="deadlineStats">
            <h6 id="deadline"></h6>
            <div class="progress">
                <div id="deadlineMeter" class="progress-bar bg-danger" style="width: 100%"></div>
            </div>
            <hr class="my-3">
            <h6 id="countdown"></h6>
            <hr class="my-3">
        </div>

        <button class="btn btn-primary" id="changeProjectButton" type="button" data-bs-toggle="modal" data-bs-target="#changeProjectModal" aria-controls="changeProjectModal">Change Selected Project</button>
        <button class="btn btn-success" id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addTaskModal" aria-controls="addTaskModal" disabled>Add Task</button>
        <button class="btn btn-danger" id='deleteProjectButton' type ='button' onclick='deleteProject()' disabled>Delete Project</button>
    </div>

    <div class="col-sm full-height p-2">
        <div id="displayTasks">
            <small>To Do</small>
            <div class="tasks">
                <div id="toDo" class="row" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
            
            <small>Selected for Development</small>
            <div class="tasks">
                <div id="dev" class="row" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>

            <small>In Progress</small>
            <div class="tasks">
                <div id="progress" class="row" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>

            <small>Done</small>
            <div class="tasks">
                <div id="done" class="row" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
        </div>
        <div id="noTasks" class="lead">
            No Tasks to Show.
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
                    <select class="form-control" name="taskStatus" id="taskStatus" required>
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
                    
                    <hr class="my-3">
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="EditTaskModal" tabindex="-1" role="dialog" aria-labelledby="EditTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditTaskModalLabel">Edit Task:</h5>
            </div>

            <div class="modal-body">
                <form id="EditTaskForm">
                    <div class="form-group">
                        <label for="editTaskName">Task Name:</label>
                        <input type="text" class="form-control" id="editTaskName" name="editTaskName">
                    </div>

                    <div class="form-group">
                        <label for="editDescriptionTextArea">Description:</label>
                        <textarea class="form-control" id="editDescriptionTextArea" name="editDescriptionTextArea" rows="3"></textarea>
                    </div>

                    <label>Assignee(s):</label>
                    <ul class="list-group" id="assigneeList">
                    </ul>
                    <button type="button" class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#assigneeCollapse" aria-expanded="false" aria-controls="assigneeCollapse">Add an Assignee...</button>

                    <div class="collapse" id="assigneeCollapse">
                        <hr class="my-3">

                        <input type="email" id="assigneeInput" name="assigneeInput" list="userOptions" class="form-control" placeholder="Enter Assignee Here">

                        <datalist id="userOptions">
                        </datalist>

                        <div class="d-grid gap-2">

                            <button type="button" class="btn btn-outline-secondary" onclick="addAssignee()">Add User</button>
                        </div>

                        <div id="assigneeResult" class="mt-3">
                        </div>
                    </div>

                    <hr class="my-3">
                    
                    <button type="submit" class="btn btn-success" style="margin-bottom:0.5em;">Save</button>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            More Options
                        </button>
                        <ul class="dropdown-menu">
                            <li><a id="deleteTask" class="dropdown-item" onclick="deleteTask()">Delete Task</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="ViewTaskModal" tabindex="-1" role="dialog" aria-labelledby="ViewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewTaskModalLabel">View Task:</h5>
            </div>

            <div id="ViewTaskBody" class="modal-body">
                <div class="form-group">
                    <label for="viewTaskName">Task Name:</label>
                    <input type="text" class="form-control" id="viewTaskName" name="viewTaskName" disabled>
                </div>

                <div class="form-group">
                    <label for="viewDescriptionTextArea">Description:</label>
                    <textarea class="form-control" id="viewDescriptionTextArea" name="viewDescriptionTextArea" rows="3" disabled></textarea>
                </div>

                <label>Assignee(s):</label>
                <ul class="list-group" id="viewAssigneeList">
                </ul>

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
</script>