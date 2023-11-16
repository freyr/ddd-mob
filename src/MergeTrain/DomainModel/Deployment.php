<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

class Deployment
{

    private HeadPointer $latestPointer;

    public function __construct(private ChangeSourceRepository $changeSourceRepository)
    {
    }

    public function synchronizeChangesUpTo(HeadPointer $headPointer): void
    {
        $changes = $this->changeSourceRepository->load($this->latestPointer, $headPointer);
        // remove duplicates


        //ommit merges between: ////
    }
}
