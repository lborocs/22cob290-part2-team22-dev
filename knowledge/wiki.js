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
                console.log(responseData);
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


var quill;

$("#addPageForm").submit(function(event){
  event.preventDefault();
  let pageName = $("#pageName").val();
  let topicDescription = quill.root.innerHTML;
  console.log(topicDescription);
  let associatedTopics = localStorage.getItem("topicName");
  $.ajax({
      url:"knowledge/addPost.php",
      type:"POST",
      data: {pageName : pageName, topicDescription: topicDescription, associatedTopics: associatedTopics,author : author},
      success: function(responseData){
        console.log(responseData);
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

$(document).ready(function(){
  setTimeout( () =>
  {
        quill = new Quill('#pageDescription', {
          modules: {
          toolbar: [
            [{ font: [] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            ["bold", "italic", "underline", "strike"],
            [{ color: [] }, { background: [] }],
            [{ script:  "sub" }, { script:  "super" }],
            ["blockquote", "code-block"],
            [{ list:  "ordered" }, { list:  "bullet" }],
            [{ indent:  "-1" }, { indent:  "+1" }, { align: [] }],
            ["image"],
            ["clean"],
          ],
          },
          placeholder: 'Compose an epic...',
          theme: 'snow'  // or 'bubble'
      });
      quill.on('text-change', function() {
        console.log(quill.root.innerHTML);
      });
  }, 1000 );


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
  var admin;

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
                   if (admin) {
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
                  letterToPage.has(letter) ? letterToPage.get(letter).push([page.name.charAt(0).toUpperCase() + page.name.slice(1), page.postID]) : letterToPage.set(letter,[[page.name.charAt(0).toUpperCase() + page.name.slice(1), page.postID]]);
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
                  console.log(pageName[1]);
                  topicCount += 1;
                  var a = document.createElement("a");
                  var li = document.createElement("li");
                  a.setAttribute("href","#");
                  a.setAttribute("onclick","localStorage.setItem('currentPost','" + pageName[1] + "'); navclick('knowledge/posts.php');")
                  a.appendChild(document.createTextNode(pageName[0]));
                  document.onclick = hideMenu;
                  if (admin) {
                      a.oncontextmenu = rightClick(pageName[0]);
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