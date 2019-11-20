<?php
namespace App\Service;

use App\Entity\ContentEntity;
use App\Exception\ContentNotFoundException;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractContentService
{
	const LIMIT_PAGE = 10;
	
	protected $em;
	protected $rep;
	
	public function __construct(EntityManagerInterface $em, ObjectRepository $rep)
	{
		$this->em = $em;
		$this->rep = $rep;
	}
	
	protected function paginedRequest(QueryBuilder $request, int $page): void
	{
		$request->setFirstResult(self::LIMIT_PAGE * $page);
		$request->setMaxResults(self::LIMIT_PAGE);
	}
	
	protected function urlFilterRequest(QueryBuilder $request, string $url): void
	{
		$request->where("c.url = :url");
		$request->setParameter("url", $url);
	}
	
	protected function createGetRequest(): QueryBuilder
	{
		$request = $this->rep->createQueryBuilder("c");
		
		return $request;
	}
	
	protected function createGetUrlRequest(string $url): QueryBuilder
	{
		$request = $this->createGetRequest();
		$this->urlFilterRequest($request, $url);
		
		return $request;
	}
	
	protected function createGetAllFromPageRequest(int $page): QueryBuilder
	{
		$request = $this->createGetRequest();
		$this->paginedRequest($request, $page);
		
		return $request;
	}
	
	public function getByUrl(string $url): ContentEntity
	{
		$request = $this->createGetUrlRequest($url);
		
		$query = $request->getQuery();
		$result = $query->getOneOrNullResult();
		
		if ($result === null)
		{
			throw new ContentNotFoundException();
		}
		
		return $result;
	}
	
	public function getAllFromPage(int $page): array
	{
		$request = $this->createGetAllFromPageRequest($page);
		
		$query = $request->getQuery();
		$result = $query->getResult();
		
		return $result;
	}
}
