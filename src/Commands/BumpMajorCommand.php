<?php


namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

class BumpMajorCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump:major';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bump MAJOR version (MAJOR.minor.patch => verison 1.0.0)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fileHelper->setVersion($this->bumper->increment('major'))->save();

        $this->sendInformationVersionMessage();
    }

}
