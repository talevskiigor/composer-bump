<?php

/**
 * @source: http://semver.org/
 * Given a version number MAJOR.MINOR.PATCH, increment the:
 * 
 * MAJOR version when you make incompatible API changes,
 * MINOR version when you add functionality in a backwards-compatible manner, and
 *PATCH version when you make backwards-compatible bug fixes.
 **/
namespace Talevskiigor\ComposerBump\Commands\Base;


use Illuminate\Console\Command;

use Talevskiigor\ComposerBump\Helpers\Bumper;
use Talevskiigor\ComposerBump\Helpers\FileHelper;


class BaseCommand extends Command
{
    
    /**
     * @var Bumper
     */
    protected $bumper;

    /**
     * @var FileHelper
     */
    protected $fileHelper;

    /**
     * @var
     */
    private $currentVersion;

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->bumper     = new Bumper();
        $this->fileHelper = new FileHelper();

        // Best to keep track of the current version before it changes later on.
        $this->setCurrentVersion($this->fileHelper->getVersion());
    }

    /**
     * @return mixed
     */
    public function currentVersion()
    {
        return $this->currentVersion;
    }

    /**
     * @param $version
     */
    private function setCurrentVersion($version)
    {
        $this->currentVersion = $version;
    }

    /**
     * @return null
     */
    public function newVersion()
    {
        return $this->fileHelper->getVersion();
    }

    /**
     * @param $version_type
     * @return mixed
     */
    public function incrementVersion($version_type)
    {
        return $this->bumper->$version_type($this->currentVersion())->get();
    }

    /**
     * Send some helpful information to user about the new version they are now using.
     */
    protected function sendInformationVersionMessage()
    {
        $this->info('Application Version bumped from: v'. $this->currentVersion().' to v' . $this->newVersion());
    }
}
