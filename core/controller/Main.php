<?php

namespace core\controller;

use core\classes\Functions;
use core\enum\SessionEnum;
use core\exception\CustomException;
use core\service\AccountService;

class Main
{

    /**
     * @throws CustomException
     */
    public function activateAccount(): void
    {
        AccountService::validateAccountToken();
        Functions::showMainLayout('activate_account');
    }

    public function confirmEmail(): void
    {
        if (!isset($_SESSION[SessionEnum::AccountEmail->value])) {
            Functions::redirect();
        }
        Functions::showMainLayout('confirm_email');
        unset($_SESSION[SessionEnum::AccountEmail->value]);
    }

    public function index(): void
    {
        if (isset($_SESSION[SessionEnum::AccountId->value])) {
            Functions::redirect('select_crew');
        }
        Functions::showMainLayout();
    }

    /**
     * @throws CustomException
     */
    public function login(): void
    {
        Functions::validatePostRequest();
        $requestBody = json_decode(file_get_contents('php://input'), true);
        $data = array_map('trim', $requestBody);
        AccountService::login($data['email'], $data['password']);
    }

    public function logout(): void
    {
        AccountService::logout();
        Functions::redirect();
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
        $requestBody = json_decode(file_get_contents('php://input'), true);
        $data = array_map('trim', $requestBody);
        AccountService::createAccount($data['name'], $data['email'], $data['password']);
    }
}