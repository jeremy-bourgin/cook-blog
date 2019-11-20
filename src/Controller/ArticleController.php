<?php
namespace App\Controller;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
	implements IControllerSubscriber
{
	use ControllerSubscriberTrait;
	
    /**
     * @Route("/article/{{url}}", name="article")
     */
    public function index(string $url)
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
        ]);
    }
}
