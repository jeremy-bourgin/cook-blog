<?php
namespace App\Service\Content;

use App\Entity\ContentEntity;
use App\Exception\Content\ContentNotFoundException;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractContentService
{	
	protected $em;
	protected $rep;

	protected $counted = null;
	
	public function __construct(EntityManagerInterface $em, ObjectRepository $rep)
	{
		$this->em = $em;
		$this->rep = $rep;
	}
	
	protected function paginedRequest(QueryBuilder $request, int $page, int $limit): void
	{
		$request->setFirstResult($limit * $page);
		$request->setMaxResults($limit);
	}

	protected function idFilterRequest(QueryBuilder $request, int $id): void
	{
		$request->where("c.id = :id");
		$request->setParameter("id", $id);
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
	
	protected function createGetIdRequest(int $id): QueryBuilder
	{
		$request = $this->createGetRequest();
		$this->idFilterRequest($request, $id);
		
		return $request;
	}

	protected function createGetUrlRequest(string $url): QueryBuilder
	{
		$request = $this->createGetRequest();
		$this->urlFilterRequest($request, $url);
		
		return $request;
	}
	
	protected function createGetAllFromPageRequest(int $page, int $limit): QueryBuilder
	{
		$request = $this->createGetRequest();
		$this->paginedRequest($request, $page, $limit);
		
		return $request;
	}

	public function getById(int $id): ContentEntity
	{
		$request = $this->createGetIdRequest($id);

		$query = $request->getQuery();
		$result = $query->getOneOrNullResult();
		
		if ($result === null)
		{
			throw new ContentNotFoundException();
		}
		
		return $result;
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
	
	public function getAllFromPage(int $page, int $limit): array
	{
		$request = $this->createGetAllFromPageRequest($page, $limit);
		
		$query = $request->getQuery();
		$result = $query->getResult();
		
		return $result;
	}
	
	public function getAll(): array
	{
		$request = $this->rep->createQueryBuilder("c");
		$request->addOrderBy("c.id", "DESC");
		
		$query = $request->getQuery();
		$result = $query->getResult();
		
		return $result;
	}

	public function countAll(): int
	{
		if ($this->counted === null)
		{
			$this->counted = $this->rep->createQueryBuilder('c')
            	->select('count(c)')
            	->getQuery()
            	->getSingleScalarResult();
		}

		return $this->counted;
	}
}
