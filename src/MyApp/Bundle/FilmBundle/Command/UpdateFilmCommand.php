<?php

namespace MyApp\Bundle\FilmBundle\Command;

use MyApp\Component\Film\Application\Commands\Film\UpdateFilmComm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateFilmCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('film:update')
            ->setDescription('Actualiza una pelicula')
            ->addArgument('id', InputArgument::REQUIRED)
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('description', InputArgument::REQUIRED)
            ->addArgument('actors', InputArgument::REQUIRED, 'Ids separados por comas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $actorIds = explode(',', $input->getArgument('actors') ?? '');
        $command = new UpdateFilmComm(
            $input->getArgument('id'),
            $input->getArgument('name'),
            $input->getArgument('description'),
            $actorIds
        );
        $film = $this->getContainer()->get('app.component.updateFilm')->__invoke($command);
        $output->write(json_encode($film, JSON_PRETTY_PRINT));
    }
}
