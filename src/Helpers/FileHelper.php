<?php

namespace Talevskiigor\ComposerBump\Helpers;
use Exception;

class FileHelper {

	protected $composerFilePath;
	protected $composerFileContent;

	public function __construct($filePath){

		$this->composerFilePath = $filePath;

		$this->readFile();

		return $this;

	}
	private function readFile(){


		if(!file_exists($this->composerFilePath)){

			throw new Exception("File not found: " . $this->composerFilePath, 1);
		}

		$fileContent = file_get_contents($this->composerFilePath);	

		
		$this->composerFileContent  = json_decode($fileContent,true);

		//var_dump($this->composerFileContent);
		if(is_null($this->composerFileContent) || !is_array($this->composerFileContent)){
			throw new \Exception("Error in decoding JSON file with description: " . $this->getJsonError(), 1);
		}

		return $this;
	}

	public function getVersion(){

		if(array_key_exists('version',$this->composerFileContent)){
			return $this->composerFileContent['version'];
		}
		return null;
	}

	public function setVersion($version){
		$this->composerFileContent['version'] = $version;
		return $this;
	}

	public function writeFile(){
		$data = json_encode($this->composerFileContent,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
		file_put_contents($this->composerFilePath, $data);
		return $this;
	}
	
	public function save(){
		return $this->writeFile();
	}

	public function getContents(){
		return $this->composerFileContent;
	}


	public function getJsonError(){
		switch (json_last_error()) {
			case JSON_ERROR_NONE:
			return  ' - No errors';
			break;
			case JSON_ERROR_DEPTH:
			return  ' - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
			return  ' - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
			return  ' - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
			return  ' - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
			return  ' - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
			return  ' - Unknown error';
			break;
		}

	}

}