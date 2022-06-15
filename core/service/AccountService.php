<?php

namespace core\service;

use core\classes\Email;
use core\classes\Functions;
use core\classes\Messages;
use core\exception\CustomException;
use core\repository\AccountRepository;

class AccountService
{

    /**
     * @throws CustomException
     */
    public static function createAccount(array $data): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleErrors(Messages::$accountAlreadyLogged);
        }
        self::validateData($data);
        $accountRepository = new AccountRepository();
        if ($accountRepository->findByEmail($data['email'])) {
            Functions::handleErrors(Messages::$emailAlreadyRegistered);
        }
        $token = $accountRepository->saveAccount($data);
        self::sendEmailActivateAccount($data, $token);
    }

    /**
     * @throws CustomException
     */
    public static function validateAccountToken(): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::redirect();
        }
        $token = self::validateUrlToken();
        $accountRepository = new AccountRepository();
        $result = $accountRepository->activateAccount($token);
        if (!$result) {
            Functions::redirect();
        }
    }

    /**
     * @param array $data
     * @param string $token
     * @return void
     */
    private static function sendEmailActivateAccount(array $data, string $token): void
    {
        $email = new Email();
        $result = $email->sendEmailNewAccount($data['email'], ucwords(strtolower($data['name'])), $token);
        if (!$result) {
            Functions::handleErrors(Messages::$genericError);
        }
        $_SESSION['accountEmail'] = $data['email'];
    }

    /**
     * @param array $data
     * @return void
     */
    private static function validateData(array $data): void
    {
        if (!$data['email'] || !$data['password'] || !$data['passwordConfirmation'] || !$data['name']) {
            Functions::handleErrors(Messages::$fillData);
        }
        if (!Functions::validateEmail($data['email'])) {
            Functions::handleErrors(Messages::$invalidEmail);
        }
        if (strlen($data['password']) < 6) {
            Functions::handleErrors(Messages::$weakPassword);
        }
        if ($data['password'] != $data['passwordConfirmation']) {
            Functions::handleErrors(Messages::$differentPasswords);
        }
        if (!Functions::validateOnlyLettersAndSpace($data['name'])) {
            Functions::handleErrors(Messages::$nameContainOnlyLettersAndSpace);
        }
    }

    /**
     * @return mixed
     */
    private static function validateUrlToken(): mixed
    {
        if (!isset($_GET['token'])) {
            Functions::redirect();
        }
        $token = $_GET['token'];
        if (strlen($token) != 12) {
            Functions::redirect();
        }
        return $token;
    }
}