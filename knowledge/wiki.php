<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $(function(){

      if ((<?php echo ($_SESSION['isAdmin'])?>) == false) {
        $("#addTaskButton").hide();
      };

      $("#addPostForm").submit(function(event){
        event.preventDefault();
          let topicName = $("#topicName").val();
          let technical = localStorage.getItem("technical");
          $.ajax({
            url:"knowledge/addTopics.php",
            type:"POST",
            data: {topicName : topicName, technical: technical},
            success: function(responseData){
              console.log(responseData);
                if (responseData === "true"){
                  $('#addPostModal').modal('hide');
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  location.reload();
                } else {
                    window.alert("Error!");
                }
            },
            error: function(e){
                window.alert("Error Occurred! Please refer to console.");
                console.log(e.message);
            }
        });

        event.preventDefault();       
          
      });
    });
    
    
    function searchFilter(x) {
        var posts = document.getElementsByClassName("letter");
        var nothing = false;
        for(var j = 0; j<posts.length;j++) {
          var letterFound = false;
          posts[j].style.display = 'block';
          for (var i = 0; i<posts[j].getElementsByTagName("li").length; i ++) {

            posts[j].getElementsByTagName("li")[i].style.display = 'list-item';
            var textInside = posts[j].getElementsByTagName("li")[i].getElementsByTagName("a")[0];

            if (!(textInside.innerHTML.toLowerCase().includes(x.toLowerCase().trim()))) {
                posts[j].getElementsByTagName("li")[i].style.display = 'None';
            }
            else {
              nothing = letterFound = true;
            }
            
          }

          if (letterFound === false) {
            posts[j].style.display = 'None';
        }

        }

        if (nothing === false) {
            document.getElementsByClassName("container")[0].style.display = 'None';
            document.getElementById("notFound").innerHTML = "Couldn't find what you were looking for.";
        }
        else {
          document.getElementsByClassName("container")[0].style.display = 'block';
          document.getElementById("notFound").innerHTML = "";
        }
        
    }
    
</script>
</head>
<body>
<div id="contextMenu" class="context-menu" style="display:none">
  <ul>
      <li><a href="#" id = 'deleteMenu'>Delete</a></li>
  </ul>
</div>
<div class="modal" id="addPostModal" tabindex="-1" role="dialog" aria-labelledby="addPostModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterTaskModalLabel">Create new topic - <span style="font-size:1rem;"> Logged in as: <? echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@")); ?></span>  </h5>
                </div>
                <div class="modal-body">
                    <form id="addPostForm">
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


<div id="knowledgeDiv" style = 'height: 100vh;'>
<div id="mainDiv" class = 'flex-master'>
<section class="jumbotron jumbotron-fluid col full-height" style = 'margin-top: 0px;'>
  <div style="width:100%" id="Options">
      <h5 style="padding-top:27px;">Options</h5>
      <hr class="my-4">
      <div class="input-group rounded">
        <input type="search" value = "" class="form-control rounded" placeholder="Search Topic" id="wordSelect" onchange="searchFilter(this.value)" aria-label="Search" aria-describedby="search-addon" />
        <span class="input-group-text border-0" id="search-addon">
          <i class="fas fa-search"></i>
        </span>
      </div>
    <div style = 'margin-top: 20px;'>
      <button class="btn btn-primary" id='addTaskButton' type="button" data-bs-toggle="modal" data-bs-target="#addPostModal" aria-controls="addPostModal">Create Topic</button>
      <br>
      <br>
      <button class="btn btn-primary" id='FAQButton' type="button" onclick="navclick('/knowledge/faq.php')">FAQ</button>
  </div>
    </div>
</section>

<p id ="nomatches"></p>

<div id="contentDiv" style = 'width:80%;'>
<div style = 'width: 100%;'>
<h1 id = 'chooseTopic'></h1>
<a href='#' id = 'prev'>Prev Page</a>
<div style = 'margin-left: 70%; display: inline;'>
<a href='#' id = 'next'>Next Page</a>
  </div>
<hr style = 'border-top: 1px solid black;'>
  </div>
  <div class="container" style = 'height: 85%; column-count:5; column-fill: auto; margin-left: 0px;'>
  <div class = "letter">
    <h1>A</h1>
    <li><a href = 'google.com'>test</a></li>
  </div>
  <div class = "letter">
    <h1>B</h1>
      <li><a href = 'google.com'>test</a></li>
  </div>
  </div>
  <div id = 'notFound' style = 'text-align: center;'></div>
  </div>
  </div>
  </div>
  </div>
<script>
  
   $(document).ready(function(){
      localStorage.setItem("currentPage", "knowledge/wiki.php");
      (localStorage.getItem("technical") == 1) ? document.getElementById('chooseTopic').innerHTML = 'Choose Technical Topic' : document.getElementById('chooseTopic').innerHTML = 'Choose non Technical Topic';
    });

    const maxItemsOnScreen = 90;
    console.log(typeof maxItemsOnScreen);
    var bottom = localStorage.hasOwnProperty('bottom') ? Number(localStorage.getItem("bottom")) : 0;
    var top1 = localStorage.hasOwnProperty('top') ? Number(localStorage.getItem("top")) : maxItemsOnScreen;
    var topicCount = 0;
    $.ajax({
            url:"knowledge/getTopics.php",
            success: function(responseData){
                let technical = localStorage.getItem("technical");
                let temp = JSON.parse(responseData);
                const letterToTopic = new Map();
                var posts = document.getElementsByClassName("letter");
                temp.forEach((topic) => {
                  if (topic.technical === technical) {
                    var letter = topic.name.charAt(0).toUpperCase();
                    letterToTopic.has(letter) ? letterToTopic.get(letter).push(topic.name.charAt(0).toUpperCase() + topic.name.slice(1)) : letterToTopic.set(letter,[topic.name.charAt(0).toUpperCase() + topic.name.slice(1)]);
                }
              });

            document.getElementsByClassName("container")[0].innerHTML = '';
            const sortedLetterToTopic = new Map([...letterToTopic].sort());
            sortedLetterToTopic.forEach((value, key) => {
              topicCount += 3;
              if (bottom <= topicCount && top1 > topicCount) {
              var container = document.getElementsByClassName("container")[0];
              var letterDiv = document.createElement("div");
              var h1 = document.createElement("h1");
              h1.appendChild(document.createTextNode(key));
              letterDiv.appendChild(h1);
              letterDiv.setAttribute("class", "letter");
              value.sort().forEach((topicName) => {
                  topicCount += 1;
                  var a = document.createElement("a");
                  var li = document.createElement("li");
                  a.setAttribute("href","#");
                  a.appendChild(document.createTextNode(topicName));
                  document.onclick = hideMenu;
                  if (<?php echo ($_SESSION['isAdmin'])?>) {
                      a.oncontextmenu = rightClick(topicName);
                  }
                  li.appendChild(a);
                  letterDiv.appendChild(li);
                
              });
              container.appendChild(letterDiv);
              }
              else {
                value.forEach((topicName) => {
                  topicCount += 1;
                });
              }
            document.getElementById("next").style.display = top1 <= topicCount ? "inline" : 'None';
            document.getElementById("prev").style.display = bottom > 0 ? "inline" : 'None';
            });
            },
            error: function(e){
                console.log(e.message);
            }
        });


  function hideMenu() {
      document.getElementById(
          "contextMenu").style.display = "none";
  }

  function rightClick(topicName) {
    return function(e) {
      e.preventDefault();

      if (document.getElementById(
          "contextMenu").style.display == "block") {
          hideMenu();
        }
      else {
          var menu = document
              .getElementById("contextMenu");
          menu.title = topicName;
          menu.style.display = 'block';
          menu.style.left = e.pageX + "px";
          menu.style.top = e.pageY + "px";
          console.log(menu.title);
      }
    }
  }

  $("#deleteMenu").click(function(event){
    let topicName = document.getElementById('contextMenu').title;
    $.ajax({
        url:"knowledge/deleteTopic.php",
        type:"POST",
        data: {topicName : topicName},
        success: function(responseData){
          location.reload();
          hideMenu();
        },
        error: function(e){
            window.alert("Error Occurred! Please refer to console.");
            console.log(e.message);
        }
    });
  });

  $("#next").click(function() {
    if (top1 <= topicCount){
      bottom += Number(maxItemsOnScreen);
      top1 += Number(maxItemsOnScreen);
      localStorage.setItem("bottom", bottom);
      localStorage.setItem("top", top1);
      location.reload();
    }
  });

  $("#prev").click(function() {
    if (bottom > 0) {
      bottom -= Number(maxItemsOnScreen);
      top1 -= Number(maxItemsOnScreen);
      localStorage.setItem("bottom", bottom);
      localStorage.setItem("top", top1);
      location.reload();
    }
  });

</script>
</body>
</html>
