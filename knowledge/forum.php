<?session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../dashboard/navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    $(function(){
            $("#addPostForm").submit(function(event){
                

                let title = $("#title").val();
                let content = $("#content").val();
                let user = $("#user").val();
                let tags = $("#tags").val();
                let Date = new Date();
                let currentDate = Date.toLocaleString("en-GB");

                $.ajax({
                    url:"../knowledge/addPost.php",
                    type:"POST",
                    data: {title: title, content: content, user: user, currentDate: currentDate},
                    success: function(){
                        $('#addPostModal').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        navclick("../knowledge/forum.php");
                    },
                    error: function(e){
                        window.alert("Error Occurred! Please refer to console.");
                        console.log(e.message);
                    }
                });
                event.preventDefault();
            });
          });
</script>
</head>

<div class="modal" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterTaskModalLabel">Create Post - <span style="font-size:1rem;"> Logged in as: <? echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@")); ?></span>  </h5>
                </div>

                <div class="modal-body">
                    <form id="addPostForm">
                        <div class="form-group">
                            <input hidden type="text" id="user" value="<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            <label for="tags">Choose subject(s) <span style="font-size:0.5rem;">CTRL Click for multiple</span></label>
                            <select class="form-control" style="height:3rem; margin-bottom:1rem;" id="tags" name="tags" multiple>
                                <option value="News">News</option>
                                <option value="Technical">Technical</option>
                                <option value="Non-Technical">Non-Technical</option>
                            <label for="content">Content</label>
                            <textarea style="margin-bottom:1rem; resize:none;" class="form-control" id="content" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<body>
<div class = 'flex-master'>
<section class="jumbotron jumbotron-fluid col full-height" style = 'margin-top: 0px;'>
  <div id="Options">
      <h5 style="padding-top:27px;">Options</h5>
      <hr class="my-4">
      <div class="forumSearch">
          <input type="text" placeholder='Search...' style = 'width :99%'/>
      </div>
      <label for="memberName" style = 'text-align: left;'>Filter Tags:</label>
      <br>
      <select class="forumSearch" style = 'width :100%'>
          <option value = "None">None</option>
      </select>
      <label for="memberName" style = 'text-align: left;'>Post Age:</label>
      <br>
      <input type="range" class="form-range" id="customRange1">
      <h6>0 days</h6>
      <button id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addPostModal" aria-controls="addPostModal">Create Post</button>
  </div>
</section>
<table  class="table table-bordered" style = 'border:1px solid black; width: 75%; margin-right: 3%; overflow-y:scroll; height: 600px; display:block;'>
    <thead class="thead-dark">
      <tr class="bg-secondary text-white">
        <th scope="col" class="col-md-5">Topic</th>
        <th scope="col">Last Post</th>
        <th scope="col">Started By</th>
        <th scope="col">Tags</th>
      </tr>
    </thead>
    <tbody id="tablebody">
      <tr class="table-active">
        <th scope="row">[Placeholder Text]<br>From:[Placeholder Text]</th>
        <td>DD/MM/YYYY HH:MM <br>From:[Placeholder Text]</td>
        <td>From:[Placeholder Text]</td>
        <td><span class="badge rounded-pill text-bg-primary">Non-Technical</span></td>
      </tr>
      
    </tbody>
  </table>
</div>
<!--Bootstrap-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<!--Bootstrap-->
<script>
  $.ajax({
            url:"../knowledge/retrievePosts.php",
            success: function(responseData){
                let temp = JSON.parse(responseData);
                for(let j = 0; j < temp.length; j++){
                  let post = temp[j];
                 
                
                    let id = post.id;
                    let title = post.title;
                    let body = post.body;
                    let from = post.from;
                    
                    let lastUpdated = post.lastUpdated;
                    let lastUpdatedBy = post.lastUpdatedBy;
                    let comments = post.comments;

                    
                    document.getElementById("tablebody").innerHTML += "<tr class='table-active'><th scope='row'>"+title+"</th><td>"+lastUpdated+"<br>From:"+lastUpdatedBy+"</td><td>"+from+"</td><td id='tagblock"+j+"'>";
                    for(let i = 0; i < post.tags.length; i++){
                      document.getElementById("tagblock"+j).innerHTML += "<span class='badge rounded-pill "+post.tags[i] +"'>"+post.tags[i]+"</span>";
                    }
                    
        
                  }
                
              },
            error: function(e){
                console.log(e.message);
            }
            
        });
</script>
</body>
</html>
