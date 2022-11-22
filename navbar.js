
function toggleClicked() {
    var canSee = $("#offcanvasNavbar").is(":visible");
    if (canSee) {
        const cont = document.getElementById('adjustablecontainer');
        
        try {
            cont.style.setProperty('width', 'calc(100vw - 20vw)');
            cont.style.margin = "0";
          }
          catch(err) {
            
          }
    }
}

function navShut() {
    const cont = document.getElementById('adjustablecontainer');
    cont.style.width = "100%";
    cont.style.margin = "0";
}
function changeSelected(name) {
    if (name == "dashboard") {
        
        document.getElementById("dashboardlink").classList.add('selected');
        document.getElementById("projectlink").classList.remove('selected');
        document.getElementById("knowledgelink").classList.remove('selected');
    } else if (name == "project") {
        document.getElementById("projectlink").classList.add('selected');
        document.getElementById("dashboardlink").classList.remove('selected');
        document.getElementById("knowledgelink").classList.remove('selected');
    } else {
        document.getElementById("knowledgelink").classList.add('selected');
        document.getElementById("projectlink").classList.remove('selected');
        document.getElementById("knowledgelink").classList.remove('selected');
    }
}

function navclick(_url){
    $.ajax({
        url : _url,
        type : 'post',
        success: function(data) {
         $('#DIVID').html(data);
        },
        error: function() {
         $('#DIVID').text('An error occurred');
        }
    });
}

function generateAuthCode(){
        let email = $("#emailInput").val();

        if (!(email.includes('@') || email.includes('.') || email.length > 5)) {
            document.getElementById('result').innerHTML = `<div class="alert alert-warning" role="alert">Enter valid email!</div>`;
            document.getElementById("result").style = "";
        } else {
            $.ajax({
                url:"dashboard/generateAuthCode.php",
                type:"POST",
                data:{recipientEmail:email},
                success: function(responseData){
                    if (responseData === "false"){
                        document.getElementById("result").innerHTML = ("Error Occurred! Please refer to console.");
                        console.log(e.message);
                        document.getElementById("result").style = "color: red;";
                    } else {
                        let msg = "Hi there!%0D%0A%0D%0AYou have been invited to Make-It-All's Productivity and Knowledge System!%0D%0A%0D%0APlease go to the following link to register: colmt.sci-project.lboro.ac.uk/register/register.php?inviteCode="+responseData;
                        window.open('mailto:'+ email +'?subject=You have been invited to Make-It-All!&body='+msg);
                        document.getElementById("result").innerHTML = ("Invite Generated! Please send the email to complete the process.");
                        document.getElementById("result").style = "color: green;";
                    }
                    
                },
                error: function(e){
                    document.getElementById("result").innerHTML = ("Error Occurred! Please refer to console.");
                    console.log(e.message);
                    document.getElementById("result").style = "color: red;";
                }
            });
        }
    }
