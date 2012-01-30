<?php
namespace Jeka\CategoryBundle\Command;

use \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class NormalizePositionsCommand extends ContainerAwareCommand{


    function configure()
    {
        $this->setName('shop:categories-positions')
            ->setDescription('Normalization positions of categoris');
    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $this->getContainer()->get('jeka.category_manager')->normalizePositions();
        $output->writeln("<info>Positions was normalized</info>");
    }
}