<!DOCTYPE html>
<html>
    <head>
        <script>
            $.ajax({
                url: "adminStuff/grabUserCards.php",
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
            })
        </script>
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