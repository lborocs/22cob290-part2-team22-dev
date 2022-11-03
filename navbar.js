
function toggleClicked() {
    var canSee = $("#offcanvasNavbar").is(":visible");
    if (canSee) {
        const cont = document.getElementById('adjustablecontainer');
        
        try {
            cont.style.setProperty('width', 'calc(100vw - 20vw)');
            cont.style.margin = "0";
          }
          catch(err) {
            
          }
    }
}

function navShut() {
    const cont = document.getElementById('adjustablecontainer');
    cont.style.width = "100%";
    cont.style.margin = "0";
}
function changeSelected(name) {
    if (name == "dashboard") {
        
        document.getElementById("dashboardlink").classList.add('selected');
        document.getElementById("projectlink").classList.remove('selected');
        document.getElementById("knowledgelink").classList.remove('selected');
    } else if (name == "project") {
        document.getElementById("projectlink").classList.add('selected');
        document.getElementById("dashboardlink").classList.remove('selected');
        document.getElementById("knowledgelink").classList.remove('selected');
    } else {
        document.getElementById("knowledgelink").classList.add('selected');
        document.getElementById("projectlink").classList.remove('selected');
        document.getElementById("knowledgelink").classList.remove('selected');
    }
}

function navclick(_url){
    $.ajax({
        url : _url,
        type : 'post',
        success: function(data) {
         $('#DIVID').html(data);
        },
        error: function() {
         $('#DIVID').text('An error occurred');
        }
    });
}
