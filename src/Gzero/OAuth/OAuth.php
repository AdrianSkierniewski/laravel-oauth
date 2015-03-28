<?php namespace Gzero\OAuth;

use OAuth\Common\Consumer\Credentials;
use OAuth\ServiceFactory;

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class Oauth
 *
 * @package    Gzero\Oauth
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class OAuth {
    /**
     * @var array
     */
    protected $config = [];
    /**
     * @var \OAuth\ServiceFactory
     */
    protected $serviceFactory;
    /**
     * @var LaravelSession
     */
    protected $storage;

    public function __construct(Array $config, $storage)
    {
        $this->serviceFactory = new ServiceFactory();
        $this->storage = $storage;
        $this->config = $config;
    }

    /**
     * @param $serviceName
     * @param $url
     *
     * @return \OAuth\Common\Service\ServiceInterface
     */
    public function init($serviceName, $url)
    {
        $config = $this->loadConfig($serviceName);
        $credentials = new Credentials($config['key'], $config['secret'], $url);
        return $this->serviceFactory->createService(
            $serviceName,
            $credentials,
            $this->storage,
            $config['scope']
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
     * Returns config for specific service
     *
     * @param $serviceName
     *
     * @return
     * @throws OAuthServiceException
     */
    protected function loadConfig($serviceName)
    {
        if (!empty($this->config[$serviceName])) {
            return $this->config[$serviceName];
        } else {
            throw new OAuthServiceException('No configuration for ' . $serviceName . ' service');
        }
    }
}
