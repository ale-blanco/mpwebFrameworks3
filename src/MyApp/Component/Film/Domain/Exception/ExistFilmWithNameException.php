<?php

namespace MyApp\Component\Film\Domain\Exception;

class ExistFilmWithNameException extends \Exception implements ValidationException
{
    public function __construct()
    {
        parent::__construct('Already exist a film with that name');
    }
}
