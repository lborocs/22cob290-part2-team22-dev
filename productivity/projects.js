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
        let selected = statusToCode[ev.path[0].id];
        
        $.ajax({
            url:"productivity/updateTaskStatus.php",
            type:"POST",
            data:{taskID:data, projectID:sessionStorage.getItem("chosenProject"), newStatus:selected},
            success: function(){
                console.log("Successfully updated!");
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
            }
        }
    });
}

function OpenTaskPanel(chosenTaskID){
    $('#EditTaskModal').modal('show');
    $.ajax({
        url: "productivity/retrieveTaskDetails.php",
        type:"POST",
        data:{taskID:chosenTaskID, projectID:sessionStorage.getItem("chosenProject")},
        success: function(responseData){
            let taskDetails = JSON.parse(responseData)[0];
            document.querySelector("#editTaskName").value = taskDetails['taskName'];
            document.querySelector("#editDescriptionTextArea").value = taskDetails['description'];
            sessionStorage.setItem("chosenTask",chosenTaskID);
        }
    });
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
        url:"productivity/retrieveTaskCards.php",
        type:"POST",
        data: {projectID:projectID},
        success: function(responseData){
            //If the Project has no tasks....
            if (responseData === "false"){
                document.getElementById("noTasks").style = "margin-top: 27%;";
                document.getElementById("displayTasks").style = "display: none;";
            //Else.....
            } else {
                document.getElementById("noTasks").style = "display:none;";
                document.getElementById("displayTasks").style = "";
                let temp = JSON.parse(responseData);
                for(let task of temp){
                    let taskStatus = Number(task['status']);
                    let newTaskCard = "<div id='"+task['taskID']+"' class='card' style='width: 18rem; margin-right:1%;' onclick='OpenTaskPanel(\""+task['taskID']+"\")' draggable='true' ondragstart='drag(event)' ondragend='dragEnd()'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
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
            }
            sessionStorage.setItem("chosenProject", projectID);
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
}

$(document).ready(function(){
    //Change Project Form
    $("#changeProjectModal").submit(function(event){
        let projectID = $("#ProjectNameField").val();
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
            url:"productivity/processAddTaskForm.php",
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
            url:"productivity/processEditTaskForm.php",
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