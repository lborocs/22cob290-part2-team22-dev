<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="knowledge/wiki.js"></script>
    <script src="../navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<script>
$(function(){
    if ((<?php echo ($_SESSION['isAdmin'])?>) == false) {
      $("#addTaskButton").hide();
      admin = false;
    }
    else {
      admin = true;
    }
});
let author = ('<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>');
</script>

<div id="contextMenu" class="context-menu" style="display:none">
  <ul>
      <li><a href="#" id = 'deleteMenu'>Delete</a></li>
  </ul>
</div>
<div class="modal" id="addTopicModal" tabindex="-1" role="dialog" aria-labelledby="addTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterTaskModalLabel">Create new topic - <span style="font-size:1rem;"> Logged in as: <? echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@")); ?></span>  </h5>
                </div>
                <div class="modal-body">
                    <form id="addTopicForm">
                        <div class="form-group">
                            <input hidden type="text" id="user" value="<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>">
                            <label for="topicName">Topic Name</label>
                            <input type="text" class="form-control" id="topicName" name="topicName" placeholder="Topic Name">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<div class="modal" id="addPageModal" tabindex="-1" role="dialog" aria-labelledby="addPageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterTaskModalLabel">Create new Page - <span style="font-size:1rem;"> Logged in as: <? echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@")); ?></span>  </h5>
            </div>
            <div class="modal-body">
                <form id="addPageForm">
                    <div class="form-group">
                        <input hidden type="text" id="user" value="<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>">
                        <label for="PageName">Page Name</label>
                        <input type="text" class="form-control" id="pageName" name="pageName" placeholder="Page Name">
                        <br>
                        <label for="PageDescription">Page Description</label>
                        <textarea id="pageDescription" class="form-control" placeholder = 'Enter Description' name="pageDescription" rows="4" cols="50"></textarea>
                        <br>
                        <label for="Author" id = "Author">Author - <?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?></label>
                        <br>
                        <label for = "Date" id = "Date"></label>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="knowledgeDiv" style = 'height: 100vh;'>
<div id="mainDiv" class = 'flex-master'>
<section class="jumbotron jumbotron-fluid col full-height" style = 'margin-top: 0px;'>
  <div style="width:100%" id="Options">
      <h5 style="padding-top:27px;">Options</h5>
      <hr class="my-4">
      <!-- change to js -->
      <div class="input-group rounded">      
        <input type="search" value = "" class="form-control rounded" placeholder="Search Topic" id="wordSelect" onchange="searchFilter(this.value)" aria-label="Search" aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
          <i class="fas fa-search"></i>
        </span>       
      </div>
    <div style = 'margin-top: 20px;'>
      <!-- change to js -->
      <button class="btn btn-primary" id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addTopicModal" aria-controls="addTopicModal">Add Topic</button>
      <br>
      <br>
      <button class="btn btn-primary" id='FAQButton' type="button" onclick="navclick('/knowledge/faq.php')">FAQ</button>
  </div>
  <br>
  <div id = 'return'>
  </div>
    </div>
</section>

<p id ="nomatches"></p>

<div id="contentDiv" style = 'width:80%;'>
<div style = 'width: 100%;'>
<h1 id = 'chooseTopic'></h1> <!-- change innerHTML -->
<a href='#' id = 'prev'>Prev Page</a>
<div style = 'margin-left: 70%; display: inline;'>
<a href='#' id = 'next'>Next Page</a>
  </div>
<hr style = 'border-top: 1px solid black;'>
  </div>
  <div class="container" style = 'height: 85%; column-count:5; column-fill: auto; margin-left: 0px;'>
  </div>
  <div id = 'notFound' style = 'text-align: center;'></div>
  </div>
  </div>
  </div>
  </div>
</body>
</html>
