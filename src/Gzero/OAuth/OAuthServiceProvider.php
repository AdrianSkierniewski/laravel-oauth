<?php namespace Gzero\OAuth;

use Illuminate\Support\Facades\App;
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
        $this->app['oauth'] = $this->app->share(
            function ($app) {
                return new OAuth();
            }
        );

        $this->app->singleton(
            'oauth.storage',
            function ($app) {
                return new LaravelSession(App::make('session'));
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['oauth', 'oauth.storage'];
    }
}
