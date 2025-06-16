<?php

namespace Modules\Chatbot;

use Illuminate\Support\ServiceProvider;
use Modules\Chatbot\Repositories\Contracts\ChatbotRepositoryInterface;
use Modules\Chatbot\Repositories\Eloquent\ChatbotRepository;
use Modules\Chatbot\RouteServiceProvider;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }

    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton(
            ChatbotRepositoryInterface::class,
            ChatbotRepository::class
        );

    }





}
