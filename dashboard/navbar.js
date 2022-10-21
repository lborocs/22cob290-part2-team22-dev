
function toggleClicked() {
    var canSee = $("#offcanvasNavbar").is(":visible");
    if (canSee) {
        const cont = document.getElementById('adjustablecontainer');
        cont.style.setProperty('width', 'calc(100vw - 20vw)');
        cont.style.margin = "0";
    }
}

function navShut() {
    const cont = document.getElementById('adjustablecontainer');
    cont.style.width = "100%";
    cont.style.margin = "0";
}