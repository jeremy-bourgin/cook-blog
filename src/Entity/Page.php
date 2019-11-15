<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 * @ORM\Entity
 * @ORM\Table(name="cblog_page")
 */
class Page extends Content
{
	const TEMPLATE_FILE = "content/page.twig.html";
	
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
	private $content;
	
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
}
