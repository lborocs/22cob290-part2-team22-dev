function GrabEmails(){
    $.ajax({
        url: "../admin/grabUserCards.php",
        success: function(responseData){
            let temp = JSON.parse(responseData);
            for(let user of temp){
                document.getElementById("TeamLeaderField").innerHTML += "<option value='" + user['email'] + "'>" + user['email'] + "</option>";
            }
        }
    });
}

function GrabProjects(){
    $.ajax({
        url:"../admin/grabProjectCards.php",
        success: function(responseData){
            let temp = JSON.parse(responseData);
            for (let project of temp){
                let card = "<div class='card' style='width: 26rem; margin-left: 10px; margin-right: 10px;'>";
                card += "<div class='card-body'>";
                card += "<h5 class='card-title'>"+ project['projectName'] +"</h5>"
                card += "<button type='button' id='hideCard' onclick='removeTask()' class='btn btn-danger'>X</button>";
                card += "<h6 class='card-subtitle mb-2 text-muted'>Team Leader: " + project['teamLeader'] + "</h6><hr class='my-1'>";
                card += "<button type='button' onclick='directToProject(\""+project['projectID']+"\", \""+project['projectName']+"\")' class='btn btn-primary'>Go to Project</button>";
                card += "</div></div>";

                document.getElementById("AdminProjectOverview").innerHTML += card;
            }
        }
    });
}

function directToProject(projectID, projectName){
    navclick('productivity/projects.php');
    RefreshPage(projectID, projectName);
}

function removeTask() {
$("hideCard").show()
}

$(document).ready(function(){
    $("#CreateProjectForm").submit(function(event){
        let projectName = $("#ProjectNameField").val();
        let teamLeader = $("#TeamLeaderField").val();
        let deadline = $("#DeadlineField").val();
        $.ajax({
            url:"dashboard/createProject.php",
            type:"POST",
            data: {projectName : projectName, teamLeader: teamLeader, deadline: deadline},
            success: function(responseData){
                if (responseData === "true"){
                    window.alert("Project Created!");
                } else {
                    window.alert("Error!");
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