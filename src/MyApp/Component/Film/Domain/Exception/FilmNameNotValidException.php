<?php

namespace MyApp\Component\Film\Domain\Exception;

class FilmNameNotValidException extends \Exception implements ValidationException
{
    public function __construct()
    {
        parent::__construct('Film name not valid');
    }
}
