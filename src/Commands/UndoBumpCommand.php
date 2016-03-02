<?php

namespace Talevskiigor\ComposerBump\Commands;

use Talevskiigor\ComposerBump\Commands\Base\BaseCommand;

class UndoBumpCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bump:undo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore last changes in the compose.json';


   


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->error(str_repeat('!!! WARNING !!!',3));
        $this->error('    This will replace content of: composer.json file with content from file: composer.json-backup   !!!');
        if ($this->confirm('Are you suere? [y|N]')) {
            $this->fileHelper->restoreBackupFile();
            $this->info('Restored file: composer.json-backup into file: composer.json');
        }else {
            $this->info('Action was canceled.');
        }


 }


}
