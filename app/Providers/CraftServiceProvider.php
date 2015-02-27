<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CraftServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
    {
        //
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
        // don't break artisan in command line
        empty( $_SERVER['SERVER_NAME'] ) && $_SERVER['SERVER_NAME'] = 'localhost';
        empty( $_SERVER['REQUEST_URI'] ) && $_SERVER['REQUEST_URI'] = '/';

        $craft = require base_path().'/craft/app/bootstrap.php';
        $this->app->singleton('Craft\WebApp', function($app) use ($craft)
        {
            return $craft;
        });
	}

}
