<?php

namespace core\repository;

use core\classes\Database;
use core\classes\Functions;
use core\enum\RoleEnum;
use core\enum\StatusEnum;
use core\exception\CustomException;
use core\model\AccountModel;
use DateTime;
use Exception;

class AccountRepository
{

    /**
     * @throws CustomException
     */
    public function activateAccount(string $token): bool
    {
        $parameters = [':token' => $token];
        $database = new Database();
        $result = $database->select('SELECT id FROM account WHERE token = :token AND status = "inactive"', $parameters);
        if (count($result) != 1) {
            return false;
        }
        $parameters = [':id' => $result[0]->id];
        return $database->update('UPDATE account SET token = null, status = "active" WHERE id = :id', $parameters);
    }

    /**
     * @throws CustomException
     */
    public function existsByEmail(string $email): bool
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
    public function existsByName(string $name): bool
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
     * @throws Exception
     */
    public function findByAccount(int $id): ?AccountModel
    {
        $parameters = [':id' => $id];
        $database = new Database();
        $result = $database->select('SELECT * FROM account WHERE id = :id', $parameters);
        if (count($result) != 1) {
            return null;
        }
        return $this->setAccount($result[0]);
    }

    /**
     * @throws CustomException
     */
    public function findByEmail(string $email): ?AccountModel
    {
        $parameters = [':email' => $email];
        $database = new Database();
        $result = $database->select('SELECT id, email, name, status, token from account WHERE email = :email', $parameters);
        if (count($result) != 1) {
            return null;
        }
        return $this->setFindByEmailAccount($result[0]);
    }

    /**
     * @throws CustomException
     */
    public function findByTokenAndStatusActive(string $token): ?AccountModel
    {
        $parameters = [':token' => $token];
        $database = new Database();
        $result = $database->select('SELECT id FROM account WHERE token = :token AND status = "active"', $parameters);
        if (count($result) != 1) {
            return null;
        }
        $accountModel = new AccountModel();
        $accountModel->setId($result[0]->id);
        return $accountModel;
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
    }

    /**
     * @throws CustomException
     */
    public function savePassword(int $accountId, string $password): bool
    {
        $parameters = [':password' => Functions::encodePassword($password), ':id' => $accountId];
        $database = new Database();
        return $database->update('UPDATE account SET password = :password WHERE id = :id', $parameters);
    }

    /**
     * @throws CustomException
     */
    public function saveSession(int $accountId, string $session): bool
    {
        $parameters = [':session' => $session, ':id' => $accountId];
        $database = new Database();
        return $database->update('UPDATE account SET session = :session WHERE id = :id', $parameters);
    }

    /**
     * @throws CustomException
     */
    public function saveToken(int $accountId, ?string $token): bool
    {
        $parameters = [':token' => $token, ':id' => $accountId];
        $database = new Database();
        return $database->update('UPDATE account SET token = :token WHERE id = :id', $parameters);
    }

    /**
     * @throws CustomException
     */
    public function validateLogin(string $email, string $password): ?AccountModel
    {
        $parameters = [':email' => $email];
        $database = new Database();
        $result = $database->select("SELECT id, email, name, password FROM account WHERE email = :email AND status = 'active' AND deleted_at IS NULL", $parameters);
        if (count($result) != 1) {
            return null;
        }
        $account = $result[0];
        if (!password_verify($password, $account->password)) {
            return null;
        }
        return $this->setValidateLoginAccount($account);
    }

    /**
     * @throws Exception
     */
    private function setAccount(object $account): AccountModel
    {
        $accountModel = new AccountModel();
        $this->setAccountFirstData($accountModel, $account);
        $this->setAccountSecondData($accountModel, $account);
        return $accountModel;
    }

    /**
     * @throws Exception
     */
    private function setAccountFirstData(AccountModel $accountModel, object $account): void
    {
        $accountModel->setId($account->id);
        $accountModel->setEmail($account->email);
        $accountModel->setName($account->name);
        $accountModel->setPassword($account->password);
        $accountModel->setAvatar($account->avatar);
        $accountModel->setBelly($account->belly);
        $accountModel->setCreatedAt(new DateTime($account->created_at));
        $accountModel->setDeletedAt($account->deleted_at == null ? null : new DateTime($account->deleted_at));
    }

    /**
     * @throws Exception
     */
    private function setAccountSecondData(AccountModel $accountModel, object $account): void
    {
        $accountModel->setExperience($account->experience);
        $accountModel->setGold($account->gold);
        $accountModel->setLevel($account->level);
        $accountModel->setRole(RoleEnum::from($account->role));
        $accountModel->setSession($account->session);
        $accountModel->setStatus(StatusEnum::from($account->status));
        $accountModel->setToken($account->token);
        $accountModel->setUpdatedAt(new DateTime($account->updated_at));
    }

    private function setFindByEmailAccount(object $account): AccountModel
    {
        $accountModel = new AccountModel();
        $accountModel->setId($account->id);
        $accountModel->setEmail($account->email);
        $accountModel->setName($account->name);
        $accountModel->setStatus(StatusEnum::from($account->status));
        $accountModel->setToken($account->token);
        return $accountModel;
    }

    private function setValidateLoginAccount(object $account): AccountModel
    {
        $accountModel = new AccountModel();
        $accountModel->setId($account->id);
        $accountModel->setEmail($account->email);
        $accountModel->setName($account->name);
        $accountModel->setPassword($account->password);
        return $accountModel;
    }
}