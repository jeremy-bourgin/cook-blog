<?php
namespace App\Controller\Content;

use App\Service\Content\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $article_service;

    public function __construct(ArticleService $article_service)
    {
        $this->article_service = $article_service;
    }

    /**
     * @Route("/", name="index")
     * @Route("/p/{offset}", name="index_pagined")
     */
    public function index(int $offset=1)
    {
        $articles = $this->article_service->getAllFromPage($offset - 1);
        $nb_page = $this->article_service->getNbPage();

        return $this->render('content/index.html.twig', array(
            "articles" => $articles,
            "current_page" => $offset,
            "nb_page" => $nb_page
        ));
    }

}
