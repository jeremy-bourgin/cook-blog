<?php
namespace App\Service\Content;

use App\Entity\ArticleEntity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class ArticleService extends AbstractContentService
{
	public function __construct(EntityManagerInterface $em)
	{
		$rep = $em->getRepository(ArticleEntity::class);

		parent::__construct($em, $rep);
	}

	protected function join(QueryBuilder $request, bool $with_comments, bool $with_user): void
	{
		if ($with_comments)
		{
			$request->leftJoin("c.comments", "com");
			$request->addSelect("com");
		}

		if ($with_user)
		{
			$request->innerJoin("c.user", "u");
			$request->addSelect("u");
		}
	}

	protected function createGetUrlRequest(string $url, bool $with_comments = true, bool $with_user = true): QueryBuilder
	{
		$request = parent::createGetUrlRequest($url);
		$this->join($request, $with_comments, $with_user);

		return $request;
	}

	protected function createGetAllFromPageRequest(int $page, bool $with_comments = true, bool $with_user = true): QueryBuilder
	{
		$request = parent::createGetAllFromPageRequest($page);
		$this->join($request, $with_comments, $with_user);
		$request->orderBy("c.time", "DESC");

		return $request;
	}
}
