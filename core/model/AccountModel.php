<?php

namespace core\model;

use core\enum\RoleEnum;
use core\enum\StatusEnum;

class AccountModel extends AbstractModel
{

    private int $avatar;
    private int $belly;
    private string $email;
    private int $experience;
    private int $gold;
    private int $level;
    private string $password;
    private RoleEnum $role;
    private ?string $session;
    private StatusEnum $status;
    private ?string $token;

    /**
     * @return int
     */
    public function getAvatar(): int
    {
        return $this->avatar;
    }

    /**
     * @param int $avatar
     */
    public function setAvatar(int $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return int
     */
    public function getBelly(): int
    {
        return $this->belly;
    }

    /**
     * @param int $belly
     */
    public function setBelly(int $belly): void
    {
        $this->belly = $belly;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getExperience(): int
    {
        return $this->experience;
    }

    /**
     * @param int $experience
     */
    public function setExperience(int $experience): void
    {
        $this->experience = $experience;
    }

    /**
     * @return int
     */
    public function getGold(): int
    {
        return $this->gold;
    }

    /**
     * @param int $gold
     */
    public function setGold(int $gold): void
    {
        $this->gold = $gold;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return RoleEnum
     */
    public function getRole(): RoleEnum
    {
        return $this->role;
    }

    /**
     * @param RoleEnum $role
     */
    public function setRole(RoleEnum $role): void
    {
        $this->role = $role;
    }

    /**
     * @return string|null
     */
    public function getSession(): ?string
    {
        return $this->session;
    }

    /**
     * @param string|null $session
     */
    public function setSession(?string $session): void
    {
        $this->session = $session;
    }

    /**
     * @return StatusEnum
     */
    public function getStatus(): StatusEnum
    {
        return $this->status;
    }

    /**
     * @param StatusEnum $status
     */
    public function setStatus(StatusEnum $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }
}