
//delscript 


function submitClick() {
    if (getCheckedboxes()) {
      return true;
    } else {
      return false;
    }
  }
function getCheckedboxes(){
    var items=document.getElementsByName('list');
    var selectedItems=[];
    for(var i=0; i<items.length; i++){
        if(items[i].type=='checkbox' && items[i].checked==true)
            selectedItems.push(items[i].value);
    }
    var b=JSON.stringify(selectedItems);
    document.getElementById('selected').value=b;
    var k= selectedItems.length;
    return confirm("Do you really want to Delete "+k+" Asmts ?");



}		

$(document).ready(function () {
    var link = document.getElementById('del');
   
    $(':checkbox').change(function() {

      if (this.checked || checkSelect()>0) {
        link.style.visibility = 'visible';
        }else{
        link.style.visibility = 'hidden';
        } 

        }); 
    
    

 });
 

 function checkSelect(){
    var items=document.getElementsByName('list');
    var selectedItems=[];
    for(var i=0; i<items.length; i++){
        if(items[i].type=='checkbox' && items[i].checked==true)
            selectedItems.push(items[i].value);
    }
    return selectedItems.length;
 }
 function toggle(source) {
    checkboxes = document.getElementsByName('list');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }
  