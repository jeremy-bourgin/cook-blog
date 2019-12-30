<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * CommentEntity
 *
 * @ORM\Table(
 *	name="cblog_comment",
 *	indexes={
 *	 @ORM\Index(name="IDX_COMMENT_ARTICLE_ID", columns={"id_article"})
 *	}
 * )
 * @ORM\Entity
 */
class CommentEntity
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
     * @Assert\NotBlank
     * @ORM\Column(name="message", type="text", nullable=false)
     */
	private $message;
	
    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(max=20)
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
     * @ORM\ManyToOne(targetEntity="ArticleEntity", inversedBy="comments")
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

    public function getArticle(): ?ArticleEntity
    {
        return $this->article;
    }

    public function setArticle(?ArticleEntity $article): self
    {
        $this->article = $article;

        return $this;
    }


}
