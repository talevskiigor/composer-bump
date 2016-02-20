<?php
namespace Talevskiigor\ComposerBump\Helpers;

use Exception;

/**
 * Class Bumper
 *
 * Given a version number MAJOR.MINOR.PATCH, increment the:
 *
 * MAJOR version when you make incompatible API changes,
 * MINOR version when you add functionality in a backwards-compatible manner, and
 * PATCH version when you make backwards-compatible bug fixes.
 *
 * @package Talevskiigor\ComposerBump\Helpers
 */
class Bumper
{

	/**
	 * @var integer
	 */
	private $major;
	/**
	 * @var integer
	 */
	private $minor;
	/**
	 * @var integer
	 */
	private $patch;

	/**
	 * Bumper constructor.
	 *
	 * @param $version
	 */
	public function __construct($version)
	{
		$this->parseVersion($version);
	}

	/**
	 * @param $type
	 * @return string
	 */
	public function increment($type)
	{
		$this->$type++;

		return $this->version();
	}

	/**
	 * Since we shouldn't allow less than 0
	 * This will make a quick check to make sure.
	 *
	 * No errors, since of course, accidental on users half O.O!!
	 *
	 * @param $type
	 * @return string
	 */
	public function decrement($type)
	{
		if($this->$type > 0)
			$this->$type--;

		return $this->version();
	}

	/**
	 * @return string
	 */
	public function version()
	{
		return implode('.',[$this->major,$this->minor,$this->patch]);
	}

	/**
	 * @param $version
	 * @return $this
	 * @throws Exception
	 */
	public function parseVersion($version){

		// no version exists, reset it.
		$version ?: $this->resetVersion();

		// convert version to array.
		$splits = explode('.', $version);

		// count the array, make sure it adds up.
		if(count($splits)!=3){
			$this->createErrorException('Invalid Characters on Version.', $version);
		}

		// check each array has a valid numeric character.
		foreach ($splits as $key => $value) {
			if(!is_numeric($value)){
				$this->createErrorException('Version is incorrect format.', $version);
			}
		}

		list($this->major,$this->minor,$this->patch) = $splits;

		$this->major = (int)$this->major;
		$this->minor = (int)$this->minor;
		$this->patch = (int)$this->patch;

		return $this;
	}

	/**
	 * @return $this
	 */
	public function resetVersion(){

		$this->major = 0;
		$this->minor = 0;
		$this->patch = 0;

		return $this;
	}

	/**
	 * @param $text
	 * @param $version
	 * @throws Exception
	 */
	public function createErrorException($text, $version)
	{
		throw new Exception($text . ' Please check "version" in composer.json.  Current Value: ['. $version .']');
	}
}