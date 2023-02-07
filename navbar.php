<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="style.css">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0">
<script src = 'navbar.js'></script>
<!--Bootstrap-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        if(localStorage.getItem("currentPage") != null){
            navclick(localStorage.getItem("currentPage"));
        }
    });
</script>

</head>
<body>
<nav class="navbar navbar-dark" style="background-color: #FFB800; margin:0; border-radius:0;">
    <div class="container-fluid">
        <a href="navbar.php" class="navbar-brand">
            Make-It-All
        </a>
        <div class="navbar-brand">Signed in as: <?php echo $_SESSION['email']?>.</div>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"  aria-controls="offcanvasNavbar" onclick="toggleClicked()">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
        <!-- Offcanvas Navbar-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel"  data-bs-scroll="true" data-bs-backdrop="false" >
            <div class="offcanvas-header" style="background-color: #FFB800; height:3.5rem;">
                <div></div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" onclick="navShut()"></button>
            </div>
            <div class="offcanvas-body">
                <h4 class="display-6" style="text-align: center;">Menu</h4>
                <hr class="my-4">
                <ul class="nav flex-column">
                    <li class="nav-item " style="text-align:center;">
                        <a id="dashboardlink" class="nav-link text-dark" onclick="<?php if ($_SESSION['isAdmin']==true) {echo "navclick('dashboard/adminDashboard.php')";} else {echo"navclick('dashboard/dashboard.php')";}?>">Dashboard</a>
                    </li>
                    <li class="nav-item" style="text-align:center;">
                        <a id="projectlink" class="nav-link text-dark" onclick="navclick('productivity/projects.php')">Projects</a>
                    </li>
                    <li class="nav-item " style="text-align:center;">
                        <h4>Knowledge Wiki</h4>
                        <a id="knowledgeNonTechnical" class="nav-link text-dark" onclick = "localStorage.setItem('technical', 0); navclick('knowledge/wiki.php'); localStorage.setItem('posts',0); location.reload();">Non-Technical Wiki</a>
                        <a id="knowledgeTechnical" class="nav-link text-dark" onclick = "localStorage.setItem('technical', 1); navclick('knowledge/wiki.php'); localStorage.setItem('posts',0); location.reload();">Technical Wiki</a>
                    </li>
                    <?php if($_SESSION['isAdmin'] == true) { echo(
                        "<li class='nav-item ' style='text-align:center;'>
                            <a id='knowledgelink' class='nav-link text-dark' onclick =\"navclick('admin/viewUsers.php')\">View All Users</a>
                        </li>"
                    );}?>
                </ul>

            </div>

            <hr class="my-4">

            <div class="offcanvas-body">
                <div>Please enter an appropriate email to send an invite to:</div>
                <br>
                <input type="email" class="form-control" id="emailInput" placeholder="Enter email">
                <button class="btn btn-primary" style="margin-top:10px;" type="button" onclick="generateAuthCode()">Send Invite</button>
                <div id="result" style="display:none"></div>
            </div>

            <hr class="my-4">

            <div class="offcanvas-footer" style="text-align:center">
                <a href="login/index.php" class="btn btn-alert">Sign Out</a>
            </div>
        </div>
        <!--Offcanvas Navbar-->
    </div>
</nav>
<script>
    
    var myOffcanvas = document.getElementById('offcanvasNavbar');
    myOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
        navShut();
    });
</script>

<div id="DIVID">
    <?php
        if($_SESSION['isAdmin'] == true){
            include('dashboard/adminDashboard.php');
        } else {
            include('dashboard/dashboard.php');
        }
    ?>
</div>


</body>
</html>
