<?php
namespace Talevskiigor\ComposerBump\Helpers;

use Exception;
/**
* Given a version number MAJOR.MINOR.PATCH, increment the:
*
* MAJOR version when you make incompatible API changes,
* MINOR version when you add functionality in a backwards-compatible manner, and
* PATCH version when you make backwards-compatible bug fixes.
*/



class Bumper
{

	protected $major;
	protected $minor;
	protected $patch;


	public function bump($version){
		return $this->bumpPatch($version);
	}

	
	public function bumpPatch($version){
		$this->parseVersion($version);
		
		$this->patch++;

		return $this;
	}
	
	public function bumpMinor($version){
		$this->parseVersion($version);
		
		$this->minor++;
		$this->patch= 0;

		return $this;
	}

	public function bumpMajor($version){
		$this->parseVersion($version);
		
		$this->major++;
		$this->minor=0;
		$this->patch=0;

		return $this;
	}

	public function parseVersion($version){
		

		if(!$version){
			return $this->initToZero();
		}
		

		$splits = explode('.', $version);

		if(count($splits)!=3){
			throw new Exception("Error parsing the version:" . $version, 1);
		}

		foreach ($splits as $key => $value) {
			if(!is_numeric($value)){
				throw new Exception("invalid string in version: " . $version, 1);
			}
		}

		list($this->major,$this->minor,$this->patch) = $splits;

		$this->major = (int)$this->major;
		$this->minor = (int)$this->minor;
		$this->patch = (int)$this->patch;

		return $this;
	}

	public function initToZero(){
		
		$this->major = 0;
		$this->minor = 0;
		$this->patch = 0;

		return $this;	
	}

	public function get(){
		return implode('.',[$this->major,$this->minor,$this->patch]);
	}
}