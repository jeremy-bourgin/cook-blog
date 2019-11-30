<?php
namespace App\Service\Content;

use App\Entity\PageEntity;

use Doctrine\ORM\EntityManagerInterface;

class PageService extends AbstractContentService
{
	public function __construct(EntityManagerInterface $em)
	{
		$rep = $em->getRepository(PageEntity::class);
		
		parent::__construct($em, $rep);
	}
	
}
