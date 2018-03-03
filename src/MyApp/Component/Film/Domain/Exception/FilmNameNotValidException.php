<?php

namespace MyApp\Component\Film\Domain\Exception;

class FilmNameNotValidException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Film name not valid');
    }
}
