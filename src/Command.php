<?php namespace Acme;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class Command extends SymfonyCommand
{
    protected $database;

    public function __construct(DatabaseAdapter $database)
    {
        $this->database = $database;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('add')
            ->setDescription('Add a new task');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

    }

    protected function showTasks(OutputInterface $output)
    {
        if (!$tasks = $this->database->fetchAll('tasks')) {
            return $output->writeln('<info>No Tasks at the moment!</info>');
        }

        $table = new Table($output);

        $table->setHeaders(['Id', 'Description'])
            ->setRows($tasks)
            ->render();
    }
}
