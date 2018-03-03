<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Application\Commands\Film\DeleteFilmComm;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class DeleteFilm
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function __invoke(DeleteFilmComm $command)
    {
        $this->filmRepository->deleteFilm($command->getId());
    }
}
