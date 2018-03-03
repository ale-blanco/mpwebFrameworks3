<?php

namespace MyApp\Component\Film\Application\CommandHandlers\Film;

use MyApp\Component\Film\Domain\Repository\FilmRepository;

class ListFilm
{
    private $filmRepository;

    public function __construct(FilmRepository $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }

    public function __invoke(): array
    {
        return $this->filmRepository->findAllFilms();
    }
}
