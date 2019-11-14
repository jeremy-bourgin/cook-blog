<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Block
 * @ORM\Entity
 * @ORM\Table(
 *	name="block",
 *	uniqueConstraints={
 *	 @ORM\UniqueConstraint(name="UC_BLOCK_ROUTE_ORDER",columns={"route", "order"})
 *	}
 * )
 */
class Block extends Content
{
	const TEMPLATE_FILE = "content/block.twig.html";
	
    /**
     * @var string
     *
     * @ORM\Column(name="route", type="string", length=255, nullable=false)
     */
	private $route;
	
    /**
     * @var int
     *
     * @ORM\Column(name="order", type="bigint", nullable=false)
     */
	private $order;
	
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Content")
     * @ORM\JoinTable(name="block_assignment",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_block", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_content", referencedColumnName="id")
     *   }
     * )
     */

	private $blocks;
	
    /**
     * Constructor
     */
    public function __construct()
    {
		$this->blocks = new ArrayCollection();
    }
	
	public function getTemplateFile(): string
	{
		return TEMPLATE_FILE;
	}
}
