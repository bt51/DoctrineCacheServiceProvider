<?php

/*
 * This file is part of DoctrineCacheServiceProvider
 *
 * (c) Ben Tollakson <ben.tollakson@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoctrineCacheServiceProvider\Tests;

use Silex\Application;
use Bt51\Silex\Provider\DoctrineCacheServiceProvider\DoctrineCacheServiceProvider;

class DoctrineCacheServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!class_exists('Doctrine\\Common\\Cache\\CacheProvider')) {
            $this->markTestSkipped('Doctrine Common is not installed');
        }
    }
    
    public function testSilexDoctrineCache()
    {
        $app = new Application();
        
        $app->register(new DoctrineCacheServiceProvider(),
                       array('doctrine.cache.class' => 'ArrayCache'));
        
        $this->assertInstanceOf('\\Doctrine\\Common\\Cache\\ArrayCache',
                                $app['doctrine.cache']);
    }
}
