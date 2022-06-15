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
    public function saveAccount(array $data): string
    {
        $token = Functions::generateToken();
        $parameters = [':email' => strtolower($data['email']), ':password' => Functions::encodePassword($data['password']), ':name' => ucwords(strtolower($data['name'])), ':token' => $token];
        $database = new Database();
        $database->insert('INSERT INTO account (email, password, name, token) VALUES(:email, :password, :name, :token)', $parameters);
        return $token;
    }
}