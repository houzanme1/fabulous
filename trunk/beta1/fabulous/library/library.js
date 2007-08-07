

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




/*************************
 * Manage Dynamic Fields *
 *************************
 * These functions are used to allow a person configuring a data submission form
 * to provide a dynamic number of elements.  For example: A user may want to
 * place only one "subject" data entry box on the form with a button that
 * allows the submitter to "+ Add another subject".  In order for this to work
 * some javascript needs to be added that will "clone" the subject data entry 
 * element (and associated labels) and change the input "name=" value to a
 * new value (e.g. subject_1).  The backend VALET software must also know how
 * many of the new dynamic fields were added by the user so this javascript also
 * creates a hidden "_count-SOURCE-TARGET" element that will be sent back to
 * the browser when the user goes back to the form to edit.  This information
 * will allow the javascript to add the dynamic fields automatically to the
 * form so that the user can edit their previous entries.
 *
 * NOTE: The person creating the form only has to know how to call the 
 * addField(source,target) function.  The rest of the javascript does not need
 * to be understand by the user.
*/

/*
* DESCRIPTION:
*  This is the function that a user will add to a form to allow for dynamic 
*  creation of form entry elements.
* ACCEPTS:
*  source_elem_id = the element id that needs to be "duplicated" or "cloned"
*      NOTE: This will clone all child elements as well.
*  target_div_id = the element id of the target div where the cloned element
*  will be placed.
*
*/

/*
* G.Lake - 11/04/07
* DESCRIPTION:
*  This is the function that will enable the dynamically created form elements to be removed.
* ACCEPTS:
*  source_elem_id = the element id that needs to be "duplicated" or "cloned"
*  target_div_id = the element id of the target div where the cloned element
*  will be placed.
* 
*/

function removeField(source_elem_id, target_div_id){

var clone_count_id = '_count_' + source_elem_id + '-' + target_div_id;

// Check to see if there is a hidden input element for this source id
var clone_count_elem = document.getElementById(clone_count_id);
    //if this exists, remove last clone or if not equal to zero
	if (clone_count_elem) {
	 clone_count = clone_count_elem.getAttribute('value');
	 if (clone_count != 0){
	 removeLastElement(source_elem_id, target_div_id, clone_count);
              }
        }
	 //if not, ignore
	 else{
	 }
}

function removeLastElement(source_elem_id,target_div_id,clone_count){
//get the target node to remove
var target_node = document.getElementById(target_div_id);

//remove last node
target_node.removeChild(target_node.lastChild);
target_node.removeChild(target_node.lastChild);

////finally - get the hidden "count-SOURCE-TARGET" element in the form and subtract 1
decreaseCloneCount(source_elem_id,target_div_id);
}


function decreaseCloneCount(source_elem_id,target_div_id) {
	var clone_count_id = '_count_' + source_elem_id + '-' + target_div_id;

	// Check to see if there is a hidden input element for this source id
	var clone_count_elem = document.getElementById(clone_count_id);

	var clone_count;
	if (clone_count_elem) {
		clone_count = clone_count_elem.getAttribute('value');
		clone_count--;
		clone_count_elem.setAttribute('value',clone_count);
	} 
	//alert(clone_count);
	
}


function addField(source_elem_id,target_div_id) {

	// Figure out how many times we've already cloned this one
	var clone_count = getCloneCount(source_elem_id,target_div_id);

	// Ok, let's clone the sucker!
	cloneElement(source_elem_id,target_div_id,clone_count);

	return false;
}


function cloneElement(source_elem_id,target_div_id,clone_count) {
	// Get source element by id
	var source_node = document.getElementById(source_elem_id);

	// Clone the source element
	var cloned_node = source_node.cloneNode(true);

	// Remove the source element's id (that's our "multiple" key)
	cloned_node.setAttribute('id','');

	// Get the target div node for the cloned source node
	var target_node = document.getElementById(target_div_id);

	// Create a new target div inside the target div "wrapper" node
	// This is really just a precaution in case we need to manipulate it
	// at a later time.
	var new_target_div = document.createElement('div');
	var new_target_div_id = source_elem_id + '_' + clone_count;
	new_target_div.setAttribute('id',new_target_div_id);
	target_node.appendChild(new_target_div);

	// Update the 'name' attributes in the cloned node to reflect count
	updateAttributes(cloned_node,clone_count);
	
	// DEBUG
	// alert(cloned_node.innerHTML);

	// Add cloned node to the target div node
	target_node.appendChild(cloned_node);
}

function updateAttributes(node,count) {
	// add a _COUNT to all name attributes (e.g. name="subject_2") 
	if (node.name) {
		node.name += '_' + count;
	}

	// for any element that has an id of "count_label" then change it's
	// text content to the current count of the dynamic elements
	if (node.id) {
		if (node.id == 'count_label') {
			node.innerHTML = count;
		}
	}

	// Clear all values from input nodes
	if (node.type == 'text' && node.nodeName == 'INPUT') {
		node.value = '';
	}

	var children = node.childNodes;
	for(var i=0; i < children.length; i++) {
		// Recurse
		updateAttributes(children[i],count);
	}
}

function getCloneCount(source_elem_id,target_div_id) {

	var clone_count_id = '_count_' + source_elem_id + '-' + target_div_id;
	// Check to see if there is a hidden input element for this source id
	var clone_count_elem = document.getElementById(clone_count_id);

	var clone_count;
	
	if (clone_count_elem) {

		clone_count = clone_count_elem.getAttribute('value');
		clone_count++;
		clone_count_elem.setAttribute('value',clone_count);
	} else {

		// Create a hidden element to hold the clone count
		var new_input_elem = document.createElement('input');
		new_input_elem.setAttribute('type','hidden');
		new_input_elem.setAttribute('id',clone_count_id);
		new_input_elem.setAttribute('name',clone_count_id);
		clone_count = 1;
		new_input_elem.setAttribute('value',clone_count);
		// Append new input elem to the check_form element
		document.check_form.appendChild(new_input_elem);
		

		// DEBUG
		// alert_debug("FORM: " + document.check_form.innerHTML);
	}

	return clone_count;
	alert(clone_count);
}
