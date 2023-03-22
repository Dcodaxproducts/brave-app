<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\Client;

class TwilioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            $accountSid = 'ACe521d0b08e96094b80fbcd7357a64d76';
            $authToken = 'dc0ef6238aef70bb029e2b4c30c301dc';
            return new Client($accountSid, $authToken);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
