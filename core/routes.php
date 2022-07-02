<?php

$routes = [
    'index' => 'main@index',
    'not_found' => 'main@notFound',
    'login' => 'main@login',
    'register' => 'main@register',
    'confirm_email' => 'main@confirmEmail',
    'activate_account' => 'main@activateAccount',
    'activate_email' => 'main@activateEmail',
    'confirm_activate_email' => 'main@confirmActivateEmail',
    'recover_password' => 'main@recoverPassword',
    'confirm_recover_password' => 'main@confirmRecoverPassword',
    'recover_account' => 'main@recoverAccount',
    'recover' => 'main@recover',
    'logout' => 'main@logout',
    'select_crew' => 'Crew@selectCrew',
    'recruit_crew' => 'Crew@recruitCrew',
    'get_character_details' => 'Crew@getCharacterDetails',
    'add_crew' => 'Crew@addCrew',
    'create_crew_session' => 'Crew@createCrewSession',
    'status' => 'Status@status',
    'inventory' => 'Inventory@inventory'
];

$action = 'index';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (!array_key_exists($_GET['action'], $routes)) {
        $action = 'not_found';
    }
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controller\\' . ucfirst($parts[0]);
$method = $parts[1];

if (class_exists($controller)) {
    $ctr = new $controller();
    $ctr->$method();
}