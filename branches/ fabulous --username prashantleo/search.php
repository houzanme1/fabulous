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


// like i said, we must never forget to start the session
session_start();
// is the one accessing this page logged in or not?
if (!isset($_SESSION['basic_is_logged_in'])
    || $_SESSION['basic_is_logged_in'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}
require_once('./library/logic.php');
include_once ('./library/functions.php');


$html_output="";

if (isset($_POST['submitted'])) {

//echo  $_POST['term'];
//echo  $_POST['results'];
	// Minimal form validation.
	if ( isset($_POST['term'])&& isset($_POST['results'])) {
		$searchTerm = $_POST['term'];
		$fieldsSelected=array("pid","title","creator","type","date","state");
		$mresult=$_POST['results'];

	} else { // Invalid submitted values.
		echo '<h1 id="mainhead">Error!</h1>
		<p class="error">Please enter a valid search term.</p><p><br /></p>';
	}

} // End of main isset() IF.



$agent= new Agent();
$xml_output    = $agent->search($fieldsSelected,$mresult,$searchTerm);
//print_r($xml_output);

if($xml_output)
		{

		$id=$_GET['id'];
		if($id=="activate")
		{
			$html_output .= $agent->transform("./stylesheets/resultA.xslt", $xml_output);
		}
                else if($id=="deactivate")
                {
                        $html_output .= $agent->transform("./stylesheets/resultD.xslt", $xml_output);
                }
                else if($id=="edit")
                {
                        $html_output .= $agent->transform("./stylesheets/resultE.xslt", $xml_output);
                }

		}


 $token=$agent->getSearchToken();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>FABULOUS | Search</title>
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

<div id="resource_results">
	<h1>Fabulous Search Result </h1>

	<div id="summary">

	<p class="about">
	
 <?php 
          
            if(isset($token))
            {
          echo '<form method="post" action="process.php?id='.$id.'&token='.$token.'">' ;
            }
            else
            {
              echo '<form method="post" action="process.php?id='.$id.'">' ;
            }

          echo '<p align =center>';
               if($id=="activate")
           {
             echo '<input type="submit" name="Action" value="Activate">' ;
           }
           else if ($id == "deactivate")
           {
             echo '<input type="submit" name="Action" value="De-Activate">' ;
           }
             else if ($id == "edit")
           {
             echo '<input type="submit" name="Action" value="Edit">' ;
           }

           if(isset($token))
 {
    echo '<input type="submit" name="next" value="Next >>">';
 }
          echo '</p>';





           echo $html_output;
            echo '<p align =center>';
               if($id=="activate")
           {
             echo '<input type="submit" name="Action" value="Activate">' ;
           }
           else if ($id == "deactivate")
           {
             echo '<input type="submit" name="Action" value="De-Activate">' ;
           }
              else if ($id == "edit")
           {
             echo '<input type="submit" name="Action" value="Edit">' ;
           }

           if(isset($token))
 {
    echo '<input type="submit" name="next" value="Next >>">';
 }
          echo '</p>';
echo '</form>';
?>

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
