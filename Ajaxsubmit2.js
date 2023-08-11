


function sendVatdetails() {

// here we go 

    var coytin = document.getElementById("coytin").value;
    var coyname = document.getElementById("coyname").value;
    var address = document.getElementById("address").value;
    var yrendm = document.getElementById("yrendm").value;
    var yoa = document.getElementById("yoa").value;

    var capture = document.getElementById("capture").value;
    var duedate = document.getElementById("duedate").value;
    var amount = document.getElementById("amount").value;
    var defaults = document.getElementById("defaults").value;
    var taxtype = document.getElementById("taxtype").value;
    
    var cattype = document.getElementById("cattype").value;
    var paydate = document.getElementById("paydate").value;
    var basis = document.getElementById("basis").value;
    var phone = document.getElementById("phone").value;
    var nob = document.getElementById("nob").value;
    var user = document.getElementById("user").value;

    var userirno = document.getElementById("userirno").value;
    var usersno = document.getElementById("usersno").value;
    var label = document.getElementById("label").value;
    



// here we stop

// Returns successful data submission message when the entered information is stored in database.
    var dataString = 'coytin=' + coytin + '&coyname=' + coyname + '&address=' + address + '&yrendm=' + yrendm 
    + '&yoa=' + yoa + '&capture=' + capture + '&duedate=' + duedate + '&amount=' + amount + '&defaults=' + defaults + '&taxtype=' + taxtype
     + '&cattype=' + cattype + '&paydate=' + paydate + '&basis=' + basis + '&nob=' + nob 
        + '&user=' + user + '&userirno=' + userirno + '&usersno=' + usersno + '&phone=' + phone + '&label=' + label;
if (coytin == '' || coyname == '' || yrendm == '' || user == '') {
alert("Please Fill All Fields");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "dosubmitvat.php",
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

