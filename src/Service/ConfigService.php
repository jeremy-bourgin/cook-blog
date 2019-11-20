<?php
namespace App\Service;

use App\Entity\ConfigEntity;
use App\Exception\ConfigNotFoundException;

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
	
	private function getConfigEntity(): ConfigEntity
	{
		if (!array_key_exists($name, $this->map_config))
		{
			$o = new ConfigEntity();
			$o->setName($name);
		}
		else
		{
			$o = $this->config_entity[$name];
		}
		
		return $o;
	}
	
	public function getConfigValue($name): string
	{
		if (!array_key_exists($name, $this->all_config))
		{
			throw new ConfigNotFoundException($name);
		}
		
		return $this->all_config[$name];
	}
	
	public function getAllConfig(): array
	{
		return $this->all_config;
	}
	
	public function setConfig($name, $value): void
	{
		$o = $this->getConfigEntity();
		$o->setValue($value);
		
		$this->em->persist($o);
		$this->em->flush();
	}
}
