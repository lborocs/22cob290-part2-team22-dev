//Drag and Drop Functionality
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("task", ev.target.id);
    
    $("#toDo").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
    $("#dev").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
    $("#progress").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
    $("#done").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("task");

    try {
        ev.target.appendChild(document.getElementById(data));
        let statusToCode = {"toDo":0, "dev":1, "progress":2, "done":3};
        let selected = statusToCode[ev.target.id];
        
        $.ajax({
            url:"productivity/updateTaskStatus.php",
            type:"POST",
            data:{taskID:data, projectID:sessionStorage.getItem("chosenProject"), newStatus:selected},
            success: function(){
                console.log("Successfully updated!");
                RefreshProgressBar();
            },
            error: function(){
                console.log("Something has happened!")
            }
        });
    } catch {}
}

function dragEnd(){
    $("#toDo").css({"border": "none", "background-color":"transparent"});
    $("#dev").css({"border": "none", "background-color":"transparent"});
    $("#progress").css({"border": "none", "background-color":"transparent"});
    $("#done").css({"border": "none", "background-color":"transparent"});
}

$("#toDo").on("dragover", function(){
    $("#toDo").css({"border":"0.25rem dashed #4CBB17", "background-color":"lightgreen"});
});
$("#toDo").on("dragleave", function(){
    $("#toDo").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
});


$("#dev").on("dragover", function(){
    $("#dev").css({"border":"0.25rem dashed #4CBB17", "background-color":"lightgreen"});
});
$("#dev").on("dragleave", function(){
    $("#dev").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
});


$("#progress").on("dragover", function(){
    $("#progress").css({"border":"0.25rem dashed #4CBB17", "background-color":"lightgreen"});
});
$("#progress").on("dragleave", function(){
    $("#progress").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
});


$("#done").on("dragover", function(){
    $("#done").css({"border":"0.25rem dashed #4CBB17", "background-color":"lightgreen"});
});
$("#done").on("dragleave", function(){
    $("#done").css({"border":"0.25rem dashed dodgerblue", "background-color":"lightblue"});
});
//////////////////////////////

function GrabProjects(){
    document.getElementById("ProjectNameField").innerHTML = "";
    $.ajax({
        url: "admin/grabProjectCards.php",
        success: function(responseData){
            let temp = JSON.parse(responseData);
            for(let project of temp){
                document.getElementById("ProjectNameField").innerHTML += "<option value='" + project['projectID'] + "'>" + project['projectName'] + "</option>";
            }
        }
    });
}

function GrabAssignees(){
    $.ajax({
        url: "admin/grabUserCards.php",
        success: function(responseData){
            let temp = JSON.parse(responseData);
            for(let user of temp) {
                document.getElementById("assignee").innerHTML += "<option value='" + user['email'] + "'>" + user['email'] + "</option>";
                document.getElementById("userOptions").innerHTML += "<option value='" + user['email'] + "'>" + user['firstName'] + " " + user['secondName'] + "</option>";
            }
        }
    });
}

function removeAssignee(user){

    if (window.confirm("Do you wish to remove " + user + " from this task?")){
        let taskID = sessionStorage.getItem("chosenTask");
        let projectID = sessionStorage.getItem("chosenProject");

        $.ajax({
            url: "productivity/databasePHPFiles/removeAssignee.php",
            type: "POST",
            data: {user:user, projectID:projectID, taskID:taskID},
            success: function() {
                OpenTaskPanel(taskID);
            }
        });
    }
}

function OpenTaskPanel(chosenTaskID){
    $('#EditTaskModal').modal('show');
    $.ajax({
        url: "productivity/databasePHPFiles/retrieveTaskDetails.php",
        type:"POST",
        async:false,
        data:{taskID:chosenTaskID, projectID:sessionStorage.getItem("chosenProject")},
        success: function(responseData){
            let taskDetails = JSON.parse(responseData)[0];
            document.querySelector("#editTaskName").value = taskDetails['taskName'];
            document.querySelector("#editDescriptionTextArea").value = taskDetails['description'];
            document.querySelector("#assigneeInput").value = "";
            document.querySelector("#assigneeResult").innerHTML = "";
            sessionStorage.setItem("chosenTask",chosenTaskID);
        }
    });
    $.ajax({
        url:"productivity/databasePHPFiles/getAssignees.php",
        type:"POST",
        data:{taskID:chosenTaskID, projectID:sessionStorage.getItem("chosenProject")},
        success: function(responseData){
            let temp = JSON.parse(responseData);
            document.querySelector("#assigneeList").innerHTML = "";

            for (i in temp){
                user = temp[i];
                document.querySelector("#assigneeList").innerHTML += `<li class="list-group-item list-group-item-action" onclick="removeAssignee('`+user['email']+`');">`+user['email']+`</li>`;
            }

            if (document.getElementById("assigneeList").childElementCount == 0){
                document.getElementById("assigneeList").innerHTML = "<small class='text-muted'>Assigned to No One.</small>"
            }
        }
    });
}

function deleteTask(){
    if (window.confirm("Are you sure you wish to delete this task?")){
        let projectID = sessionStorage.getItem("chosenProject");
        let taskID = sessionStorage.getItem("chosenTask");

        $.ajax({
            url:"productivity/databasePHPFiles/deleteTask.php",
            type:"POST",
            data: {projectID: projectID, taskID:taskID},
            success: function(){
                $('#EditTaskModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                RefreshPage(sessionStorage.getItem("chosenProject"));
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
    }
}

function RefreshProgressBar(){
    
    //Count the tasks in each category
    let toDoCount = document.getElementById("toDo").childElementCount;
    let selectedCount = document.getElementById("dev").childElementCount;
    let inProgressCount = document.getElementById("progress").childElementCount;
    let doneCount = document.getElementById("done").childElementCount;
    let total = toDoCount + selectedCount + inProgressCount + doneCount;

    //Calculate percentage of each
    toDoPerc = (toDoCount/total)*100;
    selectedPerc = (selectedCount/total)*100;
    inProgressPerc = (inProgressCount/total)*100;
    donePerc = (doneCount/total)*100;

    //Set To Do Progress Meter
    document.getElementById("toDoMeter").style="width:"+toDoPerc+"%;";
    document.getElementById("toDoMeter").ariaValueNow = toDoPerc;
    
    //Change Popover Text
    $("#toDoMeter").attr("data-bs-content", toDoCount+" out of "+total+" tasks ("+toDoPerc.toFixed(2)+"%)");

    //Set Selected Progress Meter
    document.getElementById("selectedMeter").style="width:"+selectedPerc+"%;";
    document.getElementById("selectedMeter").ariaValueNow = selectedPerc;

    //Change Popover Text
    $("#selectedMeter").attr("data-bs-content", selectedCount+" out of "+total+" tasks ("+selectedPerc.toFixed(2)+"%)")

    //Set In Progress Progress Meter
    document.getElementById("inProgressMeter").style="width:"+inProgressPerc+"%;";
    document.getElementById("inProgressMeter").ariaValueNow = inProgressPerc;

    //Change Popover Text
    $("#inProgressMeter").attr("data-bs-content", inProgressCount+" out of "+total+" tasks ("+inProgressPerc.toFixed(2)+"%)")

    //Set Done Progress Meter
    document.getElementById("doneMeter").style="width:"+donePerc+"%;";
    document.getElementById("doneMeter").ariaValueNow = donePerc;

    //Change Popover Text
    $("#doneMeter").attr("data-bs-content", doneCount+" out of "+total+" tasks ("+donePerc.toFixed(2)+"%)")


    //Reset Popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
}

function RefreshPage(projectID, projectName=null){
    
    document.getElementById("toDo").innerHTML = "";
    document.getElementById("dev").innerHTML = "";
    document.getElementById("progress").innerHTML = "";
    document.getElementById("done").innerHTML = "";
    
    if (projectName != null){
        document.getElementById("selectedProject").innerHTML = "Selected Project: " + projectName;
    }
    
    $.ajax({
        url:"productivity/databasePHPFiles/retrieveTaskCards.php",
        type:"POST",
        data: {projectID:projectID},
        success: function(responseData){
            //If the Project has no tasks....
            if (responseData === "false"){
                document.getElementById("noTasks").style = "margin-top: 27%;";
                document.getElementById("displayTasks").style = "display: none;";
                document.getElementById("progressBar").style = "display: none;";
            //Else.....
            } else {
                document.getElementById("noTasks").style = "display:none;";
                document.getElementById("displayTasks").style = "display:block;";
                document.getElementById("progressBar").style = "display:inline;";
                let temp = JSON.parse(responseData);
                for(let task of temp){
                    let taskStatus = Number(task['status']);

                    let newTaskCard = `<div id='`+task['taskID']+`' class='card shadow-none bg-white' onclick='OpenTaskPanel(\"`+task['taskID']+`\")' draggable='true' ondragstart='drag(event)' ondragend='dragEnd()'>
                    <div class='card-body'>
                    `+task['taskName'];

                    if (task['assignees'] == 0) {
                        newTaskCard += `<div class="text-muted">Assigned to No One</div><div class="cannotCalc">Cannot Calculate Estimate Time</div></div></div>`;
                    } else {

                        calcHours = Math.trunc(task['expectedManHours']/task['assignees']);
                        calcMin = Math.round(((task['expectedManHours']/task['assignees']) - calcHours) * 60)
                        let plural = "people";
                        if (task['assignees'] == 1){
                            plural = "person"
                        }
                        newTaskCard += `<div class="text-muted">Assigned to `+ task['assignees'] +` `+plural+`</div><div class='taskDeadline'>Duration: ` + calcHours + ` Hour(s), `+ calcMin +` Min</div></div></div>`;
                    }
                    

                    switch (taskStatus){
                        case 0:
                            document.getElementById("toDo").innerHTML += newTaskCard;
                            break;
                        case 1:
                            document.getElementById("dev").innerHTML += newTaskCard;
                            break;
                        case 2:
                            document.getElementById("progress").innerHTML += newTaskCard;
                            break;
                        case 3:
                            document.getElementById("done").innerHTML += newTaskCard;
                            break;
                    }
                }

                RefreshProgressBar();

            }
            sessionStorage.setItem("chosenProject", projectID);
            document.getElementById("addTaskButton").disabled = false;
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });

    $.ajax({
        url: "productivity/databasePHPFiles/grabProjectDeadline.php",
        type: "POST",
        data: {projectID: projectID},
        success: function(responseData){
            let startDate = new Date(JSON.parse(responseData)[0]['startDate']);
            let deadlineDate = new Date(JSON.parse(responseData)[0]['deadlineDate']);

            let today = new Date();
            
            let deltaTime = today - startDate;

            let perc = (deltaTime / (deadlineDate - startDate) *100);
            document.getElementById("deadlineMeter").style="width:"+perc+"%;";
            document.getElementById("deadlineMeter").ariaValueNow = perc;
            document.getElementById("deadlineStats").style="display: inline;";

            document.getElementById("deadline").innerHTML = "Deadline of Project: " + deadlineDate.getDate() + "/" + (deadlineDate.getMonth()+1) + "/" + deadlineDate.getFullYear();
            
            let secLeft = (deadlineDate - today)/1000;
            if (secLeft > 0){
                let daysLeft = Math.floor(secLeft / (60*60*24));
                secLeft = secLeft - (daysLeft * (60*60*24));

                let hoursLeft = Math.floor(secLeft/(60*60));
                secLeft = secLeft - (hoursLeft * (60*60));

                let minLeft = Math.floor(secLeft/(60));

                document.getElementById("countdown").innerHTML = daysLeft + " days, " + hoursLeft + " hours, and " + minLeft + " min until Project Deadline";
                document.getElementById("countdown").style = "";
            } else {
                secLeft = -secLeft;

                let daysLeft = Math.floor(secLeft / (60*60*24));
                secLeft = secLeft - (daysLeft * (60*60*24));

                let hoursLeft = Math.floor(secLeft/(60*60));
                secLeft = secLeft - (hoursLeft * (60*60));

                let minLeft = Math.floor(secLeft/(60));

                document.getElementById("countdown").innerHTML = daysLeft + " days, " + hoursLeft + " hours, and " + minLeft + " min past Project Deadline";
                document.getElementById("countdown").style = "color: red;";
            }

        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });

    document.getElementById("deleteProjectButton").disabled=false;
}

function addAssignee(){
    let newAssignee = $(assigneeInput).val();
    let projectID = sessionStorage.getItem("chosenProject");
    let taskID = sessionStorage.getItem("chosenTask");

    $.ajax({
        url:"productivity/databasePHPFiles/addAssignee.php",
        type:"POST",
        data: {projectID:projectID, taskID:taskID, newAssignee:newAssignee},
        success: function(responseData){
            if (responseData == 1){
                document.getElementById("assigneeResult").innerHTML = `<div class="alert alert-success" role="alert">
                User has been assigned to this task!
              </div>`;
            } else {
                document.getElementById("assigneeResult").innerHTML = `<div class="alert alert-danger" role="alert">
                User has not been assigned to this task! They may already be assigned to this task or may not be a user on the system.
              </div>`;
            }
            OpenTaskPanel(taskID);
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
}
var projectID;

function deleteProject(){
    if (window.confirm("Are you sure you wish to delete this project?")){
        let projectID = sessionStorage.getItem("chosenProject");

        $.ajax({
            url:"productivity/databasePHPFiles/deleteProject.php",
            type:"POST",
            data:{projectID:projectID},
            success:function(){
                document.getElementById("noTasks").style = "margin-top: 27%;";
                document.getElementById("displayTasks").style = "display: none;";
                document.getElementById("progressBar").style = "display: none;";
                document.getElementById("deadlineStats").style="display: none;";

                sessionStorage.removeItem("chosenProject");
                
                document.getElementById("addTaskButton").disabled = true;
                document.getElementById("deleteProjectButton").disabled = true;

                document.getElementById("selectedProject").innerHTML = "No Project Selected."

                GrabProjects();
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
    }
}

$(document).ready(function(){
    //Change Project Form
    if(localStorage.getItem("chosenProject") != null){
        projectID = localStorage.getItem("chosenProject");
        document.getElementById("selectedProject").innerHTML = "Selected Project: " + $("#ProjectNameField option:selected").text();
        RefreshPage(projectID,localStorage.getItem("chosenProjectName"));
    }
    $("#changeProjectModal").submit(function(event){
        projectID = $("#ProjectNameField").val();
        document.getElementById("selectedProject").innerHTML = "Selected Project: " + $("#ProjectNameField option:selected").text();

        RefreshPage(projectID);

        $('#changeProjectModal').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();

        event.preventDefault();
    });
    ///////////////

    //Add Task Form
    $("#addTaskModal").submit(function(event){
                
        let projectID = sessionStorage.getItem("chosenProject");

        if (projectID == null){
            window.alert("A project must be selected first");
            event.preventDefault();
            return;
        }

        let taskName = $("#taskName").val();
        let taskStatus = $("#taskStatus option:selected").val();
        let description = $("#descriptionTextArea").val();
        let manHours = $("#manHoursInput").val();
        let assignee = $("#assignee").val();

        $.ajax({
            url:"productivity/databasePHPFiles/processAddTaskForm.php",
            type:"POST",
            data: {projectID: projectID, taskName: taskName, taskStatus: taskStatus, description:description, manHours: manHours, assignee:assignee},
            success: function(){
                $('#addTaskModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                RefreshPage(sessionStorage.getItem("chosenProject"));
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
        event.preventDefault();
    });
    //////////////

    //Edit Task Form
    $("#EditTaskModal").submit(function(event){
        let projectID = sessionStorage.getItem("chosenProject");
        let taskID = sessionStorage.getItem("chosenTask");
        let taskName = $("#editTaskName").val();
        let description = $("#editDescriptionTextArea").val();
        $.ajax({
            url:"productivity/databasePHPFiles/processEditTaskForm.php",
            type:"POST",
            data: {projectID: projectID, taskID: taskID, taskName: taskName, description: description},
            success: function(){
                $('#EditTaskModal').modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                RefreshPage(sessionStorage.getItem("chosenProject"));
                sessionStorage.removeItem("chosenTask");
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
        event.preventDefault();
    });
    //////////////

    //Filter Task Form
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
    //////////////////
});

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))


sessionStorage.removeItem("chosenProject");
GrabAssignees();
GrabProjects();