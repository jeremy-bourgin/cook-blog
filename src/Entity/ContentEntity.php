<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ContentEntity
 *
 * @ORM\MappedSuperclass
 * @UniqueEntity(
 *  fields="url",
 *  message="unique_url"
 * )
 */
abstract class ContentEntity
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
     * @Assert\Length(max=100)
     * @ORM\Column(name="url", type="string", length=100, nullable=false, unique=true)
     */
	private $url;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @Assert\Length(max=100)
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
	private $title;

    /**
     * @var string
     *
     * @Assert\NotBlank
     * @ORM\Column(name="content", type="text", nullable=false)
     */
	private $content;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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


}
