<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Application\Commands\Film\CreateFilmComm;
use MyApp\Component\Film\Domain\Exception\ExistFilmWithNameException;
use MyApp\Component\Film\Domain\Film;
use MyApp\Component\Film\Domain\Repository\ActorRepository;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class CreateFilm extends GetActorsAbstract
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository, ActorRepository $actorRepository)
    {
        parent::__construct($actorRepository);
        $this->filmRepository = $filmRepository;
    }

    public function __invoke(CreateFilmComm $command): Film
    {
        $actors = $this->getActors($command->getActorIds());

        $film = new Film($command->getName(), $command->getDescription(), $actors);
        if (count($this->filmRepository->findOneByName($film)) > 0) {
            throw new ExistFilmWithNameException();
        }

        $this->filmRepository->save($film);
        return $film;
    }
}
