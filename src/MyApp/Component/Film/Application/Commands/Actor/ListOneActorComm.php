<?php

namespace MyApp\Component\Film\Application\Commands\Actor;

class ListOneActorComm
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
