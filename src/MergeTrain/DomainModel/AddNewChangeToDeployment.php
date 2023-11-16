<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

use Freyr\MT\MergeTrain\DomainModel\Changes\ChangeSourceRepository;

final readonly class AddNewChangeToDeployment
{

    public function __construct(
        private DeploymentRepository $repository,
        private ChangeSourceRepository $changeSourceRepository
    )
    {
    }

    public function __invoke(ProjectId $projectId, HeadPointer $headPointer): void
    {
        $deployment = $this->repository->get($projectId);
        if (!$deployment) {
            $deployment = Deployment::init($projectId, $headPointer);
            $deployment = Deployment::loadFromDb($projectId, $headPointer);
        }

        $events = $deployment->synchronizeChangesUpTo($headPointer, $this->changeSourceRepository);
        $this->repository->persist($deployment);


    }
}
