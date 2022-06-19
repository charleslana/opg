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
    public static function createAccount(string $name, string $email, string $password): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleErrors(Messages::$accountAlreadyLogged);
        }
        self::validateRegisterData($name, $email, $password);
        $accountRepository = new AccountRepository();
        if ($accountRepository->findByEmail($email)) {
            Functions::handleErrors(Messages::$emailAlreadyRegistered);
        }
        $token = $accountRepository->saveAccount($name, $email, $password);
        self::sendEmailActivateAccount($email, $name, $token);
    }

    public static function getAccountId(): int
    {
        return $_SESSION['accountId'];
    }

    /**
     * @throws CustomException
     */
    public static function login(string $email, string $password): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleErrors(Messages::$accountAlreadyLogged);
        }
        self::validateLoginData($email, $password);
        $accountRepository = new AccountRepository();
        $result = $accountRepository->validateLogin($email, $password);
        if (is_bool($result)) {
            Functions::handleErrors(Messages::$invalidLogin);
        }
        self::setLoginAccount($result->id, $result->name);
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

    private static function sendEmailActivateAccount(string $accountEmail, string $name, string $token): void
    {
        $email = new Email();
        $result = $email->sendEmailNewAccount($accountEmail, $name, $token);
        if (!$result) {
            Functions::handleErrors(Messages::$genericError);
        }
        $_SESSION['accountEmail'] = $accountEmail;
    }

    private static function setLoginAccount($id, $name): void
    {
        $_SESSION['accountId'] = $id;
        $_SESSION['name'] = $name;
    }

    private static function validateLoginData(string $email, string $password): void
    {
        if (!$email || !$password) {
            Functions::handleErrors(Messages::$fillData);
        }
        if (!Functions::validateEmail($email)) {
            Functions::handleErrors(Messages::$invalidEmail);
        }
    }

    private static function validateRegisterData(string $name, string $email, string $password): void
    {
        if (!$email || !$password || !$name) {
            Functions::handleErrors(Messages::$fillData);
        }
        if (!Functions::validateEmail($email)) {
            Functions::handleErrors(Messages::$invalidEmail);
        }
        if (strlen($password) < 6) {
            Functions::handleErrors(Messages::$weakPassword);
        }
        if (!Functions::validateOnlyLettersAndSpace($name)) {
            Functions::handleErrors(Messages::$nameContainOnlyLettersAndSpace);
        }
    }

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