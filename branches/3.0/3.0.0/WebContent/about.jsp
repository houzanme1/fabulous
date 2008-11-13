<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>About</title>


<style type="text/css">
<%@include file="/skins/default/style.css"%>
</style>
</head>
<jsp:include page="common/header.jsp" />
<jsp:include page="common/headerSearch.jsp" />
<body>


<div id="main">
<H1>About</H1>
<br/>
<p>Project Home: <a href="http://code.google.com/p/fabulous/">Fabulous on Google Code</a></p>
<p>Project Lead: Prashant Pandey (Library, university of South Australia)</p>
<p><em>Sponsored by DEST through the ARROW Project Mini-Project Scheme. The ARROW Project is funded under the Systemic Infrastructure Initiative as part of the Commonwealth Government&#146;s Backing Australia&#146;s Ability</em></p>
<br/>
	<H2>FABULOUS Version 3.0 User Guide</H2>
<p>The Fedora/Arrow Batch Utilities with Lots Of User Services (FABULOUS) application
  is designed to improve the efficiency of repository content management by incorporating
a number of functions designed for administrative purposes.</p>
<p>FABULOUS provides users with the following functions:</p>
<ul>
  <li>The ability to activate or deactivate various datastreams of a particular
  object making them visible or invisible to users of the repository.</li>
  <li>    Providing form based editing interface for MARC xml.</li>
  <li>    Providing an editing functionality for multiple (datastreams or metadata)
  within the repository (or batch metadata editing).</li>
  <li>    Ability to plug into various Front-end applications like VITAL etc.</li>
</ul>
<p>FABULOUS interacts with the Fedora&#8482; Repository, providing a simple and
  easy to use interface which extends the functions of fedora and ways to manipulate
the repository content.</p>
<p><em>Note: A basic knowledge of the functions and terms associated with an institutional
  research repository is assumed within this User Guide.</em></p>

<h2>Logging On </h2>
<p>To login to FABULOUS, a valid username and password is required<br>
  Once logged into FABULOUS, the navigational toolbar at the top of the screen
allows user to browse through the various functions available.</p>
<h2>Activate Datastream</h2>
<p>Activating a datastream for a particular object will make the datastream visible
  and accessible for users of the repository. Multiple datastreams may be activated
  at the same time.</p>
<p>To activate a datastream/s:</p>
<ol>
  <li>Select 'Activate Datastream' from the Home/Manual Search Selection menu.</li>
  <li>    Search for a particular object. (See the Search section for a more detailed
  explanation of search methods available)</li>
  <li>    All datastreams for each objects which are currently deactivated and
    may be activated will be displayed with a selection box. Select which datastream/s
  to activate.</li>
  <li>    Click on the 'Activate' button.</li>
  <li>    A results page will appear displaying the result.</li>
</ol>
<p><em>User Case Example:<br>
  If a copyright owner had recently given consent to the publication of their
    research material in the repository - this would be reflected by activating
    the CONTENT datastream for the particular object making it available for
users of the repository to view and download.</em></p>
<p><em>The embargoed period for publications (particularly Theses) has expired and
  the copyright permissions have been granted for the publishing of these research
  materials in the repository. This is shown by activating the CONTENT datastream
for the publications that have an expired embargoed period.</em></p>
<h2>De-Activate Datastream</h2>
<p>Deactivating a datastream for a particular object will make the datastream
  invisible and inaccessible for users of the repository. </p>
<p>To deactivate a datastream:</p>
<ol>
  <li>Select 'De-activate Datastream' from the Home/Manual Search Selection menu.</li>
  <li>    Search for a particular object. (See the Search section for a more detailed
  explanation of search methods available)</li>
  <li>    All datastreams which are currently activated and may be deactivated will
  be displayed with a selection box. Select which datastream/s to deactivate. </li>
  <li>    Click on the 'Deactivate' button.</li>
  <li>    A results page will appear displaying the result.</li>
</ol>
<p><em>User Case Example:<br>
  A copyright owner has withdrawn permission for the publication of research
    materials within the repository. This would be reflected by de-activating
the CONTENT datastream for the owners objects.</em></p>
<p>Notes:</p>
<ol>
  <li>The DC datastream is always active by default and any changes to the state
  of this datastream will not be reflected in repository.</li>
</ol>
<h2>Search</h2>
<p><strong>Searching</strong></p>
<p>Searches can be performed on any DC field of an object including the unique
  identifier (PID), title, author, type and date.</p>
<p><em>The user can enter a word or a phrase into the search box.
  A single word such as health my be entered with the * truncation, or wildcard
  character at the end ot allow for variable word endings. Embedded truncation
  may be used, such as organi*ation to allow for such terms as organisation or
  organization, or women or woman. A phrase may be entered, but to specify word
  order and proximity, the phrase MUST be surrounded by double quotes. If the
  phrase only is entered, or even if it is surrounded with single quotation marks,
  the earch will default to an AND operator. </em></p>
<p><em>Ie. &quot;market reform&quot; may retrieve all objects where that exact
  phrase appears, whereas 'market reform' will retrieve all those
  objects where both the term market and reform appear, but not necessarily in
  that order.</em></p>

<h2>Batch Metadata Editing</h2>
<p>Due to complex objects used by ARROW implementation of Fedora, various datastreams with varied states are associated with a single object. Updates would be applied to MARCXML and DC metadata datastreams only.</p>
 <p><strong>Global editing of metadata (Find and Replace). </strong></p>
        <p>Metadata needs to be amended for all or selected objects within the ARROW repository</p>
<ol>
  <li>Browse through the list of objects or search for relevant objects</li>
  <li>Type the old value</li>
  <li>Type the new value</li>
  <li>Click the submit Button</li>
  <li>The metadata (MARCXML as well as DC) for selected objects is updated</li>
</ol>
 <p><strong>Global tag/element addition </strong></p>
       <p>marc:datafield or dc:element need to be added to all or selected objects within the Arrow repository</p>
<ol>
  <li>Browse through the list of objects or search for relevant objects</li>
  <li>select the Add Data Field option</li>
  <li>When prompted, provide corresponding MARC code, identifier values, subfield code/values</li>
  <li>Click the submit Button</li>
  <li>The marc:datafield and dc:element  for selected objects is created within the existing metadata record.</li>
</ol>
 <p><strong>Global tag/element deletion</strong></p>
       <p>marc:datafield or dc:element need to be deleted from all or selected objects within the Arrow repository</p>
<ol>
  <li>Browse through the list of objects or search for relevant objects</li>
  <li>select the Delete Data Field option</li>
  <li>When prompted, provide corresponding MARC datafield value</li>
  <li>Click the submit Button</li>
  <li>The marc:datafield and dc:element  for selected objects is deleted from within the existing metadata record.</li>
</ol>
</div>

<div id="data">
<a href="javascript:history.go(-1)">back</a>
</div>

<br/>
<br/>
</body>
<jsp:include page="common/footer.jsp" />
</html>