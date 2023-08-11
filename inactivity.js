
idleMax = 15;// Logout after 10 minutes of IDLE
idleTime = 0;
$(document).ready(function () {
    var idleInterval = setInterval("timerIncrement()", 60000); 
    $(this).mousemove(function (e) {idleTime = 0;});
    $(this).keypress(function (e) {idleTime = 0;});
})
function timerIncrement() {
    fillstuff();
    
    idleTime = idleTime + 1;
    if (idleTime > idleMax) { 
        window.location="index.php";
    }
}

