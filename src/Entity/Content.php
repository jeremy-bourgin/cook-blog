<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table(name="cblog_content")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="content_type", type="bigint")
 * @ORM\DiscriminatorMap({1 = "Block", 2 = "Page", 3 = "Article"})
 */
abstract class Content
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
	private $id;
	
	public abstract function getTemplateFile(): string;

    public function getId(): ?string
    {
        return $this->id;
    }
	
	
}
