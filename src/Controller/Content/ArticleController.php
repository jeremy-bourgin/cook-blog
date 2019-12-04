<?php
namespace App\Controller\Content;

use App\Service\Content\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $article_service;

    public function __construct(ArticleService $article_service)
    {
        $this->article_service = $article_service;
    }

    /**
     * @Route("/article/{url}", name="article")
     */
    public function index(string $url)
    {
        $article = $this->article_service->getByUrl($url);

        return $this->render('content/article.html.twig', array(
            'article' => $article,
        ));
    }
}
