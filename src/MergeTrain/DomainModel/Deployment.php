<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

class Deployment
{

    private HeadPointer $latestPointer;
    private Changes $changes;

    public function __construct(private ChangeSourceRepository $changeSourceRepository)
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
        $this->changes->intersect($changes);
        //ommit merges between: ////
    }
}
