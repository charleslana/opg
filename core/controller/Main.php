<?php

namespace core\controller;

use core\classes\Functions;

class Main
{

    public function confirmEmail(): void
    {
        Functions::showMainLayout('confirm_email');
    }

    public function index(): void
    {
        Functions::showMainLayout('home');
    }

    public function login(): void
    {
//        echo '<pre>';
//        print_r($_POST);
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body, true);
        $email = $data['email'];
        echo json_encode($email);
//        $test = array (
//            'error' => 'test error!'
//        );
//        echo json_encode($test);
    }

    public function notFound(): void
    {
        Functions::showMainLayout('not_found');
    }

    public function register(): void
    {
        $test = array('error' => 'test error!');
        echo json_encode($test);
    }
}