<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

final readonly class Sha
{
    public string $long;
    public string $short;

    public function __construct(string $sha)
    {
        if (strlen($sha) !== 40) {
            throw new \UnexpectedValueException();
        }
        $this->long = $sha;
        $this->short = substr($sha, 0, 8);
    }
}
