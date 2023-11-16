<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

use Freyr\MT\MergeTrain\DomainModel\Changes\Changes;
use Freyr\MT\MergeTrain\DomainModel\Changes\ChangeSourceRepository;

class Deployment extends AggregateRoot
{

    private function __construct(
        private ChangeSourceRepository $changeSourceRepository,
        private Changes $changes,
        private HeadPointer $latestPointer,
        private ProjectId $projectId
    )
    {
        //
    }

    public static function init(ProjectId $projectId, HeadPointer $headPointer): Deployment
    {
        $deployment = new Deployment();

        $event = new NewDeploymentWasCreated();
        $deployment->emit($event);

        return $deployment;
    }

    public static function loadFromDb(ProjectId $projectId, HeadPointer $headPointer): Deployment
    {

    }

    public function synchronizeChangesUpTo(HeadPointer $headPointer): void
    {
        if ($this->latestPointer === $headPointer) {
            return;
        }
        if ($this->changes->contains($headPointer->sha)) {
            return;
        }

        $changes = $this->changeSourceRepository->load($this->latestPointer, $headPointer);


        $changesAdded = $this->changes->intersect($changes);
        $this->latestPointer = $headPointer;

        $event = new NewChangesWereSynchronizedUpTo($this->projectId, $changesAdded, $this->latestPointer);
        $this->emit($event);
    }
}
