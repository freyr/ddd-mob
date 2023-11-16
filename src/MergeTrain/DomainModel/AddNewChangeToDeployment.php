<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

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
        $deployment->synchronizeChangesUpTo($headPointer, $this->changeSourceRepository);
        $this->repository->persist($deployment);
    }
}
