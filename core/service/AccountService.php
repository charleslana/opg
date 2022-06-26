<?php

namespace core\service;

use core\classes\Email;
use core\classes\Functions;
use core\classes\Messages;
use core\enum\SessionEnum;
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
            Functions::handleResponse(Messages::$accountAlreadyLogged);
        }
        self::validateRegisterData($name, $email, $password);
        $accountRepository = new AccountRepository();
        if ($accountRepository->findByEmail($email)) {
            Functions::handleResponse(Messages::$emailAlreadyRegistered);
        }
        if ($accountRepository->findByName($name)) {
            Functions::handleResponse(Messages::$nameAlreadyRegistered);
        }
        $token = $accountRepository->saveAccount($name, $email, $password);
        self::sendEmailActivateAccount($email, $name, $token);
    }

    /**
     * @throws CustomException
     */
    public static function getAccount(): object
    {
        $accountRepository = new AccountRepository();
        $result = $accountRepository->findByAccount(self::getAccountId());
        self::validateAccountSession($result);
        return $result;
    }

    public static function getAccountId(): int
    {
        return $_SESSION[SessionEnum::AccountId->value];
    }

    /**
     * @throws CustomException
     */
    public static function login(string $email, string $password): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountAlreadyLogged);
        }
        self::validateLoginData($email, $password);
        $accountRepository = new AccountRepository();
        $result = $accountRepository->validateLogin($email, $password);
        if (is_bool($result)) {
            Functions::handleResponse(Messages::$invalidLogin);
        }
        self::createSessionLogin($accountRepository, $result);
    }

    public static function logout(): void
    {
        AccountCharacterService::characterLogout();
        if (isset($_SESSION[SessionEnum::AccountId->value])) {
            unset($_SESSION[SessionEnum::AccountId->value]);
            unset($_SESSION[SessionEnum::AccountName->value]);
        }
    }

    /**
     * @throws CustomException
     */
    public static function updateGold(int $gold): void
    {
        $accountRepository = new AccountRepository();
        $accountRepository->saveGold(self::getAccountId(), $gold);
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
     * @throws CustomException
     */
    private static function createSessionLogin(AccountRepository $accountRepository, mixed $result): void
    {
        $session = Functions::generateToken('30');
        $accountRepository->saveSession($result->id, $session);
        $_SESSION[SessionEnum::AccountSession->value] = $session;
        $_SESSION[SessionEnum::AccountId->value] = $result->id;
        $_SESSION[SessionEnum::AccountName->value] = $result->name;
    }

    private static function sendEmailActivateAccount(string $accountEmail, string $name, string $token): void
    {
        $email = new Email();
        $result = $email->sendEmailNewAccount($accountEmail, $name, $token);
        if (!$result) {
            Functions::handleResponse(Messages::$genericError);
        }
        $_SESSION[SessionEnum::AccountEmail->value] = $accountEmail;
    }

    private static function validateAccountSession(bool|object $result): void
    {
        if ($result->session != $_SESSION[SessionEnum::AccountSession->value]) {
            self::logout();
            Functions::redirect();
        }
    }

    private static function validateLoginData(string $email, string $password): void
    {
        if (!$email || !$password) {
            Functions::handleResponse(Messages::$fillData);
        }
        if (!Functions::validateEmail($email)) {
            Functions::handleResponse(Messages::$invalidEmail);
        }
    }

    private static function validateRegisterData(string $name, string $email, string $password): void
    {
        if (!$email || !$password || !$name) {
            Functions::handleResponse(Messages::$fillData);
        }
        if (!Functions::validateEmail($email)) {
            Functions::handleResponse(Messages::$invalidEmail);
        }
        if (strlen($password) < 6) {
            Functions::handleResponse(Messages::$weakPassword);
        }
        if (strlen($name) < 3 || strlen($name) > 20) {
            Functions::handleResponse(Messages::$nameCharacterMinMax);
        }
        if (!Functions::validateName($name)) {
            Functions::handleResponse(Messages::$invalidName);
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