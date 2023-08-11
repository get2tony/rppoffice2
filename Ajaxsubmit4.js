


function myFunction() {

// here we go

    var coytin = document.getElementById("coytin").value;
    var coyname = document.getElementById("coyname").value;
    var address = document.getElementById("address").value;
    var yoa = document.getElementById("yoa").value;
    var capture = document.getElementById("capture").value;

    var ttype = document.getElementById("ttype").value;
    var amount = document.getElementById("amount").value;
    var startdate = document.getElementById("startdate").value;
    var enddate = document.getElementById("enddate").value;
    var basis = document.getElementById("basis").value;

    var user = document.getElementById("user").value;
    var usersno = document.getElementById("usersno").value;
    var assmn = document.getElementById("assmn").value;
    var cgtpaid = document.getElementById("cgtpaid").value;

    var cgttnx = document.getElementById("cgttnx").value;
    var cgtpen = document.getElementById("cgtpen").value;
    var cgtrate = document.getElementById("cgtrate").value;
    // var vatpaid = document.getElementById("vatpaid").value;




// here we stop

// Returns successful data submission message when the entered information is stored in database.
    var dataString = 'coytin=' + coytin + '&coyname=' + coyname + '&address=' + address + '&yoa=' + yoa
    + '&capture=' + capture + '&ttype=' + ttype + '&amount=' + amount + '&startdate=' + startdate + '&enddate=' + enddate + '&basis=' + basis
     + '&user=' + user + '&usersno=' + usersno + '&assmn=' + assmn + '&cgtpaid=' + cgtpaid
        + '&cgttnx=' + cgttnx + '&cgtpen=' + cgtpen + '&cgtrate=' + cgtrate;
if (coytin == '' || coyname == '' || amount == '' || user == '') {
alert("Please Fill All Fields");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "dosubmitasscgt.php",
data: dataString,
cache: false,
success: function(html) {
alert(html);
    history.go(-1);
}

});

}

return false;

}
