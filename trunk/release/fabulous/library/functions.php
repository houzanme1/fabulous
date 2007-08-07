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

/**
*
* Fabulous functions file
*
* @author   Prashant Pandey <Prashant.Pandey@unisa.edu.au>
* @access   public
*/



/**
	* prints the search form for Activation of dataStream
	*
	* @return	HTML form
	* @access	public
	*/
function search_formA(){

  ?>
 <form action="search.php?id=activate" method="post">
<p align=center>Search all Fields for Phrase: </p><p align=center><input type="text" name="term" size="50" maxlength="200" value="<?php if (isset($_POST['term'])) echo $_POST['term']; ?>" /></p>

<p align=center>Maximum Number of Results (Per Page):
<select name="results">
<option value=20 selected>20</option>
<option value=40>40</option>
<option value=60>60</option>
<option value=80>80</option>
</select>
</p>

<p align=center> <input type="submit" name="submit" value="search" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />   </p>

</form>

  <?php
}


/**
	* prints the search form for De-Activation of dataStream
	*
	* @return	HTML form
	* @access	public
	*/
function search_formD(){

  ?>
 <form action="search.php?id=deactivate" method="post">
<p align=center>Search all Fields for Phrase: </p><p align=center><input type="text" name="term" size="50" maxlength="200" value="<?php if (isset($_POST['term'])) echo $_POST['term']; ?>" /></p>

<p align=center>Maximum Number of Results (Per Page):
<select name="results">
<option value=20 selected>20</option>
<option value=40>40</option>
<option value=60>60</option>
<option value=80>80</option>
</select>
</p>

<p align=center> <input type="submit" name="submit" value="search" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />   </p>

</form>

  <?php
}

/**
	* Redundant functionality for testing HTML
	*
	* @return	HTML form
	* @access	public
	*/
function test()
{
  ?>
    <h1>Functions</h1><ul id="function">
<li class="first linear"><a href="" class="selected ">Add Metadata Tag</a></li>
<li class="linear"><a href="">Delete Metadata Tag</a></li>
<li class="linear"><a href="">Edit Metadata Tag</a></li>
</ul>
  <?php
}

/**
	* prints the EDIT form for Batch Metadata Editing
	*
	* @return	HTML form
	* @access	public
	*/
function search_formE(){

  ?>
 <form action="search.php?id=edit" method="post">
<p align=center>Search all Fields for Phrase: </p><p align=center><input type="text" name="term" size="50" maxlength="200" value="<?php if (isset($_POST['term'])) echo $_POST['term']; ?>" /></p>

<p align=center>Maximum Number of Results (Per Page):
<select name="results">
<option value=20 selected>20</option>
<option value=40>40</option>
<option value=60>60</option>
<option value=80>80</option>
</select>
</p>

<p align=center> <input type="submit" name="submit" value="search" /> </p>
	<input type="hidden" name="submitted" value="TRUE" />   </p>

</form>

  <?php
}

/**
	* prints the Navigation bar
	*
	* @return	HTML
	* @access	public
	*/
function top_navigation() {

?>
<div id="navigation">
<ul>
	<li class="first"><a href="index.php">Home</span></a></li>
	<li><a href="searchform.php?id=activate"><span>Activate Datastream</span></a></li>
	<li><a href="searchform.php?id=deactivate"><span>De-Activate Datastream</span></a></li>
	<li><a href="ingest.php"><span>Batch Content Ingest</span></a></li>
	<li><a href="searchform.php?id=edit"><span>Batch Metadata Editing</span></a></li>
	<li><a href="help.php"><span>Help</span></a></li>
	<li><a href="logout.php"><span>Logout</span></a></li>
</ul>
</div>

<?php
}

/**
	* provides the selection of various functionalities like search&Replace, addition and Deletion within the Edit form
	*
	* @return	HTML form
	* @access	public
	*/
function function_implementation($fields)
{
 // print_r($fields);
  ?>
  <form name="check_form" action="edit.php" method="post" >
  <?php
        foreach ($fields as $key=>$val) {
            print '<input type=hidden name="pids[]" value="'.$val.'">';
            }
   ?>
	  <fieldset>
 <legend>Select the functionality:</legend>
  <table class="formdata_preview" width="100%" border=0>
      <tbody>

        <tr>
          <td valign=top width="25%"> <strong>*</strong> Function Type: </td>
          <td>
            <select onchange="hideAll(this);" size=1 name=function_type>
              <option value="">Select Function ...</option>
              <option value="Edit">Edit</option>
              <option value="Add">Add</option>
              <option value="Delete">Delete</option>
           </select>
          </td>
        </tr>
      </tbody>
  </table>
 </fieldset>

<br/>

<!-- START Function TYPE DIVS -->

<!-- EDIT DATA ENtrY ELEMENTS -->

<DIV id="Edit" style="display:none">
 <FIELDSET><LEGEND>Additional information - About the Edit Functionality </LEGEND>
 <TABLE width="100%" border=0>
  <TBODY>

  <tr>
    <td width="25%">Find What:</td>
    <td><input name=source></td>
  </tr>
  <tr>
    <td width="25%">Replace with:</td>
    <td><input name=destination></td>
  </tr>

  </TBODY>
 </TABLE>
   
   <fieldset>
  <legend>Submission</legend>
  <tr><p align=center> <input type="submit" name="submit" value="Submit" /> </p>  </tr>
 </fieldset>

 </FIELDSET>
 <br>
</DIV>

    
    
    
<!-- ADD DATA ENtrY ELEMENTS -->

<DIV id="Add" style="display:none">
<FIELDSET><LEGEND>Additional information - About the Add functionality </LEGEND>

<TABLE width="100%" border=0>
  <TBODY>

   <table  width="100%" id="function">
  <tbody>

 
  <tr >
    <td colspan="8"> Datafield (<i id="count_label">First</i>)</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp; </td>
    <td> <strong>*</strong> Datafield tag:</td>
    <td><input name=datafieldtag > </td>


    <td>ind1 :<select size=1 name=ind1>
              <option value=" ">_</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
           </select></td>
    <td>ind2 :<select size=1 name=ind2>
              <option value=" ">_</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
           </select></td>
  </tr>

  </tbody>

</table>

    <fieldset>
      <DIV>
        <table class="subfieldcodes" width="100%" id="subfields">
          <tbody>
            <tr bgcolor=""#cccccc="">
              <td colspan="8">
                Subfields (<i id="count_label">Original</i>)
              </td>
            </tr>
            <tr>
              <td>&nbsp;&nbsp;&nbsp;</td>
              <td>
                Subfield Code:
                </td>
              <td>
                <input name="subfieldCode" ></input>
              </td>
              <td>&nbsp;&nbsp;&nbsp;</td>
              <td>
                Subfield Value:
              </td>
              <td>
                <input name="subfieldValue" ></input>
              </td>
            </tr>

          </tbody>
      </table>
      </DIV>
      
      <div id="multiple_fields"></div>

      <a onclick="addField('subfields','multiple_fields');" href="javascript:void(0);">
        <B>+</B> Add More Subfields
      </a>
      <a onclick="removeField('subfields','multiple_fields');" href="javascript:void(0);">
        <B> | -</B> Remove
      </a>
    </fieldset>
  
    <fieldset>
      <legend>Submission</legend>
      <tr>
        <p align="center">
          <input type="submit" name="submit" value="Submit" />
        </p>
      </tr>
    </fieldset>

  </FIELDSET>
 <br>
</DIV>

<!-- Delete DATA ENtrY ELEMENTS -->

<DIV id="Delete" style="display:none">
<FIELDSET>
 <LEGEND>Additional information - About the Delete Functionality </LEGEND>
 <TABLE width="100%" border=0>
  <TBODY>

  <table class="formdata_preview" width="100%" id="creator">
  <tbody>
  
  <tr >
    <td colspan="8"> Datafield (<i id="count_label">First</i>)</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp; </td>
    <td> <strong>*</strong> Datafield tag:</td>
    <td><input name=dataFieldtag > </td>

  </tr>


  </tbody>
 </table>

 <fieldset>
  <legend>Submission</legend>
  <tr><p align=center> <input type="submit" name="submit" value="Submit" /> </p>  </tr>
 </fieldset>
 </FIELDSET>
 <br>
</DIV>

</form>
  <?php
}

/**
	* prints the Footer of the page
	*
	* @return	HTML
	* @access	public
	*/
function bottom_tags()
{
?>
<p id="imagefooter">


<a href="http://www.arrow.edu.au"><img
src="./include/images/arrowlogo.gif"
alt="Valid XHTML 1.0 Strict" height="40" width="50" /></a>
<a href="http://www.fedora.info"><img
src="./include/images/fedoralogo.gif"
alt="Valid XHTML 1.0 Strict" height="50" width="60" /></a>
<a href="http://validator.w3.org/check?uri=referer">
<img src="./include/images/xhtml.png" alt="Valid XHTML 1.0 Strict" height="15" width="60" /></a>
</div>
<?php
}

 /**
	* Content file uploading functionality - Batch upload
	*
	* @param        int $num_of_uploads numbers of files allowed to be uploaded per transaction, value read from config file
	* @param        array $file_types_array files extensions allowed to be uploaded
	* @param        int $max_file_size upload file size allowed as a check condition for the upload
	* @param        string $upload_dir path of the temp upload directory on the webserver
        * @return	array $uploadedFile files to be uploaded with their paths
	* @access	public
	*/
function UPLOADER($num_of_uploads, $file_types_array=array("xml","doc","pdf", "gif", "jpg"), $max_file_size=100048576, $upload_dir="./library/uploads/"){
  
  $uploadedFile=Array();
   global $dictionary;

  if(!is_numeric($max_file_size)){
  $max_file_size = 100048576;
  }
  if(!isset($_POST["submitted"])){
   $form = "<form action='".$_SERVER['PHP_SELF']."' method='post' enctype='multipart/form-data'>Upload files:<br /><input type='hidden' name='submitted' value='TRUE' id='".time()."'><input type='hidden' name='MAX_FILE_SIZE' value='".$max_file_size."'>";
   for($x=0;$x<$num_of_uploads;$x++){
     $form .= "<input type='file' name='file[]'><font color='red'>*</font><br />";
   }
  $form .="<br /><tr><td >Label: </td><td ><input type='text' name='label' id='label' value='CONTENT'></td></tr><br /><br />";
   $form .= "<input type='submit' value='Upload'><br /><font color='red'>*</font>Maximum file length (minus extension) is 15 characters. Anything over that will be cut to only 15 characters. Valid file type(s): ";
   for($x=0;$x<count($file_types_array);$x++){
     if($x<count($file_types_array)-1){
       $form .= $file_types_array[$x].", ";
     }else{
       $form .= $file_types_array[$x].".";
     }
   }
   $form .= "</form>";
   echo($form);
  }else{
    $dictionary["ingestLabel"] = $_POST['label'];
   foreach($_FILES["file"]["error"] as $key => $value){
     if($_FILES["file"]["name"][$key]!=""){
       if($value==UPLOAD_ERR_OK){
         $origfilename = $_FILES["file"]["name"][$key];
         $filename = explode(".", $_FILES["file"]["name"][$key]);
         $filenameext = $filename[count($filename)-1];
         unset($filename[count($filename)-1]);
         $filename = implode(".", $filename);
         $filename = substr($filename, 0, 15).".".$filenameext;
         $file_ext_allow = FALSE;
         for($x=0;$x<count($file_types_array);$x++){
           if($filenameext==$file_types_array[$x]){
             $file_ext_allow = TRUE;
           }
         }
         if($file_ext_allow){
           if($_FILES["file"]["size"][$key]<$max_file_size){
             if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], $upload_dir.$filename)){
               array_push($uploadedFile, $filename);
               echo("File uploaded successfully to the Server Buffer. - <a href='".$upload_dir.$filename."' target='_blank'>".$filename."</a><br />");
             }else{
               echo($origfilename." was not successfully uploaded<br />");
             }
           }else{
             echo($origfilename." was too big, not uploaded<br />");
           }
         }else{
           echo($origfilename." had an invalid file extension, not uploaded<br />");
         }
       }else{
         echo($origfilename." was not successfully uploaded<br />");
       }
     }
   }
  }
  return $uploadedFile;
}


/**
	* Extract raw XML from node.
	*
	* @param        $node node
        * @return	$return raw xml
	* @access	public
	*/
function dumpNode($node)
{
	$result = $node->asXML();
	$left = strpos($result,"?>");
	$left = strpos($result,">", $left + 2);
	$right = strrpos($result,"<");
	$return = substr($result,$left + 1, $right - $left - 1);
	$return = str_replace("&amp;", "&", $return);
	return $return;
}


/**
	* retrives handle from the DC datastream
	*
	* @param        $xmlstring  dc xml datastream as string
	* @param        $namespace Handle namespace, read from the config file
        * @return	$handle Handle, persisitent identifier
	* @access	public
	*/
function retrieveHandle($xmlstring, $namespace)
{
  
  
   $handle="";
  $dom= new DomDocument();
  $dom->loadXML($xmlstring);
  $xpath= new DomXPath($dom);
  
  $items= $dom->getElementsByTagName('identifier');
   // print_r($items->length);

   for ($i = 0; $i < $items->length; $i++) 
   {
    $temp= $items->item($i)->nodeValue;
   // echo "\n".$temp."\n";
    $pos = strpos($temp, $namespace);
   // print_r($pos);
    if ($pos === false) {
  // echo "The string was not found in the string ";
} else {
  $handle=$temp;
 //  echo "The string was found in the string";
}

   }
 // print_r($handle);
  return $handle;
}


/**
	* Get tagName from XML node.
	*
	* @param        $node  xml node
        * @return	Tagname
	* @access	public
	*/
function getTagName($node)
{
	$result = ($node->asXML());
	$right = strpos($result,">", 2);
	$left = strpos($result," ", 2);
	if($left != "" && $left < $right)
		$right = $left;
	
	return substr($result, 1, $right - 1);
}


/**
	* Get tagName from XML node.
	*
	* @param        string $user submitted fedora username
	* @param        string $pass submitted fedora password
	* @param        string $host submitted fedora host
	* @param        string $port submitted fedora port
	* @param        string $ver  submitted fedora version
	* @param        int $index
        * @return	boolean true/false user authentication flags
	* @access	public
	*/
function authenticate($user, $pass, $host, $port, $ver, $index)
{
    global $dictionary;
    $servers=$dictionary['servers'];
    $server=$servers[$index];
    if($user===$server['user'] && $pass===$server['password'] && $host===$server['host'] && $port===$server['port'] && $ver===$server['version'])
    {
      return true;
    }
    else
    {
      return false;
    }
}

/**
   * encodeBin - Takes $data and returns a byte array
   *
   * @param        string $data Data to be translated
   * @return:      returns byte array
*/
function encodeBin($data)
{
        //echo("TCP::encodeBin($data)",true);
        $byteArray[strlen($data)] = null;
        for ($i=0;$i < strlen($data); $i++)
                $byteArray[$i] = $data[$i];
        return $byteArray;
}

/**
	* prints the login form
	*
        * @return	HTML
	* @access	public
	*/
function loginForm()
{
  global $dictionary;
  $servers= $dictionary['servers'];
  $serverCount=count($servers) ;
 // print_r($serverCount);
  ?>
       <form method="post" name="frmLogin" id="frmLogin">
<table>
<tr>
<td >Host Name</td>
<td >
<select name = "server" id="server">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['host'].":".$counter.">".$server['host']."</option>";
 }
?>
  </select>
</tr>
<tr>
<td >Port</td>
<td >

<select name = "port" id="port">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['port'].">".$server['port']."</option>";
 }
?>
  </select>
</tr>

<tr>
<td >Version</td>
<td >

<select name = "ver" id="ver">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['version'].">".$server['version']."</option>";
 }
?>
  </select>
</tr>

<tr>
<td >User Id</td>
<td >


<select name = "txtUserId" id="txtUserId">
<?php
 for ( $counter = 0; $counter < $serverCount; $counter++ ){
    $server=$servers[$counter];
    echo "<option value = ".$server['user'].">".$server['user']."</option>";
 }
?>
  </select></td>
</tr>



<tr>
<td >Password</td>
<td ><input name="txtPassword" type="password" id="txtPassword"></td>
</tr>
<tr>
<td >&nbsp;</td>
<td ><input type="submit" name="btnLogin" value="Login"></td>
</tr>
</table>
</form>
<?php
}


/**
	* gets global value
	*
        * @param        string $key glabal array index
        * @return	global value
	* @access	public
	*/
function get($key)
{
	global $dictionary;
	if(isset($dictionary[$key])) return $dictionary[$key];
	else return "[" . $key . "]";
}


/**
	* loads variables from the config file as global values
	*
        * @param          $file config file
	* @access	public
	*/
function load_config($file)
{
        global $dictionary;


   if(!file_exists($file))
   	return;

   // Load via SimpleXML.
   $xml_document = simplexml_load_file($file);

   // Add all of the settings to the dictionary.
   foreach ($xml_document->xpath('/settings/*') as $item)
   {
   	$item_content = dumpNode($item);
   	$item_name = getTagName($item);
   	if($item_name[strlen($item_name)-1] == "/")
   		$item_name = substr($item_name, 0, strlen($item_name)-1); 
   	$dictionary["$item_name"] = $item_content;
   }

   $servers=array();
   $uploadFileType=array();
   // Add all of the languages to the dictionary.
   foreach($xml_document->xpath('/settings/servers/server') as $item)
   {
     //print_r($item);
     $temp=object2array($item);
     array_push($servers, $temp);
   }
   
    foreach($xml_document->xpath('/settings/uploadFileType') as $item)
   {
     $temp=object2array($item);
     array_push($uploadFileType, $temp);
   }

   $dictionary["servers"] = $servers;
   $dictionary["uploadFileType"] = $uploadFileType;
 //  print_r($dictionary);

}


/**
	* gets the datastream from the URI
	*
        * @param        $url the fedora get urI
        * @return	datastream
	* @access	public
	*/
function get_datastream_from_url($url)
{
	global $DEBUG;

	if($DEBUG)
		print("\n<!-- Trying [ " . $url . " ]-->\n");
	//error_log($url);
	
	$parsed_array = (parse_url($url));
	$host = $parsed_array["host"];
	$port = $parsed_array["port"];
	
	if($host == "") return;
	
	if($port==0)
		$port = 80;
	$path = $parsed_array["path"];
	if(isset($parsed_array["query"]))
		$path .= "?".$parsed_array["query"];
	$out = "GET $path HTTP/1.0\r\nHost: $host\r\n\r\n";
	$fp = fsockopen($host, $port, $errno, $errstr, 12);
	if(!$fp || feof($fp))
		return "";

	stream_set_blocking($fp, 0);
	
	fwrite($fp, $out);
	$body = false;
	$in = "";
	while(!feof($fp))
	{
		$s = fgets($fp, 256);
		if($body)
			$in .= $s;
		if(!$body && $s == "\r\n")
			$body = true;
	}
	fclose($fp);
	return $in;
}

/**
	* gets the datastream using REST
	*
        * @param        $pid the fedora pid along with namespace
        * @param        $datastream datstream ID
        * @return	datastream
	* @access	public
	*/
function get_datastream($pid, $datastream)
{
	global $strings;
	
	if($pid == "" || $datastream == "") return "";
	$url = "http://" . $_SESSION['host'].':'.$_SESSION['port'] . "/fedora/get/" . $pid . "/" . $datastream;
	return get_datastream_from_url($url);
}

/**
	* deletes the marcxml node from the marcxml datastream
	*
        * @param        $xml_output Marcxml datastream
        * @param        $deleteDataField Marcxml datafield to be deleted
        * @return	modified MARCXML
	* @access	public
	*/
function deleteNode($xml_output,$deleteDataField)
{
  //print_r($deleteDataField);
  $dom= new DomDocument();
  $dom->loadXML($xml_output);
  $xpath= new DomXPath($dom);
  //$result= $xpath->query("//default:collection/default:record/default:datafield[@tag=$deleteDataField]");
  $result= $xpath->query("//*/default:datafield[@tag=$deleteDataField]");
 
 foreach($result as $node)
 {
   //print_r( $node);
  $node->parentNode->removeChild($node);
 }

 // print_r($dom->saveXML());
  $xml_document = simplexml_import_dom($dom);
  return $xml_document;
}

/**
	* converts an object into array
	*
        * @param        $object
        * @return	array
	* @access	public
	*/
function object2array($object)
{
   $return = NULL;
       
   if(is_array($object))
   {
       foreach($object as $key => $value)
           $return[$key] = object2array($value);
   }
   else
   {
       $var = get_object_vars($object);
       if($var)
       {
           foreach($var as $key => $value)
               $return[$key] = object2array($value);
       }
       else
           return $object;
   }

   return $return;
}
 // load configuration file as the global values
load_config("configuration/config.xml");
?>