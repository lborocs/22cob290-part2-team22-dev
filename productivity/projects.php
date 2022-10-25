<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../dashboard/navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../style.css">

    <script>
        $(document).ready(function(){
            $("#addTaskForm").submit(function(event){
                event.preventDefault();

                let taskName = $("#taskName").val();
                let taskStatus = $("#taskStatus option:selected").val();
                let linkedEpic = $("#linkedEpic").val();
                let assignee = $("#assignee").val();

                $.ajax({
                    url:"processAddTaskForm.php",
                    type:"POST",
                    data: {taskName: taskName, taskStatus: taskStatus, linkedEpic: linkedEpic, assignee:assignee},
                    success: function(){
                        location.reload();
                    },
                    error: function(e){
                        window.alert("Error Occurred! Please refer to console.");
                        console.log(e.message);
                    }
                });
            });
        });
    </script>
</head>

<body>

    <?php include("productivitynavbar.php");?>

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
    
    <div onclick="navShut()" id="adjustablecontainer" class="container-fluid">
        <div class="row">
            <div id="options" class="col full-height">
                <h5 style="padding-top:27px;">Options</h5>
                <hr class="my-4">
                <div>
                    <button id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addTaskModal" aria-controls="addTaskModal">Add Task</button>
                </div>
            </div>
            <div id="todo" class="col full-height">TO-DO

                <div class="todoEntry">
                    <div class="entryBox">
                        <div class="entryTitle">Placeholder Text</div>
                        <div class="entryFooter">
                            <button class="btn subjectText">Subject</button>
                            <div id="av1" class="avatar" style="background-color:green;">
                                <div id="av2" class="avatar" style="background-color:blue;">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="todoEntry">
                    <div class="entryBox">
                        <div class="entryTitle">Placeholder Text</div>
                        <div class="entryFooter">
                            <button class="btn subjectText">Subject</button>
                            <div id="av1" class="avatar" style="background-color:green;">
                                <div id="av2" class="avatar" style="background-color:blue;">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div id="development" class="col full-height">SELECTED FOR DEVELOPMENT</div>


            <div id="progress" class="col full-height">IN PROGRESS</div>


            <div id="done" class="col full-height">DONE</div>


        </div>

    </div>

    
    <!--Footer-->
    <footer class="navbar fixed-bottom text-muted bg-light">

        <p style="text-align:center; margin: 0 auto; padding: 10px;">Designed by <b>Team 22</b>.</p>
    </footer>
    <!--Footer-->

    <!--Bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!--Bootstrap-->
    
    <?php include("generateTaskCards.php");?>

    <script type="text/javascript">
        changeSelected("project");
    </script>
    <script>
        var myOffcanvas = document.getElementById('offcanvasNavbar')
        myOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
            navShut()
        })

        $.ajax({
            url:"retrieveTaskCards.php",
            success: function(responseData){
                let temp = JSON.parse(responseData);
                for(let i = 0; i < temp.length; i++){
                    let taskName = temp[i][0];
                    let taskStatus = parseInt(temp[i][1]);
                    let linkedEpic = temp[i][2];
                    let assignee = temp[i][3];

                    switch (taskStatus){
                        case 0:
                            document.getElementById("todo").innerHTML += "<div class=\"todoEntry\" style=\"margin-top: 5px;\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+linkedEpic+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                        case 1:
                            document.getElementById("development").innerHTML += "<div class=\"developementEntry\" style=\"margin-top: 5px;\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+linkedEpic+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                        case 2:
                            document.getElementById("progress").innerHTML += "<div class=\"progressEntry\" style=\"margin-top: 5px;\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+linkedEpic+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
                            break;
                        case 3:
                            document.getElementById("done").innerHTML += "<div class=\"doneEntry\" style=\"margin-top: 5px;\"><div class=\"entryBox\" ><div class=\"entryTitle\">"+taskName+"</div><div class=\"entryFooter\"><button class=\"btn subjectText\">"+linkedEpic+"</button><div id=\"av1\" class=\"avatar\" style=\"background-color:green;\"><div id=\"av2\" class=\"avatar\" style=\"background-color:blue;\"></div></div></div></div></div>"
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