<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel\Changes;

use Freyr\MT\MergeTrain\DomainModel\Sha;

class ChangeId
{

    readonly public Sha $sha;
}
