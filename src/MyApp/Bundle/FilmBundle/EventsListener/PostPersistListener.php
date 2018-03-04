<?php

namespace MyApp\Bundle\FilmBundle\EventsListener;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\ORM\Event\LifecycleEventArgs;
use MyApp\Bundle\FilmBundle\Film\Repository\CacheFilmRepository;
use MyApp\Component\Film\Domain\Film;

class PostPersistListener
{
    private $cacheProvider;

    public function __construct(CacheProvider $cacheProvider)
    {
        $this->cacheProvider = $cacheProvider;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if (!$this->isValid($object)) {
            return;
        }

        $this->invalidateCache($object);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if (!$this->isValid($object)) {
            return;
        }

        $this->invalidateCache($object);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if (!$this->isValid($object)) {
            return;
        }

        $this->invalidateCache($object);
    }

    private function isValid($object): bool
    {
        return $object instanceof Film;
    }

    private function invalidateCache(Film $film)
    {
        $this->cacheProvider->delete(CacheFilmRepository::getKey($film->getIdfilm()));
    }
}
