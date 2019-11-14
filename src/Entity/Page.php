<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 * @ORM\Entity
 * @ORM\Table(name="page")
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
}
