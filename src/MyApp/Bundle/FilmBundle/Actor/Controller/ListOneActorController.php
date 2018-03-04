<?php

namespace MyApp\Bundle\FilmBundle\Actor\Controller;

use MyApp\Component\Film\Application\Commands\Actor\ListOneActorComm;
use MyApp\Component\Film\Domain\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ListOneActorController extends Controller
{
    public function execute(string $id)
    {
        $command = new ListOneActorComm($id ?? '');
        $data = [];
        try {
            $data['actor'] = $this->get('app.component.listOneActor')->__invoke($command);
        } catch (ValidationException $ex) {
            return new Response($ex->getMessage(), 400);
        } catch (\Exception $ex) {
            return new Response('Error', 500);
        }

        return $this->render('@film/Resources/view/listOneActor.html.twig', $data);
    }
}
