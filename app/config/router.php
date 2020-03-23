<?php

$router = $di->getRouter();

// Define your routes here

$router->add(
    '/index/index',
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);

$router->add(
    '/index/start',
    [
        'controller' => 'index',
        'action'     => 'start',
    ]
);

$router->add(
    '/index/stop',
    [
        'controller' => 'index',
        'action'     => 'stop',
    ]
);

$router->add(
    '/user/index',
    [
        'controller' => 'user',
        'action'     => 'index',
    ]
);

$router->add(
    '/user/logout',
    [
        'controller' => 'user',
        'action'     => 'logout',
    ]
);

$router->add(
    '/user/change',
    [
        'controller' => 'user',
        'action'     => 'change',
    ]
);

$router->add(
    '/session/start',
    [
        'controller' => 'session',
        'action'     => 'start',
    ]
);

$router->add(
    '/session/change',
    [
        'controller' => 'session',
        'action'     => 'change',
    ]
);


$router->add(
    '/admin/index',
    [
        'controller' => 'admin',
        'action'     => 'index',
    ]
);

$router->add(
    '/admin/late',
    [
        'controller' => 'admin',
        'action'     => 'late',
    ]
);

$router->add(
    '/admin/changelate',
    [
        'controller' => 'admin',
        'action'     => 'changelate',
    ]
);

$router->add(
    '/admin/deleteLate',
    [
        'controller' => 'admin',
        'action'     => 'deleteLate',
    ]
);

$router->add(
    '/admin/newuser',
    [
        'controller' => 'admin',
        'action'     => 'newuser',
    ]
);

$router->add(
    '/admin/deleteuser',
    [
        'controller' => 'admin',
        'action'     => 'deleteuser',
    ]
);

//$router->add(
//    '/admin/changeStatus',
//    [
//        'controller' => 'admin',
//        'action'     => 'changeStatus',
//    ]
//);

$router->add(
    '/admin/addToDb',
    [
        'controller' => 'admin',
        'action'     => 'addToDb',
    ]
);

$router->add(
    '/admin/notWorkDays',
    [
        'controller' => 'admin',
        'action'     => 'notWorkDays',
    ]
);

$router->add(
    '/errors/show404',
    [
        'controller' => 'errors',
        'action'     => 'show404',
    ]
);

$router->handle();