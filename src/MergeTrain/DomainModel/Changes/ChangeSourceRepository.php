<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel\Changes;

use Freyr\MT\MergeTrain\DomainModel\HeadPointer;

interface ChangeSourceRepository
{

    public function load(HeadPointer $latestPointer, HeadPointer $headPointer): Changes;
}
