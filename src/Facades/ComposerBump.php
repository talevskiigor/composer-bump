<?php 

namespace Talevskiigor\ComposerBump\Facades;

class ComposerBump extends \Illuminate\Support\Facades\Facade {

  /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'ComposerBump'; }
}
