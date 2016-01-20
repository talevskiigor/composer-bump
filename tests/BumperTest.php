<?php
namespace Tests;

use PHPUnit_Framework_TestCase;
use Talevskiigor\ComposerBump\Bumper;

class BumperTest extends PHPUnit_Framework_TestCase
{
	
	function __construct()
	{
	}


	/** @test */
	public function it_will_increment_patch_version(){
		$bumper = new Bumper;

		$version = $bumper->bumpPatch('1.2.3');

		$this->assertEquals('1.2.4',$version);
	}

	/** @test */
	public function it_will_increment_minor_version(){
		$bumper = new Bumper;

		$version = $bumper->bumpMinor('1.2.3');

		$this->assertEquals('1.3.0',$version);
	}

	/** @test */
	public function it_will_increment_major_version(){
		$bumper = new Bumper;

		$version = $bumper->bumpMajor('1.2.3');

		$this->assertEquals('2.0.0',$version);
	}

     /**
      * @test
      * @expectedException Exception
     **/
     public function it_will_throw_exxeption_on_invalid_number_of_args_for_patch(){
      $bumper = new Bumper;

      $bumper->bumpPatch('1.2.3.4.5');
     }
     /**
      * @test
      * @expectedException Exception
     **/
     public function it_will_throw_exxeption_on_invalid_strings_in_version_for_patch(){
      $bumper = new Bumper;

      $bumper->bumpPatch('a.b.c');
     }

 }