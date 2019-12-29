<?php
namespace App\Service\Admin;

use Doctrine\ORM\EntityManagerInterface;

class PageHandlerService extends AbstractContentHandlerService
{
	public function __construct(EntityManagerInterface $em)
	{
        parent::__construct($em);
    }

}
