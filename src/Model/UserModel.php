<?php

namespace App\Model;
/**
 * Created by PhpStorm.
 * User: mkowal
 * Date: 11.06.2019
 * Time: 15:42
 */
class UserModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @var string
     */
    private $password;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserModel
     */
    public function setId(int $id): UserModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return UserModel
     */
    public function setFirstName(string $firstName): UserModel
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserModel
     */
    public function setLastName(string $lastName): UserModel
    {
        $this->lastName = $lastName;
        return $this;
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
     * @return UserModel
     */
    public function setEmail(string $email): UserModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     * @return UserModel
     */
    public function setGender(string $gender): UserModel
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return UserModel
     */
    public function setIsActive(bool $isActive): UserModel
    {
        $this->isActive = $isActive;
        return $this;
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
     * @return UserModel
     */
    public function setPassword(string $password): UserModel
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return UserModel
     */
    public function setCreatedAt(\DateTime $createdAt): UserModel
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return UserModel
     */
    public function setUpdatedAt(\DateTime $updatedAt): UserModel
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }




}