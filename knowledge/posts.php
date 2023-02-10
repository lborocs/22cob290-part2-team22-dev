<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<script>localStorage.setItem("currentPage", "knowledge/posts.php");
console.log(localStorage.getItem('currentPost'));
</script>
<head>
    <script src="../navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
</head>
<body>

<div class="w3-sidebar w3-bar-block" style="width:160px; height: 100%;" id = "contentBar">
  <h5><i>Contents</i></h5>
  <hr style = 'border-top: 1px solid black;'>
</div>


<div class="w3-container" style="margin-left:160px">
<h2 id = "title"></h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" id = "wikiType"><a href="#"></a></li>
    <li class="breadcrumb-item" id = "Topic"><a href="#"></a></li>
    <li class="breadcrumb-item active" aria-current="page" id = "page"></li>
  </ol>
</nav>
<hr style = 'border-top: 1px solid black;'>
<h5 id = "main"></h5>
<div class="row d-flex justify-content-center">
  <div class="col-md-8 col-lg-6" style = 'width: 100%;'>
    <div style="background-color: #f0f2f5;">
      <div class="card-body p-4" id = "commentMain">
        <div class="form-outline mb-4">
          <input type="text" id="addANote" class="form-control" placeholder="Type comment..."/>
          <label class="form-label" for="addANote" id = 'commentSubmit'>+ Add a comment</label>
        </div>
      </div>
    </div>
  </div>
</div>
</div>



<script>
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}

function myDropFunc() {
  var x = document.getElementById("demoDrop");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-green";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-green", "");
  }
}


let currentPost = localStorage.getItem('currentPost');
$.ajax({
  url:"knowledge/getPost.php",
  type:"POST",
  data: {currentPost : currentPost},
  success: function(responseData){
    let temp = JSON.parse(responseData);
    document.getElementById("title").innerHTML = temp[0].name;
    document.getElementById("main").innerHTML = temp[0].description;
    let main = document.getElementById("main");
    let found = false;
      for (let i = 0 ; i< main.getElementsByTagName('h1').length; i++) {
        document.getElementById("contentBar").innerHTML += `<a class="w3-bar-item w3-button" onclick = "document.getElementById('main').getElementsByTagName('h1')[${i}].scrollIntoView();">➤ ${main.getElementsByTagName('h1')[i].innerHTML}</a>`;
        found = true;
      }
      (localStorage.getItem("technical") == 1) ? document.getElementById("wikiType").innerHTML = 'Technical Wiki' : document.getElementById("wikiType").innerHTML = 'Non Technical Wiki';
      document.getElementById("Topic").innerHTML = localStorage.getItem("topicName");
      document.getElementById("page").innerHTML = document.getElementById("title").innerHTML = temp[0].name;

    if (found === false) {
      document.getElementById("contentBar").innerHTML += `<h5><i>Add headers for contents</i></h5>`
    }
  },

  error: function(e){
      console.log(e.message);
  }
});

$.ajax({
    url:"knowledge/getComments.php",
    type:"POST",
    data: {currentPost : currentPost},
    success: function(responseData){
    let temp = JSON.parse(responseData);
    console.log(temp.length);
    if (temp.length == null) {
      document.getElementById("commentMain").innerHTML += `<h5 style = 'text-align: center;'><i>No comments for this post yet</i></h5>`;
    }
    temp.forEach((message) => {
    document.getElementById("commentMain").innerHTML += `
      <div class="card">
            <div class="card-body">
            <p>${message.comment}</p>

              <div class="d-flex justify-content-between">
                <div class="d-flex flex-row align-items-center">
                  <img src="https://i.imgur.com/518PEmt.png" alt="avatar" width="25"
                    height="25" />
                  <p class="small mb-0 ms-2">${message.author}</p>
                </div>
                <div class="d-flex flex-row align-items-center">
                  <p class="small text-muted mb-0">${message.datePosted}</p>
                  <i class="far fa-thumbs-up ms-2 fa-xs text-black" style="margin-top: -0.16rem;"></i>
                </div>
              </div>
            </div>
          </div>`;
      });
    },
    error: function(e){
        console.log(e.message);
    }
});

  $(document).on('click',"#commentSubmit",function(event){
    console.log('test');
    let postId = localStorage.getItem('currentPost'); 
    let author = ('<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>');
    let comment = $("#addANote").val();
    console.log(comment);
    $.ajax({
      url:"knowledge/addComment.php",
      type:"POST",
      data: {postId : postId,author : author, comment : comment},
      success: function(responseData){
        console.log(responseData);
        location.reload();
      },
      error: function(e){
          console.log(e.message);
      }
    });
  });




</script>

</body>
</html>