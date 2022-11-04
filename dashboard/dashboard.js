function generateAuthCode(){
    let email = $("#emailInput").val()

    if (!(email.includes('@') || email.includes('.') || email.length > 5)) {
        document.getElementById('result').innerHTML = `<div class="alert alert-warning" role="alert">Enter valid email!</div>`;
        document.getElementById("result").style = "";
    } else {
        $.ajax({
            url:"dashboard/generateAuthCode.php",
            success: function(responseData){
                let temp = JSON.parse(responseData);
                let msg = "Hi there!%0D%0A%0D%0AYou have been invited to Make-It-All's Productivity and Knowledge System!%0D%0A%0D%0AInsert the code: "+temp+" into the registration section of http://team22.sci-project.lboro.ac.uk/login/index.php";
                window.open('mailto:'+ email +'?subject=You have been invited to Make-It-All!&body='+msg);
                document.getElementById("result").innerHTML = ("AuthCode Generated: <b>" + temp + "</b><br>Please share this with whoever you wish to invite.");
                document.getElementById("result").style = "color: green;"
            },
            error: function(e){
                document.getElementById("result").innerHTML = ("Error Occurred! Please refer to console.");
                console.log(e.message);
                document.getElementById("result").style = "color: red;"
            }
        });
    }
}