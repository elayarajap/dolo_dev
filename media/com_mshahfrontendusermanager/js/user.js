
function fncSubmit() {
  if(document.maintenanceprovider.password.value != document.maintenanceprovider.ConPassword.value)
  {
    alert('Confirm Password Not Match');
    document.maintenanceprovider.ConPassword.focus();   
    return false;
  } 
  document.maintenanceprovider.submit();
}
  

function blockUser(frm,root_url) {     
        var message;
        var count=0;

   //For each checkbox see if it has been checked, record the value.
   for (i = 0; i < frm.checkbox.length; i++)
      if (frm.checkbox[i].checked){
         message = frm.checkbox[i].value + "\n"
         count++;
        var strURL="http://localhost/trunk/portal/media/com_mshahfrontendusermanager/js/block_unblock_delete.php?run=blockUser&checkbox="+message;
        $.ajax({
           url: strURL,
           type: 'put',
           success: function(response) {
             //...
             alert(req.responseText)
           }
        });
      
      }

  if(count==0)
    alert("Select Atleast One User")
  else
   self.setInterval(function(){redirecting(count)},1000);
}

function redirecting(count) {
  alert(count+ '  User Are Successfully Blocked');
  window.location.href="./mshahfrontendusermanager";
}


function unblockUser(frm,root_url) {     
        var message;
        var count=0;

   //For each checkbox see if it has been checked, record the value.
   for (i = 0; i < frm.checkbox.length; i++)
      if (frm.checkbox[i].checked){
         message = frm.checkbox[i].value + "\n"
         count++;

        var strURL=root_url+"media/com_mshahfrontendusermanager/js/block_unblock_delete.php?run=unblockUser&checkbox="+message;
        $.ajax({
           url: strURL,
           type: 'put',
           success: function(response) {
             //...
             alert(req.responseText)
           }
        }); 
      }

if(count==0)
  alert("Select Atleast One User")
else
 self.setInterval(function(){redirecting1(count)},1000);
}

function redirecting1(count) {
  alert(count+'  User Are Successfully Unblocked');
  window.location.href="./mshahfrontendusermanager";
}


 function doSearch() {
    var searchText = document.getElementById('searchTerm').value;
    var targetTable = document.getElementById('table');
    var targetTableColCount;
            
    //Loop through table rows
    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
        var rowData = '';

        //Get column count from header row
        if (rowIndex == 0) {
           targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
           continue; //do not execute further code for header row.
        }
                
        //Process data rows. (rowIndex >= 1)
        for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
            rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
        }

        //If search term is not found in row data
        //then hide the row, else show
        if (rowData.indexOf(searchText) == -1)
            targetTable.rows.item(rowIndex).style.display = 'none';
        else
            targetTable.rows.item(rowIndex).style.display = 'table-row';
    }
}

function deleteUser(frm,root_url) {     
        var message;
        var count=0;

   //For each checkbox see if it has been checked, record the value.
   for (i = 0; i < frm.checkbox.length; i++)
      if (frm.checkbox[i].checked){
         message = frm.checkbox[i].value + "\n"
         count++;
        var strURL="http://localhost/trunk/portal/media/com_mshahfrontendusermanager/js/block_unblock_delete.php?run=deleteUser&checkbox="+message;
        $.ajax({
           url: strURL,
           type: 'delete',
           success: function(response) {
             //...
             alert(req.responseText)
           }
        });  
      }

if(count==0)
  alert("Select Atleast One User")
else
 self.setInterval(function(){redirecting2(count)},1000);
}

function redirecting2(count) {
  alert(count+'  User Are Successfully Deleted');
window.location.href="./mshahfrontendusermanager";
}


function checkedall(source) {
  var e = document.getElementById("select1");
    var strSel1 =  e.options[e.selectedIndex].value;
  checkboxes = document.getElementsByName('checkbox');
  for(var i=0;i<(strSel1-1);i++) {
    checkboxes[i].checked = source.checked;
  }
}

function modifyUser(val)
{
  var $j = jQuery.noConflict();
  $j("#uid").val(val);
  document.myform.submit();
}


function DoubleScroll(element) {
        // var scrollbar= document.createElement('div');
        // scrollbar.appendChild(document.createElement('div'));
        // scrollbar.style.overflow= 'auto';
        // scrollbar.style.overflowY= 'hidden';
        // scrollbar.firstChild.style.width= element.scrollWidth+'px';
        // scrollbar.firstChild.style.paddingTop= '1px';
        // scrollbar.firstChild.appendChild(document.createTextNode('\xA0'));
       
        // element.onscroll= function() {
        //     scrollbar.scrollLeft= element.scrollLeft;
        // };
        // element.parentNode.insertBefore(element);
    }

    DoubleScroll(document.getElementById('horizontalscrollbar'));