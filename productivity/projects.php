<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../dashboard/navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
         $(document).ready(function(){
        
            localStorage.setItem("currentPage", "/productivity/projects.php");
        
            
        
    });
        $(function(){
            $("#addTaskForm").submit(function(event){
                

                let taskName = $("#taskName").val();
                let taskStatus = $("#taskStatus option:selected").val();
                let linkedEpic = $("#linkedEpic").val();
                let assignee = $("#assignee").val();

                $.ajax({
                    url:"../productivity/processAddTaskForm.php",
                    type:"POST",
                    data: {taskName: taskName, taskStatus: taskStatus, linkedEpic: linkedEpic, assignee:assignee},
                    success: function(){
                        $('#addTaskModal').modal('hide');
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
            $("#filterTaskForm").submit(function(event){
                let memberName = $("#memberName option:selected").val();
                var developmentDivs = document.getElementsByClassName("developementEntry");
                var progressDivs = document.getElementsByClassName("progressEntry");
                var doneDivs  = document.getElementsByClassName("doneEntry");
                var todoDivs = document.getElementsByClassName('todoEntry');
                var divs = [todoDivs,developmentDivs,progressDivs,doneDivs];
                for(var j = 0; j<4;j++) {
                    for(var i = 0; i < divs[j].length; i++){
                        divs[j][i].style.display = 'block'; 
                        if ((divs[j][i].getElementsByTagName('button')[0].innerHTML != memberName)) {
                            if (memberName != 'None') {
                                divs[j][i].style.display = 'None'; 
                            }
                        }
                    }
                }
                $('#filterTaskModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                return false;
            });
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
</head>

<body>

    

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
                            <label for="linkedEpic">Linked Topic:</label>
                            <input type="text" class="form-control" id="linkedEpic" name="linkedEpic">
                        </div>
                        <div class="form-group">
                            <label for="assignee">Assignee:</label>
                            <input type="text" class="form-control" id="assignee" name="assignee">
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
    
    <div onclick="navShut()" id="adjustablecontainer" class="container-fluid">
        <div class="row">
            <div id="options" class="col full-height">
                <h5 style="padding-top:27px;">Options</h5>
                <hr class="my-4">
                <div>
                    <button id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addTaskModal" aria-controls="addTaskModal">Add Task</button>
                </div>
                <div>
                    <button style="margin-top:27px;" id='filterTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#filterTaskModal" aria-controls="filterTaskModal">Filter Tasks</button>
                </div>  
            </div>
            <div id="todo" class="col full-height">TO-DO
            </div>
            <div id="development" class="col full-height">SELECTED FOR DEVELOPMENT</div>


            <div id="progress" class="col full-height">IN PROGRESS</div>


            <div id="done" class="col full-height">DONE</div>


        </div>

    </div>


    <script type="text/javascript">
        changeSelected("project");
    </script>
    <script>
        var myOffcanvas = document.getElementById('offcanvasNavbar')
        myOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
            navShut()
        })
        $.ajax({
            url:"../productivity/retrieveTaskCards.php",
            success: function(responseData){
                let temp = JSON.parse(responseData);
                console.log(temp);
                names = []
                for(let i = 0; i < temp.length; i++){
                    let id = temp[i].id;
                    let taskName = temp[i].taskName;
                    let taskStatus = parseInt(temp[i].taskStatus);
                    let linkedEpic = temp[i].linkedEpic;
                    let assignee = temp[i].assignee;
                    if (names.includes(assignee) == false) {
                        document.getElementById("memberName").innerHTML += '<option value='+assignee+'>'+assignee+'</option>';
                        names.push(assignee);
                    }
                    switch (taskStatus){
                        case 0:
                            document.getElementById("todo").innerHTML += "<div class=\"todoEntry\" style=\"margin-top: 5px;\" onclick=\"editTask("+id+")\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+assignee+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                        case 1:
                            document.getElementById("development").innerHTML += "<div class=\"developementEntry\" style=\"margin-top: 5px;\" onclick=\"editTask("+id+")\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+assignee+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                        case 2:
                            document.getElementById("progress").innerHTML += "<div class=\"progressEntry\" style=\"margin-top: 5px;\" onclick=\"editTask("+id+")\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+assignee+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                        case 3:
                            document.getElementById("done").innerHTML += "<div class=\"doneEntry\" style=\"margin-top: 5px;\" onclick=\"editTask("+id+")\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+assignee+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                    }
                }

            },
            error: function(e){
                console.log(e.message);
            }
            
        });

</script>
</body>

</html>