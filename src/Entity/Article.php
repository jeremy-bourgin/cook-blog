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
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="SET NULL")
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }
}
