<?php

namespace App\Shared\Infrastructure\Doctrine;

use Symfony\Component\Messenger\MessageBusInterface;
use App\Shared\Domain\Entity\AggregateRoot;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\Stamp\DelayStamp;
#[AsDoctrineListener(event: Events::postPersist)]
#[AsDoctrineListener(event: Events::postUpdate)]
#[AsDoctrineListener(event: Events::postFlush)]
class DoctrineEventListener
{
    protected array $events = [];

    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function postPersist(PostPersistEventArgs $args): void
    {
        $object = $args->getObject();

        if ($object instanceof AggregateRoot) {
            $this->collectEvents($object);
        }
    }

    public function postUpdate(PostUpdateEventArgs $args): void
    {
        $object = $args->getObject();

        if ($object instanceof AggregateRoot) {
            $this->collectEvents($object);
        }
    }

    private function collectEvents(AggregateRoot $aggregateRoot): void
    {
        foreach ($aggregateRoot->pullEvents() as $event) {
            $this->events[spl_object_id($event)] = $event;
        }
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        while ($event = array_shift($this->events)) {
            $this->messageBus->dispatch($event, [new DelayStamp(200)]);
        }
    }
}