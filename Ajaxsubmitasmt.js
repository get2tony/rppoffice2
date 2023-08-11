


function myFunction() {

// here we go 

    var data1 = document.getElementById("data1").value;
    var data2 = document.getElementById("data2").value;
    var data3 = document.getElementById("data3").value;
    var data4 = document.getElementById("data4").value;
    var data5 = document.getElementById("data5").value;
    var data6 = document.getElementById("data6").value;
    var data7 = document.getElementById("data7").value;
    var data8 = document.getElementById("data8").value;
    var data9 = document.getElementById("data9").value;
    var data10 = document.getElementById("data10").value;
    var data11 = document.getElementById("data11").value;
    var data12= document.getElementById("data12").value;
    var data13= document.getElementById("data13").value;
    var data14= document.getElementById("data14").value;
    var data15= document.getElementById("data15").value;
    var data16= document.getElementById("data16").value;
    var data17= document.getElementById("data17").value;
    var data18= document.getElementById("data18").value;
    var data19= document.getElementById("data19").value;
    var data20= document.getElementById("data20").value;
    
    
   
      



// here we stop

// Returns successful data submission message when the entered information is stored in database.
    var dataString = 'data1=' + data1 + '&data2=' + data2 + '&data3=' + data3 + '&data4=' + data4 
    + '&data5=' + data5 + '&data6=' + data6 + '&data7=' + data7 + '&data8=' + data8 + '&data9=' + data9 + '&data10=' + data10
     + '&data11=' + data11 + '&data12=' + data12 + '&data13=' + data13 + '&data14=' + data15 
        + '&data16=' + data16 + '&data17=' + data17 + '&data18=' + data18 + '&data19=' + data19 
        + '&data20=' + data20;
if (data1 == '' || data2 == '' || data6 == '' || data16 == '') {
alert("Please Fill All Fields");
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "viewass.php",
data: dataString,
cache: false,
success: function() {

}

});

}

return false;
    
}

