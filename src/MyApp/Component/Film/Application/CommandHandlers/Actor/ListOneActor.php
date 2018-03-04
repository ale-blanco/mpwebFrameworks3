<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Actor;

use MyApp\Component\Film\Application\Commands\Actor\ListOneActorComm;
use MyApp\Component\Film\Domain\Actor;
use MyApp\Component\Film\Domain\Repository\ActorRepository;

class ListOneActor
{
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function __invoke(ListOneActorComm $command): Actor
    {
        return $this->actorRepository->findOneByIdOrException( $command->getId());
    }
}
