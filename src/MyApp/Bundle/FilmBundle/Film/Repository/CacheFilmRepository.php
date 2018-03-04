<?php

namespace MyApp\Bundle\FilmBundle\Film\Repository;

use Doctrine\Common\Cache\CacheProvider;
use MyApp\Component\Film\Domain\Film;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class CacheFilmRepository implements FilmRepository
{
    private $repository;
    private $cacheProvider;

    public function __construct(FilmRepository $repository, CacheProvider $cacheProvider)
    {
        $this->repository = $repository;
        $this->cacheProvider = $cacheProvider;
    }

    public function save(Film $film): void
    {
        $this->repository->save($film);
    }

    public function findByName(Film $film): array
    {
        return $this->repository->findByName($film);
    }

    public function findOneByIdOrException(string $id): Film
    {
        $key = self::getKey($id);
        if ($this->cacheProvider->contains($key)) {
            return $this->cacheProvider->fetch($key);
        }

        $film = $this->repository->findOneByIdOrException($id);
        $film->setActors($film->getActors()->toArray());
        $this->cacheProvider->save($key, $film);
        return $film;
    }

    public function findAllFilms(): array
    {
        return $this->repository->findAllFilms();
    }

    public function deleteFilm(string $id): void
    {
        $this->repository->deleteFilm($id);
    }

    public static function getKey(string $id): string
    {
        return 'film_' . $id;
    }
}
