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

	protected $rootFolder = 'test-dir';
	protected $fileName = 'composer.json';

	public function setUp()
	{
		
		$this->root = vfsStream::setup($this->rootFolder);


		$file = vfsStream::newFile($this->fileName);
		

		$content = json_encode($this->initData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

		$file->setContent($content);

		$this->root->addChild($file);

		//var_dump(file_get_contents('vfs://' . $rootFolder . DIRECTORY_SEPARATOR . $fileName));
	}


	/** @test */

	public function it_will_read_version_and_return_null_if_no_version_is_in_file(){
		$filePath = 'vfs://' . $this->rootFolder . DIRECTORY_SEPARATOR . $this->fileName;
		$file = json_decode(file_get_contents($filePath),true);
		var_dump($file);	
		$fileHelper = new FileHelper($filePath);

		$this->assertEquals($file,$fileHelper->getContents());
	}
}
