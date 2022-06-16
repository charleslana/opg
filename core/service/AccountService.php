<?php

namespace core\service;

use core\classes\Email;
use core\classes\Functions;
use core\classes\Messages;
use core\exception\CustomException;
use core\model\AccountModel;
use core\repository\AccountRepository;

class AccountService
{

    /**
     * @throws CustomException
     */
    public static function createAccount(AccountModel $accountModel): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleErrors(Messages::$accountAlreadyLogged);
        }
        self::validateRegisterData($accountModel);
        $accountRepository = new AccountRepository();
        if ($accountRepository->findByEmail($accountModel->getEmail())) {
            Functions::handleErrors(Messages::$emailAlreadyRegistered);
        }
        $token = $accountRepository->saveAccount($accountModel);
        self::sendEmailActivateAccount($accountModel->getEmail(), $accountModel->getName(), $token);
    }

    /**
     * @throws CustomException
     */
    public static function login(AccountModel $accountModel): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleErrors(Messages::$accountAlreadyLogged);
        }
        self::validateLoginData($accountModel);
        $accountRepository = new AccountRepository();
        $result = $accountRepository->validateLogin($accountModel);
        if (is_bool($result)) {
            Functions::handleErrors(Messages::$invalidLogin);
        }
        self::setLoginAccount($result);
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

    private static function setLoginAccount(AccountModel $accountModel): void
    {
        $_SESSION['accountId'] = $accountModel->getId();
        $_SESSION['email'] = $accountModel->getEmail();
        $_SESSION['name'] = $accountModel->getName();
    }

    private static function validateLoginData(AccountModel $accountModel): void
    {
        if (!$accountModel->getEmail() || !$accountModel->getPassword()) {
            Functions::handleErrors(Messages::$fillData);
        }
        if (!Functions::validateEmail($accountModel->getEmail())) {
            Functions::handleErrors(Messages::$invalidEmail);
        }
    }

    private static function validateRegisterData(AccountModel $accountModel): void
    {
        if (!$accountModel->getEmail() || !$accountModel->getPassword() || !$accountModel->getName()) {
            Functions::handleErrors(Messages::$fillData);
        }
        if (!Functions::validateEmail($accountModel->getEmail())) {
            Functions::handleErrors(Messages::$invalidEmail);
        }
        if (strlen($accountModel->getPassword()) < 6) {
            Functions::handleErrors(Messages::$weakPassword);
        }
        if (!Functions::validateOnlyLettersAndSpace($accountModel->getName())) {
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