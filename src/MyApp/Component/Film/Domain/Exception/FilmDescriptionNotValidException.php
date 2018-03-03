<?php

namespace MyApp\Component\Film\Domain\Exception;

class FilmDescriptionNotValidException extends \Exception implements ValidationException
{
    public function __construct()
    {
        parent::__construct('Film description not valid');
    }
}
