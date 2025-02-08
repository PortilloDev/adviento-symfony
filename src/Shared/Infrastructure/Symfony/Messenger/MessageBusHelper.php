<?php

namespace App\Shared\Infrastructure\Symfony\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessageBusHelper
{
    public function __construct(private MessageBusInterface $bus)
    {
    }

    public function dispatchAndGetResult(object $message): mixed
    {
        $envelope = $this->bus->dispatch($message);
        $handledStamp = $envelope->last(HandledStamp::class);
        return $handledStamp ? $handledStamp->getResult() : null;
    }
}