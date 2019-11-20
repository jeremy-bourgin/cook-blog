<?php
namespace App\Service;

use App\Entity\ArticleEntity;
use App\Entity\ArticleNotFoundException;

use Doctrine\ORM\EntityManagerInterface;

class ArticleService
{
	const LIMIT_PAGE = 10;
	
	private $em;
	private $rep;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
		$this->rep = $this->em->getRepository(ArticleEntity::class);
	}
	
	private function createGetRequest(bool $with_comments, bool $with_user)
	{
		$request = $this->rep->createQueryBuilder("a");
		
		if ($with_comments)
		{
			$request->innerJoin("a.comments", "c");
			$request->addSelect("c");
		}
		
		if ($with_user)
		{
			$request->innerJoin("a.user", "u");
			$request->addSelect("u");
		}
		
		return $request;
	}
	
	public function getByUrl(string $url, bool $with_comments = true, bool $with_user = true): ArticleEntity
	{
		$request = $this->createGetRequest($with_comments, $with_user);
		$request->where("a.url = :url");
		$request->setParameter("url", $url);
		
		$query = $request->getQuery();
		$result = $query->getOneOrNullResult();
		
		if ($result === null)
		{
			throw new ArticleNotFoundException();
		}
		
		return $result;
	}
	
	public function getAllFromPage(int $page, bool $with_comments = true, bool $with_user = true): array
	{
		$from = self::LIMIT_PAGE * $page;
		
		$request = $this->createGetRequest($with_comments, $with_user);
		$request->setFirstResult($from);
		$request->setMaxResults(self::LIMIT_PAGE);
		
		$query = $request->getQuery();
		$result = $query->getResult();
		
		return $result;
	}
}
