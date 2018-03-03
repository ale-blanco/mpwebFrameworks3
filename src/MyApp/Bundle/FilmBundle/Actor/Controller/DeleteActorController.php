<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use MyApp\Component\Film\Application\Commands\Actor\DeleteActorComm;
use MyApp\Component\Film\Domain\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeleteActorController extends Controller
{
    public function execute(string $id)
    {
        try {
            $this->get('app.component.deleteActor')->__invoke(new DeleteActorComm($id));
        } catch (ValidationException $ex) {
            throw new HttpException(400, json_encode(['error' => $ex->getMessage()]));
        } catch (\Exception $ex) {
            throw new HttpException(500, json_encode(['error' => 'Error' . $ex->getMessage()]));
        }

        return new Response('', 200);
    }
}
