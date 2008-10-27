function addEvent()
{
var ni = document.getElementById('myDiv');
var numi = document.getElementById('theValue');
var num = (document.getElementById("theValue").value -1)+ 2;
numi.value = num;
var divIdName = "my"+num+"Div";
var newdiv = document.createElement('div');
newdiv.setAttribute("id",divIdName);
newdiv.innerHTML = "Element Number "+num+" has been added! <a href=\"javascript:;\" onclick=\"removeEvent(\'"+divIdName+"\')\">Remove the div &quot;"+divIdName+"&quot;</a>";
ni.appendChild(newdiv);
}

function removeEvent(divNum)
{
var d = document.getElementById('myDiv');
var olddiv = document.getElementById(divNum);
d.removeChild(olddiv);
}

/*
* DESCRIPTION:
*  Used to open external windows in the application.  Especially used for help
*  files but can be used for any type of "external" information that needs to
*  be displayed in a separate (and consistent) window.
* ACCEPTS:
*  HTTP target (e.g. HTML or CGI script, etc.).
*/
function open_window(target)
{
	window.open(target,'new_window','width=600,height=700,left=10,top=10');
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


function init_onload() {
	document.check_form.resource_type.onchange();
}

function validate() {
	var errs=0;
	// execute all element validations in reverse order, so focus gets
	// set to the first one in error.

	if (!is_required(document.check_form.function_type, 'You must select a function Type.')) errs += 1; s += 1;

	if (errs>1)
	   alert('There are fields which need correction before sending.  Any problem fields will be indicated in red to the right or below the fields.');

	if (errs==1)
	   alert('There is a field which needs correction before sending. The problem field will be indicated in red to the right or below the field.');

	return (errs==0);
}


/**********************
 Validation Functions *
***********************
*
* These functions are fairly self-explanatory.  They can be placed into 
* onchange(), onblur(), etc. events (but don't use onblur ... nasty things 
* happen) for each element.  They can also be placed into a global validate() 
* routine at the top of a web page in order to force validation at time of 
* submission.
*
* All of these routines accept a form element object and an alternative
* text message to print in case of an error.  Each routine may also accept
* other parameters necessary for it's operation (e.g. max_length accepts an 
* int). 
*
* All of these routines expect an ELEMENTNAME_error text element to be in 
* the DOM somewhere.  That is where it expects to print it's error.  You need
* to make sure that the ELEMENTNAME_error has some default value (e.g. nbsp).
*
*/

function is_length(element,length,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + ') must be (' + length + 
		   ') characters in length.';
	}

	if (element.value.length != length)
		return msg(element,mesg);

	return clear_msg(element);
}

function max_length(element,length,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + ') cannot be greater than (' + 
		   length + ') characters in length.';
	}

	if (element.value.length > length)
		return msg(element,mesg);

	return clear_msg(element);
}

function min_length(element,length,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + ') must be at least (' + 
		   length + ') characters in length.';
	}

	if (element.value.length < length)
		return msg(element,mesg);

	return clear_msg(element);
}

function is_invalid_char(element,character,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + ') cannot contain character (' + 
		   character + ').';
	}

	var regexString = new RegExp(character);
	if (regexString.test(element.value))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_regex(element,regex,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + 
		   ') does not match regular expression: ' + regex;
	}

	var regexString = new RegExp(regex);

	if (!regexString.test(element.value))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_not_regex(element,regex,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + 
		   ') must not match regular expression: ' + regex;
	}

	var regexString = new RegExp(regex);

	if (regexString.test(element.value))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_alpha_numeric(element,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + 
		   ') must contain only alphanumeric characters.';
	}

	var regexString = /^\w+$/;

	if (! regexString.test(element.value))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_alpha(element,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + 
		   ') must contain only alphabetic characters.';
	}

	var regexString = /^[A-Z]+$/i;

	if (! regexString.test(element.value))
		return msg(element,mesg);
	
	return clear_msg(element);
}

function is_numeric(element,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + ') must be a number.';
	}

	var regexString = /^\d+$/;

	if (! regexString.test(element.value))
		return msg(element,mesg);
	
	return clear_msg(element);
}

function is_year_range(element,minYear,maxYear,mesg)
{
	if (!mesg) {
	    mesg = 'Field (' + element.name + ') must be a valid year between (' + minYear + ') and (' + maxYear + ').';
	}

	if (element.value < minYear || element.value > maxYear)
		return msg(element,mesg);

	return clear_msg(element);
}

function is_email(element,mesg)
{
	if (!mesg) {
		mesg = 'Field (' + element.name + ') must be a valid e-mail address.';
	}
	
	var fld = trim(element.value);
	var emailString = /^[^@]+@[^@.]+\.[^@]*\w\w$/;
	if (!emailString.test(fld))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_empty(element,mesg)
{
	if (!mesg) {
		mesg = 'Field (' + element.name + ') must be left empty.';
	}

	var emptyString = /^\s*$/;
	if (! emptyString.test(element.value))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_required(element,mesg)
{
	if (!mesg) {
		mesg = 'Field (' + element.name + ') is required.';
	}

	var emptyString = /^\s*$/;
	if (emptyString.test(element.value))
		return msg(element,mesg);

	return clear_msg(element);
}

function is_checked(element,mesg)
{
	if (!mesg) {
		mesg = 'Field (' + element.name + ') is required.';
	}

	if (element.checked == false)
		return msg(element,mesg);

	return clear_msg(element);
}

function msg(element,mesg)
{
	if(typeof element == 'undefined' || element.name == "undefined") 
		return;
	var elem_id = element.name + '_error';
	var elem = document.getElementById(elem_id);

	// alert user that there is an error but no error element
	if (!elem) {
		//alert("You forgot to create an HTML error element with id='" + elem_id + "'");
		if(mesg) alert(mesg);
		return false;
	}

	// not available on this browser - leave validation for server
	if (!document.getElementById) 
		return true;

	// not available on this browser 
	if (!elem.firstChild)
		return true;

	// error element is wrong type of node (DOM node type is 3)
	if (elem.firstChild.nodeType != 3)
		return true;

	// setting an empty string can give problems if later set to a 
	// non-empty string, so ensure a space present. (For Mozilla and 
	// Opera one could simply use a space, but IE demands something more, 
	// like a non-breaking space [nbsp = char 160].)

	var dispmessage;
	var emptyString = /^\s*$/;
	if (emptyString.test(mesg))
	{
		elem.firstChild.nodeValue = String.fromCharCode(160);
	}
    	else
	{
		elem.firstChild.nodeValue = mesg;
		setfocus(element);
	}

	return false;
}

function clear_msg(element)
{
	// Send empty string to clear the error message
	msg(element,'');

	return true;
}

function setFocusDelayed()
{
	glb_fld.focus();
}

function setfocus(fld)
{
	glb_fld = fld;
	setTimeout( 'setFocusDelayed()', 100 );
}

function trim(str)
{
	return str.replace(/^\s+|\s+$/g, '');
}