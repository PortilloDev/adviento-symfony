<?php

namespace App\User\Application\Event;

use App\Shared\Domain\Bus\HandlerInterface;
use App\User\Domain\Event\CreatedUserEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CreatedUserEventHandler implements HandlerInterface
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function __invoke(CreatedUserEvent $event): void
    {
        $email = (new Email())
            ->from($event->email)
            ->to($event->email)
            ->subject('Welcome!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }

}