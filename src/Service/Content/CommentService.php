<?php
namespace App\Service\Content;

use App\Entity\ArticleEntity;
use App\Entity\CommentEntity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class CommentService
{
    private $em;
    private $rep;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->rep = $em->getRepository(CommentEntity::class);
    }

    public function getByArticle(ArticleEntity $article): array
    {
        $request = $this->rep->createQueryBuilder('c')
            ->where('c.article = :article')
            ->orderBy("c.time", "DESC")
            ->setParameter("article", $article);

        $query = $request->getQuery();
        $result = $query->getResult();

        return $result;
    }

    public function save(CommentEntity $comment): void
    {
        $this->em->persist($comment);
		$this->em->flush();
    }
}
