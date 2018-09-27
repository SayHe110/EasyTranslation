<?php

namespace Sayhe110\Translation;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Translation::class, function(){
            // return new Translation(config('services.translation.key'), config('services.translation.appid'));
            return new Translation('9ulwF8alAWQ4bZCTrJTk', '20180124000118319');
        });

        $this->app->alias(Translation::class, 'translation');
    }

    public function provides()
    {
        return [Translation::class, 'translation'];
    }
}
