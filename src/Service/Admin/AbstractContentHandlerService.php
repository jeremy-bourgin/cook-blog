<?php
namespace App\Service\Admin;

use App\Entity\ContentEntity;
use App\Service\Content\AbstractContentService;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractContentHandlerService
{
    protected $em;
    protected $content_service;

	public function __construct(EntityManagerInterface $em, AbstractContentService $content_service)
	{
        $this->em = $em;
        $this->content_service = $content_service;
    }

    public function save(ContentEntity $o): void
    {
        $this->em->persist($o);
		$this->em->flush();
    }

    public function delete(int $id): void
    {
        $o = $this->content_service->getById($id);

        $this->em->remove($o);
        $this->em->flush();
    }
}
