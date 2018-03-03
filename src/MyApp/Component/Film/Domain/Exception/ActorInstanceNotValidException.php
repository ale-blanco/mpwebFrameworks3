<?php

namespace MyApp\Component\Film\Domain\Exception;

class ActorInstanceNotValidException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Type Actor not valid');
    }
}
