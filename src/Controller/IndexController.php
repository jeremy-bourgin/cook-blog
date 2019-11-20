<?php
namespace App\Controller;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
	implements IControllerSubscriber
{
	use ControllerSubscriberTrait;
	
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
