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

	public function getContents(){
		return $this->composerFileContent;
	}

}