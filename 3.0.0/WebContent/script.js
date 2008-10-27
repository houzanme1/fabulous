//add controlfield
function addRowToTableCtrl()
{
  var tbl = document.getElementById('tblCntrl');
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var count = iteration+1;
  var row = tbl.insertRow(lastRow);
  
  
  
  // middle cell
  var cellRight = row.insertCell(0);
  cellRight.innerHTML='<select name="controlfieldTag_' + count+'"style="color: black; font-weight: bold; font-family: Verdana; font-size: 12px; background-color: #FF6600;"><option value="001">001</option><option value="002">002</option><option value="003">003</option><option value="004">004</option><option value="005">005</option><option value="006">006</option><option value="007">007</option><option value="008">008</option><option value="009">009</option></select>';
  
  
  // right cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  el.type = 'text';
  el.name = 'controlfieldValue_' + count;
  el.id = 'controlfieldValue_' + iteration;
  el.size = 50;
   el.style.backgroundColor='#CCCCCC';
    el.style.fontSize='12px';
  el.style.fontWeight='bold';
  cellRight.appendChild(el);  
 }
 
 // add datafield
 function addRowToTableData()
{
  var tbl = document.getElementById('tblData');
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  
  var iteration = lastRow;
  var count = iteration+1;
  var row = tbl.insertRow(lastRow);
  
 
   // first cell
  var cellRight = row.insertCell(0);
  cellRight.innerHTML='<input type="button" class="buttonS" value="X" title="Remove DataField" onClick="RemoveInnerDatafield(this);"/>';
  
  
  // middle cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('input');
  
  el.type = 'text';
  el.name = 'datafieldTag_' + count;
  el.id = 'datafieldTag_' + iteration;
  el.size = 2;
   el.style.backgroundColor='#9acd32';
    el.style.fontSize='12px';
  el.style.fontWeight='bold';
  cellRight.appendChild(el);  
  
  // right cell
  var cellRight = row.insertCell(2);
  
   cellRight.innerHTML='<select name="datafieldInd1_' + count+'" style="color: black; vertical-align: middle; horizontal-align: middle; font-weight: bold; font-size: 12px; background-color: #FF9933;"><option selected value=" ">_</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select>';
  
    // right cell
  var cellRight = row.insertCell(3);
   cellRight.innerHTML='<select name="datafieldInd2_' + count+'" style="color: black; vertical-align: middle; horizontal-align: middle; font-weight: bold; font-size: 12px; background-color: #FFCC99;"><option selected value=" ">_</option><option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option></select>';
  
  
 
     // right cell
  var cellRight = row.insertCell(4);
  
  var el = document.createElement("table");
  el.setAttribute('class','tabledataS');
   el.setAttribute('cellpadding','2');
   el.setAttribute('id','tblSub'+count);
   var row1 = el.insertRow(0);
  

  
 
  var cellRight1 = row1.insertCell(0);
  var el1 = document.createElement('input');
  
  el1.type = 'text';
  el1.name = 'subfield_'+count+'_1' ;
  el1.id = 'subfield_0' 
  el1.size = 1; 
   el1.style.backgroundColor='#CC99CC';
    el1.style.fontSize='12px';
  el1.style.fontWeight='bold';
  cellRight1.appendChild(el1);
  
  
  var cellRight2 = row1.insertCell(1);
  var el2 = document.createElement('textarea');
  el2.name = 'subvalue_'+count+'_1' ;
  el2.id = 'subvalue_0'; 
  el2.row = 3;
  el2.cols=80;
   el2.style.backgroundColor='#CCCCCC';
    el2.style.fontSize='12px';
  el2.style.fontWeight='bold';
   cellRight2.appendChild(el2);
  
  
  
  cellRight.appendChild(el);  
  
  
  // add button
   var cellRight = row.insertCell(5);
   cellRight.innerHTML='<input type="button" value="+" class="buttonS" title="Add Subfield" onclick="addSubfieldTest2('+count+');" />&nbsp;<input type="button"  value="-" class="buttonS" title="Remove Subfield" onclick="removeSubField('+count+');" />';
  

 }
 
 
  
  // add subfields
 function addSubfieldTest2(num)
{
  var orig=num+1;
 //	var orig=num;
  var tbl = document.getElementById('tblSub'+num);
  var lastRow = tbl.rows.length;
  // if there's no header row in the table, then iteration = lastRow + 1
  var iteration = lastRow;
  var count=iteration+1;
  var row = tbl.insertRow(lastRow);

  
  // left subfield cell
  var cellRight = row.insertCell(0);
  var el1 = document.createElement('input');
  
  el1.type = 'text';
 // el1.name = 'subfield_'+orig+'_'+ count;
 el1.name = 'subfield_'+num+'_'+ count;
  el1.id = 'subfield_' + iteration;
  el1.size = 1; 
   el1.style.backgroundColor='#CC99CC';
    el1.style.fontSize='12px';
  el1.style.fontWeight='bold';
  cellRight.appendChild(el1);
  
  //right subfield cell
  var cellRight = row.insertCell(1);
  var el = document.createElement('textarea');
  //el.name = 'subvalue_' +orig+'_'+ count;
  el.name = 'subvalue_' +num+'_'+ count;
  el.id = 'subvalue_' + iteration;
  el.row = 3;
  el.cols=80;
   el.style.backgroundColor='#CCCCCC';
    el.style.fontSize='12px';
  el.style.fontWeight='bold';
   cellRight.appendChild(el);
 }
 


function removeRowFromTable(tbl)
{
  var tbl = document.getElementById(tbl);
  var lastRow = tbl.rows.length;
  if (lastRow > 1)
  tbl.deleteRow(lastRow - 1);
}


function removeSubField(no)
{
  var tbl = document.getElementById('tblSub'+no);
  var lastRow = tbl.rows.length;
  if (lastRow > 1)
  tbl.deleteRow(lastRow - 1);
}

function RemoveInnerDatafield(src)
{
      var lastRow = src.parentNode.parentNode;
      lastRow.parentNode.removeChild(lastRow);
}



function changeDiv(the_div,the_change)
{
  var the_style = getStyleObject(the_div);
  if (the_style != false)
  {
    the_style.display = the_change;
  }
}

function hideAll(select_element)
{
	var intIndex = select_element.selectedIndex;
	var strView = "none";

	for (var i = 0; i < select_element.length; ++i) {
		if (i == intIndex) {
			changeDiv(select_element[i].value,"block");
		} else {
			changeDiv(select_element[i].value,"none");
		}
	}
}

function getStyleObject(objectId) {
  if (document.getElementById && document.getElementById(objectId)) {
    return document.getElementById(objectId).style;
  } else if (document.all && document.all(objectId)) {
    return document.all(objectId).style;
  } else {
    return false;
  }
}
