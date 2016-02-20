<?php
/**
 * Created by PhpStorm.
 * User: Mark
 * Date: 20/02/2016
 * Time: 00:26
 */

namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

/**
 * Class UnBumpMinorCommand
 *
 * @package Talevskiigor\ComposerBump\Commands
 */
class UnBumpMinorCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unbump:minor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'unBump Minor version (MINOR.minor.patch => verison 1.0.0)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fileHelper->setVersion($this->bumper->decrement('minor'))->save();

        $this->sendInformationVersionMessage();
    }
}