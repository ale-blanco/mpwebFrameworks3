<?php

namespace MyApp\Component\Film\Domain\Exception;

class ActorNameNotValidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Actor name not valid');
    }
}
