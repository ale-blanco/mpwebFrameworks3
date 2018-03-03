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
        $this->setName($name);
        $this->setDescription($description);
        $this->setActors($actors);
    }

    public function getIdfilm(): int
    {
        return $this->idfilm;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if ($name == '') {
            throw new FilmNameNotValidException();
        }

        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        if ($description == '') {
            throw new FilmDescriptionNotValidException();
        }

        $this->description = $description;
    }

    public function getActors(): ArrayCollection
    {
        return $this->actors;
    }

    public function setActors(array $actors): void
    {
        foreach ($actors as $actor) {
            if (!$actor instanceof Actor) {
                throw new ActorInstanceNotValidException();
            }
        }

        $this->actors = new ArrayCollection($actors);
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
