<?php

// Put this class in its Laravel namespace.
namespace App\Providers;

// Model lets us change settings for every Eloquent model
use Illuminate\Database\Eloquent\Model;
// Import ServiceProvider.
use Illuminate\Support\ServiceProvider;

// Define the AppServiceProvider.
class AppServiceProvider extends ServiceProvider
{
    // nothing to register in this lab
    public function register(): void
    {
        //
    }

    // runs when the app starts
    public function boot(): void
    {
        // throw an error on lazy loading (N+1) everywhere except production
        Model::preventLazyLoading(! app()->isProduction());
    }
}
