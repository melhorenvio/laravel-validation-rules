<?php

namespace Melhorenvio\ValidationRules;

use Illuminate\Support\ServiceProvider;

class ValidationRulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // Load translations.
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'meValidationRules');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('me-validation-rules.php'),
            ], 'config');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/meValidationRules'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'validation-rules');

        // Register the main class to use with the facade
        $this->app->singleton('validation-rules', function () {
            return new ValidationRules;
        });
    }
}
