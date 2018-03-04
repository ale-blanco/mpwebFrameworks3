<?php

namespace MyApp\Bundle\FilmBundle\Film\Controller;

use MyApp\Component\Film\Application\Commands\Film\ListOneFilmComm;
use MyApp\Component\Film\Domain\Exception\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ListOneFilmController extends Controller
{
    public function execute(string $id)
    {
        $command = new ListOneFilmComm($id ?? '');
        $data = [];
        try {
            $data['film'] = $this->get('app.component.listOneFilm')->__invoke($command);
        } catch (ValidationException $ex) {
            return new Response($ex->getMessage(), 400);
        } catch (\Exception $ex) {
            return new Response('Error', 500);
        }

        return $this->render('@film/Resources/view/listOneFilm.html.twig', $data);
    }
}
