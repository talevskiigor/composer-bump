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

/**
 * Class BaseCommand
 *
 * @package Talevskiigor\ComposerBump\Commands\Base
 */
class BaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->bumper = new Bumper();
        $this->fileHelper = new FileHelper();

    }

    /**
     * Execute the console command.
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        throw new \Exception("You need to implement your own handle() method.", 1);
    }
}
