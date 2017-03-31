<?php
namespace Digbang\Fonts;

use Illuminate\Support\ServiceProvider;

class FontsServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FontManager::class, function () {
            return new FontManager($this->app['config']->get('fonts.default'));
        });

        $this->mergeConfigFrom($this->configPath(), 'fonts');
    }

    public function boot()
    {
        $this->publishes([$this->configPath() => config_path('fonts.php')], 'config');
    }

    /**
     * @return string
     */
    private function configPath()
    {
        return dirname(__DIR__).'/config/fonts.php';
    }
}
