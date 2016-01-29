<?php 
namespace Talevskiigor\ComposerBump;

class ComposerBump{

	public function __construct(){
		$this->fileHelper = new \Talevskiigor\ComposerBump\Helpers\FileHelper();
	}

	public function version(){
		return $this->getVersion();
	}

	public function getVersion(){
		return $this->fileHelper->getVersion();
	}

}