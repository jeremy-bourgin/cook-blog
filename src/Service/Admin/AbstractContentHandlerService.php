<?php
namespace App\Service\Admin;

use App\Entity\ContentEntity;
use App\Service\Content\AbstractContentService;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractContentHandlerService
{
    protected $em;

	public function __construct(EntityManagerInterface $em)
	{
        $this->em = $em;
    }

    public function save(ContentEntity $o): void
    {
        $this->em->persist($o);
		$this->em->flush();
    }

    public function delete(ContentEntity $o): void
    {
        $this->em->remove($o);
        $this->em->flush();
    }
}
