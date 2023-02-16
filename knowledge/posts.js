localStorage.setItem("currentPage", "knowledge/posts.php");
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
      (localStorage.getItem("technical") == 1) ? document.getElementById("wikiType").innerHTML = `<a href = '#' onclick = "navclick('knowledge/wiki.php'); localStorage.setItem('posts',0); location.reload(); localStorage.setItem('currentPage', 'knowledge/wiki.php');">Technical Wiki</a>` : document.getElementById("wikiType").innerHTML = `<a href = '#' onclick = "navclick('knowledge/wiki.php'); localStorage.setItem('posts',0); location.reload(); localStorage.setItem('currentPage', 'knowledge/wiki.php');">Non Technical Wiki</a>`;
      document.getElementById("Topic").innerHTML = `<a href = '#' onclick = "navclick('knowledge/wiki.php'); localStorage.setItem('posts',1); location.reload(); localStorage.setItem('currentPage', 'knowledge/wiki.php');">${localStorage.getItem("topicName")}</a>`;
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
    let postId = localStorage.getItem('currentPost'); 
    let comment = $("#addANote").val();
    $.ajax({
        url:"knowledge/addComment.php",
        type:"POST",
        data: {postId : postId,author : author, comment : comment},
        success: function(responseData){
        location.reload();
        },
        error: function(e){
            console.log(e.message);
        }
    });
});