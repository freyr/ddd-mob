<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

abstract class AggregateRoot
{
    protected  array $events = [];

    protected function emit(NewChangesWereSynchronizedUpTo $event): void
    {
        $this->events[] = $event;
    }

    protected function popEvents(): array
    {
        $events = $this->events;
        $this->events = [];
        return $events;
    }
}
