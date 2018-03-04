<?php

namespace MyApp\Component\Film\Domain\Exception;

class ActorNotExistException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Actor id not exist');
    }
}
