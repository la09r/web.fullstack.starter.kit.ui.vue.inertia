<?php

namespace LA09R\StarterKit\UI\Vue\Inertia\App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('iconSvg', function($argString) {
            $argString = str_replace("'", '', $argString);
            $arg = explode(', ', $argString);

            $vendorPath = $arg[0];
            $fileName = $arg[1];
            $cssClass = $arg[2];

            // Create the dom document as per the other answers
            $domNode = new \DOMDocument();
            $domNode->load(base_path("$vendorPath/$fileName.svg"));
            $domNode->documentElement->setAttribute("class", $cssClass);

            return $domNode->saveXML($domNode->documentElement);
        });
    }
}
