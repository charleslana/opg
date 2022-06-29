<?php

namespace core\service;

use core\classes\Email;
use core\classes\Functions;
use core\classes\Messages;
use core\enum\ResponseEnum;
use core\enum\SessionEnum;
use core\enum\StatusEnum;
use core\exception\CustomException;
use core\model\AccountModel;
use core\repository\AccountRepository;

class AccountService
{

    public static function calculateExperience(int $level): int
    {
        return ($level * 5000) / 2;
    }

    /**
     * @throws CustomException
     */
    public static function changeRecoverPassword(string $token, string $password): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountAlreadyLogged);
        }
        if (strlen($password) < 6) {
            Functions::handleResponse(Messages::$weakPassword);
        }
        $accountRepository = new AccountRepository();
        $account = $accountRepository->findByTokenAndStatusActive($token);
        if (is_null($account)) {
            Functions::handleResponse(Messages::$tokenNotFound);
        }
        $accountRepository->saveToken($account->getId(), null);
        $accountRepository->savePassword($account->getId(), $password);
        Functions::handleResponse(Messages::$passwordChangedSuccessfully, ResponseEnum::Success);
    }

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
        if ($accountRepository->existsByEmail($email)) {
            Functions::handleResponse(Messages::$emailAlreadyRegistered);
        }
        if ($accountRepository->existsByName($name)) {
            Functions::handleResponse(Messages::$nameAlreadyRegistered);
        }
        $token = $accountRepository->saveAccount($name, $email, $password);
        self::sendEmailActivateAccount($email, $name, $token);
    }

    /**
     * @throws CustomException
     */
    public static function getAccount(): AccountModel
    {
        $accountRepository = new AccountRepository();
        $account = $accountRepository->findByAccount(self::getAccountId());
        self::validateAccountSession($account);
        return $account;
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
        $account = $accountRepository->validateLogin($email, $password);
        if (is_null($account)) {
            Functions::handleResponse(Messages::$invalidLogin);
        }
        self::createSessionLogin($accountRepository, $account);
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
    public static function sendActivateEmail(string $email): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountAlreadyLogged);
        }
        if (!Functions::validateEmail($email)) {
            Functions::handleResponse(Messages::$invalidEmail);
        }
        $accountRepository = new AccountRepository();
        $account = $accountRepository->findByEmail($email);
        if ($account->getStatus() == StatusEnum::Inactive) {
            self::sendEmailActivateAccount($account->getEmail(), $account->getName(), $account->getToken());
            return;
        }
        $_SESSION[SessionEnum::AccountEmail->value] = $email;
    }

    /**
     * @throws CustomException
     */
    public static function sendRecoverPassword(string $email): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::handleResponse(Messages::$accountAlreadyLogged);
        }
        if (!Functions::validateEmail($email)) {
            Functions::handleResponse(Messages::$invalidEmail);
        }
        $accountRepository = new AccountRepository();
        $account = $accountRepository->findByEmail($email);
        if ($account->getStatus() == StatusEnum::Active) {
            $token = Functions::generateToken();
            $accountRepository->saveToken($account->getId(), $token);
            self::sendEmailRecoverPassword($account->getEmail(), $account->getName(), $token);
            return;
        }
        $_SESSION[SessionEnum::AccountEmail->value] = $email;
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
            Functions::redirect('not_found');
        }
    }

    /**
     * @throws CustomException
     */
    public static function validateTokenRecoverPassword(): void
    {
        if (Functions::validateLoggedUser()) {
            Functions::redirect();
        }
        $token = self::validateUrlToken();
        $accountRepository = new AccountRepository();
        $account = $accountRepository->findByTokenAndStatusActive($token);
        if (is_null($account)) {
            Functions::redirect('not_found');
        }
    }

    /**
     * @throws CustomException
     */
    private static function createSessionLogin(AccountRepository $accountRepository, AccountModel $accountModel): void
    {
        $session = Functions::generateToken('30');
        $accountRepository->saveSession($accountModel->getId(), $session);
        $_SESSION[SessionEnum::AccountSession->value] = $session;
        $_SESSION[SessionEnum::AccountId->value] = $accountModel->getId();
        $_SESSION[SessionEnum::AccountName->value] = $accountModel->getName();
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

    private static function sendEmailRecoverPassword(string $accountEmail, string $name, string $token): void
    {
        $email = new Email();
        $result = $email->sendEmailRecoverPassword($accountEmail, $name, $token);
        if (!$result) {
            Functions::handleResponse(Messages::$genericError);
        }
        $_SESSION[SessionEnum::AccountEmail->value] = $accountEmail;
    }

    private static function validateAccountSession(AccountModel $accountModel): void
    {
        if ($accountModel->getSession() != $_SESSION[SessionEnum::AccountSession->value]) {
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
            Functions::redirect('not_found');
        }
        $token = $_GET['token'];
        if (strlen($token) != 12) {
            Functions::redirect('not_found');
        }
        return $token;
    }
}