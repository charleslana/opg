<?php

$routes = ['index' => 'main@index', 'login' => 'main@login', 'register' => 'main@register', 'create_crew' => 'Crew@createCrew'];

$action = 'index';

if (isset($_GET['action']) && array_key_exists($_GET['action'], $routes)) {
    $action = $_GET['action'];
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controller\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctr = new $controller();
$ctr->$method();