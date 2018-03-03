<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use MyApp\Component\Film\Application\Commands\Film\DeleteFilmComm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeleteFilmController extends Controller
{
    public function execute(string $id)
    {
        try {
            $this->get('app.component.deleteFilm')->__invoke(new DeleteFilmComm($id));
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => 'Error']));
        }

        return new Response('', 200);
    }
}
