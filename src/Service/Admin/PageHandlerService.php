<?php
namespace App\Service\Admin;

use App\Service\Content\PageService;

use Doctrine\ORM\EntityManagerInterface;

class PageHandlerService extends AbstractContentHandlerService
{
	public function __construct(EntityManagerInterface $em, PageService $page_service)
	{
        parent::__construct($em, $page_service);
    }

}
