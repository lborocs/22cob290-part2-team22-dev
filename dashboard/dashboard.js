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
                document.getElementById("AdminProjectOverview").innerHTML += "<div class='card' style='width: 20rem; margin-left: 10px; margin-right: 10px;'><div class='card-body'><h5 class='card-title'>"+ project['projectName'] +"</h5><h6 class='card-subtitle mb-2 text-muted'>Team Leader: " + project['teamLeader'] + "</h6><a onclick=\"navclick('productivity/projects.php\')\" class='card-link'>Go to Project</a></div></div>"
            }
        }
    });
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