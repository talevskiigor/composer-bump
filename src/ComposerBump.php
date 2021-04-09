<?php

namespace Talevskiigor\ComposerBump;

/**
 * Class ComposerBump
 *
 * @package Talevskiigor\ComposerBump
 */
class ComposerBump
{
    /**
     * ComposerBump constructor.
     */
    public function __construct()
    {
        $this->fileHelper = new \Talevskiigor\ComposerBump\Helpers\FileHelper();
    }

    /**
     * Get Version (alias)
     *
     * @return |null
     */
    public function version()
    {
        return $this->getVersion();
    }

    /**
     * Get Version
     *
     * @return string|null
     */
    public function getVersion()
    {
        return $this->fileHelper->getVersion();
    }

}
