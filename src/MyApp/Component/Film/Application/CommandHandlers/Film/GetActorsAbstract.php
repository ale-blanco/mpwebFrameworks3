<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Domain\Exception\NotAllActorsExistException;
use MyApp\Component\Film\Domain\Repository\ActorRepository;

abstract class GetActorsAbstract
{
    protected $actorRepository;

    public function __construct(ActorRepository $actorRepository)
    {
        $this->actorRepository = $actorRepository;
    }

    public function getActors(array $actorIds): array
    {
        $actors = $this->actorRepository->findByIds($actorIds);
        if (count($actors) !== count($actorIds)) {
            throw new NotAllActorsExistException();
        }

        return $actors;
    }
}
