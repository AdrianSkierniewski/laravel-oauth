<?php namespace Gzero\Oauth;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use OAuth\Common\Consumer\Credentials;
use OAuth\ServiceFactory;

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Oauth
 * @package    Gzero\Oauth
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class Oauth
{
    /**
     * @var array
     */
    protected $config = [];
    /**
     * @var \OAuth\ServiceFactory
     */
    protected $serviceFactory;

    public function __construct()
    {
        $this->serviceFactory = new ServiceFactory();
    }

    /**
     * @param $service
     * @param $url
     * @return \OAuth\Common\Service\ServiceInterface
     */
    public function init($service, $url)
    {
        $this->loadConfig($service);
        $credentials = new Credentials($this->config['key'], $this->config['secret'], $url);
        return $this->serviceFactory->createService(
            $service,
            $credentials,
            new LaravelSession(App::make('session')),
            $this->config['scope']
        );

    }

    /**
     * @param $service
     */
    protected function loadConfig($service)
    {
        $this->config = Config::get('laravel-oauth::services.' . $service);
    }
}
