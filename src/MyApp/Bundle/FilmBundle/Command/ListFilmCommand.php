<?php

namespace MyApp\Bundle\FilmBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListFilmCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('film:list')
            ->setDescription('Lista las peliculas guardadas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $films = $this->getContainer()->get('app.component.listFilm')->__invoke();
        $output->write(json_encode($films, JSON_PRETTY_PRINT));
    }
}
