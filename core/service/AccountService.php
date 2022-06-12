<?php

namespace core\service;

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
        $accountRepository->saveAccount($data);
    }

    /**
     * @param array $data
     * @return void
     */
    public static function validateData(array $data): void
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
}