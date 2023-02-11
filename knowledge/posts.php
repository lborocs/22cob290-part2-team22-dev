<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../navbar.js"></script>
    <script src="knowledge/posts.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
</head>
<body>

<script>let author = ('<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>');</script>

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

</body>
</html>