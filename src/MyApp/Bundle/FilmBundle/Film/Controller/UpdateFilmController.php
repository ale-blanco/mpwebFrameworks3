<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use MyApp\Component\Film\Application\Commands\Film\UpdateFilmComm;
use MyApp\Component\Film\Domain\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UpdateFilmController extends Controller
{
    public function execute(Request $request, string $id)
    {
        $json = json_decode($request->getContent(), true);
        $command = new UpdateFilmComm(
            $id,
            $json['name'] ?? '',
            $json['description'] ?? '',
            $json['actors'] ?? []
        );

        try {
            $filmCreated = $this->get('app.component.updateFilm')->__invoke($command);
        } catch (ValidationException $ex) {
            throw new HttpException(400, json_encode(['error' => $ex->getMessage()]));
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => $ex->getMessage()]));
        }

        return new Response(json_encode($filmCreated), 200);
    }
}
