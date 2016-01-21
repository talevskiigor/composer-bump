<?php

namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

class BumpMinorCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump:minor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bump MINOR version (major.MINOR.patch => verison 0.1.0)';





    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

     $oldVersion = $this->fileHelper->getVersion();

     $newVersion = $this->bumper->bumpMinor($oldVersion)->get();

     $this->fileHelper->setVersion($newVersion)->save();

     $this->info('Bump from: '. $oldVersion.' to ' . $newVersion);
 }

}
