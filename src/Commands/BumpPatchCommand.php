<?php

namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

class BumpPatchCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump:patch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Increments PATCH version (major.minor.PATCH => verison 0.0.1)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fileHelper->setVersion($this->incrementVersion('bumpPatch'))->save();

        $this->sendInformationVersionMessage();
    }
}
