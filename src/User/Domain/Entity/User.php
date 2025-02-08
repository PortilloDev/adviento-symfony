<?php

namespace App\User\Domain\Entity;

use App\Shared\Domain\Entity\AggregateRoot;
use App\User\Domain\Event\CreatedUserEvent;

class User extends AggregateRoot
{
    private int $id;
    public function __construct(
        private string $name,
        private string $email,
        private string $password,
    ) {}

    public static function create(string $name, string $email, string $password): self
    {
        $user = new self($name, $email, $password);
        $user->events[] = new CreatedUserEvent($user->getEmail());
        return $user;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }



    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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




}