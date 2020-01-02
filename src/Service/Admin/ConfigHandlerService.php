<?php
namespace App\Service\Admin;

use App\Entity\ConfigEntity;
use App\Service\ConfigService;

use Doctrine\ORM\EntityManagerInterface;

class ConfigHandlerService
{
    private $em;
    private $config_service;

    public function __construct(EntityManagerInterface $em, ConfigService $config_service)
    {
        $this->em = $em;
        $this->config_service = $config_service;
    }

    public function add(string $name, string $value, string $full_name, ?int $type = null): void
    {
        $o = new ConfigEntity($name);

        if ($type !== null)
        {
            $o->setType($type); // must be setted before value
        }
        
        $o->setValue($value);
        $o->setFullName($full_name);

        $this->save($o);
    }

	public function update(string $name, ?string $value = null, ?string $full_name = null, ?string $desc = null, ?int $type = null): void
	{
        $o = $this->config_service->getConfigEntityByName($name);
        
        if ($type !== null)
        {
            $o->setType($type); // must be setted before value
        }

        if ($value !== null)
        {
            $o->setValue($value);
        }

        if ($full_name !== null)
        {
            $o->setFullName($full_name);
        }

        if ($desc !== null)
        {
            $o->setDescription($desc);
        }
		
		$this->save($o);
    }
    
    public function delete(string $name): void
    {
        $o = $this->config_service->getConfigEntityByName($name);

        $this->em->remove($o);
        $this->em->flush();
    }

    public function save(ConfigEntity $o)
    {
        $this->em->persist($o);
        $this->em->flush();
    }
}
