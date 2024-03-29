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
            document.getElementById("AdminProjectOverview").innerHTML = "";
            let temp = JSON.parse(responseData);
            if (temp == false) {
                document.getElementById("AdminProjectOverview").innerHTML = `<p style = 'text-align: center;'><br><br><i>There are no current projects</i></p>`;
            }
            for (let project of temp){
                let card = "<div class='card' style='width: 14rem; margin-left: 10px; margin-right: 10px;'>";
                card += "<div class='card-body'>";
                card += "<p class='card-title'>"+ project['projectName'] +"<p>";
                card += "<p class='card-subtitle mb-2 text-muted'>" + project['teamLeader'] + "</p><hr class='my-1'>";
                card += "<button type='button' onclick='directToProject(\""+project['projectID']+"\", \""+project['projectName']+"\")' class='btn btn-primary'>Go to Project</button>";
                card += "</div></div>";

                document.getElementById("AdminProjectOverview").innerHTML += card;

            }
            document.getElementById("AdminProjectOverview").innerHTML += "<button type='button' id='createProjectBtn' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#CreateProjectModal' aria-controls='CreateProjectModal'>+</button>";
        }
    });
}

function directToProject(projectID, projectName){
    
    
    localStorage.setItem("chosenProjectName", projectName);
    localStorage.setItem("chosenProject", projectID);
    //localStorage.setItem("currentPage","projectStats.php");
    navclick('dashboard/projectStats.php');
}

var Delta = Quill.import('delta');

var quill = new Quill('#editor', {
    modules: {
        toolbar: [
            [{ header: [1, 2, false] }],
            ['bold', 'italic', 'underline'],
            ['code-block'],
            [{ list:  "ordered" }, { list:  "bullet" }],
        ]
    },
    placeholder: '...',
    theme: 'snow'
});


// Save periodically
setInterval(function() {
  if (change.length() > 0) {
    console.log('Saving changes', change);
    // Save the entire updated text to localStorage
    const data = JSON.stringify(quill.getContents())
    localStorage.setItem('storedText', data);
    change = new Delta();
    console.log(localStorage.getItem('storedText'));
  }
}, 1000);

// Check for unsaved data
window.onbeforeunload = function() {
  if (change.length() > 0) {
    return 'There are unsaved changes. Are you sure you want to leave?';
  }
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
                    location.reload();
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

function grabDeadline(projectID){
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
            document.getElementById("statsdeadlineMeter").style="width:"+perc+"%;";
            //document.getElementById("statsdeadlineMeter").ariaValueNow = perc;
            document.getElementById("statsdeadlineStats").style="display: inline;";

            document.getElementById("statsdeadline").innerHTML = "Deadline of Project: " + deadlineDate.getDate() + "/" + (deadlineDate.getMonth()+1) + "/" + deadlineDate.getFullYear();
            
            let secLeft = (deadlineDate - today)/1000;
            if (secLeft > 0){
                let daysLeft = Math.floor(secLeft / (60*60*24));
                secLeft = secLeft - (daysLeft * (60*60*24));

                let hoursLeft = Math.floor(secLeft/(60*60));
                secLeft = secLeft - (hoursLeft * (60*60));

                let minLeft = Math.floor(secLeft/(60));

                document.getElementById("statscountdown").innerHTML = daysLeft + " days, " + hoursLeft + " hours, and " + minLeft + " min until Project Deadline";
                document.getElementById("statscountdown").style = "";
            } else {
                secLeft = -secLeft;

                let daysLeft = Math.floor(secLeft / (60*60*24));
                secLeft = secLeft - (daysLeft * (60*60*24));

                let hoursLeft = Math.floor(secLeft/(60*60));
                secLeft = secLeft - (hoursLeft * (60*60));

                let minLeft = Math.floor(secLeft/(60));

                document.getElementById("statscountdown").innerHTML = daysLeft + " days, " + hoursLeft + " hours, and " + minLeft + " min past Project Deadline";
                document.getElementById("statscountdown").style = "color: red;";
            }

        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
}


$(document).ready(function() {
    let user = document.getElementById("save").value;
    console.log(user);
    $.ajax({
        url:"dashboard/getToDo.php",
        type:"POST",                   
        data: {user : user},  
        success: function(responseData){
            let temp = JSON.parse(responseData);
            console.log(temp);
            document.getElementById("editor").innerHTML = temp[0]['task'];
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
});


$("#save").click(function(event){
    console.log('test');
    let user = document.getElementById("save").value;
    let task = document.getElementById("editor").innerHTML;
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