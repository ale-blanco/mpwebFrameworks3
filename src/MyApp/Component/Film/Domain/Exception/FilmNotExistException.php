<?php

namespace MyApp\Component\Film\Domain\Exception;

class FilmNotExistException extends \Exception implements ValidationException
{
    public function __construct()
    {
        parent::__construct('Film id not exist');
    }
}
