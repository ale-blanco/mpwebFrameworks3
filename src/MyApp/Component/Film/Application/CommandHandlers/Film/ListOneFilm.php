<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Application\Commands\Film\ListOneFilmComm;
use MyApp\Component\Film\Domain\Film;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class ListOneFilm
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function __invoke(ListOneFilmComm $command): Film
    {
        return $this->filmRepository->findOneByIdOrException($command->getId());
    }
}
