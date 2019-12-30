<?php
namespace App\Service\Content;

use App\Entity\ContentEntity;
use App\Exception\ContentNotFoundException;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractContentService
{
	const LIMIT_PAGE = 4;
	
	protected $em;
	protected $rep;

	protected $counted = null;
	
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
	
	protected function createGetAllFromPageRequest(int $page): QueryBuilder
	{
		$request = $this->createGetRequest();
		$this->paginedRequest($request, $page);
		
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
	
	public function getAllFromPage(int $page): array
	{
		$request = $this->createGetAllFromPageRequest($page);
		
		$query = $request->getQuery();
		$result = $query->getResult();
		
		return $result;
	}
	
	public function getAll(): array
	{
		$request = $this->rep->createQueryBuilder("c");
		$request->orderBy("c.id", "DESC");
		
		$query = $request->getQuery();
		$result = $query->getResult();
		
		return $result;
	}

	public function count(): int
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

	public function getNbPage(): int
	{
		$count = $this->count();
		$nb_page = ceil($count / self::LIMIT_PAGE);

		return $nb_page;
	}
}
