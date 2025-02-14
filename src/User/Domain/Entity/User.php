<?php

namespace App\User\Domain\Entity;

use App\Shared\Domain\Entity\AggregateRoot;
use App\User\Domain\Event\CreatedUserEvent;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class User extends AggregateRoot implements UserInterface
{
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private string $id;
    public function __construct(
        private string $name,
        private string $email,
        private bool $active = false,
        private ?string $password = null,
        private ?string $avatar = null,
        private ?string $token = null,
        private ?string $resetPasswordToken = null,
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->setEmail($email);
        $this->createdAt = new \DateTime();
        $this->token = \sha1(\uniqid(\mt_rand(), true));
        $this->markAsUpdated();
    }

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
        if (!\filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw new \LogicException('Invalid email');
        }
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

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     */
    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
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

    /**
     * @return string|null
     */
    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    /**
     * @param string|null $resetPasswordToken
     */
    public function setResetPasswordToken(?string $resetPasswordToken): void
    {
        $this->resetPasswordToken = $resetPasswordToken;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }


    public function getRoles(): array
    {
       return [];
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}