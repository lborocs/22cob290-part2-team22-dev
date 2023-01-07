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

      $("#addTopicForm").submit(function(event){
        event.preventDefault();
        let topicName = $("#topicName").val();
        let technical = localStorage.getItem("technical");
          $.ajax({
            url:"knowledge/addTopics.php",
            type:"POST",
            data: {topicName : topicName, technical: technical},
            success: function(responseData){
                if (responseData === "true"){
                  $('#addTopicModal').modal('hide');
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
    $("#addPageForm").submit(function(event){
      event.preventDefault();
      let pageName = $("#pageName").val();
      let topicDescription = $("#pageDescription").val();
      let associatedTopics = localStorage.getItem("topicName");
      let author = ('<?php echo substr($_SESSION['email'], 0, strpos($_SESSION['email'], "@"));?>');
      $.ajax({
          url:"knowledge/addPost.php",
          type:"POST",
          data: {pageName : pageName, topicDescription: topicDescription, associatedTopics: associatedTopics,author : author},
          success: function(responseData){
              if (responseData === "true"){
                $('#addPageModal').modal('hide');
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
<script>
  
   $(document).ready(function(){
      localStorage.setItem("currentPage", "knowledge/wiki.php");
      if (localStorage.getItem("posts") === '0') {
        document.getElementById("return").innerHTML = '';
        (localStorage.getItem("technical") == 1) ? document.getElementById('chooseTopic').innerHTML = 'Choose Technical Topic' : document.getElementById('chooseTopic').innerHTML = 'Choose non Technical Topic';
      }
      else {
        document.getElementById('chooseTopic').innerHTML = `Choose Post Associated With "${localStorage.getItem("topicName")}"`; 
        document.getElementById("addTaskButton").innerHTML = 'Add Page';
        document.getElementById("addTaskButton").setAttribute("data-bs-target", "#addPageModal");
        document.getElementById("addTaskButton").setAttribute("aria-controls", "addPageModal");
        const date = new Date();
        let day = date.getDate() > 9 ? date.getDate() : '0' + date.getDate();
        let month = date.getMonth() + 1 > 9 ? (date.getMonth() + 1): '0' + (date.getMonth() + 1);
        let year = date.getFullYear();
        document.getElementById("Date").innerHTML = `Published on - ${day}/${month}/${year}`;
        document.getElementById("return").innerHTML += `<button type="button" class="btn btn-danger" onclick = 'localStorage.setItem("posts",0); location.reload();'>Return To Topics</button>`;
      }
    });

    const maxItemsOnScreen = 90;
    var lower = localStorage.hasOwnProperty('bottom') ? Number(localStorage.getItem("bottom")) : 0;
    var higher = localStorage.hasOwnProperty('top') ? Number(localStorage.getItem("top")) : maxItemsOnScreen;
    var topicCount = 0;
    if (localStorage.getItem("posts") === '0') {
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
                if (lower <= topicCount && higher > topicCount) {
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
                    a.setAttribute("onclick","getPosts(this);");
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
              document.getElementById("next").style.display = higher <= topicCount ? "inline" : 'None';
              document.getElementById("prev").style.display = lower > 0 ? "inline" : 'None';
              });
              },
              error: function(e){
                  console.log(e.message);
              }
          });
        }

      else {
        let topicName = localStorage.getItem("topicName");
        $.ajax({
          type:"POST",
          data: {topicName : topicName},
          url:"knowledge/getPosts.php",
          success: function(responseData){
            if (responseData === 'false') {
              document.getElementsByClassName("container")[0].style.display = 'None';
              document.getElementById("notFound").innerHTML = `Couldn't find any pages associated with "${topicName}".`;
            }
            else {
              let temp = JSON.parse(responseData);
                  const letterToPage = new Map();
                  var posts = document.getElementsByClassName("letter");
                  temp.forEach((page) => {
                    var letter = page.name.charAt(0).toUpperCase();
                    letterToPage.has(letter) ? letterToPage.get(letter).push(page.name.charAt(0).toUpperCase() + page.name.slice(1)) : letterToPage.set(letter,[page.name.charAt(0).toUpperCase() + page.name.slice(1)]);
                });
              document.getElementsByClassName("container")[0].innerHTML = '';
              const sortedLetterToPage = new Map([...letterToPage].sort());
              sortedLetterToPage.forEach((value, key) => {
                topicCount += 3;
                if (lower <= topicCount && higher > topicCount) {
                  var container = document.getElementsByClassName("container")[0];
                  var letterDiv = document.createElement("div");
                  var h1 = document.createElement("h1");
                  h1.appendChild(document.createTextNode(key));
                  letterDiv.appendChild(h1);
                  letterDiv.setAttribute("class", "letter");
                  value.sort().forEach((pageName) => {
                    topicCount += 1;
                    var a = document.createElement("a");
                    var li = document.createElement("li");
                    a.setAttribute("href","#");
                    a.appendChild(document.createTextNode(pageName));
                    document.onclick = hideMenu;
                    if (<?php echo ($_SESSION['isAdmin'])?>) {
                        a.oncontextmenu = rightClick(pageName);
                    }
                    li.appendChild(a);
                    letterDiv.appendChild(li);
                    
                  });
                  container.appendChild(letterDiv);
                }
                else {
                  value.forEach((pageName) => {
                    topicCount += 1;
                  });
                }
              document.getElementById("next").style.display = higher <= topicCount ? "inline" : 'None';
              document.getElementById("prev").style.display = lower > 0 ? "inline" : 'None';
              });
            }
      },
        error: function(e){
            console.log(e.message);
        }
      });
    }

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

  function getPosts(ele) {
    localStorage.setItem("posts",1);
    localStorage.setItem("topicName",ele.innerHTML);
    location.reload();
  }

  $("#next").click(function() {
    if (higher <= topicCount){
      lower += Number(maxItemsOnScreen);
      higher += Number(maxItemsOnScreen);
      localStorage.setItem("bottom", lower);
      localStorage.setItem("top", higher);
      location.reload();
    }
  });

  $("#prev").click(function() {
    if (lower > 0) {
      lower -= Number(maxItemsOnScreen);
      higher -= Number(maxItemsOnScreen);
      localStorage.setItem("bottom", lower);
      localStorage.setItem("top", higher);
      location.reload();
    }
  });

</script>
</body>
</html>
