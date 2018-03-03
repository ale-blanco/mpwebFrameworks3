<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use MyApp\Component\Film\Application\Commands\Actor\CreateActorComm;
use MyApp\Component\Film\Domain\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CreateActorController extends Controller
{
    public function execute(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $command = new CreateActorComm(
            $json['name'] ?? ''
        );

        try {
            $filmCreated = $this->get('app.component.createActor')->__invoke($command);
        } catch (ValidationException $ex) {
            throw new HttpException(400, json_encode(['error' => $ex->getMessage()]));
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => 'Error']));
        }

        return new Response(json_encode($filmCreated), 200);
    }
}
