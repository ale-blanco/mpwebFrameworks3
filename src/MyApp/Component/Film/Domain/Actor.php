<?php

namespace MyApp\Component\Film\Domain;

use MyApp\Component\Film\Domain\Exception\ActorNameNotValidException;

class Actor implements \JsonSerializable
{
    private $idactor;
    private $name;

    public function __construct(string $name)
    {
        if ($name == '') {
            throw new ActorNameNotValidException();
        }
        $this->name = $name;
    }

    public function getIdactor(): int
    {
        return $this->idactor;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->idactor,
            'name' => $this->getName()
        ];
    }
}
