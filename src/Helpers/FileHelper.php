<?php

namespace Talevskiigor\ComposerBump\Helpers;


class FileHelper {

	protected $composerFilePath;
	protected $composerFileContent;

	public function __construct($composerFilePath = null){
		$this->composerFilePath = $composerFilePath;

		$this->readFile($this->composerFilePath);
		return $this;

	}
	private function readFile($fileName = null){
		$this->composerFileContent  = file_get_contents($this->composerFilePath);
		return $this;
	}

	public function getVersion(){
		var_dump($this->getContents());
		if(!array_key_exists('version',$this->getContents())){
		//	return ($this->getContents())->version;
		}
		return null;
	}
	public function getContents(){
		return json_decode($this->composerFileContent,true);
	}

}