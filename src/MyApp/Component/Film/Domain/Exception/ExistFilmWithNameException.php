<?php

namespace MyApp\Component\Film\Domain\Exception;

class ExistFilmWithNameException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Already exist a film with that name');
    }
}
