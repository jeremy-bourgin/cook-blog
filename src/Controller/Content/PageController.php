<?php
namespace App\Controller\Content;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
	implements IControllerSubscriber
{
	use ControllerSubscriberTrait;

    /**
     * @Route("/page/{url}", name="page")
     */
    public function index($url)
    {
        return $this->render('content/page.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
