<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ListFilmController extends Controller
{
    public function execute()
    {
        try {
            $films = $this->get('app.component.listFilm')->__invoke();
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => $ex->getMessage()]));
        }

        return new JsonResponse($films);
    }
}
