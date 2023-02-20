
function GrabProjects(userEmail){
    $.ajax({
        url:"dashboard/grabProjectCards.php",
        type:"POST",
        data:{email:userEmail},
        success: function(responseData){
            document.getElementById("userProjectOverview").innerHTML = "";
            let temp = JSON.parse(responseData);
            if (temp == false) {
                document.getElementById("userProjectOverview").innerHTML = `<p style = 'text-align: center;'><br><br><i>No projects have been assigned to you</i></p>`;
            }
            for (let project of temp){
                let card = "<div class='card' style='width: 23%; margin-left: 1%; margin-right: 1%;'>";
                card += "<div class='card-body'>";
                card += "<p class='card-title'>"+ project['projectName'] +"<p>";
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
            if (temp == false) {
                document.getElementById("usersAssigned").innerHTML += `<p><i>No tasks yet</i></p>`;
            }
            for(let user of temp){
                found = true;
                document.getElementById("usersAssigned").innerHTML += "<div class='user'>" + user['email'] + "</div>";
            }
        }
    });
}


function directToProject(projectID, projectName, email){
    navclick('productivity/projects.php');
    RefreshPage(projectID, projectName, email);
}

var quill = new Quill('#userEditor', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['image', 'code-block'],
            [{ list:  "ordered" }, { list:  "bullet" }],
        ]
    },
    placeholder: '...',
    theme: 'snow'
});


$(document).ready(function() {
    let user = document.getElementById("save").value;
    $.ajax({
        url:"dashboard/getToDo.php",
        type:"POST",                   
        data: {user : user},  
        success: function(responseData){
            let temp = JSON.parse(responseData);
            document.getElementById("userEditor").innerHTML = temp[0]['task'];
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
});


$("#save").click(function(event){
    let user = document.getElementById("save").value;
    let task = document.getElementById("userEditor").innerHTML;
    $.ajax({
        url:"dashboard/setToDo.php",
        type:"POST",
        data: {user : user,task :task},                      
        success: function(responseData){
            console.log(responseData);
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
});

