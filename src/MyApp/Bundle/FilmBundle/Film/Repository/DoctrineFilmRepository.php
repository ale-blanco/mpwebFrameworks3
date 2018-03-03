<?php

namespace MyApp\Bundle\FilmBundle\Film\Repository;

use Doctrine\ORM\EntityRepository;
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

    public function findOneByName(Film $film): ?Film
    {
        return $this->findOneBy(['name' => $film->getName()]);
    }
}
