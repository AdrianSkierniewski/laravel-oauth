<?php namespace Gzero\OAuth;

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
class OAuth
{
    protected $config = [];
    protected $serviceFactory;
    /**
     * @var LaravelSession
     */
    protected $storage;

    public function __construct()
    {
        $this->serviceFactory = new ServiceFactory();
        $this->storage = App::make('oauth.storage');
    }

    public function init($serviceName, $url)
    {
        $this->loadConfig($serviceName);
        $credentials = new Credentials($this->config['key'], $this->config['secret'], $url);
        return $this->serviceFactory->createService(
            $serviceName,
            $credentials,
            $this->storage,
            $this->config['scope']
        );
    }

    /**
     * @return LaravelSession
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param $serviceName
     */
    protected function loadConfig($serviceName)
    {
        $this->config = Config::get('laravel-oauth::services.' . $serviceName);
    }
}
