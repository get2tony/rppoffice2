


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
    var edtpaid = document.getElementById("edtpaid").value;
    var citpaid = document.getElementById("citpaid").value;

    var aprofit = document.getElementById("aprofit").value;
    var tprofit = document.getElementById("tprofit").value;
    var citpen = document.getElementById("citpen").value;
    var edtpen = document.getElementById("edtpen").value;
    var vatpen = document.getElementById("vatpen").value;
    
    var inputtax = document.getElementById("inputtax").value;
    var vatpaid = document.getElementById("vatpaid").value;
    var vatsales = document.getElementById("vatsales").value;
    var vatexmpt = document.getElementById("vatexmpt").value;

    var vatrate = document.getElementById("vatrate").value;
    var citrate = document.getElementById("citrate").value;
    var edtrate = document.getElementById("edtrate").value;



    // <input type="hidden" value="<?php echo $vatexmpt;?>"  id="vatexmpt" name="vatexmpt">
    //            <input type="hidden" value="<?php echo $vatsales;?>"  id="vatsales" name="vatsales"></input>
      



// here we stop

// Returns successful data submission message when the entered information is stored in database.
    var dataString = 'coytin=' + coytin + '&coyname=' + coyname + '&address=' + address + '&yoa=' + yoa 
    + '&capture=' + capture + '&ttype=' + ttype + '&amount=' + amount + '&startdate=' + startdate + '&enddate=' + enddate + '&basis=' + basis
     + '&user=' + user + '&usersno=' + usersno + '&assmn=' + assmn + '&edtpaid=' + edtpaid 
        + '&citpaid=' + citpaid + '&aprofit=' + aprofit + '&tprofit=' + tprofit + '&citpen=' + citpen 
        + '&edtpen=' + edtpen + '&vatpen=' + vatpen + '&inputtax=' + inputtax + '&vatpaid=' + vatpaid + '&vatsales=' + vatsales + '&vatexmpt=' + vatexmpt
        + '&vatrate=' + vatrate + '&citrate=' + citrate  + '&edtrate=' + edtrate;
if (coytin == '' || coyname == '' || amount == '' || user == '') {
alert("Please Fill All Fields");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "dosubmitass.php",
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

