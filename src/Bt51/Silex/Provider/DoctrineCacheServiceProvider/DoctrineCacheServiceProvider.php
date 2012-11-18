<?php

/*
 * This file is part of DoctrineCacheServiceProvider
 *
 * (c) Ben Tollakson <ben.tollakson@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bt51\Silex\Provider\DoctrineCacheServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class DoctrineCacheServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (! isset($app['doctrine.cache.class'])) {
            $app['doctrine.cache.class'] = 'ArrayCache';
        }

        $app['doctrine.cache.handler'] = $app->share(function ($app) {
            $options = (isset($app['doctrine.cache.options']) ? $app['doctrine.cache.options'] : array());
            $class = sprintf('\\Doctrine\\Common\\Cache\\%s', $app['doctrine.cache.class']);
            $handler = new \ReflectionClass($class);
            return $handler->newInstanceArgs($options);
        });
        
        $app['doctrine.cache'] = $app->share(function ($app) {
            return $app['doctrine.cache.handler'];
        });
    }
    
    public function boot(Application $app)
    {
        
    }
}
