<?php
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;


$app->get('/hello', function () {
    return 'Hello!';
});
$app->get('/hola', function (Silex\Application $app, Request $request) {

    return '¡Hola! -> '.$request->getUriForPath("/hello");
});
$app->error(function (\Exception $e, $code) use ($app) {

    // commented for testing purposes
    /*if ($app['debug']) {
        return;
    }*/

    if ($code == 404) {
        return '¡AJJJJ! -> '.$_SERVER['REQUEST_URI'];
//        $loader = $app['dataloader'];
//        $data = array(
//            'global' => $loader->load('global'),
//            'common' => $loader->load('common', $app['locale']),
//            'header' => $loader->load('header', $app['locale']),
//            'footer' => $loader->load('footer', $app['locale'])
//        );
//
//        return new Response( $app['twig']->render('404.html.twig', array( 'data' => $data )), 404);
    }

    return new Response('We are sorry, but something went terribly wrong.', $code);

});
$app->run();
