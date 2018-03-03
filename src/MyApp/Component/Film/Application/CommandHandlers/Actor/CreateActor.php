<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Actor;

use MyApp\Component\Film\Application\Commands\Actor\CreateActorComm;
use MyApp\Component\Film\Domain\Actor;
use MyApp\Component\Film\Domain\Exception\ExistActorWithNameException;
use MyApp\Component\Film\Domain\Repository\ActorRepository;

class CreateActor
{
    private $repository;

    public function __construct(ActorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateActorComm $command): Actor
    {
        $actor = new Actor($command->getName());
        if ($this->repository->findOneByName($actor) !== null) {
            throw new ExistActorWithNameException();
        }

        $this->repository->save($actor);
        return $actor;
    }
}
