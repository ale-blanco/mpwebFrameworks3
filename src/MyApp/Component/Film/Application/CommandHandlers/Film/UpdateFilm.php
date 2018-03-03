<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Application\Commands\Film\UpdateFilmComm;
use MyApp\Component\Film\Domain\Exception\ExistFilmWithNameException;
use MyApp\Component\Film\Domain\Repository\ActorRepository;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class UpdateFilm extends GetActorsAbstract
{
    private $filmRepostiory;

    public function __construct(FilmRepository $filmRepostiory, ActorRepository $actorRepository)
    {
        parent::__construct($actorRepository);
        $this->filmRepostiory = $filmRepostiory;
    }

    public function __invoke(UpdateFilmComm $command)
    {
        $actors = $this->getActors($command->getActorIds());

        $film = $this->filmRepostiory->findOneByIdOrException($command->getId());
        $film->setName($command->getName());
        $film->setDescription($command->getDescription());
        $film->setActors($actors);

        $existentes = $this->filmRepostiory->findByName($film);
        foreach ($existentes as $existente) {
            if ($existente->getIdfilm() != $film->getIdfilm()) {
                throw new ExistFilmWithNameException();
            }
        }

        $this->filmRepostiory->save($film);
        return $film;
    }
}
