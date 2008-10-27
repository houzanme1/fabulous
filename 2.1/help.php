<?php
// +----------------------------------------------------------------------+
// | FABULOUS - Fedora/Arrow Batch Utility with Lots Of User Services     |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006, 2007 The University of South Australia,          |
// | ARROW (Australian Research Repository Online to the World),          |
// | mini Projects                                                        |
// |                                                                      |
// | This program is free software; you can redistribute it and/or modify |
// | it under the terms of the GNU General Public License as published by |
// | the Free Software Foundation; either version 2 of the License, or    |
// | (at your option) any later version.                                  |
// |                                                                      |
// | This program is distributed in the hope that it will be useful,      |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
// | GNU General Public License for more details.                         |
// |                                                                      |
// | You should have received a copy of the GNU General Public License    |
// | along with this program; if not, write to:                           |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+
// | Author: Prashant Pandey <prashant.pandey@unisa.edu.au>               |
// +----------------------------------------------------------------------+



// start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['basic_is_logged_in'])
    || $_SESSION['basic_is_logged_in'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}

//include the dependancies
require_once('./library/logic.php');
include_once('./library/functions.php');

 $html_output="";
 
 //writing XHTML
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>FABULOUS | Help</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<style type="text/css" media="all">@import "./include/layout.css";</style>
</head>

<body>


<div id="document"><a name="top"></a>
	<div id="header"></div>

	<?php top_navigation();?>




</div>





<div id="content">


	<H1>FABULOUS Version 1.0 User Guide</H1><br />
<p>The Fedora/Arrow Batch Utilities with Lots Of User Services (FABULOUS) application
  is designed to improve the efficiency of repository content management by incorporating
a number of functions designed for administrative purposes.</p>
<p>FABULOUS provides users with the following functions:</p>
<ul>
  <li>The ability to activate or deactivate various datastreams of a particular
  object making them visible or invisible to users of the repository.</li>
  <li>    Enabling multiple uploads of research materials to the repository (or
  batch content ingests).</li>
  <li>    Providing an editing functionality for multiple (datastreams or metadata)
  within the repository (or batch metadata editing).</li>
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
  <li>Select 'Activate Datastream' from the navigation menu.</li>
  <li>    Search for a particular object. (See the Search section for a more detailed
  explanation of search methods available)</li>
  <li>    All datastreams for each objects which are currently deactivated and
    may be activated will be displayed with a selection box. Select which datastream/s
  to activate.</li>
  <li>    Click on the 'Deactivate' button.</li>
  <li>    A results page will appear displaying .... &lt;to be done&gt;</li>
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
  <li>Select 'De-activate Datastream' from the navigation menu.</li>
  <li>    Search for a particular object. (See the Search section for a more detailed
  explanation of search methods available)</li>
  <li>    All datastreams which are currently activated and may be deactivated will
  be displayed with a selection box. Select which datastream/s to deactivate. </li>
  <li>    Click on the 'Deactivate' button.</li>
  <li>    A results page will appear displaying ....</li>
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
<p>Searches can be performed on any fields of an object including the unique
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

<h2>Batch Content Ingest</h2>
<p>The Batch content ingest function allows a user to insert multiple content
  files into the repository. These content files can be for the same object or
  for a number of different objects (or both). The application automatically
  links the content files to their associated metadata files without the need
  to re-ingest the metadata files. Files being ingested need to follow a strict
  naming convention in order to be uploaded and associated with their metadata
  files. </p>
<p>File naming convention: All ingested files must have the same filename as
  their associated metadata. Where there are multiple content files for the same
  object, files being ingested must follow the naming convention of:</p>
<p>To perform a batch content ingest:</p>
<ol>
  <li>Select 'Batch Content Ingest' from the navigation menu</li>
  <li>    For each file to be ingested &gt; select 'Browse' and navigate
    to the location of the file then select. Ensure all files being ingested
    follow the correct naming conventions.</li>
  <li>    Once all files have been selected, click on 'Upload'</li>
  <li>    A results page will appear displaying the result of the ingest process.</li>
</ol>
<p>Notes:</p>
<ol>
  <li>File naming convention: When ingesting files, each file name must correspond
    to its associated metadata filename. i.e. when uploading xxx.xml unisa:xxx.asdf &gt; xxx.asdf</li>
</ol>
<p>Note: The maximum file length (not including the file extension) is 15 characters.
  Anything over that will be cut to only 15 characters. Valid file types include:
  txt, xml, doc, pdf, gif, and jpg.</p>
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
	<div id="summary">

	<p class="about">

</p>
</div>
  <hr/>
<div id="footer">
<p id="footer_copyright">
Copyright &#169;2007 <b>ARROW</b>, All right reserved
</p>

<?php bottom_tags();?>
 <hr/>
</div>

</div>

</body>
</html>
