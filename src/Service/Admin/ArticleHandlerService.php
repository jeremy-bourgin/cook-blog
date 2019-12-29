<?php
namespace App\Service\Admin;

use App\Entity\ContentEntity;
use App\Service\UploaderService;

use Doctrine\ORM\EntityManagerInterface;

class ArticleHandlerService extends AbstractContentHandlerService
{
    protected $uploader_service;

	public function __construct(EntityManagerInterface $em, UploaderService $uploader_service)
	{
        parent::__construct($em);

        $this->uploader_service = $uploader_service;
    }

    public function save(ContentEntity $o): void
    {
        $this->uploader_service->upload($o);

        parent::save($o);
    }

    public function delete(ContentEntity $o): void
    {
        $this->uploader_service->delete($o);

        parent::delete($o);
    }
}
