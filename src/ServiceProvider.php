<?php

namespace DefStudio\Tools;

use DefStudio\Tools\View\Components\Card;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $this->loadViewComponentsAs(config('tools.tags_prefix', ''), [
            Card::class,
        ]);

        $this->loadViewsFrom(__DIR__."/../resources/views", 'tools');

        $this->mergeConfigFrom(__DIR__."/../config/tools.php", 'tools');

        $this->publishes([
            __DIR__."/../resources/views" => resource_path('views/vendor/tools'),
        ], 'views');

        $this->publishes([
            __DIR__."/../config/tools.php" => config_path('tools.php'),
        ], 'config');
    }
}
