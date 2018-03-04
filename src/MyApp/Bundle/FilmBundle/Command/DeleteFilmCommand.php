<?php

namespace MyApp\Bundle\FilmBundle\Command;

use MyApp\Component\Film\Application\Commands\Film\DeleteFilmComm;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteFilmCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this
            ->setName('film:delete')
            ->setDescription('Delete a film')
            ->addArgument('id', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new DeleteFilmComm($input->getArgument('id'));
        $this->getContainer()->get('app.component.deleteFilm')->__invoke($command);
        $output->writeln('Deleted');
    }
}
