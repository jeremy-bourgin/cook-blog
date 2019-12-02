<?php
namespace App\Command\Config;

use App\Service\Admin\ConfigHandlerService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteConfigCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:config:delete';

    private $config_handler_service;

    public function __construct(ConfigHandlerService $config_handler_service)
    {
        parent::__construct();

        $this->config_handler_service = $config_handler_service;
    }

    protected function configure()
    {
        $this
            ->setDescription('Delete a config entry');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $name = $io->ask('Entrer le nom (clé)');

        $this->config_handler_service->delete($name);

        $io->write('Le configuration a bien été supprimé');
    }
}
