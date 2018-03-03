<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Actor;

use MyApp\Component\Film\Domain\Repository\ActorRepository;

class ListActor
{
    private $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function __invoke()
    {
        return $this->actorRepository->findAllActors();
    }
}
