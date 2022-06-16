<?php

namespace core\repository;

use core\classes\Database;
use core\classes\Functions;
use core\exception\CustomException;
use core\model\AccountModel;

class AccountRepository
{

    /**
     * @throws CustomException
     */
    public function activateAccount(string $token): bool
    {
        $parameters = [':token' => $token];
        $database = new Database();
        $result = $database->select('SELECT id FROM account WHERE token = :token', $parameters);
        if (count($result) != 1) {
            return false;
        }
        $id = $result[0]->id;
        $parameters = [':id' => $id];
        return $database->update('UPDATE account SET token = null, status = "active" WHERE id = :id', $parameters);
    }

    /**
     * @throws CustomException
     */
    public function findByEmail(string $email): bool
    {
        $parameters = [':email' => $email];
        $database = new Database();
        $results = $database->select('SELECT email from account WHERE email = :email', $parameters);
        if (count($results) != 0) {
            return true;
        }
        return false;
    }

    /**
     * @throws CustomException
     */
    public function saveAccount(AccountModel $accountModel): string
    {
        $token = Functions::generateToken();
        $parameters = [':email' => $accountModel->getEmail(), ':password' => Functions::encodePassword($accountModel->getPassword()), ':name' => $accountModel->getName(), ':token' => $token];
        $database = new Database();
        $database->insert('INSERT INTO account (email, password, name, token) VALUES(:email, :password, :name, :token)', $parameters);
        return $token;
    }

    /**
     * @throws CustomException
     */
    public function validateLogin(AccountModel $accountModel): bool|AccountModel
    {
        $parameters = [':email' => $accountModel->getEmail()];
        $database = new Database();
        $result = $database->select("SELECT id, email, name, password FROM account WHERE email = :email AND status = 'active' AND deleted_at IS NULL", $parameters);
        if (count($result) != 1) {
            return false;
        }
        $account = $this->getLoginAccountModel($result[0]);
        if (!password_verify($accountModel->getPassword(), $account->getPassword())) {
            return false;
        }
        return $account;
    }

    private function getLoginAccountModel(object $result): AccountModel
    {
        $accountModel = new AccountModel();
        $accountModel->setId($result->id);
        $accountModel->setEmail($result->email);
        $accountModel->setName($result->name);
        $accountModel->setPassword($result->password);
        return $accountModel;
    }
}