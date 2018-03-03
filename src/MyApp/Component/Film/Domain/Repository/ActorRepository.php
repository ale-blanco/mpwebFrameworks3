<?php

namespace MyApp\Component\Film\Domain\Repository;

use MyApp\Component\Film\Domain\Actor;

interface ActorRepository
{
    public function save(Actor $actor): void;
    public function findOneByName(Actor $actor): ?Actor;
    public function findByIds(array $ids): array;
    public function findAllActors(): array;
}
