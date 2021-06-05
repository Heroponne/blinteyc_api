<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/answers' => [[['_route' => 'answer_check', '_controller' => 'App\\Controller\\AnswerController::checkAnswer'], null, ['POST' => 0], null, false, false, null]],
        '/games' => [[['_route' => 'app_game_creategame', '_controller' => 'App\\Controller\\GameController::createGame'], null, ['POST' => 0], null, false, false, null]],
        '/games/play' => [[['_route' => 'app_game_playgame', '_controller' => 'App\\Controller\\GameController::playGame'], null, ['POST' => 0], null, false, false, null]],
        '/users/login' => [[['_route' => 'user_or_session_create', '_controller' => 'App\\Controller\\UserController::loginAction'], null, ['POST' => 0], null, false, false, null]],
        '/users/logout' => [[['_route' => 'user_logout', '_controller' => 'App\\Controller\\UserController::logoutUserAction'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/participations/([^/]++)/get_ready(*:76)'
                .'|/tracks/([^/]++)(*:99)'
                .'|/user/([^/]++)(*:120)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        76 => [[['_route' => 'participation_create', '_controller' => 'App\\Controller\\ParticipationController::setReadyPlayerStateAction'], ['id'], ['POST' => 0], null, false, false, null]],
        99 => [[['_route' => 'track_show', '_controller' => 'App\\Controller\\TrackController::showTrackAction'], ['id'], ['GET' => 0], null, false, true, null]],
        120 => [
            [['_route' => 'user_show', '_controller' => 'App\\Controller\\UserController::showUserAction'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
