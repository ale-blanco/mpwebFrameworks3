<?php

namespace MyApp\Component\Film\Application\Commands\Film;

class UpdateFilmComm extends CreateFilmComm
{
    private $id;

    public function __construct(string $id, string $name, string $description, array $actorIds)
    {
        parent::__construct($name, $description, $actorIds);
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
