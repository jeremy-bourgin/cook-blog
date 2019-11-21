<?php
namespace App\Controller;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;
use App\Service\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
	implements IControllerSubscriber
{
	use ControllerSubscriberTrait;
	
    private $article_service;

    public function __construct(ArticleService $article_service)
    {
        $this->article_service = $article_service;
    }

    /**
     * @Route("/article/{{url}}", name="article")
     */
    public function index(string $url)
    {
        $article = $this->article_service->getByUrl($url);

        return $this->render('article/index.html.twig', array(
            'article' => $article,
        ));
    }
}
