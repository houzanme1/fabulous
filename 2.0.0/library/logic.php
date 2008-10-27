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
//
require_once('nusoap.php');
require_once("class.Object2XML.php");
class Agent
{

 public $UrlA;
 public $UrlM;
 public $user;
 public $pwd;
 public $nextFlag;
 public $searchToken;



 function __construct()
 {
  // print_r($GLOBALS);
    $version= $_SESSION['version'];
    if($version==="2.1" or $version==="2.1.1")
    {
      $this->UrlA='http://'.$_SESSION['host'].':'.$_SESSION['port'].'/fedora/services/access?wsdl';
      $this->UrlM='http://'.$_SESSION['host'].':'.$_SESSION['port'].'/fedora/services/management?wsdl';
    }
    else
    {
   $this->UrlA='http://'.$_SESSION['host'].':'.$_SESSION['port'].'/fedora/access/soap?wsdl';
   $this->UrlM='http://'.$_SESSION['host'].':'.$_SESSION['port'].'/fedora/management/soap?wsdl';
    }
   $this->user=$_SESSION['user'];
   $this->pwd=$_SESSION['password'];
 }

 function describeRepository()
{
 $clientA=new soapclienttx($this->UrlA, true);
 $result=$clientA->call('describeRepository');
 if(isset($result['repositoryPIDNamespace']))
 {
 $_SESSION["pidNamespace"] = $result['repositoryPIDNamespace'];
 }
 //print_r($GLOBALS);
 return $this->arrayToXML($result);
}

function search($fieldsSelected, $mresult, $searchTerm)
{
$clientA=new soapclienttx($this->UrlA, true);

$arg_a =array(
'resultFields'=>$fieldsSelected,
'maxResults'=>$mresult,
'query'=>array('conditions'=>"", 'terms'=> $searchTerm));

$result=$clientA->call('findObjects',$arg_a);
//  print_r($result);
if(count($result['resultList'])>0)
{
$lsession=$result['listSession'];
$this->searchToken=$lsession['token'];
if(isset($this->searchToken))
{
  $this->nextFlag=true;
}
else
{
  $this->nextFlag=false;
}

$resultarray=$result['resultList'];
foreach($resultarray as $key=>$value)
{
  $pidvalue=$value['pid'];
  $Dresult=$this->getDatastreams($pidvalue);
 //print_r($Dresult);
// print_r($Dresult['detail']);
  $dr=array();
  foreach($Dresult as $key1=>$value1)
  {
   array_push($dr,array('ID'=>$value1['ID'],'state'=>$value1['state']));
  }
 // print_r($dr);
 // array_push($resultarray[$key], 'datastreams'>$dr);
 $resultarray[$key]["datastreams"]= $dr;
}
return $this->arrayToXML($resultarray);

}
else
{
  return  "<?xml version='1.0' encoding='utf-8'?><error>ERROR</error>";
}
//return $resultarray;
}

function nextSearch($token)
{
    $arg_a =array('sessionToken'=>$token);
    $clientA=new soapclienttx($this->UrlA, true);
    $result=$clientA->call('resumeFindObjects',$arg_a);
    if(array_key_exists('listSession', $result))
    {
     $lsession=$result['listSession'];
      $this->searchToken=$lsession['token'];
    }



if(isset($this->searchToken))
{
  $this->nextFlag=true;
}
else
{
  $this->nextFlag=false;
}
if(array_key_exists('resultList', $result))
{
$resultarray=$result['resultList'];



foreach($resultarray as $key=>$value)
{
  $pidvalue=$value['pid'];
  $Dresult=$this->getDatastreams($pidvalue);
 //print_r($Dresult);
  $dr=array();
  foreach($Dresult as $key1=>$value1)
  {
   array_push($dr,array('ID'=>$value1['ID'],'state'=>$value1['state']));
  }
 // print_r($dr);
 // array_push($resultarray[$key], 'datastreams'>$dr);
 $resultarray[$key]["datastreams"]= $dr;
}
return $this->arrayToXML($resultarray);

}
else
{
  return "<?xml version='1.0' encoding='utf-8'?><error>ERROR</error>";
}
}

function searchFlag()
{
  return $this->nextFlag;
}

function getSearchToken()
{
  return $this->searchToken;
}

function getNextPid($namespace)
{
  $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
  $result=$clientM->call('getNextPID',$namespace);
  return $result;
}

//current API-A implementation buggy returns an empty array
function listDatastreams($pid)
{
    $clientA=new soapclienttx($this->UrlA, true);
 // $clientA->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid,
'asOfDateTime'=>null);
  $result=$clientA->call('listDatastreams',$arg_a);
  return $this->arrayToXML($result);
}

function getObjectProfile($pid)
{
    $clientA=new soapclienttx($this->UrlA, true);
 // $clientA->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid,
'asOfDateTime'=>null);
  $result=$clientA->call('getObjectProfile',$arg_a);
  return $this->arrayToXML($result);
}

function listMethods($pid)
{
    $clientA=new soapclienttx($this->UrlA, true);
 $arg_a =array(
'pid'=>$pid,
'asOfDateTime'=>null);
  $result=$clientA->call('listMethods',$arg_a);
  return $this->arrayToXML($result);
}

function describeUser($id)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'id'=>$id);
  $result=$clientM->call('describeUser',$arg_a);
  return $this->arrayToXML($result);
}

function getDatastreams($pid)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid,
'asOfDateTime'=>null);
  $result=$clientM->call('getDatastreams',$arg_a);
  //return $this->arrayToXML($result);
  return $result;
}

function getDatastream($pid, $ds)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid,
'dsID'=>$ds,
'asOfDateTime'=>null);
  $result=$clientM->call('getDatastream',$arg_a);
  return $this->arrayToXML($result);
}


function getDatastreamHistory($pid, $ds)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid,
'dsID'=>$ds);
  $result=$clientM->call('getDatastreamHistory',$arg_a);
  return $this->arrayToXML($result);
}
// returns a DOMELEMENT Object
function getMarcXML($pid, $ds)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid);
  $result=$clientM->call('getObjectXML',$arg_a);
   $dom = new DomDocument();
   //$dom=domxml_open_mem($result);
    $dom->loadXML($result);
    $test= $dom->getElementsByTagName("collection");
    $node = $test->item(0);
    return $node;

 // $result1=$this->domNodeList_to_string($test);
 // return $result1;
}

function InsertXML($source, $ingestSource)
{
       //$node
       $source->append_child($node);

       $doc = new DOMDocument;
       $domNode = $doc->importNode($source, true);
       $doc->appendChild($domNode);
       return $doc;
}

function domNodeList_to_string($DomNodeList) {
    $output = '';
    $i=0;
    $doc = new DOMDocument;
    while ( $node = $DomNodeList->item($i) ) {
        // import node
        $domNode = $doc->importNode($node, true);
        // append node
        $doc->appendChild($domNode);
        $i++;
    }
    $output = $doc->saveXML();
    $output = print_r($output, 1);
    // I added this because xml output and ajax do not like each others
    $output = htmlspecialchars($output);
    return $output;
}

function setDatastreamState($pid, $ds, $state, $log)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'pid'=>$pid,
'dsID'=>$ds,
'dsState'=>$state,
'logMessage'=>$log);
  $result=$clientM->call('setDatastreamState',$arg_a);
  return $result;
}


function arrayToXML($result)
{
  $array2XML = new Array2xml();
$array2XML->setArray($result);
 return $array2XML->saveArray("Result") ;
}

function addDatastream($path, $pid, $label, $type, $group, $state, $log)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);

  $arg_a =array(
'pid'=>$pid,
'dsID'=>null,
'altIDs'=>array(),
'dsLabel'=> $label,
'versionable'=>true,
'MIMEType'=>$type,
'formatURI'=>"",
'dsLocation'=>$path,
'controlGroup'=>$group,
'dsState'=>$state,
'logMessage'=>$log
);

  $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
  $result=$clientM->call('addDatastream',$arg_a);
  if(is_array($result))
  {
    echo "<b><u>".$path."</u></b> failed to be ingested <br />";
  }
  else
  {
    echo "Datastream for pid: <b><u>".$pid."</u></b> successfully ingested <br />";
  }
  //print_r($result);
}

function addDataStreams($files, $state, $log, $label)
{
        foreach($files as $key=>$value)
        {
         //$label=$value;
         // server name needs to be automated.
         $file="http://".$_SERVER['HTTP_HOST']."/fabulous/library/uploads/".$value;
         $fileArray=explode(".",$value);
          $pid= $_SESSION['pidNamespace'].":".$fileArray[0];

       switch($fileArray[1])
       {
         case "pdf":
              $type="application/pdf";
              $group="M";
             // echo "its pdf";
              $this->addDatastream($file, $pid, $label, $type, $group, $state, $log);
               break;
         case "xml":
         $type="text/xml";
              $group="X";
               // echo "its xml";
                $this->addDatastream($file, $pid, $label, $type, $group, $state, $log);
                 break;
         case "doc":
         $type="application/msword";
              $group="M";
                // echo "its doc";
                 $this->addDatastream($file, $pid, $label, $type, $group, $state, $log);
                 break;
         case "jpg":
         $type="image/jpg";
              $group="M";
                // echo "its jpg";
                 $this->addDatastream($file, $pid, $label, $type, $group, $state, $log);
                 break;
         case "gif":
         $type="image/gif";
              $group="M";
                // echo "its gif";
                 $this->addDatastream($file, $pid, $label, $type, $group, $state, $log);
                 break;

         default: echo "<b><u>".$value."</u></b> failed to ingest as <b><u>.".$fileArray[1]."</u></b> extension is not supported for ingest at this moment <br />";
       }

                  // print_r($label);
       unlink("./library/uploads/".$value);

        }
}

 function get_file($filename)
{
	if(file_exists($filename) && filesize($filename) > 0)
	{
		$handle = fopen(($filename), "r") or die("Error: Can't open [" . $filename . "].");
		$content = fread($handle, filesize($filename));
		return $content;
	}
	return "";
}

function transform($xsl_content,$xml_content)
{
  $xp = new XsltProcessor();
  
  // create a DOM document and load the XSL stylesheet
  $xsl = new DomDocument;
  if(file_exists($xsl_content) && filesize($xsl_content) > 0)
  {
  $xsl->load($xsl_content);
  
  // import the XSL styelsheet into the XSLT process
  $xp->importStylesheet($xsl);
  
  // create a DOM document and load the XML data
  $xml_doc = new DomDocument;
 // print_r($xml_content);
  $xml_doc->loadXML($xml_content);
// transform the XML into HTML using the XSL file
  if ($html = $xp->transformToXML($xml_doc)) {
      return $html;
  } else {
     return trigger_error('XSL transformation failed.', E_USER_ERROR);
  } // if
  }
  else
  {
    return   trigger_error('XSL File Doesnt Exist.', E_USER_ERROR);
  }
}


}



?>

