<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigEntity
 *
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
	
    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=false)
	 * @ORM\Id
     */
	private $full_name;
	
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
	private $description;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
