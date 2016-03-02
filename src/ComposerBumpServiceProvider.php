<?php
namespace Talevskiigor\ComposerBump;

use Illuminate\Support\ServiceProvider;

class ComposerBumpServiceProvider extends ServiceProvider
{


    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/config.php', 'ComposerBump'
        );


        $this->publishes([
            __DIR__ . '/config.php' => config_path('composerbump.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind('ComposerBump', \Talevskiigor\ComposerBump\ComposerBump::class);

        $this->registerBumpGenerator();

        $this->registerBumpPatchGenerator();

        $this->registerBumpMinorGenerator();

        $this->registerBumpMajorGenerator();

        $this->registerUndoBump();
    }


    private function registerBumpGenerator()
    {
        $this->app->singleton('bump.bump', function ($app) {
            return $app['Talevskiigor\ComposerBump\Commands\BumpCommand'];
        });

        $this->commands('bump.bump');
    }

    private function registerBumpPatchGenerator()
    {
        $this->app->singleton('bump.bump.patch', function ($app) {
            return $app['Talevskiigor\ComposerBump\Commands\BumpPatchCommand'];
        });

        $this->commands('bump.bump.patch');
    }

    private function registerBumpMinorGenerator()
    {
        $this->app->singleton('bump.bump.minor', function ($app) {
            return $app['Talevskiigor\ComposerBump\Commands\BumpMinorCommand'];
        });

        $this->commands('bump.bump.minor');
    }

    private function registerBumpMajorGenerator()
    {
        $this->app->singleton('bump.bump.major', function ($app) {
            return $app['Talevskiigor\ComposerBump\Commands\BumpMajorCommand'];
        });

        $this->commands('bump.bump.major');
    }

    private function registerUndoBump()
    {
        $this->app->singleton('bump.bump.undo', function ($app) {
            return $app['Talevskiigor\ComposerBump\Commands\UndoBumpCommand'];
        });

        $this->commands('bump.bump.undo');
    }
}