<?php

namespace MyApp\Bundle\FilmBundle\Actor\Repository;

use Doctrine\ORM\EntityRepository;
use MyApp\Component\Film\Domain\Actor;
use MyApp\Component\Film\Domain\Repository\ActorRepository;

class DoctrineActorRepository extends EntityRepository implements ActorRepository
{
    public function save(Actor $actor): void
    {
        $em = $this->getEntityManager();
        $em->persist($actor);
        $em->flush();
    }

    public function findOneByName(Actor $actor): ?Actor
    {
        return $this->findOneBy(['name' => $actor->getName()]);
    }

    public function findByIds(array $ids): array
    {
        return $this->findBy(['idactor' => $ids]);
    }
}
