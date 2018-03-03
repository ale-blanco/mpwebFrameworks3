<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Actor;

use MyApp\Component\Film\Application\Commands\Actor\DeleteActorComm;
use MyApp\Component\Film\Domain\Repository\ActorRepository;

class DeleteActor
{
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function __invoke(DeleteActorComm $command)
    {
        $this->actorRepository->deleteActor($command->getId());
    }
}
