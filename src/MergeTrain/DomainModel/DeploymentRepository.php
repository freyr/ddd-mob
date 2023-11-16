<?php

declare(strict_types=1);

namespace Freyr\MT\MergeTrain\DomainModel;

interface DeploymentRepository
{

    public function get(ProjectId $projectId): Deployment;

    public function persist(Deployment $deployment);
}
