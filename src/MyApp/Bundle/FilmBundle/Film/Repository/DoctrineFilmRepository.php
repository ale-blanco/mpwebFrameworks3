<?php

namespace MyApp\Bundle\FilmBundle\Film\Repository;

use Doctrine\ORM\EntityRepository;
use MyApp\Component\Film\Domain\Exception\FilmNotExistException;
use MyApp\Component\Film\Domain\Film;
use MyApp\Component\Film\Domain\Repository\FilmRepository;

class DoctrineFilmRepository extends EntityRepository implements FilmRepository
{
    public function save(Film $film): void
    {
        $em = $this->getEntityManager();
        $em->persist($film);
        $em->flush();
    }

    public function findByName(Film $film): array
    {
        return $this->findBy(['name' => $film->getName()]);
    }

    public function findOneByIdOrException(string $id): Film
    {
        $film = $this->findOneBy(['idfilm' => $id]);
        if ($film == null) {
            throw new FilmNotExistException();
        }

        return $film;
    }

    public function findAllFilms(): array
    {
        return $this->findAll();
    }
}
