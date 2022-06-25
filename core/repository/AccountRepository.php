<?php

namespace core\repository;

use core\classes\Database;
use core\classes\Functions;
use core\exception\CustomException;

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
    public function findByAccount(int $id): bool|object
    {
        $parameters = [':id' => $id];
        $database = new Database();
        $result = $database->select('SELECT id, email, name, role, level, belly, gold, avatar from account WHERE id = :id', $parameters);
        if (count($result) != 1) {
            return false;
        }
        return $result[0];
    }

    /**
     * @throws CustomException
     */
    public function findByEmail(string $email): bool
    {
        $parameters = [':email' => $email];
        $database = new Database();
        $result = $database->select('SELECT email from account WHERE email = :email', $parameters);
        if (count($result) != 0) {
            return true;
        }
        return false;
    }

    /**
     * @throws CustomException
     */
    public function findByName(string $name): bool
    {
        $parameters = [':name' => $name];
        $database = new Database();
        $result = $database->select('SELECT name from account WHERE name = :name', $parameters);
        if (count($result) != 0) {
            return true;
        }
        return false;
    }

    /**
     * @throws CustomException
     */
    public function saveAccount(string $name, string $email, string $password): string
    {
        $token = Functions::generateToken();
        $parameters = [':email' => strtolower($email), ':password' => Functions::encodePassword($password), ':name' => ucwords(strtolower($name)), ':token' => $token];
        $database = new Database();
        $database->insert('INSERT INTO account (email, password, name, token) VALUES(:email, :password, :name, :token)', $parameters);
        return $token;
    }

    /**
     * @throws CustomException
     */
    public function saveGold(int $accountId, int $gold): bool
    {
        $parameters = [':gold' => $gold, ':id' => $accountId];
        $database = new Database();
        return $database->update('UPDATE account SET gold = :gold WHERE id = :id', $parameters);
        //TODO: criar tabela de histórico de dados do usuário, gold, etcs
    }

    /**
     * @throws CustomException
     */
    public function validateLogin(string $email, string $password): bool|object
    {
        $parameters = [':email' => $email];
        $database = new Database();
        $result = $database->select("SELECT id, email, name, password FROM account WHERE email = :email AND status = 'active' AND deleted_at IS NULL", $parameters);
        if (count($result) != 1) {
            return false;
        }
        $account = $result[0];
        if (!password_verify($password, $account->password)) {
            return false;
        }
        return $account;
    }
}