<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ListActorController extends Controller
{
    public function execute()
    {
        try {
            $films = $this->get('app.component.listActor')->__invoke();
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => 'Error']));
        }

        return new JsonResponse($films);
    }
}
