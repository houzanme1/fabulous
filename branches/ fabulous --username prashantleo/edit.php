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

session_start();

// is the one accessing this page logged in or not?
if (!isset($_SESSION['basic_is_logged_in'])
    || $_SESSION['basic_is_logged_in'] !== true) {

    // not logged in, move to login page
    header('Location: login.php');
    exit;
}

require_once('./library/logic.php');
include_once('./library/functions.php');

//print_r($GLOBALS);
$htmlFinal="";
$objectList="";

  if (isset($_POST['submit']))
{

        $marcID= $dictionary['marcDatastreamID'];
        $marcLabel =  $dictionary['marcDatastreamLabel'];
        $dcID =  $dictionary['dcDatastreamID'];
        $dcLabel = $dictionary['dcDatastreamLabel'];

        $fields=$_POST['pids'];
          foreach ($fields as $key=>$val) {
                         $pid=$val;
                        $objectList.='<li>'.$pid.'</li>';
        }
        if ($_POST['function_type']== "Edit")
        {
         // print_r($GLOBALS);
        $source=$_POST['source'];
        $source = str_replace("&", "&amp;", $source);
        $destination=$_POST['destination'];
        $destination = str_replace("&", "&amp;", $destination);

        foreach ($fields as $key=>$val) {

        $xml_output  = get_Datastream($val, $marcID);

        $xml_output_dc  = get_Datastream($val, $dcID);
        $handle = retrieveHandle($xml_output_dc,$dictionary['HandleNamespace']);
       // print_r($xml_output);
       // $xml_document = simplexml_load_string($xml_output);
        //print_r($xml_output);
        //print_r($source);
        $marc_string= str_replace($source, $destination, $xml_output);
        $marcxml=simplexml_load_string($marc_string);
        $agent= new Agent();
        $dc_temp=$agent->transform2("./stylesheets/dc.xslt", $marcxml);
        
        //append identifiers information into DC i.e Handles (namespace:port and pid extracted from Val) and Pid = val
        $xmlDC  = new simpleXMLElement($dc_temp);
        $namespace=$xmlDC->getNamespaces(true);
        $split=explode(":", $val);
       // $handle=$dictionary['HandleNamespace'].$split[1];
        $xmlDC->addChild('dc:identifier',$val,$namespace['dc']);
        $xmlDC->addChild('dc:identifier',$handle,$namespace['dc']);

        $dc= $xmlDC->saveXML();
        $marc= $marcxml->saveXML()  ;




$myFile1= base64_encode(trim($marc));
$myFile2= base64_encode(trim($dc));

$agent->callModifyDatastreamByValue ($val, $marcID, 'I', $marcLabel, $marc);
$agent->callModifyDatastreamByValue ($val, $dcID, 'A', $dcLabel, $dc);


        }
        $htmlFinal.= "<h1> Replaced </h1>All Occurances of <B><u>'".$source."'</u></B> with <B><u>'".$destination."'</u></B> <h1> for Objects</h1>"     ;

        }
        else if ($_POST['function_type']== "Add")
        {
            

                     
         //print_r($_POST);
        
        
        //GET ALL THE FORM SUBMITTED VALUES
        $datafieldtag=$_POST['datafieldtag'];
        $ind1=$_POST['ind1'];
        $ind2=$_POST['ind2'];
        if(isset ($_POST['_count_subfields-multiple_fields'] ))
        {
        $count=$_POST['_count_subfields-multiple_fields'];
        }
        else $count=0;

        foreach ($fields as $key=>$val) {

        $xml_output  = get_Datastream($val, $marcID);
        
        $xml_output_dc  = get_Datastream($val, $dcID);
        $handle = retrieveHandle($xml_output_dc,$dictionary['HandleNamespace']);

         $xmlA  = new simpleXMLElement($xml_output);
       $namespace=$xmlA->getNamespaces(true);
        $temp=$xmlA->children($namespace['default'])->addChild('datafield');
        $temp->addAttribute('tag', $datafieldtag);
        $temp->addAttribute('ind1', $ind1);
        $temp->addAttribute('ind2', $ind2);
        $tempTest=$temp->addChild('subfield',$_POST['subfieldValue']);
        $tempTest->addAttribute('code', $_POST['subfieldCode']);

        for($i=1; $i<=$count;$i++)
        {
        $tempValue= "subfieldValue_".$i;
        $tempCode= "subfieldCode_".$i;
        $tempTest=$temp->addChild('subfield',$_POST[$tempValue]);
        $tempTest->addAttribute('code', $_POST[$tempCode]);
        }
        $marcTest= $xmlA->saveXML()  ;


        $marcxml=simplexml_load_string($marcTest);
        $agent= new Agent();
        $dc_temp=$agent->transform2("./stylesheets/dc.xslt", $marcxml);
        
        //append identifiers information into DC i.e Handles (namespace:port and pid extracted from Val) and Pid = val
        $xmlDC  = new simpleXMLElement($dc_temp);
        $namespace=$xmlDC->getNamespaces(true);
        $split=explode(":", $val);
       // $handle=$dictionary['HandleNamespace'].$split[1];
        $xmlDC->addChild('dc:identifier',$val,$namespace['dc']);
        $xmlDC->addChild('dc:identifier',$handle,$namespace['dc']);

        $dc= $xmlDC->saveXML();
        $marc= $marcxml->saveXML()  ;



$myFile1= base64_encode(trim($marc));
$myFile2= base64_encode(trim($dc));

$agent->callModifyDatastreamByValue ($val, $marcID, 'I', $marcLabel, $marc);
$agent->callModifyDatastreamByValue ($val, $dcID, 'A', $dcLabel, $dc);


        }
        $htmlFinal.= "<h1> Added </h1>Datafield '".$datafieldtag."'<h1>for Objects</h1>"    ;
        }
        else if ($_POST['function_type']== "Delete")
        {
         // print_r($GLOBALS);
         $deleteDataField=$_POST['dataFieldtag'];

        foreach ($fields as $key=>$val) {

        $xml_MARC  = get_Datastream($val, $marcID);

        $xml_output_dc  = get_Datastream($val, $dcID);
        $handle = retrieveHandle($xml_output_dc,$dictionary['HandleNamespace']);

        $marcxml= deleteNode($xml_MARC,$deleteDataField);

        $agent= new Agent();
        $dc_temp=$agent->transform2("./stylesheets/dc.xslt", $marcxml);

        //append identifiers information into DC i.e Handles (namespace:port and pid extracted from Val) and Pid = val
        $xmlDC  = new simpleXMLElement($dc_temp);
        $namespace=$xmlDC->getNamespaces(true);
        $split=explode(":", $val);
       // $handle=$dictionary['HandleNamespace'].$split[1];
        $xmlDC->addChild('dc:identifier',$val,$namespace['dc']);
        $xmlDC->addChild('dc:identifier',$handle,$namespace['dc']);

        $dc= $xmlDC->saveXML();
        $marc= $marcxml->saveXML()  ;



$myFile1= base64_encode(trim($marc));
$myFile2= base64_encode(trim($dc));

$agent->callModifyDatastreamByValue ($val, $marcID, 'I', $marcLabel, $marc);
$agent->callModifyDatastreamByValue ($val, $dcID, 'A', $dcLabel, $dc);

           }
           $htmlFinal.= "<h1> Deleted all Occurances of </h1>Datafield  '".$deleteDataField."' <h1> for Objects</h1>"     ;
        }
        else
        {
            $htmlFinal.= "Please select a functionality before proceeding !"    ;
        }

}
else
{
   $htmlFinal.= "nothing Submitted"  ;
}




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
	<h1></h1>
	<?php
//	print_r($GLOBALS);
           $htmlFinal.=$objectList;
        ?>

	<div id="summary">

	<p class="about">


           <?php
                  echo $htmlFinal ;

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
