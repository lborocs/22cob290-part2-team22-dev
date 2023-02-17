function GrabProjects(userEmail){
    $.ajax({
        url:"dashboard/grabProjectCards.php",
        type:"POST",
        data:{email:userEmail},
        success: function(responseData){
            document.getElementById("userProjectOverview").innerHTML = "";
            let temp = JSON.parse(responseData);
            for (let project of temp){
                let card = "<div class='card' id='projectCard' style='width: 23%; margin-left: 1%; margin-right: 1%;'>";
                card += "<div class='card-body'>";
                card += "<p class='card-title'>"+ project['projectName'] +"<p>";
                card += "<button class='btn btn-danger 'onclick='removeProject()'>X</button>";
                card += "<p class='card-subtitle mb-2 text-muted'>Team Leader: " + project['teamLeader'] + "</p><hr class='my-1'>";
                card += "<button type='button' onclick='directToProject(\""+project['projectID']+"\", \""+project['projectName']+"\", \""+userEmail+"\")' class='btn btn-primary'>Go to Project</button>";
                card += "</div></div>";
                document.getElementById("userProjectOverview").innerHTML += card;
            }
        }
    });
}
function grabProjectStats(){
    let projectID = localStorage.getItem("projectID");
    let projectName = localStorage.getItem("projectName");
    $.ajax({
        url:"../admin/grabProjectStats.php",
        type:"POST",
        data: {projectID : projectID},
        success: function(responseData){
            let temp = JSON.parse(responseData);

            document.getElementById("ProjectName").innerHTML = projectName;
            document.getElementById("ProjectID").innerHTML = projectID;
            document.getElementById("ProjectTeamLeader").innerHTML = temp['teamLeader'];
            document.getElementById("ProjectDeadline").innerHTML = temp['deadline'];
            document.getElementById("ProjectStatus").innerHTML = temp['status'];
        }
    });
}

function grabUsersByProject(projectID){
    
    $.ajax({
        url:"../admin/grabUsersByProject.php",
        type:"POST",
        data: {projectID : projectID},
        success: function(responseData){
            let temp = JSON.parse(responseData);
            for(let user of temp){
                document.getElementById("usersAssigned").innerHTML += "<div class='user'>" + user['email'] + "</div>";
            }
        }
    });

}

function removeProject() {
var element = document.getElementById('projectCard');
element.classList.remove('card');
}


function directToProject(projectID, projectName, email){
    navclick('productivity/projects.php');
    RefreshPage(projectID, projectName, email);
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
var quill = new Quill('#userEditor', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block']
        ]
    },
    placeholder: '...',
    theme: 'snow'
});