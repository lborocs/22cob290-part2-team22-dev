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