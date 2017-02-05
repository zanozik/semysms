<?php namespace NotificationChannels\SemySMS;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Notifications\Factory as FactoryContract;
use Illuminate\Contracts\Notifications\Dispatcher as DispatcherContract;

class SemySMSServiceProvider extends ServiceProvider{
    /**
     * Boot the application services.
     *
     * @return void
     */
    public function boot(){
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){
        $this->app->singleton(SemySMSChannel::class, function ($app) {
            return new SemySMSChannel(new Client());
        });
    }
}
