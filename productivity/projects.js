function GrabProjects(){
    $.ajax({
        url: "../admin/grabProjectCards.php",
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
        url: "../admin/grabUserCards.php",
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
        }
    });
}

function RefreshPage(projectID){
    
    document.getElementById("toDo").innerHTML = "";
    document.getElementById("dev").innerHTML = "";
    document.getElementById("progress").innerHTML = "";
    document.getElementById("done").innerHTML = "";

    $.ajax({
        url:"productivity/retrieveTaskCards.php",
        type:"POST",
        data: {projectID:projectID},
        success: function(responseData){
            document.getElementById("noTasks").style = "display:none;";
            document.getElementById("displayTasks").style = "";
            let temp = JSON.parse(responseData);
            for(let task of temp){
                let taskStatus = Number(task['status']);
                let newTaskCard = "<div class='card' style='width: 18rem; margin-right:1%;' onclick='OpenTaskPanel(\""+task['taskID']+"\")'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
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
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
}

$(document).ready(function(){
    //Change Project Form
    $("#changeProjectForm").submit(function(event){

        document.getElementById("toDo").innerHTML = "";
        document.getElementById("dev").innerHTML = "";
        document.getElementById("progress").innerHTML = "";
        document.getElementById("done").innerHTML = "";

        let projectID = $("#ProjectNameField").val();
        document.getElementById("selectedProject").innerHTML = "Selected Project: " + $("#ProjectNameField option:selected").text();
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
                        let newTaskCard = "<div class='card' style='width: 18rem; margin-right:1%;' onclick='OpenTaskPanel(\""+task['taskID']+"\")'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
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
        event.preventDefault();
    });
    ///////////////

    //Add Task Form
    $("#addTaskForm").submit(function(event){
                
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
            url:"../productivity/processAddTaskForm.php",
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