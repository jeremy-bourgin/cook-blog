<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ArticleEntity
 *
 * @ORM\Entity
 * @ORM\Table(
 *	name="cblog_article",
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

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(?UserEntity $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|CommentEntity[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(CommentEntity $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(CommentEntity $comment): self
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

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }


}
