<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

interface ChangeSourceRepository
{

    public function load(HeadPointer $latestPointer, HeadPointer $headPointer): Changes;
}
