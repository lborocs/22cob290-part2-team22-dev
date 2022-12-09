<!DOCTYPE html>
<html>
    <head>
        <script>
            $.ajax({
                url: "admin/grabUserCards.php",
                success: function(responseData){
                    let temp = JSON.parse(responseData);
                    for(let user of temp){
                        if (user['isAdmin'] === "1"){
                            document.getElementById("tableBody").innerHTML += "<tr><th scope='row'>Admin:</th><td>"+user['email']+"</td></tr>";
                        } else {
                            document.getElementById("tableBody").innerHTML += "<tr><th scope='row'>User:</th><td>"+user['email']+"</td></tr>";
                        }
                    }
                }
            });
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class = "table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>
    </body>
</html>