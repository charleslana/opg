<?php

namespace core\controller;

use core\classes\Functions;
use core\exception\CustomException;
use core\service\AccountService;

class Main
{

    public function confirmEmail(): void
    {
        Functions::showMainLayout('confirm_email');
    }

    public function index(): void
    {
        Functions::showMainLayout();
    }

    public function login(): void
    {
//        echo '<pre>';
//        print_r($_POST);
        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);
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

    /**
     * @throws CustomException
     */
    public function register(): void
    {
        Functions::validatePostRequest();
        $requestBody = file_get_contents('php://input');
        $data = json_decode($requestBody, true);
        AccountService::createAccount(array_map('trim', $data));
    }
}