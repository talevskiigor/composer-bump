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
            __DIR__.'/config.php', 'ComposerBump'
        );


        $this->publishes([
            __DIR__.'/config.php' => config_path('composerbump.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBumpGenerator();
        // TODO: Implement register() method.
    }



    private function registerBumpGenerator()
    {
        $this->app->singleton('bump.bump', function ($app) {
            return $app['Talevskiigor\ComposerBump\Commands\BumpCommand'];
        });
        $this->commands('bump.bump');
    }

}