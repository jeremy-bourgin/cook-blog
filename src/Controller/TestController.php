<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
	/**
	 * @Route("/", methods={"GET"})
	 */
	public function testAction()
	{
        return $this->render('index.html.twig', array(
            
        ));
	}
}
