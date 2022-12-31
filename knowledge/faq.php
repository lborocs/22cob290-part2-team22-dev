<?session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../navbar.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
    $(function(){
      $("#addFAQform").submit(function(event){
        event.preventDefault();
          let question = $("#question").val();
          let answer = $("#answer").val();
          let tags = $("#tags").val();
          
          $.ajax({
              url:"../knowledge/addFaq.php",
              type:"POST",
              data: {question: question, answer: answer, tags: tags},
              success: function(){
                  $('#addFAQModal').hide();
                  $('body').removeClass('modal-open');
                  $('.modal-backdrop').remove();
                  navclick("/knowledge/faq.php");
              },
              error: function(e){
                  window.alert("Error Occurred! Please refer to console.");
                  console.log(e.message);
              }
          });
          
      });
    });
    </script>
</head>
<body>
<div class="modal" id="addFAQModal" tabindex="-1" role="dialog" aria-labelledby="addFAQModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="filterTaskModalLabel">Add FAQ</h5>
              </div>

              <div class="modal-body">
                  <form id="addFAQform">
                      <div class="form-group">
                          <label for="title">Question</label>
                          <textarea style="margin-bottom:1rem; resize:none;" class="form-control" id="question" name="question" rows="3"></textarea>
                          <label for="title">Answer</label>
                          <textarea style="margin-bottom:1rem; resize:none;" class="form-control" id="answer" name="answer" rows="3"></textarea>
                          <label for="tags">Choose subject(s) <span style="font-size:0.5rem;">CTRL Click for multiple</span></label>
                          <select class="form-control" style="height:3rem; margin-bottom:1rem;" id="tags" name="tags[]" multiple>
                              <option value="News">News</option>
                              <option value="Technical">Technical</option>
                              <option value="Non-Technical">Non-Technical</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
    <div style = 'text-align: center;'>Frequently Asked Questions</div>
    <button class="btn btn-primary" id='backButton' onclick='navclick("knowledge/forum.php")' type="button">Back</button>
<div id= 'posts'>
    <div class="card" style="width:95%;margin:auto !important;" id='postCard'>
    <div class="card-body">
      <h1 class="card-title"></h1>
      <h6 class="card-subtitle">Question</h6>
    
      <p class="card-text"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut.</em></p>
    <h6 class="card-subtitle">Answer</h6>
    <p class="card-text">The answer is ...</p>
    <h6 class="card-subtitle">Tags</h6>
    <p class="card-text"><span class="badge rounded-pill Non-Technical">Non-Technical</span></p>
    </div>
</div>
    <div class="card" style="width:95%;margin:auto !important;" id='postCard'>
    <div class="card-body">
      <h1 class="card-title"></h1>
      <h6 class="card-subtitle">Question</h6>
      <p class="card-text"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut.</em></p>
      <h6 class="card-subtitle">Answer</h6>
    <p class="card-text">The answer is ...</p>
    <h6 class="card-subtitle">Tags</h6>
    <p class="card-text"><span class="badge rounded-pill Technical">Technical</span></p>
    </div>
    </div>
    <div class="card" style="width:95%;margin:auto !important;" id='postCard'>
    <div class="card-body">
      <h1 class="card-title"></h1>
      <h6 class="card-subtitle">Question</h6>
    
      <p class="card-text"><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam semper diam at erat pulvinar, at pulvinar felis blandit. Vestibulum volutpat tellus diam, consequat gravida libero rhoncus ut.</em></p>
      <h6 class="card-subtitle">Answer</h6>
    <p class="card-text">The answer is ...</p>
    <h6 class="card-subtitle">Tags</h6>
    <p class="card-text"><span class="badge rounded-pill News">News</span></p>
    </div>
    <div id='postFooter'>
    </div>
    </div>
</div>
<br>
<div style = 'text-align: center;'>
<button id='addFAQ' type='button' data-bs-toggle='modal' data-bs-target='#addFAQModal' aria-controls='addFAQModal'>Add FAQ</button>
</div>
</body>
<script>
  
   $(document).ready(function(){
        
            localStorage.setItem("currentPage", "knowledge/faq.php");
   });
            
    $.ajax({
    url:"/knowledge/retrieveFaq.php",
    success: function(responseData){
        let temp = JSON.parse(responseData);
        for(let j = 0; j < temp.length; j++){
            let post = temp[j];
        
            let id = post.id;
            let question = post.question;
            let answer = post.answer;

            
            document.getElementById("posts").innerHTML += `   
            <div class="card" style="width:95%;margin:auto !important;" id='postCard'>
                <div class="card-body">
                    <h1 class="card-title"></h1>
                        <h6 class="card-subtitle">Question</h6>
                        <p class="card-text"><em>`+question+`</em></p>
                        <h6 class="card-subtitle">Answer</h6>
                        <p class="card-text">`+answer+`</p>
                        <h6 class="card-subtitle">Tags</h6>
                        <p class="card-text" id = "cardNo`+j+`">
                        </p>
                </div>
            </div>`;

            for(let i = 0; i < post.tags.length; i++){
                document.getElementById("cardNo"+j).innerHTML += `                        
                <span class="badge rounded-pill `+post.tags[i]+`">`+post.tags[i]+`</span>`;
            }
            

            }
        
        },
    error: function(e){
        console.log(e.message);
    }
    
});
        
</script>



</html>
