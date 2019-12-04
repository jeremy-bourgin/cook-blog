<?php
namespace App\Controller\Content;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;
use App\Service\Content\PageService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
	implements IControllerSubscriber
{
	use ControllerSubscriberTrait;

    private $page_service;

    public function __construct(PageService $page_service)
    {
        $this->page_service = $page_service;
    }

    /**
     * @Route("/page/{url}", name="page")
     */
    public function index(string $url)
    {
        $page = $this->page_service->getByUrl($url);

        return $this->render('content/page.html.twig', array(
            'page' => $page,
        ));
    }
}
