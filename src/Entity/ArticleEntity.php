<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 * @ORM\Entity
 * @ORM\Table(
 *	name="cblog_article",
 * 	uniqueConstraints={
 *	 @ORM\UniqueConstraint(name="UC_ARTICLE_URL",columns={"url"})
 *	},
 *	indexes={
	 @ORM\Index(name="IDX_ARTICLE_URL", columns={"url"}),
 *	 @ORM\Index(name="IDX_ARTICLE_USER_ID", columns={"id_user"})
 *	}
 * )
 */
class ArticleEntity extends ContentEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="time", type="bigint", nullable=false)
     */
	private $time;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserEntity")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="SET NULL")
     */
	private $user;
	
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="CommentEntity", mappedBy="article")
     */
	private $comments;
	
    /**
     * Constructor
     */
    public function __construct()
    {
		$this->comments = new ArrayCollection();
    }
	
	
}
