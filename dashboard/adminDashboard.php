<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $.ajax({
            url: "dashboard/grabUserCards.php",
            success: function(responseData){
                let temp = JSON.parse(responseData);
                for(let user of temp){
                    if (user['isAdmin'] === true){
                        document.getElementById("test").innerHTML += "<div class=\"card\" style=\"margin-top:5px;\"><div class=\"card-body\"><h5 class=\"card-title text-center\"><b>Admin: </b>"+user['email']+"</h5></div></div>";
                    } else {
                        document.getElementById("test").innerHTML += "<div class=\"card\" style=\"margin-top:5px;\"><div class=\"card-body\"><h5 class=\"card-title text-center\"><b>User: </b>"+user['email']+"</h5></div></div>";
                    }
                }
            }
        })
    </script>
</head>
<body style="width:100% !important;">
    <main class="bd-content p-5" id="content" role="main">
        <section class="jumbotron jumbotron-fluid" style="border-radius: 15px; padding: 20px;">
            <h1 class="display-4" style="text-align: center;">Admin Dashboard</h1>

            <hr class="my-4">

            <h5>Current Projects:</h5>

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

            <h5>Active Employees:</h5>
            <div class="row">
                <div id="test" class="col" style="margin-left: 5px;">
                </div>
                <div class="col">
                </div>
                <div class="col">             
                </div>
                <div class="col">
                </div>
                <div class="col" style="margin-right: 10px;">
                </div>
            </div>

        </section>
    </main>

    <script type="text/javascript">
        changeSelected("dashboard");
    </script>
</body>

</html>
