<script>
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
            document.getElementById("dashboardlink").classList.remove('selected');
        }
    }
</script>
<!DOCTYPE html>
<html>

<body>
    <?php include 'navbar.php' ?>




    <main class="bd-content p-5" id="content" role="main">
        <section class="jumbotron jumbotron-fluid" style="border-radius: 15px;">
            <h1 class="display-4" style="text-align: center;">Dashboard</h1>
            <hr class="my-4">
            <p class="lead" style="text-align:center;">[placeholder]</p>
        </section>
    </main>




    <!--Footer-->
    <footer class="bd-footer text-muted bg-light">

        <p style="text-align:center;">Designed by <b>Team 22</b>.</p>
    </footer>
    <!--Footer-->

    <!--Bootstrap-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!--Bootstrap-->

    <script type="text/javascript">
        changeSelected("dashboard");
    </script>
</body>

</html>