<?php
namespace App\Service\Admin;

use App\Entity\ArticleEntity;
use App\Service\Content\ArticleService;

use Doctrine\ORM\EntityManagerInterface;

class ArticleHandlerService extends AbstractContentHandlerService
{
	public function __construct(EntityManagerInterface $em, ArticleService $article_service)
	{
        parent::__construct($em, $article_service);
    }

}
