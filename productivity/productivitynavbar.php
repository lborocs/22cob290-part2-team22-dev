
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="../style.css">
<script src = 'navbar.js'></script>

    <nav class="navbar navbar-dark" style="background-color: #FFB800;">
        <div class="container-fluid">

            <a href="../dashboard/dashboard.php" class="navbar-brand">
                Make-It-All
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" onclick="toggleClicked()">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Offcanvas Navbar-->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header" style="background-color: #FFB800; height:3.5rem;">
                    <div></div>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" onclick="navShut()"></button>
                </div>
                <div class="offcanvas-body">
                    <h4 class="display-6" style="text-align: center;">Menu</h4>
                    <hr class="my-4">
                    <ul class="nav flex-column">
                        <li class="nav-item " style="text-align:center;">
                            <a id="dashboardlink" class="nav-link text-dark" href="/dashboard/dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item" style="text-align:center;">
                            <a id="projectlink" class="nav-link text-dark" href="../productivity/projects.php">Projects</a>
                        </li>
                        <li class="nav-item " style="text-align:center;">
                            <a id="knowledgelink" class="nav-link text-dark" href="/knowledge.php">Knowledge Forum</a>
                        </li>
                    </ul>

                </div>
                <div class="offcanvas-footer" style="text-align:center">
                    <a class="btn btn-alert">Sign Out</a>
                </div>
            </div>
            <!--Offcanvas Navbar-->
        </div>
    </nav>
<script>
    var myOffcanvas = document.getElementById('offcanvasNavbar')
    myOffcanvas.addEventListener('hidden.bs.offcanvas', function() {
        navShut()
    })
</script>

</html>