<?php

namespace MyApp\Component\Film\Domain\Exception;

class ExistActorWithNameException extends \Exception implements ValidationException
{
    public function __construct()
    {
        parent::__construct('Already exist a actor with that name');
    }
}
