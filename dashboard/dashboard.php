<?php
session_start();

?>
<script src="dashboard/dashboard.js"></script>
<script>
$(document).ready(function(){
    localStorage.setItem("currentPage", "dashboard/dashboard.php");
});
</script>
<main id="content" role="main">
    <div class="row">
        <div class="bg-light rounded-3" style="border-radius: 15px; padding: 3rem;">
            <h1 class="display-6" style="text-align: center;">Dashboard</h1>

            <hr class="my-4">

            <h6>Current Assigned Projects:</h6>

            <div class="row" id="userProjectOverview" style="overflow-x:hidden;">
                <script>GrabProjects("<?php echo $_SESSION['email'];?>");</script>
            </div>
        </div>
    </div> 
</main>

<script type="text/javascript">
    changeSelected("dashboard");
</script>