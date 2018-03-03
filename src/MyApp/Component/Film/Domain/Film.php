<?php

namespace MyApp\Component\Film\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use MyApp\Component\Film\Domain\Exception\ActorInstanceNotValidException;
use MyApp\Component\Film\Domain\Exception\FilmDescriptionNotValidException;
use MyApp\Component\Film\Domain\Exception\FilmNameNotValidException;

class Film implements \JsonSerializable
{
    private $idfilm;
    private $name;
    private $description;
    private $actors;

    public function __construct(string $name, string $description, array $actors)
    {
        if ($name == '') {
            throw new FilmNameNotValidException();
        }

        if ($description == '') {
            throw new FilmDescriptionNotValidException();
        }

        $this->name = $name;
        $this->description = $description;
        $this->actors = new ArrayCollection();
        foreach ($actors as $actor) {
            if (!$actor instanceof Actor) {
                throw new ActorInstanceNotValidException();
            }
            $this->actors->add($actor);
        }
    }

    public function getIdfilm(): int
    {
        return $this->idfilm;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getActors(): ArrayCollection
    {
        return $this->actors;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->idfilm,
            'name' => $this->name,
            'description' => $this->description,
            'actors' => $this->actors->toArray()
        ];
    }
}
