<?php
namespace Tests;

use PHPUnit_Framework_TestCase;
use Talevskiigor\ComposerBump\Helpers\Bumper;

class BumperTest extends PHPUnit_Framework_TestCase
{
	
	function __construct()
	{
	}


	/** @test */
	public function it_will_increment_bump_version_as_alias_of_bumpPatch(){
		$bumper = new Bumper;

		$version = $bumper->bumpPatch('1.2.3')->get();

		$this->assertEquals('1.2.4',$version);
	}

	/** @test */
	public function it_will_increment_patch_version(){
		$bumper = new Bumper;

		$version = $bumper->bumpPatch('1.2.3')->get();

		$this->assertEquals('1.2.4',$version);
	}

	/** @test */
	public function it_will_increment_minor_version(){
		$bumper = new Bumper;

		$version = $bumper->bumpMinor('1.2.3')->get();

		$this->assertEquals('1.3.0',$version);
	}

	/** @test */
	public function it_will_increment_major_version(){
		$bumper = new Bumper;

		$version = $bumper->bumpMajor('1.2.3')->get();

		$this->assertEquals('2.0.0',$version);
	}

     /**
      * @test
      * @expectedException Exception
     **/
     public function it_will_throw_exxeption_on_invalid_number_of_args_for_patch(){
     	$bumper = new Bumper;

     	$bumper->bumpPatch('1.2.3.4.5')->get();
     }
     /**
      * @test
      * @expectedException Exception
     **/
     public function it_will_throw_exxeption_on_invalid_strings_in_version_for_patch(){
     	$bumper = new Bumper;

     	$bumper->bumpPatch('a.b.c')->get();
     }

     /** @test */
     public function it_will_return_inital_bump_value_where_version_is_null_or_empty_or_false(){

     	$bumper = new Bumper;

     	$versionNull = $bumper->bump(null)->get();
     	$this->assertEquals('0.0.1',$versionNull);

     	$versionEmptyString = $bumper->bump(null)->get();
     	$this->assertEquals('0.0.1',$versionEmptyString);

     	$versionFalse = $bumper->bump(false)->get();
     	$this->assertEquals('0.0.1',$versionFalse);
     }

     /** @test */
     public function it_will_return_inital_patch_value_where_version_is_null_or_empty_or_false(){

     	$bumper = new Bumper;

     	$versionNull = $bumper->bumpPatch(null)->get();
     	$this->assertEquals('0.0.1',$versionNull);

     	$versionEmptyString = $bumper->bumpPatch(null)->get();
     	$this->assertEquals('0.0.1',$versionEmptyString);

     	$versionFalse = $bumper->bumpPatch(false)->get();
     	$this->assertEquals('0.0.1',$versionFalse);
     }
     
     /** @test */
     public function it_will_return_inital_minor_value_where_version_is_null_or_empty_or_false(){

     	$bumper = new Bumper;

     	$versionNull = $bumper->bumpMinor(null)->get();
     	$this->assertEquals('0.1.0',$versionNull);

     	$versionEmptyString = $bumper->bumpMinor(null)->get();
     	$this->assertEquals('0.1.0',$versionEmptyString);

     	$versionFalse = $bumper->bumpMinor(false)->get();
     	$this->assertEquals('0.1.0',$versionFalse);
     }

     /** @test */
     public function it_will_return_inital_major_value_where_version_is_null_or_empty_or_false(){

     	$bumper = new Bumper;

     	$versionNull = $bumper->bumpMajor(null)->get();
     	$this->assertEquals('1.0.0',$versionNull);

     	$versionEmptyString = $bumper->bumpMajor(null)->get();
     	$this->assertEquals('1.0.0',$versionEmptyString);

     	$versionFalse = $bumper->bumpMajor(false)->get();
     	$this->assertEquals('1.0.0',$versionFalse);
     }


 }