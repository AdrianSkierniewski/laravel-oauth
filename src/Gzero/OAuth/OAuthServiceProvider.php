<?php namespace Gzero\OAuth;

use Illuminate\Support\ServiceProvider;

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class OAuthServiceProvider
 *
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class OAuthServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->package('gzero/laravel-oauth', 'gzero-laravel-oauth');
        $this->app['oauth'] = $this->app->share(
            function ($app) {
                return new OAuth(
                    $this->app['config']->get('gzero-laravel-oauth::services'), // cfg
                    new LaravelSession($this->app->make('session')) // session
                );
            }
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['oauth'];
    }
}
