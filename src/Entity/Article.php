<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 * @ORM\Entity
 * @ORM\Table(
 *	name="article",
 *	indexes={
 *	 @ORM\Index(name="IDX_ARTICLE_USER_ID", columns={"id_user"})
 *	}
 * )
 */
class Article extends Content
{
	const TEMPLATE_FILE = "content/article.twig.html";
	
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
	private $content;
	
    /**
     * @var int
     *
     * @ORM\Column(name="time", type="bigint", nullable=false)
     */
	private $time;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
	private $user;
	
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article")
     */
	private $comments;
	
    /**
     * Constructor
     */
    public function __construct()
    {
		$this->comments = new ArrayCollection();
    }

	public function getTemplateFile(): string
	{
		return TEMPLATE_FILE;
	}
}
