<?php

namespace FilippoToso\DialogflowBackup;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton('dialogflow-backup', function () {
            return new DialogflowBackup(
                config('services.dialogflow.options'),
                config('services.dialogflow.project_id')
            );
        });
    }
}
