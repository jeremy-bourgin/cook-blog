<?php
namespace App\Command\Config;

use App\Entity\ConfigEntity;
use App\Service\ConfigService;
use App\Service\Admin\ConfigHandlerService;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallConfigCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:config:install';

    private $config_service;
    private $config_handler_service;

    public function __construct(ConfigService $config_service, ConfigHandlerService $config_handler_service)
    {
        parent::__construct();

        $this->config_service = $config_service;
        $this->config_handler_service = $config_handler_service;
    }

    protected function configure()
    {
        $this
            ->setDescription('Initialize configs data');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = array(
            'site_title' => array(
                'raw_value' => 'blog',
                'full_name' => 'Titre du site',
                'type'      => ConfigEntity::STRING_TYPE
            ),
            'pagination_size' => array(
                'raw_value' => 4,
                'full_name' => 'Nombre d\'articles par page',
                'type'      => ConfigEntity::INT_TYPE
            ),
            'contact_enable' => array(
                'raw_value' => true,
                'full_name' => 'Activer le formulaire de contact',
                'type'      => ConfigEntity::BOOL_TYPE
            ),
            'contact_email' => array(
                'raw_value' => 'admin@localhost',
                'full_name' => 'Adresse mail de contact',
                'type'      => ConfigEntity::STRING_TYPE
            ),
            'comment_enable' => array(
                'raw_value' => true,
                'full_name' => 'Activer les commentaires',
                'type'      => ConfigEntity::BOOL_TYPE
            )
        );

        foreach ($data as $name => &$e)
        {
            if ($this->config_service->hasConfig($name))
            {
                continue;
            }

            $raw_value = $e['raw_value'];
            $full_name = $e['full_name'];
            $type = $e['type'];

            $this->config_handler_service->add($name, $raw_value, $full_name, $type);
        }
    }
}
