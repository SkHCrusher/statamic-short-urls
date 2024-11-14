<?php

namespace HallowTech\ShortUrls;

use HallowTech\ShortUrls\Http\Controllers\CP\ShortUrlsController;
use Statamic;
use Statamic\Facades\Utility;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function bootAddon()
    {
        Statamic::afterInstalled(function ($command) {
            // Required for the following package https://github.com/ash-jc-allen/short-url?tab=readme-ov-file#migrate-the-database
            $command->call('migrate');
        });

        $this->loadViewsFrom(__DIR__.'../resources/views', 'short-urls');

        Utility::extend(function () {
            Utility::register('short-urls')
                ->action([ShortUrlsController::class, 'index'])
                ->title(__('Short URLs'))
                ->icon('link')
                ->navTitle(__('Short URLs'))
                ->routes(function ($router) {
                    $router->post('/', [ShortUrlsController::class, 'create'])->name('create');
                })
                ->description('Create Short URLs');
        });
    }
}
