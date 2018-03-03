<?php

namespace MyApp\Component\Film\Domain\Exception;

class NotAllActorsExistException extends \Exception implements ValidationException
{
    public function __construct()
    {
        parent::__construct('Not all actors exists');
    }
}
