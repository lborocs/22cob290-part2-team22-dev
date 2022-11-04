<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="dashboard/dashboard.js"></script>
    <script>
         $(document).ready(function(){
        
            localStorage.setItem("currentPage", "dashboard/adminDashboard.php");
        
            
        
    });
    </script>
</head>
<body>
    <main class="bd-content p-5" id="content" role="main">
        <section class="jumbotron jumbotron-fluid" style="border-radius: 15px;">
            <h1 class="display-4" style="text-align: center;">Admin Dashboard</h1>
            <hr class="my-4">

            <div class="jumbotron form-jumbo">
                <p>Please enter a recipient's email and click on the button below to generate an invite code:</p>
                <div class="form-group">
                    <input type="email" class="form-control" id="emailInput" placeholder="Enter email">
                </div>
                <button class="btn btn-primary" style="margin-top:10px;" type="button" onclick="generateAuthCode()">Create an Auth Code</button>
                <div class="jumbotron jumbotron-fluid" id="result" style="display:none"></div>
            </div>
        </section>
    </main>




    <!--Footer-->
    <footer class="navbar fixed-bottom text-muted bg-light">

        <p style="text-align:center; margin: 0 auto; padding: 10px;">Designed by <b>Team 22</b>.</p>
    </footer>
    <!--Footer-->

    <script type="text/javascript">
        changeSelected("dashboard");
    </script>
</body>

</html>