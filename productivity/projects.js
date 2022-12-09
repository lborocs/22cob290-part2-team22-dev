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

$(document).ready(function(){
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
                if (responseData === "false"){
                    window.alert("Error!");
                } else {
                    let temp = JSON.parse(responseData);
                    for(let task of temp){
                        let taskStatus = task['status'];
                        if (taskStatus === "toDo"){
                            document.getElementById("toDo").innerHTML += "<div class='card' style='width: 18rem; margin-right:1%;'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
                        } else if (taskStatus === "selectedForDevelopment") {
                            document.getElementById("dev").innerHTML += "<div class='card' style='width: 18rem; margin-right:1%;'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
                        } else if (taskStatus === "inProgress") {
                            document.getElementById("progress").innerHTML += "<div class='card' style='width: 18rem; margin-right:1%;'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
                        } else {
                            document.getElementById("done").innerHTML += "<div class='card' style='width: 18rem; margin-right:1%;'><div class='card-body'><h5 class='card-title'>"+task['taskName']+"</h5></div></div>";
                        }
                    }
                }
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
        event.preventDefault();
    });
});