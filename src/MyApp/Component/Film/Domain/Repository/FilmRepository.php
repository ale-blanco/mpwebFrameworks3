<?php

namespace MyApp\Component\Film\Domain\Repository;

use MyApp\Component\Film\Domain\Film;

interface FilmRepository
{
    public function save(Film $film): void;
    public function findOneByName(Film $film): ?Film;
}
