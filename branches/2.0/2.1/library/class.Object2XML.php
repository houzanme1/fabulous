<?php
 
 
 /**
   * Array2xml Class - converts php array into XML
   *
   * this class is used to convert result of SOAP calls(FEDORA API) into XML
   * @access public
   */


class Array2xml {


	private $XMLArray;

	private $arrayOK;

	private $doc;


        //empty constructor
	public function __construct(){
		
	}


	/**
	 * saveArray
	 * @access public
	 * @param string $XMLFile
	 * @return bool
	 */

	public function saveArray($rootName="", $encoding="utf-8"){
		global $debug;
		$this->doc = new domdocument("1.0", $encoding);
		$arr = array();
		if (count($this->XMLArray) > 1){
			if ($rootName != ""){
				$root = $this->doc->createElement($rootName);
			}else{
				$root = $this->doc->createElement("root");
				$rootName = "root";
			}
			$arr = $this->XMLArray;
		}else{

			$key = key($this->XMLArray);
			$val = $this->XMLArray[$key];

			if (!is_int($key)){
				$root = $this->doc->createElement($key);
				$rootName = $key;
			}else{
				if ($rootName != ""){
					$root = $this->doc->createElement($rootName);
				}else{
					$root = $this->doc->createElement("root");
					$rootName = "root";
				}
			}
			$arr = $this->XMLArray[$key];
		}
		
		$root = $this->doc->appendchild($root);
	
		$this->addArray($arr, $root, $rootName);

return $this->doc->saveXML();

	}

         //add array
	function addArray($arr, &$n, $name=""){
		foreach ($arr as $key => $val){

			if (is_int($key)){
                          /*
				if (strlen($name)>1){
					$newKey = substr($name, 0, strlen($name)-1);
				}else{
					$newKey="item";
				}
				*/
                              $newKey="item";
			}else{
				$newKey = $key;
			}
			$node = $this->doc->createElement($newKey);
			if (is_array($val)){
				$this->addArray($arr[$key], $node, $key);
			}else{
				$nodeText = $this->doc->createTextNode($val);
				$node->appendChild($nodeText);
			}
			$n->appendChild($node);
		}
	}

        //set array
	public function setArray($XMLArray){
		if (is_array($XMLArray) && count($XMLArray) != 0){
			$this->XMLArray = $XMLArray;
			$this->arrayOK = true;
		}else{
			$this->arrayOK = false;
		}
		return $this->arrayOK;
	}

}

?>