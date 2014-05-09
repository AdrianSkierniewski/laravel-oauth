<?php namespace Gzero\OAuth\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Class OAuth
 * @package    Gzero\Oauth\Facade
 * @author     Adrian Skierniewski <adrian.skierniewski@gmail.com>
 * @copyright  Copyright (c) 2014, Adrian Skierniewski
 */
class OAuth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'oauth';
    }
}
