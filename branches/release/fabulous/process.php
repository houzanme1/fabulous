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


//start the session
session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['basic_is_logged_in'])
    || $_SESSION['basic_is_logged_in'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}


//include dependancies
require_once('./library/logic.php');
include_once('./library/functions.php');


$htmlFinal="";


//check if the values were posted..........
  if (isset($_POST['Action']))
{
    //if (isset($_POST['submitted'])) {
      $id=$_GET['id'];
$agent=new Agent();
//echo  $_POST['term'];
//echo  $_POST['results'];
	// Minimal form validation.
	if ( isset($_POST['Dcheck'])) 
        {
	$fields= $_POST['Dcheck'];
//	print_r($fields);

// if the batch edit process is selected
	 if ($id=="edit")
                  {
                     foreach ($fields as $key=>$val) {
                         $pid=$val;
                         $htmlFinal.='<li>'.$pid.'</li>';
                     }
                  }
                  else
                  {
                    foreach ($fields as $key=>$val) {
                  $tempV=explode(";",$val);
                         $pid=$tempV[0];
                         $ds=$tempV[1];
                         if($id=="activate")
		{
                  //set datastream to active
		 $agent->setDatastreamState($pid, $ds, "A", "test");
		}
                else if($id=="deactivate")
                {
                  //set datastream to inactive
                         $agent->setDatastreamState($pid, $ds, "I", "test") ;
                }
                    $htmlFinal.='<li>'.$val.'</li>';

                        }

                  }
                  
        }
        else
        {
          // Invalid submitted values.
		$htmlFinal.= '<h1 id="mainhead">Error!</h1>
		<p class="error">Please select some datastreams for activation/de-activation/editing.</p><p><br /></p>';
        }

}

//if search is resumed using the resumption token
else if(isset($_POST['next']))
{
  $html_output="";
   // echo "You entered next";
    $token=$_GET['token'];
$id=$_GET['id'];
$agent= new Agent();
//call next search
$xml_output   = $agent->nextSearch($token);
//print_r($xml_output);
if($xml_output)
		{

		if($id=="activate")
		{
			//use activation stylesheet
                        $html_output .= $agent->transform("./stylesheets/resultA.xslt", $xml_output);
		}
                else if($id=="deactivate")
                {
                        //use de-activation stylesheet
                        $html_output .= $agent->transform("./stylesheets/resultD.xslt", $xml_output);
                }
                 else if($id=="edit")
                {
                        //use edit stylesheet
                        $html_output .= $agent->transform("./stylesheets/resultE.xslt", $xml_output);
                }


		}

 //echo $html_output;
  // create the next search page
$tokenNew=$agent->getSearchToken();


          if(isset($tokenNew))
            {
          $htmlFinal.= '<form method="post" action="process.php?id='.$id.'&token='.$tokenNew.'">' ;
            }
            else
            {
             $htmlFinal.= '<form method="post" action="process.php?id='.$id.'">' ;
            }

          $htmlFinal.= '<p align =center>';
               if($id=="activate")
           {
             $htmlFinal.= '<input type="submit" name="Action" value="Activate">' ;
           }
           else if ($id == "deactivate")
           {
             $htmlFinal.= '<input type="submit" name="Action" value="De-Activate">' ;
           }
            else if ($id == "edit")
           {
             $htmlFinal.= '<input type="submit" name="Action" value="Edit">' ;
           }

           if(isset($tokenNew))
 {
    $htmlFinal.= '<input type="submit" name="next" value="Next >>">';
 }
          $htmlFinal.= '</p>';

          if(isset($_POST['Dcheck']))
          {
            $fields=$_POST['Dcheck'];
            

          //  print_r($fields);
            foreach ($fields as $key=>$val) {
            $htmlFinal.= '<input type=hidden name="Dcheck[]" value="'.$val.'">';
            }
          }


           $htmlFinal.= $html_output;
           

                if(isset($tokenNew))
            {
          $htmlFinal.= '<form method="post" action="process.php?id='.$id.'&token='.$tokenNew.'">' ;
            }
            else
            {
              $htmlFinal.= '<form method="post" action="process.php?id='.$id.'">' ;
            }

          $htmlFinal.= '<p align =center>';
               if($id=="activate")
           {
             $htmlFinal.= '<input type="submit" name="Action" value="Activate">' ;
           }
           else if ($id == "deactivate")
           {
             $htmlFinal.= '<input type="submit" name="Action" value="De-Activate">' ;
           }
             else if ($id == "edit")
           {
             $htmlFinal.= '<input type="submit" name="Action" value="Edit">' ;
           }

           if(isset($tokenNew))
 {
    $htmlFinal.= '<input type="submit" name="next" value="Next >>">';
 }
          $htmlFinal.= '</p>';



$htmlFinal.= '</form>';
    
    }


 //writing XHTML

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>FABULOUS | Search</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<style type="text/css" media="all">@import "./include/layout.css";</style>
<script type="text/javascript" src="./library/library.js">
<!--


//-->
</script>
</head>

<body>


<div id="document"><a name="top"></a>
	<div id="header"></div>

	<?php top_navigation();?>




</div>





<div id="content">

<div id="resource_results">
	<h1>
        <?php
        if(isset($_POST['next']))
        {
          echo "Fabulous Search Result";
        }
        else
        {
        if($id=="activate")
		{
			echo "Activated Datastreams";
		}
                else if($id=="deactivate")
                {
                	echo "De-Activated Datastreams";
                }
                 else if($id=="edit")
                {
                    //  function_implementation();
                        echo "Objects Selected for Editing";

                }
        }
                ?> 
                </h1>

	<div id="summary">

	<p class="about">


           <?php 
         //  test();

                  echo $htmlFinal ;
                  if($id=="edit" && isset($_POST['Dcheck']))
                  {
                  function_implementation($fields);
                  }

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
