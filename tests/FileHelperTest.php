<?php 

namespace Tests;

use PHPUnit_Framework_TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Talevskiigor\ComposerBump\Helpers\FileHelper;

class FileHelperTest extends PHPUnit_Framework_TestCase {

	protected $initData = [
	'something'=>'a value',
	'version'=>'1.0.0',
	'another thing'=>'some other value'
	];

	protected $initDataNoVersion = [
	'something'=>'a value',
	'other'=>'x y z',
	'another thing'=>'some other value'
	];

		protected $initDataInvalidFile = "[
	'something'=>'a value',[]]
	'version'=>'1.0.0',,
	'another thing'=>'some other value'
	]";

	protected $testFileName = 'test-dir/composer.json';
	protected $testFileNameBackup = 'test-dir/composer.json-backup';
	protected $testFileNameVFS = 'vfs://test-dir/composer.json';

	public function setTestingFile($fileData)
	{
		
		$this->root = vfsStream::setup(dirname($this->testFileName));

		$file = vfsStream::newFile(basename($this->testFileName));

		$content = json_encode($fileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

		$file->setContent($content);

		$this->root->addChild($file);

		$file = vfsStream::newFile(basename($this->testFileNameBackup));

		$content = json_encode($fileData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

		$file->setContent($content);

		$this->root->addChild($file);

	}


	/** @test */
	public function it_will_read_version_and_return_version_from_file(){
		$this->setTestingFile($this->initData);

		$version = (new FileHelper($this->testFileNameVFS))->getVersion();

		$this->assertEquals('1.0.0',$version);
	}

	/** @test */
	public function it_will_read_version_and_return_null_when_no_version_int_file(){
		$this->setTestingFile($this->initDataNoVersion);

		$version = (new FileHelper($this->testFileNameVFS))->getVersion();

		$this->assertEquals(null,$version);
	}

	/** @test */
	public function it_will_will_write_new_version(){
		$this->setTestingFile($this->initDataNoVersion);

		$testVersion = '1.2.3';
		$FileHelper = new FileHelper($this->testFileNameVFS);

		$versionOld = $FileHelper->getVersion();

		$versionWrite = $FileHelper->setVersion($testVersion)->writeFile()->getVersion();

		$versionRead = (new FileHelper($this->testFileNameVFS))->getVersion();
		
		$this->assertNotEquals($versionRead,$versionOld);

		$this->assertEquals($testVersion,$versionRead);
	}


	/**
	 *	@test
	 *	@expectedException Exception
	 **/
	public function it_will_thor_error_if_file_dont_exists(){
		

		new FileHelper('not existing file path');
	}

	/**
	 *	@test
	 *	@expectedException Exception
	 **/
	public function it_will_thor_error_if_file_has_invalid_format(){
		

		$this->setTestingFile($this->initDataInvalidFile);

		new FileHelper($this->testFileNameVFS);

		
	}
}
