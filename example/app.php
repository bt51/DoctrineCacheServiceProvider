<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Bt51\Silex\Provider\DoctrineCacheServiceProvider\DoctrineCacheServiceProvider;

$app = new Application();

$app->register(new DoctrineCacheServiceProvider(),
               array('doctrine.cache.class' => 'PhpFileCache',
                     'doctrine.cache.options' => array(__DIR__ . '/cache', 'cache')));

$app->get('/', function () use ($app) {
    $hash = array('value1', 'value2');
    
    $cache = $app['doctrine.cache'];
    $cache->save('test', $hash);
    
    return new Response('Saved content!',
                        200,
                        array('Content-Type' => 'text/plain'));
});
