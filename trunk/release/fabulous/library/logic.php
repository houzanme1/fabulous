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

/* load classes */
require_once('nusoap.php');
require_once("class.Object2XML.php");


/**
   * Agent Class - Fedora API-A and API-M Interface class
   *
   * @author prashant pandey <prashant.pandey@unisa.edu.au>
   * @version ver1.0
   * @access public
   */
class Agent
{

 //declaring public variable
 
 //fedora API-A URL
 public $UrlA;
 //fedora API-M URL
 public $UrlM;
 //fedora username
 public $user;
 //fedora password
 public $pwd;
 //fedora next search boolean flag
 public $nextFlag;
 //fedora next search token
 public $searchToken;


 /**
   * Class constructor - initializes apia-a and api-m uri based on the version of the fedora repository
   *
   * @access public
   */
 function __construct()
 {
  // print_r($GLOBALS);
    $version= $_SESSION['version'];
    if($version==="2.1" or $version==="2.1.1" or $version==="2.2")
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

 /**
   * describes the repository
   *
   * @return repository settings like pid namespace, version etc.
   * @access public
   */
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


 /**
   * searches the repository
   *
   * @param  $fieldsSelected The metadata fields to be returned
   * @param  $mresult   The max nnumber of results to be returned per page
   * @param  $searchTerm  the term searching for
   * @return search result as XML
   * @access public
   */
function search($fieldsSelected, $mresult, $searchTerm)
{
$clientA=new soapclienttx($this->UrlA, true);

$arg_a =array(
'resultFields'=>$fieldsSelected,
'maxResults'=>$mresult,
'query'=>array('conditions'=>"", 'terms'=> $searchTerm));

$result=$clientA->call('findObjects',$arg_a);
 // print_r($result);
if(is_array($result['resultList']))
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
  return  "<?xml version='1.0' encoding='utf-8'?><error>ERROR: server behaved unexpectedly !!</error>";
}
//return $resultarray;
}


 /**
   * next search for the repository
   *
   * @param  $token The next search token
   * @return search result as XML
   * @access public
   */
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

 /**
   * gets the search fleg
   *
   * @return search flag, boolean
   * @access public
   */
function searchFlag()
{
  return $this->nextFlag;
}

 /**
   * gets the search token (resumption token)
   *
   * @return search token
   * @access public
   */
function getSearchToken()
{
  return $this->searchToken;
}

 /**
   * gets the next pid for a particular namespace
   *
   * @return next pid
   * @access public
   */
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

 /**
   * gets the fedora object profile
   *
   * @param pid fedora PID
   * @return object profile as XML
   * @access public
   */
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

 /**
   * gets the fedora object methods
   *
   * @param pid fedora PID
   * @return object methods as XML
   * @access public
   */
function listMethods($pid)
{
    $clientA=new soapclienttx($this->UrlA, true);
 $arg_a =array(
'pid'=>$pid,
'asOfDateTime'=>null);
  $result=$clientA->call('listMethods',$arg_a);
  return $this->arrayToXML($result);
}

 /**
   * gets the information about the fedora user
   *
   * @param id userid
   * @return user info. as XML
   * @access public
   */
function describeUser($id)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
 $arg_a =array(
'id'=>$id);
  $result=$clientM->call('describeUser',$arg_a);
  return $this->arrayToXML($result);
}

 /**
   * gets the fedora object datastreams
   *
   * @param pid fedora PID
   * @return datastreams as an array object
   * @access public
   */
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

/**
   * gets a particular fedora object datastream
   *
   * @param pid fedora PID
   * @param ds fedora datastream ID
   * @return datastream as an xml
   * @access public
   */
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

/**
   * gets history of fedora object
   *
   * @param pid fedora PID
   * @param ds fedora datastream ID
   * @return history of fedora object as an xml
   * @access public
   */
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


/**
   * returns a DOMELEMENT Object
   *
   * @param pid fedora PID
   * @param ds fedora datastream ID
   * @return DOMELEMENT Object
   * @access public
   */
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

}


/**
   * inserts xml node into source xml
   *
   * @return DOM DOCUMENT
   * @access public
   */
function InsertXML($source, $ingestSource)
{
       //$node
       $source->append_child($node);

       $doc = new DOMDocument;
       $domNode = $doc->importNode($source, true);
       $doc->appendChild($domNode);
       return $doc;
}

/**
   * converts DOMNODELIST into string
   *
   * @return string
   * @access public
   */
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

/**
   * sets the datastream state to active/inactive
   *
   * @param $pid  fedora object pid
   * @param $ds   fedora datatstream ID
   * @param $state  state of the datastream
   * @param $log     the log message
   * @return timestamp
   * @access public
   */
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

/**
   * converts PHP array into XML
   *
   * @param $result  php array
   * @return xml
   * @access public
   */
function arrayToXML($result)
{
  if(is_array($result))
  {
  $array2XML = new Array2xml();
  $array2XML->setArray($result);
  return $array2XML->saveArray("Result") ;
  }
  else
  return  "<?xml version='1.0' encoding='utf-8'?><error>ERROR: server behaved unexpectedly !!</error>";
}


/**
   * adds a new datastream to the fedora object
   *
   * @param $path  content file to be ingested
   * @param $pid  fedora object pid
   * @param $label  fedora object label
   * @param $type  content file mime-type
   * @param $group   control group
   * @param $state  state of the datastream
   * @param $log     the log message
   * @return timestamp
   * @access public
   */
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
 // print_r($result);
}


/**
   * updates the datastream of a fedora object
   *
   * @param $path  content file to be ingested
   * @param $pid  fedora object pid
   * @param $label  fedora object label
   * @param $type  content file mime-type
   * @param $log     the log message
   * @return timestamp
   * @access public
   */
function updateDatastream($path, $pid, $label, $type, $log)
{
    $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);

  $arg_a =array(
'pid'=>$pid,
'dsID'=>$label,
'altIDs'=>array(),
'dsLabel'=> $label,
'versionable'=>true,
'MIMEType'=>$type,
'formatURI'=>"",
new soapval("dsContent","base64Binary",$dsContent),
'logMessage'=>$log,
'force'=>true
);

  $clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
  $result=$clientM->call('modifyDatastreamByValue',$arg_a);
  //print_r($result);
}


/**
    * This function modifies inline xml datastreams (ByValue)
	*
    * @access  public
	* @param string $pid The persistant identifier of the object
	* @param string $dsID The name of the datastream
	* @param string $state The datastream state
	* @param string $label The datastream label
	* @param string $dsContent The datastream content
	* @param string $mimetype The mimetype of the datastream
	* @param boolean $versionable Whether to version control this datastream or not
    * @return void
    */
	function callModifyDatastreamByValue ($pid, $dsID, $state, $label, $dsContent, $mimetype='text/xml', $versionable="false") {
//		echo "\n\n before tidy for modify ".$dsID." "; echo date("l dS of F Y h:i:s A");
		if ($mimetype == 'text/xml') {
			$config = array(
			  'indent'         => true,
			  'input-xml'   => true,
			  'output-xml'   => true,
			  'wrap'           => 200);

			$tidy = new tidy;
			$tidy->parseString($dsContent, $config, 'utf8');
			$tidy->cleanRepair();
			$dsContent = $tidy;
		}
	    $dsContent = base64_encode(trim($dsContent));
	    $logmsg = 'Modifying datastream from Fez';
		if (empty($versionable)) {
			$versionable = 'false';
		}
		if ($versionable == "true") {
			$versionable = 'true';
		} elseif ($versionable == "false") {
			$versionable = 'false';
		}
		$versionable = 'false'; //overriding this here.
		$parms= array('pid' => $pid, 'dsID' => $dsID, 'altIDs' => array(), 'dsLabel' => $label, new soapval('versionable', 'boolean', $versionable), 'MIMEType' => $mimetype, 'formatURI' => 'unknown',  new soapval("dsContent","base64Binary",$dsContent), 'dsState' => $state, 'logMessage' => $logmsg, 'force' => true);


$clientM=new soapclienttx($this->UrlM, true);
  $clientM->setCredentials($this->user, $this->pwd);
  $result=$clientM->call('modifyDatastreamByValue',$parms);
 // print_r($result);


	}
	

/**
   * updates the datastream of a fedora object
   *
   * @param $files  array of content files to be ingested
   * @param $state  fedora datastream state
   * @param $log    the log message
   * @param $label  fedora object label
   * @access public
   */
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

/**
   * gets content of the file
   *
   * @param $filename  name of the file
   * @return the content of the file
   * @access public
   */
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

/**
   * transforms xml into html using xsl stylesheet
   *
   * @param $xsl_content  content of xsl stylesheet
   * @param $xml_content  content of source xml
   * @return html
   * @access public
   */
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

/**
   * transforms xml DOM Object into html using xsl stylesheet
   *
   * @param $xsl_content  content of xsl stylesheet
   * @param $xml_doc  XMl DOM DOcument object
   * @return html
   * @access public
   */
function transform2($xsl_content,$xml_doc)
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
  //$xml_doc = new DomDocument;
 // print_r($xml_content);
 // $xml_doc->loadXML($xml_content);
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

