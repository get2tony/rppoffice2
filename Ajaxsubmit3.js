


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
    var whtpaid = document.getElementById("whtpaid").value;
    
    var whttnx = document.getElementById("whttnx").value;
    var whtpen = document.getElementById("whtpen").value;
    var whtrate = document.getElementById("whtrate").value;
    // var vatpaid = document.getElementById("vatpaid").value;
      



// here we stop

// Returns successful data submission message when the entered information is stored in database.
    var dataString = 'coytin=' + coytin + '&coyname=' + coyname + '&address=' + address + '&yoa=' + yoa 
    + '&capture=' + capture + '&ttype=' + ttype + '&amount=' + amount + '&startdate=' + startdate + '&enddate=' + enddate + '&basis=' + basis
     + '&user=' + user + '&usersno=' + usersno + '&assmn=' + assmn + '&whtpaid=' + whtpaid 
        + '&whttnx=' + whttnx + '&whtpen=' + whtpen + '&whtrate=' + whtrate;
if (coytin == '' || coyname == '' || amount == '' || user == '') {
alert("Please Fill All Fields");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "dosubmitasswht.php",
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

