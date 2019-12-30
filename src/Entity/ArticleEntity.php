<?php
namespace App\Entity;

use App\Entity\Interfaces\IFileEntity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

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
class ArticleEntity extends ContentEntity implements IFileEntity
{
    const SUMMARIZE_MAXLENGTH = 255;
    const DEFAULT_IMAGE = "article-no-image.png";

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(max=ArticleEntity::SUMMARIZE_MAXLENGTH)
     * @ORM\Column(name="summarize", type="string", length=ArticleEntity::SUMMARIZE_MAXLENGTH, nullable=false)
     */
    private $summarize;

    /**
     * @ORM\Column(name="filename", type="string", length=255, nullable=false, options={"default" : ArticleEntity::DEFAULT_IMAGE})
     */
    private $filename = self::DEFAULT_IMAGE;

    /**
     * @Assert\File()
     * @Assert\Image() 
     */
    private $file;

    private $old_filename = null;

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

    public function getSummarize(): ?string
    {
        return $this->summarize;
    }

    public function setSummarize(string $summarize): self
    {
        $this->summarize = $summarize;

        return $this;
    }

    /* BEGIN : Image handler part */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        if ($filename === null)
        {
            $filename = self::DEFAULT_IMAGE;
        }

        $this->filename = $filename;

        return $this;
    }

    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file = null): self
    {
        $this->file = $file;

        if ($this->filename !== self::DEFAULT_IMAGE)
        {
            $this->old_filename = $this->filename;
        }

        return $this;
    }

    public function getOldFilename(): ?string
    {
        return $this->old_filename;
    }
    /* END : Image handler part */
}
