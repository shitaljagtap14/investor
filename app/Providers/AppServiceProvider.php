<?php

namespace App\Providers;

use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Laracasts\Generators\GeneratorsServiceProvider;
use Braintree_Configuration;
use Braintree;
use Laravel\Cashier\Cashier;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
   // require_once 'PATH_TO_BRAINTREE/lib/Braintree.php';
    public function boot()
    {

        \Braintree_Configuration::environment(config('services.braintree.environment'));
        \Braintree_Configuration::merchantId(config('services.braintree.merchantId'));
        \Braintree_Configuration::publicKey(config('services.braintree.publicKey'));
        \Braintree_Configuration::privateKey(config('services.braintree.privateKey'));
        Cashier::useCurrency('eur', '€');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(GeneratorsServiceProvider::class);
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }
}
