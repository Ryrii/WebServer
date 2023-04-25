<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\TwitterController::login'], null, null, null, false, false, null]],
        '/createPost' => [[['_route' => 'createPost', '_controller' => 'App\\Controller\\TwitterController::createPost'], null, null, null, false, false, null]],
        '/signup' => [[['_route' => 'signup', '_controller' => 'App\\Controller\\TwitterController::signup'], null, null, null, false, false, null]],
        '/lastPosts' => [[['_route' => 'lastPosts', '_controller' => 'App\\Controller\\TwitterController::lastPosts'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/deletePost/(\\d+)(*:59)'
                .'|/post/(\\d+)(*:77)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        59 => [[['_route' => 'deletePost', '_controller' => 'App\\Controller\\TwitterController::deletePost'], ['id'], null, null, false, true, null]],
        77 => [
            [['_route' => 'post', '_controller' => 'App\\Controller\\TwitterController::post'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
