<?php

namespace MyApp\Component\Film\Domain\Exception;

class ActorInFilmException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Actor in film, remove of all films first');
    }
}
