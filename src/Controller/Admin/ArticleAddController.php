<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAddController extends AbstractController
{
    /**
     * @Route("%admin_path%/article/add", name="article_add")
     */
    public function index()
    {
        return $this->render('article_add/index.html.twig', [
            'controller_name' => 'ArticleAddController',
        ]);
    }
}
