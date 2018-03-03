<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Application\Commands\Film\CreateFilmComm;
use MyApp\Component\Film\Domain\Exception\ExistFilmWithNameException;
use MyApp\Component\Film\Domain\Exception\NotAllActorsExistException;
use MyApp\Component\Film\Domain\Film;
use MyApp\Component\Film\Domain\Repository\ActorRepository;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class CreateFilm
{
    private $filmRepository;
    private $actorRepository;

    public function __construct(FilmRepository $filmRepository, ActorRepository $actorRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->actorRepository = $actorRepository;
    }

    public function __invoke(CreateFilmComm $command): Film
    {
        $actors = $this->actorRepository->findByIds($command->getActorIds());
        if (count($actors) !== count($command->getActorIds())) {
            throw new NotAllActorsExistException();
        }

        $film = new Film($command->getName(), $command->getDescription(), $actors);
        if ($this->filmRepository->findOneByName($film) !== null) {
            throw new ExistFilmWithNameException();
        }

        $this->filmRepository->save($film);
        return $film;
    }
}
