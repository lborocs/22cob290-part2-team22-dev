function GrabProjects(userEmail){
    $.ajax({
        url:"dashboard/grabProjectCards.php",
        type:"POST",
        data:{email:userEmail},
        success: function(responseData){
            document.getElementById("userProjectOverview").innerHTML = "";
            let temp = JSON.parse(responseData);
            for (let project of temp){
                let card = "<div class='card' style='width: 14rem; margin-left: 10px; margin-right: 10px;'>";
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

function directToProject(projectID, projectName, email){
    navclick('productivity/projects.php');
    RefreshPage(projectID, projectName, email);
}