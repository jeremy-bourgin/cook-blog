<?php
namespace App\Service\Admin;

use App\Entity\CommentEntity;

use Doctrine\ORM\EntityManagerInterface;

class CommentHandlerService
{
    private $em;

	public function __construct(EntityManagerInterface $em)
	{
        $this->em = $em;
    }

    public function delete(CommentEntity $comment): void
    {
        $this->em->remove($o);
        $this->em->flush();
    }
}
