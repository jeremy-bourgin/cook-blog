<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 * @ORM\Entity
 * @ORM\Table(name="cblog_config")
 */
class ConfigEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
	 * @ORM\Id
     */
	private $name;
	
    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false)
     */
	private $value;
	
	
}
