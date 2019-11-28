<?php
namespace App\Controller\Content;

use App\EventSubscriber\Interfaces\IControllerSubscriber;
use App\EventSubscriber\Traits\ControllerSubscriberTrait;
use App\Service\ArticleService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
	implements IControllerSubscriber
{
	const CONTENT_LIMIT = 50;

	use ControllerSubscriberTrait;

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

        return $this->render('index/index.html.twig', [
            "articles" => $articles,
			"content_limit" => self::CONTENT_LIMIT
        ]);
    }

}
