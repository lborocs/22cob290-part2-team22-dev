<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../navbar.js"></script>
    <script src="faq/faq.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="faq/faq.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>


<div class="modal" id="addFaqModal" tabindex="-1" role="dialog" aria-labelledby="addFaqModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addFaqModalLabel">Create new topic - <span style="font-size:1rem;"> Logged in as: <? echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@")); ?></span>  </h5>
          </div>
          <div class="modal-body">
              <form id="addFaqForm">
                  <div class="form-group">
                      <input hidden type="text" id="user" value="<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>">
                      <label for="question" id = "questionTag">Question</label>
                      <input type="text" class="form-control" id="question" name="topicName" placeholder="Topic Name">
                      <label for="answer" id = "answerTag">Answer</label>
                      <textarea class="form-control" id="answer" rows="3"></textarea>
                      <label for="attachments">Add images</label>
                      <input type="file" id = "file" accept="image/png, image/jpeg"> 
                    </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
      </div>
  </div>
</div>

<h1 id = 'faqTitle'>How Can We Help?</h1> 
<h2 id = 'faqSubTitle'>Search our frequently asked questions.</h2>
<br>
<input type="search" value = "" class="form-control rounded" placeholder="Search Topic" id="wordSelect" onchange="searchFilter(this.value)" aria-label="Search" aria-describedby="search-addon" style = "width: 70%"/>
<br>
<a id = "faqAdd" role="button" href='#' data-bs-toggle="modal" data-bs-target="#addFaqModal" aria-controls="addFaqModal">Add question</a>
<hr style = 'border-top: 1px solid black;'>

<script>
$(function(){
    if ((<?php echo ($_SESSION['isAdmin'])?>) == false) {
      $("#faqAdd").hide();
      admin = false;
    }
    else {
      admin = true;
    }
});
</script>


<div id="module" class="container">
  <div id = "notFound">
</div>

</body>
</html>
