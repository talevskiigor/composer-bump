<?php
namespace Tests;

use PHPUnit_Framework_TestCase;
use Talevskiigor\ComposerBump\Helpers\Bumper;
use Talevskiigor\ComposerBump\Helpers\FileHelper;

class BumperTest extends PHPUnit_Framework_TestCase
{

	/** @test */
	public function it_will_increment_patch_version()
	{
		$bumper = new Bumper('1.2.3');

		$bumper->increment('patch');

		$this->assertEquals('1.2.4', $bumper->version());
	}

	/** @test */
	public function it_will_increment_minor_version()
	{
		$bumper = new Bumper('1.2.3');

		$bumper->increment('minor');

		$this->assertEquals('1.3.0', $bumper->version());
	}

	/** @test */
	public function it_will_increment_major_version()
	{
		$bumper = new Bumper('1.2.3');

		$bumper->increment('major');

		$this->assertEquals('2.0.0', $bumper->version());
	}

     /**
      * @test
      * @expectedException Exception
     **/
     public function it_will_throw_exception_on_invalid_number_of_args_for_patch()
	 {
     	$bumper = new Bumper('1.2.3.4.5');

     	$bumper->increment('patch');
     }

     /**
      * @test
      * @expectedException Exception
     **/
     public function it_will_throw_exception_on_invalid_strings_in_version_for_patch()
	 {
     	$bumper = new Bumper('a.b.c');

     	$bumper->increment('patch');
     }

     /** @test */
     public function it_will_reset_the_value_and_increment_where_it_is_null_or_non_existent()
	 {
     	$bumper = new Bumper(null);

     	$bumper->increment('patch');

     	$this->assertEquals('0.0.1', $bumper->version());
     }

 }