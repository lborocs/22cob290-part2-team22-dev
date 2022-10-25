<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../dashboard/navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
</head>

<body>
   
    <div onclick="navShut()" id="adjustablecontainer" class="container-fluid">
        <div class="row">

            <div id="todo" class="col full-height">TO-DO

                <div class="todoEntry">
                    <div class="entryBox">
                        <div class="entryTitle">Placeholder Text</div>
                        <div class="entryFooter">
                            <button class="btn subjectText">Subject</button>
                            <div id="av1" class="avatar" style="background-color:green;">
                                <div id="av2" class="avatar" style="background-color:blue;">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="todoEntry">
                    <div class="entryBox">
                        <div class="entryTitle">Placeholder Text</div>
                        <div class="entryFooter">
                            <button class="btn subjectText">Subject</button>
                            <div id="av1" class="avatar" style="background-color:green;">
                                <div id="av2" class="avatar" style="background-color:blue;">
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div id="development" class="col full-height">SELECTED FOR DEVELOPMENT</div>


            <div id="progress" class="col full-height">IN PROGRESS</div>


            <div id="done" class="col full-height">DONE</div>


        </div>

    </div>


   

    <!--Bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <!--Bootstrap-->
    <script type="text/javascript">
        changeSelected("project");
    </script>
</body>

</html>