<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel\Changes;

use Freyr\MT\MergeTrain\DomainModel\Sha;

class Changes
{
    /**
     * @var array<int, Change>
     */
    private $changes = [];
    public function add(Change $change): void
    {
        $this->changes[] = $change;
    }
    public function intersect(Changes $changes): Changes
    {
        $addedChanges = new Changes();
        /** @var Change $change */
        foreach ($changes as $change) {
            if (!$this->contains($change->changeId->sha)) {
                $this->add($change);
                $addedChanges->add($change);
            }
        }

        return $addedChanges;
    }

    public function contains(Sha $sha): bool
    {
        foreach ($this->changes as $change) {
            if ($change->changeId->sha === $sha) {
                return true;
            }
        }

        return false;
    }
}
