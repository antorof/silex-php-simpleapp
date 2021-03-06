<?php
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
require_once __DIR__.'/config/header.php';
require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->get('/', function () use ($app) {
    return $app['twig']->render('inicio.twig', array(
        'page_title' => "Inicio :: Gestor de contactos",
        'titulo_cabecera' => "",
        'titulo_principal' => "Gestor de contactos",
        'subtitulo_principal' => "Administra tus contactos de forma sencilla.",
        'titulo_contenido' => "",
        'contenido' => "",
        'keyword' => "",
        'seccion' => "",
    ));
});

$app->get('/crear-contacto', function () use ($app) {
    return $app['twig']->render('crear-contacto.twig', array(
        'page_title' => "Crear contacto :: Gestor de contactos",
        'titulo_cabecera' => "",
        'titulo_principal' => "Crear contacto",
        'subtitulo_principal' => "Rellena los campos para añadir un nuevo contacto.",
        'titulo_contenido' => "Campos opcionales",
        'contenido' => "",
        'keyword' => "",
        'seccion' => "crear-contacto",
    ));
});

$app->get('/buscar-contactos', function () use ($app) {
    return $app['twig']->render('buscar-contactos.twig', array(
        'page_title' => "Buscar contactos :: Gestor de contactos",
        'titulo_cabecera' => "",
        'titulo_principal' => "Buscar contactos",
        'subtitulo_principal' => "Introduce algún dato que pueda estar relacionado con un contacto.",
        'titulo_contenido' => "",
        'contenido' => '',
        'keyword' => "",
        'seccion' => "buscar-contactos"
    ));
});

$app->get('/buscar-contactos/', function (Request $request) use ($app) {
    return $app->redirect($request->getBasePath().'/buscar-contactos');
});

$app->match('/buscar-contactos/{keyword}', function ($keyword) use ($app) {
    global $gc;
    $contactos = $gc->buscar($keyword);
    return $app['twig']->render('buscar-contactos.twig', array(
        'page_title' => "Buscar contactos :: Gestor de contactos",
        'titulo_cabecera' => "",
        'titulo_principal' => "Buscar contactos",
        'subtitulo_principal' => "Introduce algún dato que pueda estar relacionado con un contacto.",
        'titulo_contenido' => "",
        'contenido' => '',
        'keyword' => "$keyword",
        'seccion' => "buscar-contactos",
        'contactos' => $contactos
    ));
})->method('POST|GET');

$app->get('/ver-contactos', function () use ($app) {
    global $gc;
    $contactos = $gc->listarContactos();
    return $app['twig']->render('ver-contactos.twig', array(
        'page_title' => "Ver contactos :: Gestor de contactos",
        'titulo_cabecera' => "",
        'titulo_principal' => "Ver contactos",
        'subtitulo_principal' => "Aquí están todos tus contactos.",
        'titulo_contenido' => "Contactos:",
        'contenido' => '',
        'keyword' => "",
        'seccion' => "ver-contactos",
        'contactos' => $contactos
//        'contactos' => json_encode($contactos)
    ));
});

// Funciones CRUD

$app->match('/borrar-contacto/{id}', function ($id) use ($app) {
    global $gc;
    $result = $gc->eliminarContacto($id);

    return $app->json(array("resultado"=>$result));
})->method('POST|DELETE');

$app->post('/crear-contacto', function (Request $request) use ($app) {
    global $gc;
    $nombre = $request->get("nombre");
    $email = $request->get("email");
    $telefono = $request->get("telefono");

    $result = $gc->aniadirContacto($nombre,$email,$telefono);

    return $app->json(array("resultado"=>$result));
});

$app->get('/buscar/{keyword}', function ($keyword) use ($app) {
    global $gc;
    $result = $gc->buscar($keyword);

    return $app->json($result);
});

//$app->error(function (\Exception $e, $code) use ($app) {
//
//    // commented for testing purposes
//    /*if ($app['debug']) {
//        return;
//    }*/
//
//    if ($code == 404) {
//        return '¡AJJJJ! -> '.$_SERVER['REQUEST_URI'];
////        $loader = $app['dataloader'];
////        $data = array(
////            'global' => $loader->load('global'),
////            'common' => $loader->load('common', $app['locale']),
////            'header' => $loader->load('header', $app['locale']),
////            'footer' => $loader->load('footer', $app['locale'])
////        );
////
////        return new Response( $app['twig']->render('404.html.twig', array( 'data' => $data )), 404);
//    }
//
//    return new Response('We are sorry, but something went terribly wrong.', $code);
//
//});
$app->run();
