<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\Infrastructure;

use Doctrine\DBAL\Connection;
use Freyr\MT\MergeTrain\DomainModel\Changes\ChangeSourceRepository;
use Freyr\MT\MergeTrain\DomainModel\Deployment;
use Freyr\MT\MergeTrain\DomainModel\DeploymentRepository;
use Freyr\MT\MergeTrain\DomainModel\DomainEvent;
use Freyr\MT\MergeTrain\DomainModel\NewChangesWereSynchronizedUpTo;
use Freyr\MT\MergeTrain\DomainModel\ProjectId;

class DeploymentDbRepository implements DeploymentRepository
{
    public function __construct(private Connection $db, private ChangeSourceRepository $changeSourceRepository)
    {
    }

    public function get(ProjectId $projectId): Deployment
    {
        //

        return Deployment::loadFromDb($this->changeSourceRepository);
    }

    public function persist(Deployment $deployment)
    {
        $eventExtractor = fn(): array => $this->popEvents();
        /** @var DomainEvent[] $events */
        $events = $eventExtractor->call($deployment);
        //start transactyion
        foreach ($events as $event) {
            match (get_class($event)) {
                NewChangesWereSynchronizedUpTo::class => $this->onNewChangesWereSynchronizedUpTo($event)
            };

        }
        //commit transaction


        foreach ($events as $event) {
            // emmiting domain events to LOCAL listeners for read model etc...
            $this->publisher->publish($event);
        }
    }

    private function onNewChangesWereSynchronizedUpTo(NewChangesWereSynchronizedUpTo $event)
    {
        //$this->db->
    }
}
