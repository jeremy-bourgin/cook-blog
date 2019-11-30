<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleUpdateController extends AbstractController
{
    /**
     * @Route("%admin_path%/article/update/{id}", name="article_update")
     */
    public function index(int $id)
    {
        return $this->render('article_update/index.html.twig', [
            'controller_name' => 'ArticleUpdateController',
        ]);
    }
}
