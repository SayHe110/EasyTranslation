<?php

/*
 * This file is part of the sayhe110/translation
 *
 * (c) sayhe110 <949426374@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sayhe110\Translation;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Translation::class, function () {
            return new Translation(config('services.translation.key'), config('services.translation.appid'));
        });

        $this->app->alias(Translation::class, 'translation');
    }

    public function provides()
    {
        return [Translation::class, 'translation'];
    }
}
