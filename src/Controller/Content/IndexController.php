<?php
namespace App\Controller\Content;

use App\Service\ConfigService;
use App\Service\Content\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $config_service;
    private $article_service;

    public function __construct(ConfigService $config_service, ArticleService $article_service)
    {
        $this->config_service = $config_service;
        $this->article_service = $article_service;
    }

    /**
     * @Route(
     *  "/",
     *  name="index",
     *  methods={"GET"}
     * )
     * 
     * @Route(
     *  "/p/{offset}",
     *  name="index_pagined",
     *  methods={"GET"}
     * )
     */
    public function index(int $offset=1)
    {
        $limit = $this->config_service->getConfigValue('pagination_size');
        $articles = $this->article_service->getAllFromPage($offset - 1, $limit);
        $count = $this->article_service->countAll();
        $nb_page = ceil($count / $limit);

        return $this->render('content/index.html.twig', array(
            "articles" => $articles,
            "current_page" => $offset,
            "nb_page" => $nb_page
        ));
    }

}
