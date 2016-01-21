<?php

/*
    @source: http://semver.org/
Given a version number MAJOR.MINOR.PATCH, increment the:

MAJOR version when you make incompatible API changes,
MINOR version when you add functionality in a backwards-compatible manner, and
PATCH version when you make backwards-compatible bug fixes.
 */
namespace Talevskiigor\ComposerBump\Commands;


use Illuminate\Console\Command;

use Talevskiigor\ComposerBump\Helpers\Bumpper;
use Talevskiigor\ComposerBump\Helpers\FileHelper;


class BumpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bump version';

    protected $composerFilePath;
    protected $composerContent;
    protected $newVersion;
    protected $currentVersion;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->bumper = new Bumpper();
        $this->fileHelper = new FileHelper();

    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->composerFilePath = base_path('composer.json');

        if(!file_exists($this->composerFilePath)){
            throw new \Exception('The file is not found: ' . $this->composerFilePath);
        }

        $this->composerContent = json_decode(file_get_contents($this->composerFilePath),true);
        
        if(is_null($this->composerContent)){
            throw new \Exception("Error in decoding JSON file: " . $this->getJsonError(), 1);
            
        }
        if($this->isThisInitialRun()){

            $this->runInitVersion();

            $this->info('Bump init version of: '. $this->newVersion);            
            
            return true;
        }


        $this->currentVersion = $this->composerContent['version'];

        $this->bumpNewVersion();

        $this->info('Bump from: '. $this->currentVersion.' to ' . $this->newVersion);
    }

    public function appendVersion($version = '1.0.0'){

        $this->composerContent['version']=$version;

        $this->currentVersion = $this->newVersion = $version;

    }

    public function isThisInitialRun(){

        return !array_key_exists('version',$this->composerContent);


    }
    public function runInitVersion(){
     $this->error('You don\'t have version setup in the file: ' . $this->composerFilePath);
     $appendVersion = $this->confirm('Do you whant to append init version as: 1.0.0');

     if($appendVersion){
        $this->appendVersion();
        $this->save();
    }
}

public function save(){
    $data = json_encode($this->composerContent,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($this->composerFilePath, $data);
}

public function bumpNewVersion(){
    list($MAJOR,$MINOR,$PATCH) = explode('.', $this->currentVersion);
    (int)$PATCH++; 
    $this->composerContent['version']= $this->newVersion = implode('.', [$MAJOR,$MINOR,$PATCH]);
    $this->save();
}
public function getJsonError(){
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
        return  ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
        return  ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
        return  ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
        return  ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
        return  ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
        return  ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
        return  ' - Unknown error';
        break;
    }

}

public function getFile(){
    return base_path('composer.json');
}
}
