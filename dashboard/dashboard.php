<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
     $(document).ready(function(){
       
            localStorage.setItem("currentPage", "dashboard/Dashboard.php");
        
            
        
    });
        function generateAuthCode(){
            $.ajax({
                    url:"dashboard/generateAuthCode.php",
                    success: function(responseData){
                        let temp = JSON.parse(responseData);
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
    </script>
</head>
<body style="width:100% !important;">
    
    <main class="bd-content p-5" id="content" role="main">
        <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">

            <h1 class="display-4" style="text-align: center;">Dashboard</h1>

            <hr class="my-4">

            <h5>Your Projects:</h5>

            <div class="row">
                <div class="card" style="width: 20rem; margin-left: 10px; margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">[Project Name]</h5>
                        <h6 class="card-subtitle mb-2 text-muted">[Subject]</h6>
                        <a onclick="navclick('productivity/projects.php')" class="card-link">Go to Project</a>
                    </div>
                </div>
                <div class="card" style="width: 20rem; margin-left: 10px; margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">[Project Name]</h5>
                        <h6 class="card-subtitle mb-2 text-muted">[Subject]</h6>
                        <a onclick="navclick('productivity/projects.php')" class="card-link">Go to Project</a>
                    </div>
                </div>
                <div class="card" style="width: 20rem; margin-left: 10px; margin-right: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">[Project Name]</h5>
                        <h6 class="card-subtitle mb-2 text-muted">[Subject]</h6>
                        <a onclick="navclick('productivity/projects.php')" class="card-link">Go to Project</a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="jumbotron form-jumbo">
                <p>Click on the button below to generate an invite code:</p>
                <button class="btn btn-primary" style="margin-top:10px;" type="button" onclick="generateAuthCode()">Create an Auth Code</button>
                <div class="jumbotron jumbotron-fluid" id="result" style="display:none"></div>
            </div>

            <hr class="my-4">
        </section>
    </main>
    
    <script type="text/javascript">
        changeSelected("dashboard");
    </script>
</body>

</html>