$(function() {
    localStorage.setItem("currentPage", "faq/faq.php");
    (localStorage.getItem("technical") == 1) ? document.getElementById("wikiType").innerHTML = `<a href = '#' onclick = "navclick('knowledge/wiki.php'); localStorage.setItem('posts',0); location.reload(); localStorage.setItem('currentPage', 'knowledge/wiki.php');">Technical Wiki</a>` : document.getElementById("wikiType").innerHTML = `<a href = '#' onclick = "navclick('knowledge/wiki.php'); localStorage.setItem('posts',0); location.reload(); localStorage.setItem('currentPage', 'knowledge/wiki.php');">Non Technical Wiki</a>`;
    document.getElementById("page").innerHTML = 'FAQ';
});

function searchFilter(x) {
    var posts = document.getElementsByClassName("questionAnswerWrapper");
    document.getElementById("notFound").innerHTML = "";
    let nothing = true;
    for(var j = 0; j<posts.length;j++) {
        console.log('hello')
        posts[j].style.display = 'block';
        console.log(posts[j].getElementsByTagName('b')[0].innerHTML);
        if (!( posts[j].getElementsByTagName('b')[0].innerHTML.toLowerCase().includes(x.toLowerCase().trim()))) {
            posts[j].style.display = 'None';
        }     
        else {
            nothing = false;
        }
    }
    if (nothing) {
        document.getElementById("notFound").innerHTML = "Couldn't find what you were looking for.";
    }        
}

var link;
const formdata = new FormData();
const file = document.getElementById("file");
file.addEventListener("change", ev => {
    formdata.append("image", ev.target.files[0]);
      fetch("https://api.imgur.com/3/image/", {
          method: "post",
          headers: {
              Authorization: "Client-ID 152051c2d7a71e4"
          },
          body: formdata
      }).then(data => data.json()).then(data => {
          console.log('now');
          link = data.data.link;
        });
  });


$("#addFaqModal").submit(function(event){
    let question = $("#question").val();
    let answer = document.getElementById("answer").value;
    if (link == null) {
        link = '';
    }
    $.ajax({
        url:"faq/addFaq.php",
        type:"POST",
        data: {question : question, answer: answer, image: link},
        success: function(responseData){
        console.log(responseData);
            if (responseData === "true"){
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


$.ajax({
    url:"faq/get.php",
    success: function(responseData){
    let temp = JSON.parse(responseData);
    let first = true;
    temp.forEach((faq) => {
        if (faq.question != "") {
            var container = document.getElementById("module");
            var qaWrapper = document.createElement("div");
            qaWrapper.setAttribute("class","questionAnswerWrapper");
            let question = faq.question;
            let answer = faq.answer;
            let id = faq.faqID;
            let img = faq.attachments;
            if (!first) {
                qaWrapper.innerHTML = `  
                    <hr style = 'border-top: 1px solid black;'>`;
            }
            qaWrapper.innerHTML += `
                <h3><b>${question}</b></h3>
                <br>
                <p class="collapse" id=x${id} aria-expanded="false">${answer}<br><img src="${img}"></p>
                <a role="button" class="collapsed" data-bs-toggle="collapse" href="#x${id}" aria-expanded="false" aria-controls=x${id}></a>`;
            container.appendChild(qaWrapper);
            first = false;
        }
    });
    },
    error: function(e){
        window.alert("Error Occurred! Please refer to console.");
        console.log(e.message);
    }
});