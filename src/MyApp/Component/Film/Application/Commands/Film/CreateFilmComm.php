<?php

namespace MyApp\Component\Film\Application\Commands\Film;

class CreateFilmComm
{
    private $name;
    private $description;
    private $actorIds;

    public function __construct(string $name, string $description, array $actorIds)
    {
        $this->name = $name;
        $this->description = $description;
        $this->actorIds = $actorIds;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getActorIds(): array
    {
        return $this->actorIds;
    }
}
