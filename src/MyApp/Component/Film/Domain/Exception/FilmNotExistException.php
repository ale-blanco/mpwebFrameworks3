<?php

namespace MyApp\Component\Film\Domain\Exception;

class FilmNotExistException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Film id not exist');
    }
}
