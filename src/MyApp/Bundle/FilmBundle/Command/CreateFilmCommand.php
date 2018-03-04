<?php

namespace MyApp\Bundle\FilmBundle\Command;

use MyApp\Component\Film\Application\Commands\Film\CreateFilmComm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateFilmCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('film:create')
            ->setDescription('Create a film')
            ->addArgument('name', InputArgument::REQUIRED)
            ->addArgument('description', InputArgument::REQUIRED)
            ->addArgument('actors', InputArgument::REQUIRED, 'Ids separados por comas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $actorIds = explode(',', $input->getArgument('actors') ?? '');
        $command = new CreateFilmComm(
            $input->getArgument('name'),
            $input->getArgument('description'),
            $actorIds
        );
        $film = $this->getContainer()->get('app.component.createFilm')->__invoke($command);
        $output->write(json_encode($film, JSON_PRETTY_PRINT));
    }
}
