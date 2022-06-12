<?php

$routes = ['index' => 'main@index', 'notFound' => 'main@notFound', 'login' => 'main@login', 'register' => 'main@register', 'confirm_email' => 'main@confirmEmail', 'create_crew' => 'Crew@createCrew'];

$action = 'index';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (!array_key_exists($_GET['action'], $routes)) {
        $action = 'notFound';
    }
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controller\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctr = new $controller();
$ctr->$method();