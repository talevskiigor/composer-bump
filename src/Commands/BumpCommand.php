<?php

namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

/**
 * Class BumpCommand
 *
 * @package Talevskiigor\ComposerBump\Commands
 */
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
        $oldVersion = $this->fileHelper->getVersion();
        $newVersion = $this->bumper->bump($oldVersion)->get();
        $this->fileHelper->setVersion($newVersion)->save();
        $this->info('Bump from: ' . $oldVersion . ' to ' . $newVersion);
    }
}
