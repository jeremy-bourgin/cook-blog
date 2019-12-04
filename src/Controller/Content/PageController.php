<?php
namespace App\Controller\Content;

use App\Service\Content\PageService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
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
