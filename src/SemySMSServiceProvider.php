<?php namespace NotificationChannels\SemySMS;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

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
