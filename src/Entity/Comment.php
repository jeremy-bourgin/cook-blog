<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(
 *	name="cblog_comment",
 *	indexes={
 *	 @ORM\Index(name="IDX_COMMENT_ARTICLE_ID", columns={"id_article"})
 *	}
 * )
 * @ORM\Entity
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
	private $id;
	
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
	private $message;
	
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=20, nullable=false)
     */
	private $name;
	
    /**
     * @var int
     *
     * @ORM\Column(name="time", type="bigint", nullable=false)
     */
	private $time;

    /**
     * @var \Article
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments")
     * @ORM\JoinColumn(name="id_article", referencedColumnName="id", onDelete="CASCADE")
     */
	private $article;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }
	
	
}
