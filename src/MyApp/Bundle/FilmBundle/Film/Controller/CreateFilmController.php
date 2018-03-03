<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use MyApp\Component\Film\Application\Commands\Film\CreateFilmComm;
use MyApp\Component\Film\Domain\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreateFilmController extends Controller
{
    public function execute(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $command = new CreateFilmComm(
            $json['name'] ?? '',
            $json['description'] ?? '',
            $json['actors'] ?? []
        );

        try {
            $filmCreated = $this->get('app.component.createFilm')->__invoke($command);
        } catch (ValidationException $ex) {
            throw new HttpException(400, json_encode(['error' => $ex->getMessage()]));
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => $ex->getMessage()]));
        }
        
        return new Response(json_encode($filmCreated), 200);
    }
}
