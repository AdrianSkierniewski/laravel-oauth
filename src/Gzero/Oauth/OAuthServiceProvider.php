<?php namespace Gzero\Oauth;

use Illuminate\Support\ServiceProvider;

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class OAuthServiceProvider
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class OAuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->package('gzero/laravel-oauth');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['oauth'] = $this->app->singleton(function ($app) {
            return new Oauth();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
