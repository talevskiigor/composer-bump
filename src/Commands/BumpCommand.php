<?php

namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

class BumpCommand extends BaseCommand
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
    protected $description = 'Bump version (This is alias of bump:patch)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fileHelper->setVersion($this->incrementVersion('bump'))->save();

        $this->sendInformationVersionMessage();
    }

}
