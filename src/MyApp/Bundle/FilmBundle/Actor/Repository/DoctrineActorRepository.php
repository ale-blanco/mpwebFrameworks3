<?php

namespace MyApp\Bundle\FilmBundle\Actor\Repository;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Doctrine\ORM\EntityRepository;
use MyApp\Component\Film\Domain\Actor;
use MyApp\Component\Film\Domain\Exception\ActorInFilmException;
use MyApp\Component\Film\Domain\Exception\ActorNotExistException;
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

    public function findAllActors(): array
    {
        return $this->findAll();
    }

    public function deleteActor(string $id): void
    {
        $em = $this->getEntityManager();
        $actor = $em->getReference('FilmBundle:Actor', $id);
        try {
            $em->remove($actor);
            $em->flush();
        } catch (ForeignKeyConstraintViolationException $ex) {
            throw new ActorInFilmException();
        }
    }

    public function findOneByIdOrException(string $id): Actor
    {
        $actor = $this->findOneBy(['idactor' => $id]);
        if ($actor == null) {
            throw new ActorNotExistException();
        }

        return $actor;
    }
}
