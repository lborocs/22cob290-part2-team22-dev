function init(){
    $.ajax({
        url: "admin/grabUserCards.php",
        success: function(responseData){
            let temp = JSON.parse(responseData);
            for(let user of temp){
                if (user['isAdmin'] === "1"){
                    document.getElementById("tableBody").innerHTML += `<tr>
                    <th scope='row'>Admin:</th>
                    <td>`+user['email']+`</td>
                    <td>`+user['tasks']+`</td>
                    <td><button class="btn btn-dark" onclick="OpenPanel('`+user['email']+`')">View Assigned Projects</button>
                    <button class="btn btn-secondary" type="button" onclick="demote('`+user['email']+`')">Demote to User</button>
                    <button class="btn btn-danger" type="button" onclick="deleteUser('`+user['email']+`')">Delete User</button></td>
                    </tr>`;
                } else {
                    document.getElementById("tableBody").innerHTML += `<tr>
                    <th scope='row'>User:</th>
                    <td>`+user['email']+`</td>
                    <td>`+user['tasks']+`</td>
                    <td><button class="btn btn-dark" onclick="OpenPanel('`+user['email']+`')">View Assigned Projects</button>
                    <button class="btn btn-info" onclick="promote('`+user['email']+`')">Promote to Admin</button>
                    <button class="btn btn-danger" type="button" onclick="deleteUser('`+user['email']+`')">Delete User</button></td>
                    </tr>`;
                }
            }
        }
    });
}

function OpenPanel(email){
    $.ajax({
        url:"admin/generateModalTable.php",
        type:"POST",
        data:{email:email},
        success: function(responseData){
            document.getElementById("exampleModalLabel").innerHTML = email + `'s Project Statistics`;
            responseData = JSON.parse(responseData);
            console.log(responseData);
            if (responseData == false){
                document.getElementById("modalTable").style="display: none;";
                document.getElementById("noProjects").style="display: inline;";
            } else {
                document.getElementById("modalTable").style="display: inline;";
                document.getElementById("noProjects").style="display: none";

                document.getElementById("modalTableBody").innerHTML = "";

                for (let temp of responseData){
                    document.getElementById("modalTableBody").innerHTML += `<tr>
                    <th scope='row'>`+temp['projectName']+`</th>
                    <td>`+temp['tasks']+`</td>
                    <td><button class="btn btn-primary" onclick="DirectToProject('`+temp['ID']+`', '`+temp['projectName']+`')">Go to Project</button></td>
                    </tr>`;
                }
            }
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });

    $('#exampleModal').modal('show');
}

function DirectToProject(projectID, projectName){
    $('#exampleModal').modal('hide');
    navclick("productivity/projects.php");
    RefreshPage(projectID, projectName);
}

function demote(email){
    if (window.confirm("Do you wish to demote " + email + " to user status?")){
        $.ajax({
            url: "admin/demoteUser.php",
            type:"POST",
            data:{email:email},
            success: function(){
                document.getElementById("tableBody").innerHTML = "";
                init();
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
    }
}

function promote(email){
    if (window.confirm("Do you wish to promote " + email + " to admin status?")){
        $.ajax({
            url: "admin/promoteUser.php",
            type:"POST",
            data:{email:email},
            success: function(){
                document.getElementById("tableBody").innerHTML = "";
                init();
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
    }
}

function deleteUser(email){
    if (window.confirm("Are you sure you want to remove " + email + "?")){
        $.ajax({
            url: "admin/deleteUser.php",
            type:"POST",
            data:{email:email},
            success: function(){
                document.getElementById("tableBody").innerHTML = "";
                init();
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });
    }
}

init();