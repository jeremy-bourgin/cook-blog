<?php
namespace App\Service;

use App\Entity\ConfigEntity;
use App\Exception\Config\ConfigNotFoundException;

use Doctrine\ORM\EntityManagerInterface;

class ConfigService
{
	private $em;
	
	private $config_entity;
	private $all_config;
	private $map_config;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
		$rep = $this->em->getRepository(ConfigEntity::class);
		
		$this->config_entity = $rep->findAll();
		$this->all_config = array();
		$this->map_config = array();
		
		foreach ($this->config_entity as $i => &$e)
		{
			$name = $e->getName();
			$value = $e->getValue();
			
			$this->all_config[$name] = $value;
			$this->map_config[$name] = $i;
		}
	}

	public function hasConfig(string $name): bool
	{
		return (array_key_exists($name, $this->map_config));
	}
	
	public function getConfigEntityByName(string $name): ConfigEntity
	{
		if (!$this->hasConfig($name))
		{
			throw new ConfigNotFoundException($name);
		}
		else
		{
			$i = $this->map_config[$name];
			$o = $this->config_entity[$i];
		}
		
		return $o;
	}
	
	public function getConfigEntities(): array
	{
		return $this->config_entity;
	}
	
	public function getConfigValue(string $name)
	{
		if (!$this->hasConfig($name))
		{
			throw new ConfigNotFoundException($name);
		}
		
		return $this->all_config[$name];
	}
	
	public function getAllConfig(): array
	{
		return $this->all_config;
	}

}
